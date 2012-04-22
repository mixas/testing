<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_user extends crud{
    
    var $table = 'users';
    var $add_rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email|is_unique[users.email]'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|MD5'
                  ),
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'group_id',
                     'label'   => 'Group',
                     'rules'   => 'required'
                  )
            );
    
    var $edit_rules = array (
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required|MD5'
                  ),
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'group_id',
                     'label'   => 'Group',
                     'rules'   => 'required'
                  )
            );
    
    function mdl_user(){
        parent::__construct();
    }
    
}
?>