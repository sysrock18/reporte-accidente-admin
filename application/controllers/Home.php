<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');

        if (!$this->session->has_userdata('logged_in')) {
            redirect(base_url('login'), 'location');
            return;
        }
    }

    public function index() {
        $this->load->view('home');
    }

    public function user_logout() {
        foreach ($this->session->userdata as $key => $value) {
            $this->session->unset_userdata($key);
        }

        $this->session->sess_destroy();
        
        redirect(base_url('login'), 'location');
        return;
    }

    public function accident_types() {

    }

    public function accident_type_form($id = null) {

    }

    public function accidents_report() {

    }

    public function users() {

    }

    public function user_form($id = null) {

    }

}
