<?php

class Transaksi_model extends CI_Model
{
    public function delete($id)
    {
        $this->db->where('cr_id_hdr', $id);
        $this->db->delete('tbl_cr_hdr');
    }

    public function edit($id)
    {
        $this->db->where('cr_id_hdr', $id);
        $this->db->get('tbl_cr_hdr');
    }
}
