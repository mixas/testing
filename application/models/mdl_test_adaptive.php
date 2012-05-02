<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_test_adaptive extends Mdl_test{
    
    var $table = 'tests';
    
    function mdl_test_adaptive(){
        parent::__construct();
    }
    
    function start_test($test_id){ 
        parent::start_test($test_id);
        
        //form array with passed questions
        $passed_question = array();
        $questions = $this->questions($test_id);
        foreach($questions as $question){
            $passed_question[$question->id] = false;
        }
        
        $this->session->set_userdata('user_level', 0);//[-5; 5]
        $this->session->set_userdata('passed_questions', $passed_question);
        $this->session->set_userdata('standart_error', 0);
    }
    
    function check_answer($ans){
        //get session data
        $current_question_id = $this->session->userdata('current_question_number');
        $passed_questions = $this->session->userdata('passed_questions');
        $user_level = $this->session->userdata('user_level');
        $test_id = $this->session->userdata('current_test');
        
        
        //get current question
        $questions = $this->questions($test_id);       
        $question = $questions[$current_question_id-1];
        $question_id = $question->id;
        
        $this->db->where('id', $ans);
        $request = $this->db->get('answers');
        $current_answer = $request->row();
        if ($current_answer){
            if ($current_answer->right == 1){
                //up user level
                $user_level = $user_level + ((abs($question->complexity) + 5) * 0.1);
                
                //no needed
                $right_answers = $this->session->userdata('right_answers');
                $right_answers += 1;
                $this->session->set_userdata('right_answers', $right_answers);
            }
            else{
                //down user level
                $user_level = $user_level - (1- ((abs($question->complexity) + 5) * 0.1));
            }
            
            //set question as passed question
            $passed_questions[$current_answer->question_id] = true;
            $this->session->set_userdata('passed_questions', $passed_questions);
            //set new user level
            $this->session->set_userdata('user_level', $user_level);
        }
    }
    
    //return true if questions over or accuracy achieved
    function is_questions_over(){
        
        $current_question = $this->session->userdata('current_question_number');
        if(($current_question >= $this->questions_count()) or ($this->is_accuracy_achieved())){
            return true;
        }
        else{
            return false;
        }
    }
    
    //return true if accuracy achieved
    private function is_accuracy_achieved(){
        $information_function = $this->test_information_function();
        
        $current_question = $this->session->userdata('current_question_number');
        //die($current_question);
        
        if ($current_question > 1){
            
            $previous_standart_error = $this->session->userdata('standart_error');
            $current_standart_error = $this->get_standart_error($information_function);
            
            //write current standart error to session. In next step this error will be previous_error.
            $this->session->set_userdata('standart_error', $current_standart_error);
            
            if (abs($previous_standart_error - $current_standart_error) < 0.01){
                //echo $previous_standart_error . ' - ' . $current_standart_error . ' = ' .abs($previous_standart_error - $current_standart_error);   
                return true;
            }
            else{
                return false;   
            }
        }
        else{
            return false;
        }
    }
    
    //ruturn information function for test in current step
    private function test_information_function(){        
        $passed_questions = $this->session->userdata('passed_questions');
        $user_level = $this->session->userdata('user_level');
        $test_id = $this->session->userdata('current_test');
        
        //information function for test equally sum of information functions for every question
        $questions = $this->questions($test_id);
        $inform_function = 0;
        foreach ($questions as $question){
            if ($passed_questions[$question->id] == true){
                $inform_function += $this->question_information_function($question->complexity, $user_level);
            }
        }
        //echo $inform_function;
        $this->session->set_userdata('test_information_function', $inform_function);
        return $inform_function;
    
    }
    
    private function get_standart_error($inform_function){
        if ($inform_function != 0){
            return (1 / sqrt($inform_function));
        }
        else{
            return 0;
        }
    }
    
    private function question_information_function($complexity, $user_level){
        return ( 1 / (1 + exp($user_level - $complexity)))*(1-(1/(1 + exp($user_level - $complexity))));
    }
    
    function get_question(){
        $test_id = $this->session->userdata('current_test');
        $user_level = $this->session->userdata('user_level');
        $current_question_number = $this->session->userdata('current_question_number');
        $passed_questions = $this->session->userdata('passed_questions');

        //get all questions and select question with necessary complexity
        $questions = $this->questions($test_id);
        
        $max = -1000;
        foreach($questions as $question){
            $complexity = $question->complexity;
            //information function of question for current user
            $information_function = $this->question_information_function($complexity, $user_level);
            if (($information_function > $max) && ($passed_questions[$question->id] == false)){
                $max = $information_function;
                $necessary_question = $question;
            }
        }
        //print_r($necessary_question);
        return $necessary_question;
    }
    
    public function get_result(){
        $user_level = $this->session->userdata('user_level');        
        // set result 0..100 points for user
        $result = $user_level * 20;
        if ($user_level >= 2.75){
            $response = 'Congratulations! You pass test, your result is <b>' . $result . '</b> points from 100 total.';
        }
        elseif($user_level < 2.75){
            $response = 'You fail test! You resut is <b>' . $result . '</b> points from 100 total. You should have minimum 55 points';
        }
        
        //write to database results for current testing session
        $this->write_to_db($result);

        $this->clear_session();
        
        $data['result'] = $response;
        return $data;
    }
    

}
?>