<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property M_Navigasi $M_Navigasi
 * @property M_wisata $M_wisata
 * @property DB_query_builder $db
 */
class Rute extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek login
        if($this->session->userdata('status') != "logged_in") {
            redirect(base_url("auth"));
        }
        
        // Load Model
        $this->load->model('M_Navigasi');
        $this->load->model('M_wisata'); // Pastikan nama file & class model wisata sesuai
    }

    public function index() {
        // Mengambil data rute dengan join nama lokasi (fungsi baru di model)
        $data['navigasi'] = $this->M_Navigasi->get_all_admin();
        
        // Mengambil semua data objek wisata untuk dropdown (Titik Awal & Tujuan)
        $data['wisata'] = $this->db->get('objek_wisata')->result();
        
        $this->load->view('templates/header');
        $this->load->view('admin/navigasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function simpan() {
        $data = [
            'titik_awal' => $this->input->post('titik_awal'),
            'tujuan'     => $this->input->post('tujuan'),
            'urutan'     => $this->input->post('urutan'),
            'pos_y'      => $this->input->post('pos_y'),
            'rotasi_y'   => $this->input->post('rotasi_y'),
            'keterangan' => $this->input->post('keterangan'),
            'lat'        => $this->input->post('lat'),
            'lng'        => $this->input->post('lng')
        ];
        
        $this->M_Navigasi->insert($data);
        redirect('admin/navigasi');
    }

    public function update() {
        $id = $this->input->post('id');
        $data = [
            'titik_awal' => $this->input->post('titik_awal'),
            'tujuan'     => $this->input->post('tujuan'),
            'urutan'     => $this->input->post('urutan'),
            'pos_y'      => $this->input->post('pos_y'),
            'rotasi_y'   => $this->input->post('rotasi_y'),
            'keterangan' => $this->input->post('keterangan'),
            'lat'        => $this->input->post('lat'),
            'lng'        => $this->input->post('lng')
        ];
        
        $this->M_Navigasi->update($id, $data);
        redirect('admin/navigasi');
    }

    public function hapus($id) {
        if ($id) {
            $this->M_Navigasi->delete($id);
        }
        redirect('admin/navigasi');
    }
}