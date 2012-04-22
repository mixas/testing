<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_answer extends crud{
    
    var $table = 'answers';
    
    var $add_rules = array(
               array(
                     'field'   => 'text',
                     'label'   => 'Text',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'question_id',
                     'label'   => 'Number of question',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'right',
                     'label'   => 'Right answer or not',
                     'rules'   => ''
               )
            );
    
    var $edit_rules = array (
               array(
                     'field'   => 'text',
                     'label'   => 'Text',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'question_id',
                     'label'   => 'Right answer or not',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'right',
                     'label'   => 'Right answer or not',
                     'rules'   => ''
               )
            );
    
    function mdl_answer(){
        parent::__construct();
    }
    
}
?>