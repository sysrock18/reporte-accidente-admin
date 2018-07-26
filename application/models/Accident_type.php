<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accident_type extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }
    
    public function create($name) {
        $data = array('name' => $name);
        
        return $this->db->insert('accident_types', $data);
    }

    public function update($id, $name) {
        $data = array('name' => $name);

        $this->db->where('id', $id);
        return $this->db->update('accident_types', $data);
    }

    public function delete($id) {
        $this->db->delete('accident_types', array('id' => $id));
    }
}