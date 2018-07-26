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
      $result = $this->accident_type->get_all_by_page($page);

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
      $this->load->view('users');
    }

    public function user_form($id = null) {
      echo $id;
    }

}
