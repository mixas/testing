<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_test extends crud{
    
    var $table = 'tests';
    var $testing_table = 'testing';
    
    var $add_rules = array(
               array(
                     'field'   => 'title',
                     'label'   => 'Text',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'description',
                     'label'   => 'test description',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'type',
                     'label'   => 'type of test',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'image',
                     'label'   => 'test image',
                     'rules'   => ''
                  )                  
            );
    
    var $edit_rules = array (
               array(
                     'field'   => 'title',
                     'label'   => 'Text',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'description',
                     'label'   => 'test description',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'type',
                     'label'   => 'type of test',
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'image',
                     'label'   => 'test image',
                     'rules'   => ''
                  )                  
            );
    
    function mdl_test(){
        parent::__construct();
    }
    
    function questions($test_id){
        $this->db->where('test_id',$test_id);
        $query = $this->db->get('questions');
        $questions = $query->result();
        return $questions;
    }
    
    function start_test($test_id){
        
        if($this->auth_lib->logged_in()){
            
            $user_id = $this->session->userdata('user_id');
            $begin_time = time();
            
            //insert into db entry with current user id, begin time and current test id
            $data = array('user_id' => $user_id, 'begin_time' => $begin_time, 'test_id' => $test_id);
            $this->db->insert($this->testing_table, $data);
            
            //get last_insert_id and write to session storage current testing id
            $testing_id = $this->db->insert_id();
            //set session data
            $this->session->set_userdata('testing_id', $testing_id);
            $this->session->set_userdata('current_question_number', 0);
            $this->session->set_userdata('right_answers', 0);
            $this->session->set_userdata('current_test', $test_id);
            $this->session->set_userdata('testing', 1);
        }
    }
    
    //return true if time over
    function is_time_over(){
        if (30 - ceil(abs($this->left_time() / 60)) > 0){
            return false;
        }
        else{
            return true;
        }
    }
    
    //return true if questions over
    function is_questions_over(){
        $current_question = $this->session->userdata('current_question_number');
        if($current_question < $this->questions_count()){
            return false;
        }
        else{
            return true;
        }
    }
    
    //return count of questions
    function questions_count(){
        $test_id = $this->session->userdata('current_test');
        $query = $this->db->query('SELECT COUNT(*) as count FROM questions WHERE test_id=' . $test_id);
        return $query->row('count');
    }
    
    //return current question as object
    function get_question(){
        $current_question_number = $this->session->userdata('current_question_number');
        $request = $this->db->get('questions');
        $result = $request->row($current_question_number);
        return $result;
    }
    
    //increment question number in session
    function inc_question_number(){
        $current_question_number = $this->session->userdata('current_question_number');
        $current_question_number += 1;
        $this->session->set_userdata('current_question_number', $current_question_number);
    }
    
    //return left time in minutes
    function left_time(){
        $testing_id = $this->session->userdata('testing_id');
        $this->db->where('id', $testing_id);
        $request = $this->db->get($this->testing_table);
        if ($request->num_rows() > 0){
            $result = $request->row();
            $unix_left_time = $result->begin_time - time();
            return $unix_left_time;
        }
    }
    
    //if user answer right then inc session('right_answers')
    function check_answer($ans){
        $this->db->where('id',$ans);
        $request = $this->db->get('answers');
        $current_question = $request->row();
        if ($current_question){
            if ($current_question->right == 1){
                $right_answers = $this->session->userdata('right_answers');
                $right_answers += 1;
                $this->session->set_userdata('right_answers', $right_answers);
            }
        }
    }
    
    protected function clear_session(){
        $this->session->unset_userdata('testing_id');
        $this->session->unset_userdata('current_question_number');
        $this->session->unset_userdata('right_answers');
        $this->session->unset_userdata('current_test');
        $this->session->unset_userdata('user_level');
        $this->session->unset_userdata('passed_questions');
        $this->session->set_userdata('testing', 0);
    }
    
    
    protected function write_to_db($result){
        $testing_id = $this->session->userdata('testing_id');
        $user_level = $this->session->userdata('user_level');
        $right_answers = $this->session->userdata('right_answers');
        
        $data = array(
                    'count_of_questions' => $this->questions_count(),
                    'right_answers' => $right_answers,
                    'user_level' => $result
            );
        $this->db->insert('results', $data);
        $result_id = $this->db->insert_id();
        
        //update record in 'testing' table for add result_id
        $data = array('result_id' => $result_id);
        $this->db->where('id', $testing_id);
        $this->db->update('testing', $data);
    }
    
    function get_results($test_id, $where=''){
        $request = $this->db->query('
            SELECT users.name, results.right_answers, results.count_of_questions, results.user_level, users.group_id
            FROM testing, users, results
            WHERE (testing.user_id = users.id)
            AND (testing.result_id = results.id)
            AND (testing.test_id = ' . $test_id . ')' . 
            $where
        );
        
        $result = $request->result();
        return $result;
        
    }
    
}
?>