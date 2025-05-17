<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fetch activities for a specific user, filtered by year and month
    public function get_activities_by_user($user_id, $year = null, $month = null) {
        $this->db->where('user_id', $user_id);
        
        if ($year !== null && $month !== null) {
            $this->db->where('YEAR(date)', $year);
            $this->db->where('MONTH(date)', $month);
        }

        $query = $this->db->get('activity');
        return $query->result_array();
    }

    // Insert new activity
    public function insert_activity($data) {
        return $this->db->insert('activity', $data);
    }

    // Update existing activity
    public function update_activity($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('activity', $data);
    }

    // Delete activity
    public function delete_activity($id) {
        $this->db->where('id', $id);
        return $this->db->delete('activity');
    }

    // Get activity by ID
    public function get_activity_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('activity');
        return $query->row_array();
    }
}
