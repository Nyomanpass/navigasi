<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Rules extends CI_Model {

    // Mengambil semua aturan wisata
    public function get_all_rules() {
        // Urutkan berdasarkan tipe agar 'do' muncul lebih dulu baru 'dont'
        return $this->db->order_by('tipe', 'ASC')->get('rules_wisata')->result();
    }

    // Menambah aturan baru
    public function insert_rule($data) {
        return $this->db->insert('rules_wisata', $data);
    }

    // Mengambil satu aturan berdasarkan ID (untuk edit)
    public function get_rule_by_id($id) {
        return $this->db->get_where('rules_wisata', ['id' => $id])->row();
    }

    // Memperbarui data aturan
    public function update_rule($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('rules_wisata', $data);
    }

    // Menghapus aturan
    public function delete_rule($id) {
        $this->db->where('id', $id);
        return $this->db->delete('rules_wisata');
    }
}