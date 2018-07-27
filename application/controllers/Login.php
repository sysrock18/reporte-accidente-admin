<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');

        if ($this->session->has_userdata('logged_in')) {
            redirect(base_url('home'), 'location');
            return;
        }
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function auth_user() {
        $data = new stdClass();
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if (!$this->form_validation->run()) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            if ($user_id = $this->user->resolve_user_login($email, $password, true)) {
                $user = $this->user->get_user($user_id);
                
                $userdata = array(
                    'user_id' => (int)$user->id,
                    'email' => (string)$user->email,
                    'name' => (string)$user->name,
                    'logged_in' => (bool)true,
                    'is_admin' => (bool)$user->is_admin
                );

                $this->session->set_userdata($userdata);
                
                redirect(base_url('home'), 'location');
                return;
                
            } else {
                $data->message = 'Email o contraseña invalido.';
                $this->load->view('login', $data);
            }
        }
    }
  
}
