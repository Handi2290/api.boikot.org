<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        // echo 'Selamat datang, ' . $data['users']['name'];
        $this->load->view('admin/index');
    }
}
