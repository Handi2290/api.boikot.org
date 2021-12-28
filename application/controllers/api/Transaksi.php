<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Transaksi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CR_Hdr');
    }

    public function index_get()
    {
        $cr_no_hdr = $this->get('cr_no_hdr');
        if ($cr_no_hdr == null) {
            $crhdr = $this->CR_Hdr->getCrHdr();
        } else {
            $crhdr = $this->CR_Hdr->getCrHdr($cr_no_hdr);
        }

        // var_dump($crhdr);
        if ($crhdr) {
            $this->response([
                'status' => true,
                'message' => $crhdr
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data Tidak Ditemukan!'
            ], 404);
        }
    }

    public function index_delete()
    {
        $cr_no_hdr = $this->delete('cr_no_hdr');

        if ($cr_no_hdr === null) {
            $this->response([
                'status' => false,
                'message' => 'Silahkan isi Nomor CR!'
            ], 404);
        } else {
            if ($this->CR_Hdr->deleteCrHdr($cr_no_hdr) > 0) {
                // ok
                $this->response([
                    'status' => true,
                    'cr_no_hdr' => $cr_no_hdr,
                    'message' => 'CR telah dihapus.'
                ], 200);
            } else {
                // no cr tidak ada
                $this->response([
                    'status' => false,
                    'message' => 'Nomor CR Tidak ada!'
                ], 404);
            }
        }
    }
}
