<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

  private $AUTH_USER = 'admin';
  private $AUTH_PASS = 'admin';

  public function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');
  }

  public function test() {
    echo json_encode(array('hello' => 'Api Accidents Report!'));
  }

  public function login_user() {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Nombre', 'required');
    $this->form_validation->set_rules('password', 'Contraseña', 'required');

    if ($this->form_validation->run()) {
      $this->load->model('user');

      $email = $this->input->post('email');
      $password = $this->input->post('password');
      
      if ($user_id = $this->user->resolve_user_login($email, $password)) {
          $user = $this->user->get_user($user_id);
          
          echo json_encode(array(
            'result' => 'success',
            'record' => $user,
            'credentials' => array('user' => $this->AUTH_USER, 'pass' => $this->AUTH_PASS))
          );
      } else {
          echo json_encode(array('result' => 'error', 'record' => null));
      }
    } else {
      echo json_encode(array('result' => 'invalid', 'record' => null));
    }
  }

  public function register_user() {
    $this->load->model('user');

    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Contraseña', 'required');
    $this->form_validation->set_rules('name', 'Nombre', 'required');

    if ($this->form_validation->run()) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $name = $this->input->post('name');

      $result = $this->user->create($name, $email, $password, (int)false);

      if ($result) {
        $user_id = $this->db->insert_id();
        echo json_encode(array('result' => 'success', 'record' => $user_id));
      } else {
        echo json_encode(array('result' => 'error', 'record' => null));
      }
    } else {
      echo json_encode(array('result' => 'invalid', 'record' => null));
    }
  }

  public function register_accident() {
    $this->require_auth();

    $this->load->library('form_validation');

    $this->form_validation->set_rules('user', 'Usuario', 'required');
    $this->form_validation->set_rules('accident_type', 'Tipo de Accidente', 'required');
    $this->form_validation->set_rules('comments', 'Observaciones', 'required');
    $this->form_validation->set_rules('date', 'Fecha', 'required');

    if ($this->form_validation->run()) {
      $this->load->model('accident');

      $user_id = $this->input->post('user');
      $accident_type_id = $this->input->post('accident_type');
      $comments = $this->input->post('comments');
      $date = $this->input->post('date');

      $result = $this->accident->create($user_id, $accident_type_id, $comments, $date);

      if ($result) {
        $accident_id = $this->db->insert_id();
        echo json_encode(array('result' => 'success', 'record' => $accident_id));
      } else {
        echo json_encode(array('result' => 'error', 'record' => null));
      }
    } else {
      echo json_encode(array('result' => 'invalid', 'record' => null));
    }
  }

  public function get_accident_types() {
    $this->require_auth();

    $this->load->model('accident_type');
    $accident_types = $this->accident_type->get_all();

    echo json_encode(array('record' => $accident_types));
  }

  private function require_auth() {
    header('Cache-Control: no-cache, must-revalidate, max-age=0');

    $has_supplied_credentials = $_SERVER['PHP_AUTH_USER'] == $this->AUTH_USER && $_SERVER['PHP_AUTH_PW'] == $this->AUTH_PASS;

    if ((int)$has_supplied_credentials === 0) {
      echo json_encode(array('message' => "Unauthorized"));
      exit;
    }
  }
  
}
