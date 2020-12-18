<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_clear extends CI_Model {
    public function data_clear()
    {
        // $query = $this->db->query("SELECT id_siswa, nama_siswa, warning FROM siswa WHERE warning >=1 ORDER BY warning DESC");
        // return $query->result_array();

        return $this->db->select('id_siswa, nama_siswa, warning, level, cabang_clc.nama_cabang, (select count(clear_warning_counter.id_siswa) as total_cleared from clear_warning_counter where clear_warning_counter.id_siswa = siswa.id_siswa)')->from('siswa')->join('cabang_clc', 'siswa.id_cabang = cabang_clc.id_cabang')->where('warning >=', 1)->order_by('warning', 'desc')->get();
    }

    public function daily_reading()
    {
        return $this->db->select('siswa.id_siswa, nama_siswa, level, cabang_clc.nama_cabang, warning.daily_reading as warning, warning.totalclear_dailyreading as total')->from('siswa')->join('cabang_clc', 'siswa.id_cabang = cabang_clc.id_cabang', 'left')->join('warning', 'warning.id_siswa = siswa.id_siswa', 'left')->where('warning.daily_reading >=', 1)->order_by('warning.daily_reading', 'desc')->get();
    }

    public function daily_speaking()
    {
        return $this->db->select('siswa.id_siswa, nama_siswa, level, cabang_clc.nama_cabang, warning.daily_speaking as warning, warning.totalclear_dailyspeaking as total')->from('siswa')->join('cabang_clc', 'siswa.id_cabang = cabang_clc.id_cabang', 'left')->join('warning', 'warning.id_siswa = siswa.id_siswa', 'left')->where('warning.daily_speaking >=', 1)->order_by('warning.daily_speaking', 'desc')->get();
    }

    public function clear_warning($data)
    {   
        $getData = $this->db->get_where('warning', ['id_siswa' => $data['id_siswa']])->row_array();
        if($data['mode'] == 'daily_reading') {
            $update['daily_reading'] = 0;
            $update['totalclear_dailyreading'] = $getData['totalclear_dailyreading'] + 1;

            $this->db->where('id_siswa', $data['id_siswa']);
            return $this->db->update('warning', $update);
        } else {
            $update['daily_speaking'] = 0;
            $update['totalclear_dailyspeaking'] = $getData['totalclear_dailyspeaking'] + 1;

            $this->db->where('id_siswa', $data['id_siswa']);
            return $this->db->update('warning', $update);
        }
    }

    public function edit()
    {
        $data = [
            'warning' => $this->input->post('warning'),
        ];

        $id_siswa = $this->input->post('id_siswa');
        $this->db->where('id_siswa', $id_siswa);
        $this->db->update('siswa', $data);

        $data_clear_count = [
            'id_siswa' => $id_siswa,
            'date' => date('Y-m-d')
        ];
        
        $this->db->insert('clear_warning_counter', $data_clear_count);
    }
}