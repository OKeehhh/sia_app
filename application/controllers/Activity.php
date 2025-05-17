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

    public function update() {
        // Ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->output->set_status_header(401)->set_output(json_encode(['error' => 'Unauthorized']));
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $activity_id = $this->input->post('id');

        // Verify the activity belongs to the user
        $activity = $this->Activity_model->get_activity_by_id($activity_id);
        if (!$activity || $activity['user_id'] != $user_id) {
            $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
            return;
        }

        $data = [
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'date'        => $this->input->post('date'),
            'time'        => $this->input->post('time')
        ];

        $success = $this->Activity_model->update_activity($activity_id, $data);
        
        if ($success) {
            $this->output->set_output(json_encode(['success' => true]));
        } else {
            $this->output->set_status_header(500)->set_output(json_encode(['error' => 'Failed to update activity']));
        }
    }

    public function delete() {
        // Ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->output->set_status_header(401)->set_output(json_encode(['error' => 'Unauthorized']));
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $activity_id = $this->input->post('id');

        // Verify the activity belongs to the user
        $activity = $this->Activity_model->get_activity_by_id($activity_id);
        if (!$activity || $activity['user_id'] != $user_id) {
            $this->output->set_status_header(403)->set_output(json_encode(['error' => 'Forbidden']));
            return;
        }

        $success = $this->Activity_model->delete_activity($activity_id);
        
        if ($success) {
            $this->output->set_output(json_encode(['success' => true]));
        } else {
            $this->output->set_status_header(500)->set_output(json_encode(['error' => 'Failed to delete activity']));
        }
    }
}
