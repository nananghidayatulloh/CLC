<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_user_agent_mngmnt extends CI_Model {

    public function insert_user_agent($user_agent, $id_siswa)
    {
        $dec_id_siswa = decrypt_url($id_siswa);
        $get_data = $this->db->get_where('user_agent', ['id_siswa' => $dec_id_siswa]);

        if ($get_data->num_rows() > 0) {
            return $get_data->result_array();
        } else {
            $user_agent['id_siswa'] = $dec_id_siswa;
            return $this->db->insert('user_agent', $user_agent);
        }
    }
}