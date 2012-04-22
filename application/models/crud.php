<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model{      
    var $table = '';
    var $add_rules = array();
    var $edit_rules = array ();
            
function crud(){
        parent::__construct();
    }

function getlist(){
    $query = $this->db->get($this->table);
    $res = $query->result_array();
    return $res;
}
    
function add(){
    $this->form_validation->set_rules($this->add_rules);
    if ($this->form_validation->run()){
        $data = array();
        foreach ($this->add_rules as $each){
            $field = $each['field'];
            $data[$field] = $this->input->post($field);
        }
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    else{
        return false;
    }
}

function update($id){
    $this->form_validation->set_rules($this->edit_rules);
    if ($this->form_validation->run()){
        $object = array();
        foreach ($this->edit_rules as $each){
            $field = $each['field'];
            $object[$field] = $this->input->post($field);
        }
        $this->db->where('id',$id);
        $this->db->update($this->table,$object);
        return $this->db->insert_id();
    }
    else{
        return false;
    }
}

function delete($id){
    $this->db->where('id',$id);
    $this->db->delete($this->table);
}

function show($id){
    $this->db->where('id', $id);
    $query = $this->db->get($this->table);
    return $query->row_array();
}
    
}
?>