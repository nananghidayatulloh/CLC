<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_kantor extends CI_Model {
    
    public function datakantor()
    {
        $query = $this->db->query("SELECT * FROM cabang_clc ORDER BY id_cabang ASC ");
        return $query->result_array();
    }

    public function simpan()
    {
    	$data = array(
            'nama_cabang'     => $this->input->post('nama_cabang'),
        );
        
            $this->db->insert('cabang_clc', $data);
    }

    public function edit() {
        $data = array(
            'nama_cabang'  => $this->input->post('nama_cabang'),
        );
        
        $id_cabang   = $this->input->post('id_cabang');
        $this->db->where('id_cabang', $id_cabang);
        $this->db->update('cabang_clc', $data);
    }
}