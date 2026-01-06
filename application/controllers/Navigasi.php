<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Memastikan database dan library input terload dengan benar
        $this->load->database(); 
        $this->load->library('session'); // Kadang dibutuhkan untuk input
        
        // Memanggil Model (Pastikan penulisan file M_Navigasi.php benar)
        $this->load->model('M_Navigasi');
        
        // Load Helper
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
    // Mengambil daftar titik_awal yang unik dari database
        $data['lokasi_asal'] = $this->db->select('titik_awal')->distinct()->get('rute_navigasi')->result();
        // Mengambil daftar tujuan yang unik
        $data['lokasi_tujuan'] = $this->db->select('tujuan')->distinct()->get('rute_navigasi')->result();
        
        $this->load->view('v_menu_utama', $data);
    }

    public function mulai() {
        // Ambil data post dengan pengamanan XSS filter
        $asal = $this->input->post('asal', TRUE);
        $tujuan = $this->input->post('tujuan', TRUE);

        // Cek apakah data ada di database
        $data['waypoints'] = $this->M_Navigasi->get_rute($asal, $tujuan);
        $data['asal'] = $asal;
        $data['tujuan'] = $tujuan;

        if (empty($data['waypoints'])) {
            echo "Rute tidak ditemukan di database! Silakan isi tabel rute_navigasi dulu.";
        } else {
            $this->load->view('v_navigasi_ar', $data);
        }
    }
}