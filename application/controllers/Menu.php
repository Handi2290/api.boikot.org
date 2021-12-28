<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller

{
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        // echo 'Selamat datang, ' . $data['users']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }
}
