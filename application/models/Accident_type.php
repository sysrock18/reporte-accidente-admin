<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accident_type extends CI_Model {

    private $table = 'accident_types';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function create($name) {
        $data = array('name' => $name);
        
        return $this->db->insert($this->table, $data);
    }

    public function get_all_by_page($page) {
        $this->db->select('count(*) OVER() AS count, *', false);

        $records = $this->db->get($this->table, 10, ($page * 10) - 10)->result();
        
        $count = 0;
        if (count($records) > 0) {
            $count = $records[0]->count;
        }

        return array(
            'data' => $records,
            'count' => (int)$count
        );
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function update($id, $name) {
        $data = array('name' => $name);

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id));
    }
}