<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    var $rules = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Password',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required'
                  )
            );

    function auth (){
        parent::__construct();
        $this->load->library('auth_lib');
    }
    
    public function index(){
        //echo 'mixas';
    }
    
    public function login(){
        $this->form_validation->set_rules($this->rules);
        if ($this->form_validation->run()){
            $email = $this->input->post('email');
            $pass = $this->input->post('password');
            $res = $this->auth_lib->login($email,$pass);
            if ($res == true){
                redirect('index.php');
            }
            else{
                $data = array('message' => 'wrong email or password');
                render('auth/login','login',$data);
            }
        }
        else{
            render('auth/login','login');
        }
    }
    
    public function logout(){
        $this->auth_lib->logout();
        render('pages/main');
    }
    
}

?>