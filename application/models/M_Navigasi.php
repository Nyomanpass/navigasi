<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Navigasi extends CI_Model {

    // Ambil daftar unik ID awal dan join ke tabel objek_wisata untuk ambil namanya
    public function get_list_asal() {
        return $this->db->select('rute_navigasi.titik_awal, objek_wisata.nama_id')
                        ->from('rute_navigasi')
                        ->join('objek_wisata', 'objek_wisata.id = rute_navigasi.titik_awal')
                        ->distinct()
                        ->get()
                        ->result();
    }

    // Ambil daftar unik ID tujuan dan join ke tabel objek_wisata
    public function get_list_tujuan() {
        return $this->db->select('rute_navigasi.tujuan, objek_wisata.nama_id')
                        ->from('rute_navigasi')
                        ->join('objek_wisata', 'objek_wisata.id = rute_navigasi.tujuan')
                        ->distinct()
                        ->get()
                        ->result();
    }

    public function get_rute($asal, $tujuan) {
        $this->db->where('titik_awal', $asal);
        $this->db->where('tujuan', $tujuan);
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get('rute_navigasi')->result();
    }

    // Fungsi tambahan untuk mengambil nama satu objek saja (untuk tampilan di AR)
    public function get_nama_objek($id) {
        $query = $this->db->select('nama_id')->where('id', $id)->get('objek_wisata')->row();
        return $query ? $query->nama_id : "Lokasi";
    }

    public function get_all_admin() {
        $this->db->select('rute_navigasi.*, w1.nama_id as nama_asal, w2.nama_id as nama_tujuan');
        $this->db->from('rute_navigasi');
        $this->db->join('objek_wisata w1', 'rute_navigasi.titik_awal = w1.id', 'left');
        $this->db->join('objek_wisata w2', 'rute_navigasi.tujuan = w2.id', 'left');
        $this->db->order_by('rute_navigasi.titik_awal', 'ASC');
        $this->db->order_by('rute_navigasi.urutan', 'ASC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        return $this->db->insert('rute_navigasi', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('rute_navigasi', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('rute_navigasi');
    }
}