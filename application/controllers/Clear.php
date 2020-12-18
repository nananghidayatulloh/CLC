<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clear extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        session();
    }

    public function clear_all_device()
    {
        $mode = $this->input->post('mode', TRUE);
        if ($mode == "siswa") {
            $result = $this->db->query('TRUNCATE device_siswa restart identity');
            if ($result > 0) {
                echo "Berhasil";
            } else {
                echo "Gagal";
            }
        } elseif($mode == "guru") {
            $result = $this->db->query('TRUNCATE device_guru restart identity');
            if ($result > 0) {
                echo "Berhasil";
            } else {
                echo "Gagal";
            }
        } else {
            echo "Gagal";
        }
    }
}