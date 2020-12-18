<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_reminder extends CI_Model {

    public function getReminder()
    {
        return $this->db->get('reminder');
    }

    public function kirim()
    {
        $status = 0;
        if ($this->input->post('status') != null) {
            $status = 1;
        }
        $data = [
            'id' => 1,
            'title'     => $this->input->post('title'),
            'message'   => $this->input->post('message'),
            'hour'      => $this->input->post('hour'),
            'status'    => $status
        ];

        $this->db->truncate('reminder');
        $this->db->insert('reminder', $data);
    }
}