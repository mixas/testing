<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions extends CI_Controller{

    var $table = 'questions';
    //var $mdl = 'mdl_question';
    
    function questions (){
        parent::__construct();
        $this->load->model('mdl_question');
    }
    
    function show($id){
        $data = $this->mdl_question->show($id);
        $answers = $this->mdl_question->answers($id);
        $data['answers'] = $answers;
        //$this->load->model('mdl_testing');
        render('questions/show','question',$data);
    }
    
    public function index(){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            render($this->table . '/index','all ' . $this->table);
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
	}
    
    public function add(){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            if ($this->mdl_question->add() !== false){   //!!!
                redirect('index.php/tests/edit/' . $this->input->get('test_id'));
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
            
            $complexity = $object['complexity'];
            
            $object['answers'] = $this->mdl_question->answers($id);///!!!!!!
            $object['graph_values'] = json_encode($this->get_graph_values($complexity));

            if ($this->mdl_question->update($id) !== false){//!!!
                redirect('index.php/tests/edit/' . $this->input->get('test_id'));
            }
            else{
                render('questions/edit', 'edit question', $object);
            }
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    public function delete($id){
        $user = $this->session->userdata('user_role');
        if ($user['user_role'] == 3){
            $this->db->where('id', $id);
            $request = $this->db->get('questions');
            $question = $request->row();
            $test_id = $question->test_id;
            $this->mdl_question->delete($id);   ////!!!
            redirect('index.php/tests/edit/' . $test_id);
        }
        else{
            render('errors/have_not_permissions','permissions error');
        }
    }
    
    
    private function get_graph_values($complexity){
        $values = array();
        $h = 0.05;
        for($i = -5; $i < 5; $i+=0.05){
            $key_value = array(
                'x' => $i, 
                'y' => 1/(1 + exp($i - $complexity)), 
                'f' => (1/(1 + exp($i - $complexity)))*(1-(1/(1 + exp($i - $complexity))))
            );
            /**
            * x - user level in graphic
            * y - icc value
            * f - inform function value
            */
            
            array_push($values, $key_value);

        }
        return $values;
    }
    
    
}

?>