<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_calendar extends CI_Model {
    public function cekCalendar($indo_format)
    {
        $query = $this->db->query("SELECT * FROM calendar WHERE indo_format = '$indo_format'");
        return $query;
    }

    public function insertData($clc_format, $indo_format)
    {
        $data = [
            'clc_format' => $clc_format,
            'indo_format' => $indo_format
        ];

        return $this->db->insert('calendar', $data);
    }

    public function updateData($clc_format, $indo_format)
    {
        $data = [
            'clc_format' => $clc_format
        ];
        $this->db->where('indo_format', $indo_format);
        return $this->db->update('calendar', $data);
        // $query = $this->db->query("UPDATE calendar SET clc_format = '$clc_format' where indo_format='$indo_format'");
        // return $query;
    }

    public function deleteData($indo_format)
    {
        $this->db->where('indo_format', $indo_format);
        return $this->db->delete('calendar');
    }
}