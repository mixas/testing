<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends CI_Controller {

    function testing(){
        parent::__construct();
        $this->load->model('mdl_testing');
    }
    
    function show_results(){
        /*$mas = array('name' => 'mixas', 'surname' => 'shelest');
        $string = serialize($mas);
        $mas = unserialize($string);
        print_r($mas);*/
    }
    
}

?>