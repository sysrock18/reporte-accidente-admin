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
      $page = 1;
      if ($this->input->get('page')) {
        $page = (int)$this->input->get('page');
      }

      $this->load->model('accident_type');
      $result = $this->accident_type->get_all($page);

      $data = array(
        'accident_types' => $result['data'],
        'count' => $result['count'],
        'page' => $page
      );

      $this->load->view('accident_types', $data);
    }

    public function accident_type_register() {
      $id = $this->input->post('id');
      $name = $this->input->post('name');

      $this->load->model('accident_type');

      if (strlen($id) > 0) {
        $this->accident_type->update($id, $name);
      } else {
        $this->accident_type->create($name);
      }

      redirect(base_url('home/accident_types'), 'location');
      return;
    }

    public function accident_type_delete() {
      $id = $this->input->post('id');

      $this->load->model('accident_type');
      $this->accident_type->delete($id);

      redirect(base_url('home/accident_types'), 'location');
      return;
    }

    public function accidents_report() {
      $this->load->view('accidents_report');
    }

    public function users() {
      $this->load->view('users');
    }

    public function user_form($id = null) {
      echo $id;
    }

}
