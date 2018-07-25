<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

  public function __construct() {
    header('Content-Type: application/json');
    $this->require_auth();
  }

  public function test()
  {
    echo json_encode(array('hello' => 'Hello World!'));
  }

  function require_auth() {
    $AUTH_USER = 'admin';
    $AUTH_PASS = 'admin';

    header('Cache-Control: no-cache, must-revalidate, max-age=0');

    $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

    $is_not_authenticated = (
      !$has_supplied_credentials ||
      $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
      $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
    );

    if ($is_not_authenticated) {
      header('HTTP/1.1 401 Authorization Required');
      header('WWW-Authenticate: Basic realm="Access denied"');
      exit;
    }
  }
  
}
