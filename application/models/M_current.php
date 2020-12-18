<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_current extends CI_Model {
    public function edit()
    {
        $data = [
            'from_date' => $this->input->post('from_date'),
            'to_date' => $this->input->post('to_date'),
            'end_term_notice' => $this->input->post('end_term_notice')
        ];

        $no = $this->input->post('no');
        $this->db->where('no', $no);
        $this->db->update('current_term', $data);
    }

    public function getCurrentTerm()
    {
        return $this->db->get('current_term');
    }

    public function dataCalendar($bulan, $tahun)
    {
        return $this->db->query("SELECT * FROM calendar WHERE to_char(indo_format, 'YYYY-MM-DD') LIKE '%$tahun-$bulan%'");
    }

    public function tgl_CLC($tgl)
    {
        return $this->db->query("SELECT clc_format FROM calendar WHERE indo_format = '$tgl'");
    }
}