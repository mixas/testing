<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller{

    var $table = 'tests';
    
    function tests(){
        parent::__construct();
        $this->load->model('mdl_test');
    }
    
    public function index(){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            render($this->table . '/index','all ' . $this->table);
        }
        else{
            render('errors/have_not_permissions', 'permissions error');
        }
	}
    
    function show($id){
        $data = $this->mdl_test->show($id);
        render('tests/show','show test', $data);
    }
    
    public function add(){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            if ($this->mdl_test->add() !== false){   //!!!!!
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
            $object['questions'] = $this->mdl_test->questions($id);
            if ($this->mdl_test->update($id) !== false){   //!!!
                redirect('index.php/tests/index');
            }
            else{
                render('tests/edit','edit test', $object);
            }
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    public function delete($id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $this->mdl_test->delete($id);  //!!!
            redirect('index.php/' . $this->table . '/index');
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    
    
    
    //testing
    function go_first($id){
        //get child model and download it
        $general_model = $this->get_child_model($id);
        $this->load->model($general_model);
        
        $this->$general_model->start_test($id);
        redirect('/index.php/tests/go');
    }
    
    function go(){
        //get child model and download it
        $test_id = $this->session->userdata('current_test');
        $general_model = $this->get_child_model($test_id);
        $this->load->model($general_model);
        
        //check user answer
        $user_answer = $this->input->post('answer');
        if (isset($user_answer)){
            $this->$general_model->check_answer($user_answer);
        }
        
        if(($this->$general_model->is_time_over()) or ($this->$general_model->is_questions_over())){
            redirect('/index.php/tests/result');
        }
        
        $question = $this->$general_model->get_question();
        $this->$general_model->inc_question_number();
        redirect('/index.php/questions/show/' . $question->id);
    }
    
    function result(){
        $test_id = $this->session->userdata('current_test');
        $general_model = $this->get_child_model($test_id);
        $this->load->model($general_model);
        
        $data = $this->$general_model->get_result();
        render('testing/result', 'result', $data);
    }
    
    function left_time(){
        echo $this->mdl_test->left_time();
    }    
    
    function get_child_model($id){
        $this->db->where('id', $id);
        $request = $this->db->get($this->table);
        if ($request->num_rows() > 0){
            $result = $request->row();
            return $result->type;
        }
    }
    
    function testfunc(){
        render('tests/test', 'graph');
    }
    
    function show_tests_tesults(){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            render('tests/show_tests_tesults', 'tests results');
        }
        else{
            render('errors/have_not_permissions', 'permissions error');
        }
    }
    
    function show_results($test_id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $data['results'] = $this->mdl_test->get_results($test_id);
            $data['test_id'] = $test_id;
            render('tests/show_results', 'users results', $data);
        }
        else{
            render('errors/have_not_permissions', 'permissions error');
        }
        
    }
    
    function get_filtred_results($test_id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $where = 'AND (users.group_id = ' . $this->input->get('group') . ')';
            $data['results'] = $this->mdl_test->get_results($test_id, $where);
            echo(json_encode($data));
        }
        else{
            render('errors/have_not_permissions', 'permissions error');
        }
    }
    
}

?>