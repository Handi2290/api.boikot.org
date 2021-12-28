<?php

class CR_Hdr extends CI_Model
{
    public function getCrHdr($cr_no_hdr = null)
    {
        if ($cr_no_hdr == null) {
            return $this->db->get('tbl_cr_hdr')->result_array();
        } else {
            return $this->db->get_where('tbl_cr_hdr', ['cr_no_hdr' => $cr_no_hdr])->result_array();
        }
    }

    public function deleteCrHdr($cr_no_hdr)
    {
        $this->db->delete('tbl_cr_hdr', ['cr_no_hdr' => $cr_no_hdr]);
        return $this->db->affected_rows();
    }
}
