<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answers extends CI_Controller{

    var $table = 'answers';
    
    function answers (){
        parent::__construct();
        $this->load->model('mdl_answer');
        
    }
    
    function show($id){
        $this->mdl_question->show($id);
        render('answers/show','answer');
    }
    
    public function add(){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            if ($this->mdl_answer->add() !== false){   //!!!
                redirect('index.php/questions/edit/' . $this->input->get('question_id'));
            }
            else{
                render($this->table . '/add','create ' . $this->table);
            }
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    public function edit($id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $this->db->where('id', $id);
            $request = $this->db->get($this->table);
            $object = $request->row_array();
            if ($this->mdl_answer->update($id) !== false){   //!!!
                redirect('index.php/questions/edit/' . $this->input->get('question_id'));
            }
            else{
                render('answers/edit','edit ' . $this->table, $object);
            }
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    public function delete($id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $this->db->where('id',$id);
            $request = $this->db->get('answers');
            $answer = $request->row();
            $question_id = $answer->question_id;
            $this->mdl_answer->delete($id);   ////!!!
            redirect('index.php/questions/edit/'.$question_id);
        }
        else{
            render('errors/have_not_permissions', 'permissions error');
        }
    }
    
}

?>