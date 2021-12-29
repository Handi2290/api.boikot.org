<?php

class Users_model extends CI_Model
{
    public function getUsers()
    {
        return $this->db->get('users')->result_array();
    }

    public function createUsers($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }
}
