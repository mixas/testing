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
    }
    
    function check_answer($ans){
        //get session data
        $current_question_id = $this->session->userdata('current_question_number');
        $passed_questions = $this->session->userdata('passed_questions');
        $user_level = $this->session->userdata('user_level');
        
        //get current question
        $this->db->where('id', $current_question_id);
        $request = $this->db->get('questions');
        $current_question = $request->row();
        
        $this->db->where('id', $ans);
        $request = $this->db->get('answers');
        $current_answer = $request->row();
        if ($current_answer){
            if ($current_answer->right == 1){
                //up user level
                $user_level = $user_level + ((abs($current_question->complexity)+5) * 0.1);
                
                //set new user level
                $this->session->set_userdata('user_level', $user_level);
                
                //no needed
                $right_answers = $this->session->userdata('right_answers');
                $right_answers += 1;
                $this->session->set_userdata('right_answers', $right_answers);
            }
            else{
                //down user level
                $user_level = $user_level + (1- ((abs($current_question->complexity) + 5) * 0.1));
            }
            
            //set question as passed question
            $passed_questions[$current_answer->question_id] = true;
            $this->session->set_userdata('passed_questions', $passed_questions);
        }        
    }
    
    //return true if questions over
    function is_questions_over(){
        $current_question = $this->session->userdata('current_question_number');
        if(($current_question < $this->questions_count()) or ($this->is_accuracy_achieved())){
            return false;
        }
        else{
            return true;
        }
    }
    
    //return true if accuracy achieved
    private function is_accuracy_achieved(){
        return false;
    }
    
    function get_question(){
        $test_id = $this->session->userdata('current_test');
        $user_level = $this->session->userdata('user_level');
        $current_question_number = $this->session->userdata('current_question_number');
        $passed_questions = $this->session->userdata('passed_questions');

        //get all questions and select question with necessary complexity
        $questions = $this->questions($test_id);
        
        $min = 1000;
        foreach($questions as $question){
            $difference = $user_level - $question->complexity;
            if ((abs($difference) < $min) && ($passed_questions[$question->id] == false)){
                $min = $difference;
                $necessary_question = $question;
            }
        }
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