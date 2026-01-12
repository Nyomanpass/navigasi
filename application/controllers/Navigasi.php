<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property M_Navigasi $M_Navigasi
 * @property CI_Input $input
 */
class Navigasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load resources
        $this->load->database(); 
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form']);
        
        // Load Model
        $this->load->model('M_Navigasi');
    }

    public function index() {
        // Mengambil data melalui Model (lebih rapi)
        $data = [
            'lokasi_asal'   => $this->M_Navigasi->get_list_asal(),
            'lokasi_tujuan' => $this->M_Navigasi->get_list_tujuan(),
            'title'         => 'Menu Utama Navigasi'
        ];
        
        $this->load->view('v_menu_utama', $data);
    }

    public function mulai() {
        $asal   = $this->input->post('asal', TRUE);
        $tujuan = $this->input->post('tujuan', TRUE);

        if (!$asal || !$tujuan) {
            $this->session->set_flashdata('error', 'Silakan pilih asal dan tujuan.');
            redirect('navigasi');
        }

        $waypoints = $this->M_Navigasi->get_rute($asal, $tujuan);

        if (empty($waypoints)) {
            // ... (pesan error tetap sama) ...
        } else {
            // AMBIL NAMA ASLI DARI ID
            $nama_tujuan = $this->M_Navigasi->get_nama_objek($tujuan);

            $data = [
                'waypoints'   => $waypoints,
                'nama_tujuan' => $nama_tujuan, // Kirim nama asli ke view
                'asal'        => $asal,
                'tujuan'      => $tujuan
            ];
            $this->load->view('v_navigasi_ar', $data);
        }
    }
}