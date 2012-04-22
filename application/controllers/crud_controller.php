<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_controller extends CI_Controller{
    
    var $table = '';
    
    function crud_conroller(){
        parent::__construct();
        $this->load->model($this->table);
    }
    
    public function index(){
        
        render($this->table . '/index','all ' . $this->table);
        
	}
    
}

?>