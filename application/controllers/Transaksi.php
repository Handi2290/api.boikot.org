<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Transaksi CR Admin';
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['cr'] = $this->db->get('tbl_cr_hdr')->result_array();

        // $this->form_validation->set_rules('project', 'Project', 'required');
        // $this->form_validation->set_rules('induk', 'Induk', 'required');
        // $this->form_validation->set_rules('cabang', 'Cabang', 'required');
        // $this->form_validation->set_rules('ranting', 'Ranting', 'required');
        // $this->form_validation->set_rules('uraian', 'Uraian', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/transaksi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'cr_no_hdr' => $this->input->post('cr_no_hdr'),
                'cr_photo' => $this->input->post('cr-add'),
                'cr_tanggal' => $this->input->post('cr_tanggal'),
                'cr_status' => $this->input->post('cr_status')
            ];
            $this->db->update('tbl_cr_hdr', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">CR Admin Berhasil diupdate!</div>');
            redirect('transaksi');
        }
    }

    public function delete($id)
    {
        $this->Transaksi_model->delete($id);
        redirect('transaksi');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail CR';
        $data['detail'] = $this->Transaksi_model->detail($id);

        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/transaksi/detail', $data);
        $this->load->view('templates/footer');
    }

    public function unlock($id)
    {
        $this->Transaksi_model->update($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">CR Berhasil di unlock!</div>');
        redirect('transaksi');
    }
}
