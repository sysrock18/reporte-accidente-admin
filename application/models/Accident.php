<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accident_type extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }

    public function create_accident($user_id, $accident_type_id, $comments) {
        $data = array(
            'user_id' => $user_id,
            'accident_type_id' => $accident_type_id,
            'comments' => $comments,
            'date' => date('Y-m-j H:i:s')
        );
        
        return $this->db->insert('accidents', $data);
    }
}
