<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_test_classic extends Mdl_test{
    
    var $table = 'tests';
    
    function mdl_test_classic(){
        parent::__construct();
    }
    
    public function get_result(){
        //$is_testing = $this->session->userdata('testing');
        //if($is_testing){
            $questions_count = $this->questions_count();
            $right_answers = $this->session->userdata('right_answers');
            $result = ceil(100 / $questions_count * $right_answers );
            
            if($result >= 55){ 
                $response = 'Congratulations! You pass test, your result is <b>' . $result . '</b> points from 100 total';
            }
            elseif($result < 55){
                $response = 'You fail test! You resut is <b>' . $result . '</b> points from 100 total. You should have minimum 55 points';
            }
            
            //write to database results for current testing session
            $this->write_to_db($result);
    
            $this->clear_session();
            
            $data['result'] = $response;
            return $data;
        //}
        
    }
    
}
?>