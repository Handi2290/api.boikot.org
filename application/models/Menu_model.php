<?php

class Menu_model extends CI_Model
{
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    public function edit($id)
    {
        $this->db->where('id', $id);
        $this->db->get('user_menu');
    }
}
