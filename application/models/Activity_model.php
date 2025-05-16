<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fetch activities for a specific user
    public function get_activities_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('activity');
        return $query->result_array();
    }

    // Insert new activity
    public function insert_activity($data) {
        return $this->db->insert('activity', $data);
    }
}
