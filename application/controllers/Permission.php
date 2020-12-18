<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        $data_update = [
            'spontan'  => 0,
            'practice' => 0,
            'test'     => 0,
            'review'   => 0,
        ];
        $this->db->update('permission_selftest', $data_update);

        echo "Berhasil change permission";
    }
}