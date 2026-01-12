<?php

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Upload $upload
 * @property M_wisata $M_wisata
 */

class Objek_wisata extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "logged_in") redirect(base_url("auth"));
        $this->load->model('M_wisata');
    }

    public function index() {
        $data['wisata'] = $this->M_wisata->get_all_wisata();
        $this->load->view('templates/header');
        $this->load->view('admin/wisata/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        $this->load->view('templates/header');
        $this->load->view('admin/wisata/tambah');
        $this->load->view('templates/footer');
    }

    public function simpan() {
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name']  = TRUE; 
        $this->load->library('upload', $config);

        $gambar = "default.jpg";
        if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data('file_name');
        }

        $data = [
            'nama_id'       => $this->input->post('nama_id'),
            'nama_eng'      => $this->input->post('nama_eng'),
            'deskripsi_id'  => $this->input->post('deskripsi_id'),
            'deskripsi_eng' => $this->input->post('deskripsi_eng'),
            'kategori'      => $this->input->post('kategori'),
            'filosofi_id'   => $this->input->post('filosofi_id'),
            'filosofi_eng'  => $this->input->post('filosofi_eng'),
            'gambar'        => $gambar
        ];

        $this->M_wisata->insert($data);
        redirect('admin/objek_wisata');
    }

    public function edit($id) {
    $data['wisata'] = $this->M_wisata->get_wisata_by_id($id);
    $this->load->view('templates/header');
    $this->load->view('admin/wisata/edit', $data);
    $this->load->view('templates/footer');
}

public function update() {
    $id = $this->input->post('id');
    $old_data = $this->M_wisata->get_wisata_by_id($id);

    $config['upload_path']   = './assets/uploads/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);

    // Cek apakah ada file baru yang diupload
    if ($this->upload->do_upload('gambar')) {
        // 1. Ambil nama file baru
        $new_image = $this->upload->data('file_name');
        
        // 2. Hapus file lama dari folder (jika bukan default.jpg)
        if ($old_data->gambar != 'default.jpg' && file_exists('./assets/uploads/' . $old_data->gambar)) {
            unlink('./assets/uploads/' . $old_data->gambar);
        }
        
        $gambar = $new_image;
    } else {
        // Jika tidak upload gambar baru, gunakan gambar lama
        $gambar = $this->input->post('old_gambar');
    }

    $data = [
        'nama_id'       => $this->input->post('nama_id'),
        'nama_eng'      => $this->input->post('nama_eng'),
        'deskripsi_id'  => $this->input->post('deskripsi_id'),
        'deskripsi_eng' => $this->input->post('deskripsi_eng'),
        'kategori'      => $this->input->post('kategori'),
        'filosofi_id'   => $this->input->post('filosofi_id'),
        'filosofi_eng'  => $this->input->post('filosofi_eng'),
        'gambar'        => $gambar
    ];

    $this->M_wisata->update_wisata($id, $data);
    redirect('admin/objek_wisata');
}

    public function hapus($id) {
        $this->M_wisata->delete($id);
        redirect('admin/objek_wisata');
    }
}