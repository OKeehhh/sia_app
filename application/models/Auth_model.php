<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function register($data) {
        return $this->db->insert('weather_accounts', $data);
    }

    public function login($username) {
        return $this->db->get_where('weather_accounts', ['username' => $username])->row();
    }
}
