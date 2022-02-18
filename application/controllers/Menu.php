<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success text-center" role="alert">
                Menu berhasil ditambahkan!
                </div>'
            );
            redirect('menu');
        }
    }

    public function delete($id)
    {
        $this->Menu_model->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger text-center" role="alert">
            Menu berhasil dihapus!
            </div>'
        );
        redirect('menu');
    }
}
