<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        var_dump($users);
    }
}

