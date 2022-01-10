<?php

class Costcode_model extends CI_Model
{
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_code');
    }

    public function edit($id)
    {
        $this->db->where('id', $id);
        $this->db->get('tbl_code');
    }
}
