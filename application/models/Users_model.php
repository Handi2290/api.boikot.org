<?php

class Users_model extends CI_Model
{
    public function getUsers()
    {
        return $this->db->get('users')->result_array();
    }
}