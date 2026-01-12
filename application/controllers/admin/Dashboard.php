<?php

/**
 * @property CI_Session $session
 * @property CI_Input $input
 */

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek login
        if($this->session->userdata('status') != "logged_in"){
            redirect(base_url("auth"));
        }
    }

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }
}