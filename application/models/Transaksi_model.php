<?php

class Transaksi_model extends CI_Model
{
    public function delete($id)
    {
        $this->db->where('cr_id_hdr', $id);
        $this->db->delete('tbl_cr_hdr');
    }

    public function update($id)
    {

        $data = array(
            'cr_status' => 0
        );
        $this->db->where('cr_id_hdr', $id);
        $this->db->update('tbl_cr_hdr', $data);
    }

    // public function detail($id)
    // {
    //     $this->db->where('cr_id_hdr', $id);
    //     $this->db->get('tbl_cr_dtl')->result_array($id);
    // }

    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_cr_dtl');
        $this->db->join('tbl_cr_hdr', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr');
        $this->db->where('tbl_cr_hdr.cr_id_hdr', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
