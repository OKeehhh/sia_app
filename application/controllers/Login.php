<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url']);
        $this->load->library('session');
    }

    public function index() {
        // Load the login view
        $this->load->view('login_view');
    }

    public function authenticate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Simple static check — replace with DB check in real application
        if ($username === 'admin' && $password === 'password') {
            $this->session->set_userdata('logged_in', true);
            redirect('webservice/consume');
        } else {
            $this->session->set_flashdata('error', 'Invalid credentials');
            redirect('login');
        }
    }

    public function logout() {
    $this->session->sess_destroy();
    redirect('login');
}

}
