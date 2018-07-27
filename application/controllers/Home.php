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
      $this->load->model('accident');
      $this->load->model('user');

      $data = array(
        'count_accidents' => $this->accident->get_accidents_count(),
        'count_users' => $this->user->get_users_count(),
      );

      $this->load->view('home', $data);
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
      $result = $this->accident_type->get_all_by_page($page);

      $data = array(
        'accident_types' => $result['data'],
        'count' => $result['count'],
        'page' => $page
      );

      $this->load->view('accident_types', $data);
    }

    public function accident_type_register() {
      $this->load->library('form_validation');
      $this->load->model('accident_type');

      $this->form_validation->set_rules('name', 'Email', 'required');

      if ($this->form_validation->run()) {
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        if (strlen($id) > 0) {
          $this->accident_type->update($id, $name);
        } else {
          $this->accident_type->create($name);
        }
      }

      redirect(base_url('home/accident_types'), 'location');
      return;
    }

    public function accident_type_delete() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('id', 'Clave', 'required');

      if ($this->form_validation->run()) {
        $id = $this->input->post('id');

        $this->load->model('accident_type');
        $this->accident_type->delete($id);
      }

      redirect(base_url('home/accident_types'), 'location');
      return;
    }

    public function accidents_report() {
      $page = 1;
      if ($this->input->get('page')) {
        $page = (int)$this->input->get('page');
      }

      if ($this->input->post('accident_type')) {
        $this->session->set_userdata('filter_accident_type', $this->input->post('accident_type'));
      }

      if ($this->input->post('date_to') && $this->input->post('date_from')) {
        $this->session->set_userdata('filter_date_to', $this->input->post('date_to'));
        $this->session->set_userdata('filter_date_from', $this->input->post('date_from'));
      }

      $filters['accident_type'] = $this->session->userdata('filter_accident_type');
      $filters['date_to'] = $this->session->userdata('filter_date_to');
      $filters['date_from'] = $this->session->userdata('filter_date_from');

      $this->load->model('accident');
      $result = $this->accident->get_all_by_page($page, $filters);

      $this->load->model('accident_type');
      $accident_types = $this->accident_type->get_all();

      $data = array(
        'accidents' => $result['data'],
        'count' => $result['count'],
        'page' => $page,
        'accident_types' => $accident_types
      );

      $this->load->view('accidents_report', $data);
    }

    public function clean_accidents_report() {
      $this->session->unset_userdata('filter_accident_type');
      $this->session->unset_userdata('filter_date_to');
      $this->session->unset_userdata('filter_date_from');

      redirect(base_url('home/accidents_report'), 'location');
      return;
    }

    public function users() {
      $page = 1;
      if ($this->input->get('page')) {
        $page = (int)$this->input->get('page');
      }

      $this->load->model('user');
      $result = $this->user->get_all_by_page($page);

      $data = array(
        'users' => $result['data'],
        'count' => $result['count'],
        'page' => $page
      );

      $this->load->view('users', $data);
    }

    public function user_register() {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('name', 'Nombre', 'required');
      $this->form_validation->set_rules('password', 'Contraseña', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('is_admin', 'is_admin', 'required');

      if ($this->form_validation->run()) {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $is_admin = $this->input->post('is_admin');

        $this->load->model('user');

        if (strlen($id) > 0) {
          $this->user->update($id, $name, $email, $password, $is_admin);
        } else {
          $this->user->create($name, $email, $password, $is_admin);
        }
      }

      redirect(base_url('home/users'), 'location');
      return;
    }

    public function user_delete() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('id', 'Clave', 'required');

      if ($this->form_validation->run()) {
        $id = $this->input->post('id');

        $this->load->model('user');
        $this->user->delete($id);
      }

      redirect(base_url('home/users'), 'location');
      return;
    }

}
