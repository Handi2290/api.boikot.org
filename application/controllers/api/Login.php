<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Login extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }
    public function index_get()
    {
        $users = $this->Users_model->getUsers();
        // var_dump($users);
        $users = $this->Users_model->getUsers();
        // var_dump($crhdr);
        if ($users) {
            $this->response([
                'status' => true,
                'message' => $users
            ], 200);
        }
    }

    public function index_post()
    {
        $data = [
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'avatar' => $this->post('avatar'),
            'role_id' => $this->post('role_id'),
            'password' => $this->post('password'),
            'is_active' => $this->post('is_active'),
            'created_at' => $this->post('created_at')
        ];

        if ($this->Users_model->createUsers($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Akun Berhasil dibuat.'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Akun Gagal dibuat!',
                // 'data' => $data
            ], 400);
        }
    }
}
