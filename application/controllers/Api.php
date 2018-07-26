<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

  private $AUTH_USER = 'admin';
  private $AUTH_PASS = 'admin';

  public function __construct() {
    parent::__construct();
    header('Content-Type: application/json');
  }

  public function test() {
    echo json_encode(array('hello' => 'Api Accidents Report!'));
  }

  public function login_user() {
    $this->load->model('user');

    $email = $this->input->post('email');
    $password = $this->input->post('password');
    
    if ($user_id = $this->user->resolve_user_login($email, $password)) {
        $user = $this->user->get_user($user_id);
        
        echo json_encode(array(
          'result' => 'success',
          'data' => $user,
          'credentials' => array('user' => $this->AUTH_USER, 'pass' => $this->AUTH_PASS))
        );
    } else {
        echo json_encode(array('result' => 'error', 'data' => null));
    }
  }

  public function register_user() {
    $this->require_auth();

    $this->load->model('user');

    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $name = $this->input->post('name');

    $result = $this->user->create_user($name, $email, $password, (int)false);

    if ($result) {
      $user_id = $this->db->insert_id();
      echo json_encode(array('result' => 'success', 'data' => $user_id));
    } else {
      echo json_encode(array('result' => 'error', 'data' => null));
    }
  }

  public function register_accident() {
    $this->require_auth();

    $this->load->model('accident');

    $user_id = $this->input->post('user');
    $accident_type_id = $this->input->post('accident_type');
    $comments = $this->input->post('comments');
    $date = $this->input->post('date');

    $result = $this->accident->create($user_id, $accident_type_id, $comments, $date);

    if ($result) {
      $accident_id = $this->db->insert_id();
      echo json_encode(array('result' => 'success', 'data' => $accident_id));
    } else {
      echo json_encode(array('result' => 'error', 'data' => null));
    }
  }

  private function require_auth() {
    header('Cache-Control: no-cache, must-revalidate, max-age=0');

    $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

    $is_not_authenticated = (
      !$has_supplied_credentials ||
      $_SERVER['PHP_AUTH_USER'] != $this->AUTH_USER ||
      $_SERVER['PHP_AUTH_PW']   != $this->AUTH_PASS
    );

    if ($is_not_authenticated) {
      header('HTTP/1.1 401 Authorization Required');
      header('WWW-Authenticate: Basic realm="Access denied"');
      exit;
    }
  }
  
}
