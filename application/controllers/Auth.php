<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Auth extends CI_Controller {

    // Fungsi utama yang dipanggil saat akses: localhost/projek/auth
    public function index()
    {
        // Jika sudah login, lempar ke dashboard
        if($this->session->userdata('status') == "logged_in"){
            redirect(base_url("admin/dashboard"));
        }

        // Tampilkan halaman login dari folder views
        $this->load->view('login_view');
    }

    // Fungsi untuk proses pengecekan login
    public function login_process()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Data statis (Nanti bisa diganti ambil dari model/database)
        if ($username == "admin" && $password == "12345") {
            
            $data_session = array(
                'username' => $username,
                'status' => "logged_in"
            );

            $this->session->set_userdata($data_session);
            redirect(base_url("admin/dashboard"));

        } else {
            $this->session->set_flashdata('error', 'Username atau Password Salah!');
            redirect(base_url('auth'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}