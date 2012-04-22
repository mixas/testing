<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller{

    var $table = 'groups';
    
    function groups(){
        parent::__construct();
        $this->load->model('mdl_group');
    }
    
    public function index(){
        render($this->table . '/index','all ' . $this->table);
	}
    
    public function add(){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            if ($this->mdl_group->add() !== false){   //!!!!!
                redirect('index.php/' . $this->table . '/index');
            }
            else{
                render($this->table . '/add','create ' . $this->table);
            }
        }
        else{
            render('errors/have_not_permissions', 'permissions error');
        }
    }
    
    public function edit($id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $this->db->where('id',$id);
            $request = $this->db->get($this->table);
            $object = $request->row_array();
            $object['users'] = $this->mdl_group->users($id);
            if ($this->mdl_group->update($id) !== false){   //!!!
                redirect('index.php/groups/index');
            }
            else{
                render('groups/edit','edit group', $object);
            }
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    public function delete($id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $this->mdl_group->delete($id);  //!!!
            redirect('index.php/' . $this->table . '/index');
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
}

?>