<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    private $table = 'users';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }
    
    public function create($name, $email, $password, $is_admin) {
        $data = array(
            'name' => $name,
            'email' => $email,
            'is_admin' => $is_admin
        );

        if (strlen($password) > 5) {
            $data['password'] = $this->hash_password($password);
        }
        
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $name, $email, $password, $is_admin) {
        $data = array(
            'name' => $name,
            'email' => $email,
            'is_admin' => $is_admin
        );

        if (strlen($password) > 5) {
            $data['password'] = $this->hash_password($password);
        }

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table, array('id' => $id, 'protected' => 0));
    }
    
    public function resolve_user_login($email, $password, $admin = false) {
        $this->db->from($this->table);
        $this->db->where('email', $email);

        if ($admin) {
            $this->db->where('is_admin', 1);
        }
        
        $user = $this->db->get()->row();
        
        if ($user) {
            if ($this->verify_password_hash($password, $user->password)) {
                return $user->id;
            }
        }

        return false;
    }
    
    public function get_user($user_id) {
        $this->db->select('id, name, email, is_admin');
        $this->db->where('id', $user_id);

        return $this->db->get($this->table)->row();
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

    public function get_users_count() {
        return $this->db->count_all_results($this->table);
    }
    
    private function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function verify_password_hash($password, $hash) {
        return password_verify($password, $hash);
    }
    
}