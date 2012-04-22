<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_question extends crud{
    
    var $table = 'questions';
    
    var $add_rules = array(
               array(
                     'field'   => 'text',
                     'label'   => 'Text of question',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'test_id',
                     'label'   => 'id of question test',
                     'rules'   => ''
                  ),
               array(
                     'field'   => 'complexity',
                     'label'   => 'id of question test',
                     'rules'   => ''
                  )
            );
    
    var $edit_rules = array (
               array(
                     'field'   => 'text',
                     'label'   => 'Text of question',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'test_id',
                     'label'   => 'id of question test',
                     'rules'   => ''
                  ),
               array(
                     'field'   => 'complexity',
                     'label'   => 'question complexity',
                     'rules'   => ''
                  ),
               array(
                     'field'   => 'total_answers_count',
                     'label'   => 'total answers count',
                     'rules'   => ''
                  ),
               array(
                     'field'   => 'right_answers_count',
                     'label'   => 'right answers count',
                     'rules'   => ''
                  )
            );
    
    function mdl_question(){
        parent::__construct();
    }
    
    function answers($id){
        $this->db->where('question_id', $id);
        $query = $this->db->get('answers');
        $res = $query->result_array();
        return $res;
    }
    
}
?>