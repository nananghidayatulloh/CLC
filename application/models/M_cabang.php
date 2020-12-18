<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_cabang extends CI_Model {
    
    public function datacabang()
    {
        $query = $this->db->query("SELECT * FROM cabang_clc ORDER BY id_cabang ASC");
        return $query->result_array();
    }
}