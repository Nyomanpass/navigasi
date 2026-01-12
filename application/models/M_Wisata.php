<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Wisata extends CI_Model {

    // 1. Mengambil semua data (Read)
    public function get_all_wisata() {
        // Urutkan berdasarkan yang terbaru ditambahkan
        $this->db->order_by('id', 'DESC');
        return $this->db->get('objek_wisata')->result();
    }

    // 2. Mengambil satu data berdasarkan ID (Read for Edit)
    public function get_wisata_by_id($id) {
        return $this->db->get_where('objek_wisata', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('objek_wisata', $data);
    }

    public function delete($id) {
        // 1. Ambil data wisata berdasarkan ID untuk mendapatkan nama file gambar
        $this->db->where('id', $id);
        $query = $this->db->get('objek_wisata');
        $row = $query->row();

        // 2. Jika data ditemukan dan bukan gambar default, hapus file fisiknya
        if ($row) {
            $file_path = './assets/uploads/' . $row->gambar;
            
            // Cek apakah file ada di folder dan pastikan bukan file 'default.jpg'
            if (file_exists($file_path) && $row->gambar != 'default.jpg') {
                unlink($file_path); // Menghapus file dari folder assets/uploads/
            }
        }

        // 3. Hapus baris data dari database
        $this->db->where('id', $id);
        return $this->db->delete('objek_wisata');
    }
    
    // 4. Mengubah data (Update)
    public function update_wisata($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('objek_wisata', $data);
    }

}