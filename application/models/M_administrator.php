<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_administrator extends CI_Model {
    public $table  ="login";

    //data
    public function data_administrator() {
    	$query	=	"SELECT * FROM $this->table ORDER BY username ASC";
    	return $this->db->query($query)->result_array();
    }

    public function simpan_administrator() {
        $data = array(
            'username'      => $this->input->post('username'),
            'password'      => SHA1($this->input->post('password')),
            'role_user'     => $this->input->post('role_user'),
        );

            $this->db->insert($this->table, $data);
    }

    public function edit_administrator(){
        if($this->input->post('username') == '') {
            $data = array(
                'password'     => SHA1($this->input->post('password')),
                'role_user'    => $this->input->post('role_user'),
            );
        } else if($this->input->post('password') != '') {
            $data = array(
                'username'     => $this->input->post('username'),
                'role_user'    => $this->input->post('role_user'),
                'password'     => SHA1($this->input->post('password'))
            );
        } else if($this->input->post('password') == '') {
            $data = array (
                'username'     => $this->input->post('username'),
                'role_user'    => $this->input->post('role_user'),

            );
        } else if($this->input->post('role_user') == '') {
            $data = array(
                'username'     => $this->input->post('username'),
                'password'     => $this->input->post('password'),
            );
        }

        $username   = $this->input->post('username');
        $this->db->where('username', $username);
        $this->db->update($this->table, $data);
    }
}
