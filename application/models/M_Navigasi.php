<?php
class M_Navigasi extends CI_Model {
    public function get_rute($asal, $tujuan) {
        $this->db->where('titik_awal', $asal);
        $this->db->where('tujuan', $tujuan);
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get('rute_navigasi')->result();
    }
}