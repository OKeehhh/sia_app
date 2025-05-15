<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url']);
        $this->load->library(['session']);
        $this->load->model('Auth_model');
    }

    public function index() {
        $this->load->view('login_view');
    }

    public function authenticate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->login($username);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'logged_in' => true,
                'user_id' => $user->id,
                'username' => $user->username
            ]);
            redirect('webservice/forecast'); 
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
