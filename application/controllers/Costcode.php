<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Costcode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Costcode_model');
    }

    public function index()
    {
        $data['title'] = 'Input Cost Code';
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['code'] = $this->db->get('tbl_code')->result_array();

        $this->form_validation->set_rules('project', 'Project', 'required');
        $this->form_validation->set_rules('induk', 'Induk', 'required');
        $this->form_validation->set_rules('cabang', 'Cabang', 'required');
        $this->form_validation->set_rules('ranting', 'Ranting', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/costcode/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'project' => $this->input->post('project'),
                'induk' => $this->input->post('induk'),
                'cabang' => $this->input->post('cabang'),
                'ranting' => $this->input->post('ranting'),
                'uraian' => $this->input->post('uraian')
            ];
            $this->db->insert('tbl_code', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Costcode Berhasil ditambahkan!</div>');
            redirect('costcode');
        }
    }

    public function delete($id)
    {
        $this->Costcode_model->delete($id);
        redirect('costcode');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Costcode',
            'code' => $this->Costcode_model->edit($id)
        ];

        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $id = $this->db->get('tbl_code', $id)->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/costcode/edit', $data);
        $this->load->view('templates/footer');

        

        $this->db->update('tbl_code', $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Costcode Berhasil ditambahkan!</div>');
        redirect('costcode');
    }
}
