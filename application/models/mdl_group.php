<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_group extends crud{
    
    var $table = 'groups';
    
    var $add_rules = array(
               array(
                     'field'   => 'name',
                     'label'   => 'Group name',
                     'rules'   => 'required'
                  )
            );
    
    var $edit_rules = array (
               array(
                     'field'   => 'name',
                     'label'   => 'Group name',
                     'rules'   => 'required'
                  )
            );
    
    function mdl_question(){
        parent::__construct();
    }
    
    function users($id){
        $this->db->where('group_id', $id);
        $query = $this->db->get('users');
        $res = $query->result_array();
        return $res;
    }
    
}
?>