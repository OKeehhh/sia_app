<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function logout() {
        // Destroy the session
        $this->session->sess_destroy();
        
        // Redirect to login page
        redirect('login');
    }
} 