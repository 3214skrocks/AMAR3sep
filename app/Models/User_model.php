<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user($username, $password, $department) {
        $this->db->where('Username', $username);
        $this->db->where('Password', $password);
        $this->db->where('Department', $department);
        $query = $this->db->get('users');
        return $query->row();
    }

}
