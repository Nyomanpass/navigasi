<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property M_Wisata $M_Wisata
 */
class ObjekWisata extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load model
        $this->load->model('M_Wisata');
    }

    public function index() {
        // Garis merah akan hilang karena @property di atas memberi tahu editor
        $data['wisata'] = $this->M_Wisata->get_all_wisata();
        $this->load->view('v_wisata_index', $data);
    }

    public function detail($id) {
        $data['item'] = $this->M_Wisata->get_wisata_by_id($id);
        if(!$data['item']) show_404();
        $this->load->view('v_wisata_detail', $data);
    }
}