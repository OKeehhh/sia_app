<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'url']);
        $this->load->library(['session', 'form_validation']);
        $this->load->model('Auth_model');
    }

    public function index() {
        $this->load->view('register_view');
    }

    public function create_account() {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[weather_accounts.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_view');
        } else {
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'username'   => $this->input->post('username'),
                'password'   => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            ];
            $this->Auth_model->register($data);
            $this->session->set_flashdata('success', 'Registration successful! Please login.');
            redirect('login');
        }
    }
}
