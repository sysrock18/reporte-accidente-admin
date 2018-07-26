<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }
    
    public function create_user($name, $email, $password, $is_admin) {
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $this->hash_password($password),
            'is_admin' => $is_admin
        );
        
        return $this->db->insert('users', $data);
    }
    
    public function resolve_user_login($email, $password) {
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('is_admin', 1);
        $user = $this->db->get()->row();
        
        if ($this->verify_password_hash($password, $user->password)) {
            return $user->id;
        } else {
            return false;
        }
    }
    
    public function get_user($user_id) {
        $this->db->from('users');
        $this->db->where('id', $user_id);

        return $this->db->get()->row();
    }
    
    private function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function verify_password_hash($password, $hash) {
        return password_verify($password, $hash);
    }
    
}