<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Activity_model');
        $this->load->library('session');
    }

    public function create() {
        // Ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            return;
        }

        $user_id = $this->session->userdata('user_id');

        $data = [
            'user_id'     => $user_id,
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'date'        => $this->input->post('date'),
            'time'        => $this->input->post('time'),
            'status'      => 'pending'
        ];

        $this->Activity_model->insert_activity($data);
        redirect('webservice/forecast'); // redirect after successful creation
    }
}
