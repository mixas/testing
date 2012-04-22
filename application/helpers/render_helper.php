<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('render')){
    function render($path, $header = '', $data = array()){
        $CI = &get_instance();
        $data['page'] = $path;
        $data['header'] = $header;
        $CI->load->view('templates/teststyle/teststyle', $data);
    }
}

?>