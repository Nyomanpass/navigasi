<?php

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property M_rules $M_rules
 */

class Rules_wisata extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "logged_in") redirect(base_url("auth"));
        $this->load->model('M_rules');
    }

    public function index() {
        $data['rules'] = $this->M_rules->get_all_rules();
        $this->load->view('templates/header');
        $this->load->view('admin/rules/index', $data);
        $this->load->view('templates/footer');
    }

    public function simpan() {
        $data = [
            'judul_id'      => $this->input->post('judul_id'),
            'judul_eng'     => $this->input->post('judul_eng'),
            'deskripsi_id'  => $this->input->post('deskripsi_id'),
            'deskripsi_eng' => $this->input->post('deskripsi_eng'),
            'tipe'          => $this->input->post('tipe')
        ];
        $this->M_rules->insert_rule($data);
        redirect('admin/rules_wisata');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = [
            'judul_id'      => $this->input->post('judul_id'),
            'judul_eng'     => $this->input->post('judul_eng'),
            'deskripsi_id'  => $this->input->post('deskripsi_id'),
            'deskripsi_eng' => $this->input->post('deskripsi_eng'),
            'tipe'          => $this->input->post('tipe')
        ];

        $this->M_rules->update_rule($id, $data);
        redirect('admin/rules_wisata');
    }

    public function hapus($id) {
        $this->M_rules->delete_rule($id);
        redirect('admin/rules_wisata');
    }
}