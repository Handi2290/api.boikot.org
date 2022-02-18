<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Admin SIMAB';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //Validasi Sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = hash('sha256', $_POST['password']);

        // $password = $this->input->post('password');
        // $hashed = hash("sha256", $password);

        $users = $this->db->get_where('users', ['email' => $email])->row_array();

        // Cek Query DB
        // var_dump($email, $password);
        // die;

        if ($users) {
            // Usernya ada
            if ($users['is_active'] == 1) {
                // Cek Password
                if ($password == $users['password']) {
                    $data = [
                        'email' => $users['email'],
                        'role_id' => $users['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($users['role_id'] == 1) {
                        redirect('superadmin');
                    } else {
                        redirect('admin');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger text-center" role="alert">
                        Password salah!
                        </div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-warning text-center" role="alert">
                    Akun ini belum aktif!
                    </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger text-center" role="alert">
                Email tidak terdaftar di sistem!
                </div>'
            );
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[users.email]',
            [
                'is_unique' => 'Email ini sudah terdaftar!'
            ]
        );
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!',
            'required' => 'Silahkan isi password!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Buat Akun SIMAB';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'avatar' => 'default.jpg',
                'role_id' => 2,
                'password' => hash("sha256", $this->input->post('password1')),
                'is_active' => 1,
                'created_at' => time()
            ];

            $this->db->insert('users', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success text-center" role="alert">
                Berhasil mendaftar, silahkan login!
                </div>'
            );
            redirect('auth');
        }
    }

    public function forgot_password()
    {
        $data['title'] = 'Lupa Password';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/forgot-password');
        $this->load->view('templates/auth_footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-warning text-center" role="alert">
            Berhasil logout, terima kasih!
            </div>'
        );
        redirect('auth');
    }
}
