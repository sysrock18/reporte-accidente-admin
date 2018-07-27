<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accident extends CI_Model {

    private $table = 'accidents';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }

    public function create($user_id, $accident_type_id, $comments, $date) {
        $data = array(
            'user_id' => $user_id,
            'accident_type_id' => $accident_type_id,
            'comments' => $comments,
        );

        $this->db->set('date', "TO_TIMESTAMP('".$date."','MM/DD/YYYY HH24:MI:SS')", FALSE);
        
        return $this->db->insert('accidents', $data);
    }

    public function get_all_by_page($page, $filters) {
        $this->db->select('count(*) OVER() AS count, accidents.*, users.name AS username, accident_types.name AS accident_type_name', false);
        $this->db->join('users', 'users.id = accidents.user_id');
        $this->db->join('accident_types', 'accident_types.id = accidents.accident_type_id');

        if ($filters['accident_type']) {
            $this->db->where('accidents.accident_type_id', $filters['accident_type']);
        }

        if ($filters['date_to'] && $filters['date_from']) {
            $this->db->where('accidents.date >=', $filters['date_to']);
            $this->db->where('accidents.date <', $filters['date_from']);
        }

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

    public function get_accidents_count() {
        return $this->db->count_all_results($this->table);
    }
}
