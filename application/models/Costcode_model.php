<?php

class Costcode_model extends CI_Model
{
    public function delete($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('tbl_code', ['id' => $id]);
    }

    public function edit($id)
    {
        return $this->db->get_where('tbl_code', ['id' => $id])->row_array();
    }

    public function ubahData($id)
    {
        $data = [
            "project" => $this->input->post('project', true),
            "induk" => $this->input->post('induk', true),
            "cabang" => $this->input->post('cabang', true),
            "ranting" => $this->input->post('ranting', true),
            "uraian" => $this->input->post('uraian', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_code', $data);
    }
}
