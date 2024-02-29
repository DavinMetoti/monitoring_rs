<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->session->unset_userdata('username');
        $this->session->unset_userdata('status');

        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim'
        );
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Monitoring Ruangan';
            $this->load->view('template/header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $user = $this->db->get_where('account', ['username' => $username])->row_array();

        if ($user) {
            if ($password == $user['password']) {
                $data = [
                    'username' => $user['username'],
                    'status' => 'login',
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Login Berhasil</div>');
                if ($user['status'] == 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Admin tidak aktif!</div>');
                    redirect('auth');
                } else {
                    if ($user['role_access'] == 1) {
                        redirect('admin/jadwal/');
                    } else {
                        redirect('monitoring/operasi/operator');
                    }
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak terdaftar</div>');
            redirect('auth');
        }
    }
}
