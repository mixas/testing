<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    var $table = 'users';
    
    function users (){
        parent::__construct();
        $this->load->model('mdl_user');
    }

    public function index(){
        $user = $this->auth_lib->get_userdata();
        if ($user->role == 3){
            render($this->table . '/index','all ' . $this->table);
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
	}
    
    public function add(){
        if ($this->mdl_user->add() !== false){
            redirect('index.php/pages/main');
        }
        else{
            render('users/add','new account');
        }
    }
    
    public function edit($id){
        //check relationship between current user and editing user
        $this->db->where('id',$id);
        $request = $this->db->get($this->table);
        $object = $request->row_array();
        if ($this->mdl_user->update($id) !== false){
            redirect('index.php/users/index');
        }
        else{
            render('users/edit','edit profile', $object);
        }
    }
    
    public function delete($id){
        $this->mdl_user->delete($id);
        redirect('index.php/users/index');
    }
    
    public function show($id){
        $user = $this->auth_lib->get_userdata();
        if(($user->id == $id) or ($user->role == 3)){
            $data = $this->mdl_user->show($id);
            render('users/show', 'profile', $data);
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    public function show_for_admin(){
        $data = '';
        render('users/show_for_admin', 'user resuls', $data);
    }
}

?>