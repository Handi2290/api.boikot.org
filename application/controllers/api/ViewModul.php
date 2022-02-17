	<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    // This can be removed if you use __autoload() in config.php OR use Modular Extensions
    /** @noinspection PhpIncludeInspection */
    require APPPATH . '/libraries/REST_Controller.php';

    // use namespace
    use Restserver\Libraries\REST_Controller;


    /**
     * This is an example of a few basic user interaction methods you could use
     * all done with a hardcoded array
     *
     * @package         CodeIgniter
     * @subpackage      Rest Server
     * @category        Controller
     * @author          Phil Sturgeon, Chris Kacerguis
     * @license         MIT
     * @link            https://github.com/chriskacerguis/codeigniter-restserver
     */

    class ViewModul extends REST_Controller
    {

        function __construct($config = 'rest')
        {
            parent::__construct($config);
            $this->load->model('query_model', 'query');
        }

        public function login_get()
        {

            $user = $this->get('user');
            $password = $this->get('password');
            $response = array();
            $password1 = hash("sha256", $password);


            // $password1 = hash($password, PASSWORD_DEFAULT);
            // $password1 = password_hash($password, PASSWORD_DEFAULT);
            // $password1 = password_hash($this->input->post($password), PASSWORD_DEFAULT);

            $query['select']    = '*, CONCAT("http://api.boikot.org/assets/profil/", avatar) as avatar';
            $query['table']        = 'users';
            $query['where']        = 'email = "' . $user . '"   and password = "' . $password1 . '"';
            $data                 = $this->query->getRow($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]    = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
                $response['password']   = $password;
                $response['password1']  = $password1;
                // $response['password2']     = "a883902a7959246b3bdb248c44af93ed3469a3cf2c9cf3a36da5a4be4539d45f";
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }

        public function home_get()
        {

            $user = $this->get('user');
            $password = $this->get('password');
            $response = array();
            $password1 = hash("sha256", $password);

            $query['select']    = '*, SUM(tbl_cr_dtl.cr_dtl_nominal) AS total,ROW_NUMBER() OVER ()  as "index", tbl_cr_hdr.cr_id_hdr as cr_id_hdr, tbl_cr_hdr.cr_tanggal as cr_tanggal';
            $query['table']        = 'tbl_cr_hdr';
            $query['join'][0]  = array('tbl_cr_dtl', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr', 'left');
            $query['group']        = 'tbl_cr_hdr.cr_id_hdr';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]    = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
                $response['password']     = $password;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }
        public function homef_get()
        {

            $id = $this->get('id');

            $query['select']    = '*,ROW_NUMBER() OVER ()  as "index", tbl_cr_hdr.cr_id_hdr as cr_id_hdr, tbl_cr_hdr.cr_tanggal as cr_tanggal, CONCAT("http://svc.boikot.org/assets/photo_realisasi/", cr_foto) AS cr_foto';
            $query['table']        = 'tbl_cr_hdr';
            $query['join'][0]   = array('tbl_cr_dtl', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr', 'left');
            $query['where']        = 'tbl_cr_hdr.cr_id_hdr = "' . $id . '"';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            $query1['select']    = 'SUM(tbl_cr_dtl.cr_dtl_nominal) AS total';
            $query1['table']        = 'tbl_cr_hdr';
            $query1['join'][0]   = array('tbl_cr_dtl', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr', 'left');
            $query1['where']        = 'tbl_cr_hdr.cr_id_hdr = "' . $id . '"';
            $data1                 = $this->query->getRow($query1);

            if ($cek > 0) {

                $response["data"]       = $data;
                $response["total"]       = $data1->total;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }
        public function halamancari_get()
        {

            $date1 = $this->get('date1');
            $date2 = $this->get('date2');

            $query['select']    = '*,ROW_NUMBER() OVER ()  as "index", tbl_cr_hdr.cr_id_hdr as cr_id_hdr, tbl_cr_hdr.cr_tanggal as cr_tanggal';
            $query['table']        = 'tbl_cr_hdr';
            $query['join'][0]   = array('tbl_cr_dtl', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr', 'left');
            $query['where']        = 'tbl_cr_hdr.cr_tanggal between "' . $date1 . '" and "' . $date2 . '"';
            $query['group']        = 'tbl_cr_hdr.cr_id_hdr';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);



            if ($cek > 0) {

                $response["data"]       = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }
        public function UploadFoto_post()

        {

            date_default_timezone_set('Asia/Jakarta');



            $kat = $this->input->post('type');



            // if (!is_dir('assets/realisasi/'.$this->input->post('realisasi_ID'))) {

            //     mkdir('assets/realisasi/'.$this->input->post('realisasi_ID'));

            // }



            if ($_FILES['file']['name'] != '') {

                $config['upload_path'] = './assets/photo_realisasi/';

                $config['allowed_types'] = 'jpg|jpeg|png';

                $config['encrypt_name'] = TRUE;

                $config['overwrite'] = TRUE;

                $this->load->library('upload');
                $this->upload->initialize($config);

                $this->upload->initialize($config);



                if ($this->upload->do_upload("file")) {

                    $name = $this->upload->data();

                    $sql = array(

                        'realisasi_pict1'    => $name['file_name'],

                    );

                    $message = array(

                        'success'    => true,

                        'message'   => 'Data berhasil diupload.',
                        'files' => $name['file_name'],
                        'url' => 'http://api.boikot.org/assets/transaksi/' . $name['file_name']

                    );
                } else {

                    $message = array(

                        'status'    => false,

                        'message'   => $this->upload->display_errors(),

                    );
                }
                $this->response($message, REST_Controller::HTTP_OK);
            }
        }

        public function kategori_get()
        {


            $query['select']    = 'project as item';
            $query['table']        = 'tbl_code';
            $query['group']        = 'project';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]    = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }

        public function sub_kategori_get()
        {

            $id = $this->get('kategori');
            $query['select']    = 'induk as item';
            $query['table']        = 'tbl_code';
            $query['where']        = 'project = "' . $id . '"';

            $query['group']        = 'induk';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]       = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = $id;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }

        public function pos_get()
        {

            $id                 = $this->get('induk');
            $query['select']    = 'cabang  as item';
            $query['table']        = 'tbl_code';
            $query['where']        = 'tbl_code.induk = "' . $id . '"';

            $query['group']        = 'cabang';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]       = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }

        public function sub_pos_get()
        {

            $id                 = $this->get('cabang');
            $query['select']    = 'ranting  as item';
            $query['table']        = 'tbl_code';
            $query['where']        = 'tbl_code.cabang = "' . $id . '"';

            $query['group']        = 'ranting';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]       = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }

        public function uraian_get()
        {

            $project                 = $this->get('project');
            $induk                   = $this->get('induk');
            $cabang                  = $this->get('cabang');
            $ranting                 = $this->get('ranting');

            $query['select']    = 'uraian as item';
            $query['table']        = 'tbl_code';
            $query['where']        = 'tbl_code.project = "' . $project . '" and tbl_code.induk = "' . $induk . '" and tbl_code.cabang = "' . $cabang . '" and tbl_code.ranting = "' . $ranting . '"';

            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]       = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }

        public function search_get()
        {

            $project                 = $this->get('project');
            $induk                   = $this->get('induk');
            $cabang                  = $this->get('cabang');
            $ranting                 = $this->get('ranting');

            $query['select']    = 'uraian as item';
            $query['table']        = 'tbl_code';
            $query['where']        = 'tbl_code.project = "' . $project . '" and tbl_code.induk = "' . $induk . '" and tbl_code.cabang = "' . $cabang . '" and tbl_code.ranting = "' . $ranting . '"';

            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);

            if ($cek > 0) {

                $response["data"]       = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }

        public function cari_get()
        {

            $project                 = $this->get('project');
            $induk                   = $this->get('induk');
            $cabang                  = $this->get('cabang');
            $ranting                 = $this->get('ranting');

            $query['select']    = '*, SUM(tbl_cr_dtl.cr_dtl_nominal) AS total,ROW_NUMBER() OVER ()  as "index"';
            $query['table']        = 'tbl_cr_hdr';
            $query['join'][0]   = array('tbl_cr_dtl', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr', 'left');
            $query['where']        = 'tbl_cr_hdr.cr_no_hdr like "%' . $project . $induk . $cabang . $ranting . '%"';
            $query['group']        = 'tbl_cr_hdr.cr_no_hdr';
            $data                 = $this->query->getData($query);
            $cek                = $this->query->getNum($query);


            if ($cek > 0) {

                $response["data"]       = $data;
                $response["success"]    = "1";
                $response['status']     = true;
            } else {
                $response["success"]    = "0";
                $response["message"]    = "Tidak ada data";
                $response['status']     = false;
            }

            $this->set_response($response, REST_Controller::HTTP_CREATED);
        }


        // script insert versi satu

        public function submit1_post()

        {

            date_default_timezone_set('Asia/Jakarta');

            $cr_id_hdr              = $this->input->post('cr_id_hdr');

            $cr_no_hdr              = $this->query->kdauto("CR/" . $this->post('cr_no_hdr') . "/");

            $cr_foto                = $this->input->post('cr_foto');

            $cr_tanggal             = $this->input->post('cr_tanggal');


            $cr_created_at           = date("Y-m-d H:i:s");




            $data = array(

                'cr_no_hdr'                 => $cr_no_hdr,

                'cr_foto'                   => $cr_foto,

                'cr_tanggal'                => $cr_tanggal,

                'cr_created_at'             => $cr_created_at,

                'cr_updated_at'         => $cr_created_at

            );

            $insert = $this->query->insert_id('tbl_cr_hdr', $data);

            if ($insert) {


                $message = array(

                    'success'    => 1,
                    'insert'    => $insert,

                    'message'   => 'Data berhasil diubah.'

                );
            } else {

                $message = array(

                    'success'    => 0,

                    'message'   => 'Data gagal diubah.'

                );
            }



            $this->set_response($message, REST_Controller::HTTP_CREATED);
        }
        public function submitdetail_post()

        {

            date_default_timezone_set('Asia/Jakarta');

            $cr_id_hdr                    = $this->input->post('cr_id_hdr');

            $cr_tanggal                    = $this->input->post('cr_tanggal');

            $cr_dtl_nominal                = $this->input->post('cr_dtl_nominal');

            $cr_uraian                 = $this->input->post('cr_uraian');

            $cr_user                 = $this->input->post('cr_user');

            $cost_code                 =  $this->query->kdauto("CR/" . $this->input->post('cost_code') . "/");



            $cr_created_at           = date("Y-m-d H:i:s");


            $data = array(

                'cr_id_hdr'                 => $cr_id_hdr,

                'cr_tanggal'                => $cr_tanggal,

                'cr_dtl_nominal'            => $cr_dtl_nominal,

                'cr_uraian'                 => $cr_uraian,

                'cr_user'                   => $cr_user,

                'cr_created_at'             => $cr_user,

                'cr_created_at'             => $cr_created_at,

                'cr_updated_at'            => $cr_created_at,

                'cr_created_by'             => $cr_user,

                'cr_updated_by'            => $cr_user,

                'cr_dtl_cost_code'       => $cost_code

            );

            $insert = $this->query->insert_id('tbl_cr_dtl', $data);

            if ($insert) {


                $message = array(

                    'success'    => 1,
                    'insert'    => $insert,

                    'message'   => 'Data berhasil diubah.'

                );
            } else {

                $message = array(

                    'success'    => 0,

                    'message'   => 'Data gagal diubah.'

                );
            }



            $this->set_response($message, REST_Controller::HTTP_CREATED);
        }

        // script insert v2

        public function submit_post()
        {
            $data = [
                'cr_no_hdr' => $this->query->kdauto("CR/" . $this->post('cr_no_hdr') . "/"),
                'cr_foto' => $this->post('cr_foto'),
                'cr_tanggal' => $this->post('cr_tanggal'),
                'cr_created_at' => $this->post('cr_created_at'),
                'cr_updated_at' => $this->post('cr_updated_at')
            ];

            if ($this->CR_Hdr->createCrHdr($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'CR Baru Berhasil dibuat.'
                ], 201);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'CR Baru Gagal dibuat!',
                    // 'data' => $data
                ], 400);
            }
        }

        public function setData_post()
        {

            $id = $this->post('cr_no_hdr');
            $this->response([
                'status' => true,
                'message' => $this->query->kdauto("CR/" . $id . "/")
            ], 201);
        }

        public function updateStatus_post()

        {

            date_default_timezone_set('Asia/Jakarta');

            $cr_id_hdr              = $this->input->post('id');
            $cr_status                = $this->input->post('status');
            $data = array(

                'cr_status'                => $cr_status
            );

            $insert = $this->query->update('tbl_cr_hdr', array('cr_id_hdr' => $cr_id_hdr), $data);

            if ($insert) {

                $query['select']    = '*,ROW_NUMBER() OVER ()  as "index", tbl_cr_hdr.cr_id_hdr as cr_id_hdr, tbl_cr_hdr.cr_tanggal as cr_tanggal, CONCAT("http://svc.boikot.org/assets/photo_realisasi/", cr_foto) AS cr_foto';
                $query['table']        = 'tbl_cr_hdr';
                $query['join'][0]   = array('tbl_cr_dtl', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr', 'left');
                $query['where']        = 'tbl_cr_hdr.cr_id_hdr = "' . $cr_id_hdr . '"';
                $data                 = $this->query->getData($query);
                $cek                = $this->query->getNum($query);

                $query1['select']    = 'SUM(tbl_cr_dtl.cr_dtl_nominal) AS total';
                $query1['table']        = 'tbl_cr_hdr';
                $query1['join'][0]   = array('tbl_cr_dtl', 'tbl_cr_dtl.cr_id_hdr = tbl_cr_hdr.cr_id_hdr', 'left');
                $query1['where']        = 'tbl_cr_hdr.cr_id_hdr = "' . $cr_id_hdr . '"';
                $data1                 = $this->query->getRow($query1);


                $message = array(
                    'data'      => $data,
                    'total'      => $data1->total,
                    'success'    => 1,
                    'insert'    => $insert,
                    'message'   => 'Data berhasil diubah.'

                );
            } else {

                $message = array(
                    'success'    => 0,
                    'message'   => 'Data gagal diubah.'
                );
            }

            $this->set_response($message, REST_Controller::HTTP_CREATED);
        }
    }
