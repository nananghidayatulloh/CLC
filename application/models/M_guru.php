<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_guru extends CI_Model {
    
    public function dataguru()
    {
        $query = $this->db->query("SELECT * FROM guru WHERE id_guru != '' ORDER BY id_guru ASC");
        return $query->result_array();
    }
    
    public function dataperguru()
    {
        $query = $this->db->query("SELECT id_guru, nama_guru FROM guru WHERE id_guru != '' ORDER BY id_guru ASC");
        return $query->result_array();
    }

    public function datadevice($id_guru)
    {
        $query = $this->db->query("SELECT * FROM device_guru WHERE id_guru = '$id_guru' ORDER BY no ASC");
        return $query;
    }
    public function simpan() {
        $data = array(
            'id_guru'       => $this->input->post('id_guru'),
            'nama_guru'     => $this->input->post('nama_guru'),
            'password'      => $this->input->post('password'),
            'id_examiner'   => $this->input->post('id_examiner'),
        );
        
            $this->db->insert('guru', $data);
    }

    public function edit() {
        $clear_device = $this->input->post('clear_device', TRUE);
        $id_guru = $this->input->post('id_guru');

        $examiner_lama = $this->db->query("SELECT id_examiner FROM guru WHERE id_guru = '$id_guru'")->row_array();
        $examiner_lama = $examiner_lama['id_examiner'];

        $id_examiner = $this->input->post('id_examiner');

        if ($examiner_lama != $id_examiner) {
            $list_siswa = $this->db->query("SELECT id_siswa FROM siswa WHERE id_guru = '$id_guru'")->result_array();
            foreach ($list_siswa as $ls) {
                $id_siswa = $ls['id_siswa'];
                // echo $id_siswa."<br>";
                $this->db->query("UPDATE final_test SET id_guru = '$id_examiner' WHERE final_test.status = 0 AND final_test.id_siswa = '$id_siswa'");
            }
        }

        if ($clear_device == "1") {
            $this->db->where('id_guru', $id_guru);
            $reset_device = $this->db->delete('device_guru');
        }

            $data = array(
                'nama_guru'     => $this->input->post('nama_guru'),
                'password'      => $this->input->post('password'),
                'device_limit'  => $this->input->post('device_limit'),
                'id_examiner'   => $id_examiner
            );
    
            $this->db->where('id_guru', $id_guru);
            $result = $this->db->update('guru', $data);
            if ($result > 0) {
                $this->db->query("UPDATE guru SET id_examiner = '$id_guru' WHERE guru.id_guru = '$id_guru'" );
                return $return = "Berhasil";
            } else {
                return $return = "Gagal";
            }
    }
}