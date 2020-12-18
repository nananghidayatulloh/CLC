<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_siswa extends CI_Model {
    
    public function datasiswa()
    {
        $query = $this->db->query("SELECT siswa.id_siswa, siswa.nama_siswa, siswa.level, siswa.id_cabang, siswa.produk_name, siswa.class_name, siswa.custom_active_subject, (SELECT nama_cabang FROM cabang_clc WHERE cabang_clc.id_cabang = siswa.id_cabang) AS nama_cabang, siswa.id_guru, (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_guru) AS nama_guru, (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_checker) AS nama_checker, (SELECT exam.nama_guru FROM guru AS exam, guru AS checker WHERE exam.id_guru = checker.id_examiner AND checker.id_guru = siswa.id_checker) AS nama_examiner, siswa.device_limit AS siswa_device_limit FROM siswa ORDER BY siswa.id_siswa");
        return $query;

        // return $this->db->select('siswa.id_siswa, siswa.nama_siswa, siswa.level, siswa.id_cabang, cabang_clc.nama_cabang, siswa.id_guru, guru.nama_guru, checker.nama_guru as nama_checker, (SELECT exam.nama_guru FROM guru AS exam, guru AS checker WHERE exam.id_guru = checker.id_examiner AND checker.id_guru = siswa.id_checker) AS nama_examiner, siswa.device_limit as siswa_device_limit')->from('siswa')->join('cabang_clc', 'cabang_clc.id_cabang = siswa.id_cabang', 'left')->join('guru', 'guru.id_guru = siswa.id_guru', 'left')->order_by('siswa.id_siswa')->get();
    }

    public function pencarian_siswa($keyword)
    {
        $kw = '%'.strtolower($keyword).'%';
        return $this->db->query(
            "SELECT siswa.id_siswa, siswa.nama_siswa, siswa.level, siswa.id_cabang, siswa.produk_name, siswa.class_name, siswa.custom_active_subject,
            (SELECT nama_cabang FROM cabang_clc WHERE cabang_clc.id_cabang = siswa.id_cabang) AS nama_cabang, siswa.id_guru,
            (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_guru) AS nama_guru,
            (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_checker) AS nama_checker,
            (SELECT exam.nama_guru FROM guru AS exam, guru AS checker WHERE exam.id_guru = checker.id_examiner AND checker.id_guru = siswa.id_checker) AS nama_examiner, siswa.device_limit AS siswa_device_limit 

            FROM siswa LEFT JOIN cabang_clc ON siswa.id_cabang = cabang_clc.id_cabang
            LEFT JOIN guru ON siswa.id_guru = guru.id_guru
            LEFT JOIN guru AS checker ON siswa.id_checker = checker.id_guru

            WHERE LOWER(id_siswa) LIKE '$kw' OR LOWER(nama_siswa) LIKE '$kw' OR LOWER(level) LIKE '$kw' OR LOWER(produk_name) LIKE '$kw' OR LOWER(class_name) LIKE '$kw' OR LOWER(nama_cabang) LIKE '$kw' OR LOWER(guru.nama_guru) LIKE '$kw' OR LOWER(checker.nama_guru) LIKE '$kw' ORDER BY siswa.id_siswa"
        );

        // $query = $this->db->query(
        //     "SELECT siswa.id_siswa, siswa.nama_siswa, siswa.level, siswa.id_cabang, siswa.produk_name, siswa.class_name, siswa.custom_active_subject,
        //     (SELECT nama_cabang FROM cabang_clc WHERE cabang_clc.id_cabang = siswa.id_cabang) AS nama_cabang, siswa.id_guru,
        //     (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_guru) AS nama_guru,
        //     (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_checker) AS nama_checker,
        //     (SELECT exam.nama_guru FROM guru AS exam, guru AS checker WHERE exam.id_guru = checker.id_examiner AND checker.id_guru = siswa.id_checker) AS nama_examiner, siswa.device_limit AS siswa_device_limit 
        //     FROM siswa WHERE id_siswa = '$keyword' OR nama_siswa = '$keyword' OR level = '$keyword' ORDER BY siswa.id_siswa");
        // return $query;

    }

    public function dataSiswaPagination($limit, $offset)
    {
        $query = $this->db->query("SELECT siswa.id_siswa, siswa.nama_siswa, siswa.level, siswa.id_cabang, siswa.produk_name, siswa.class_name, siswa.custom_active_subject, (SELECT nama_cabang FROM cabang_clc WHERE cabang_clc.id_cabang = siswa.id_cabang) AS nama_cabang, siswa.id_guru, (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_guru) AS nama_guru, (SELECT nama_guru FROM guru WHERE guru.id_guru = siswa.id_checker) AS nama_checker, (SELECT exam.nama_guru FROM guru AS exam, guru AS checker WHERE exam.id_guru = checker.id_examiner AND checker.id_guru = siswa.id_checker) AS nama_examiner, siswa.device_limit AS siswa_device_limit FROM siswa ORDER BY siswa.id_siswa LIMIT $limit OFFSET $offset");
        return $query;
    }

    public function simpan()
    {   
        $custom_term_activated = $this->input->post('custom_term_activated');
        if ($custom_term_activated == "" || $custom_term_activated == NULL) $custom_term_activated = 0;

        $dialog_activated = $this->input->post('dialog_activated');
        if ($dialog_activated == "" || $dialog_activated == NULL) $dialog_activated = 0;

        $comprehension_activated = $this->input->post('comprehension_activated');
        if ($comprehension_activated == "" || $comprehension_activated == NULL) $comprehension_activated = 0;
        
        $extended_class = $this->input->post('extended_class');
        if ($extended_class == "" || $extended_class == NULL) $extended_class = 0;

        $speaking_activated = $this->input->post('speaking_activated');
        if ($speaking_activated == "" || $speaking_activated == NULL) $speaking_activated = 0;

        $meaning_activated = $this->input->post('meaning_activated');
        if ($meaning_activated == "" || $meaning_activated == NULL) $meaning_activated = 0;

        $custom_story = $this->input->post('custom_story1').$this->input->post('custom_story2').$this->input->post('custom_story3');
        $custom_len = strlen($custom_story);

        if ($custom_len == 2) {
            $custom_story = substr_replace($custom_story, '-', 1, 0);
        } else if ($custom_len == 3) {
            $custom_story = substr_replace($custom_story, '-', 1, 0);
            $custom_story = substr_replace($custom_story, '-', 3, 0);
        }

        $current_term = $this->db->query("SELECT * FROM current_term")->row_array();
        if ($this->input->post('custom_term_from') == "" && $this->input->post('custom_term_from') == NULL) $custom_term_from = $current_term['from_date'];
        if ($this->input->post('custom_term_to') == "" && $this->input->post('custom_term_to') == NULL) $custom_term_to = $current_term['to_date'];

        $data = [
    	    'id_siswa'              => $this->input->post('id_siswa'),
            'nama_siswa'            => $this->input->post('nama_siswa'),
            'level'     	        => $this->input->post('id_level'),
            'tgl_daftar'            => date('Y-m-d'),
            'password'              => $this->input->post('password'),
            'id_cabang'    	        => $this->input->post('nama_cabang'),
            'id_checker'            => $this->input->post('nama_checker'),
            'id_guru'               => $this->input->post('nama_guru'),
            'device_limit'          => $this->input->post('device_limit'),
            'dialog_activated'      => $dialog_activated,
            'custom_term_activated' => $custom_term_activated,
            'custom_term_from'      => $custom_term_from,
            'custom_term_to'        => $custom_term_to,
            'custom_active_story'   => $custom_story,
            'extended_class'        => $extended_class,
            'send_limit'            => $this->input->post('max_recording'),
            'dialog_limit'          => $this->input->post('dialog_limit'),
            'comprehension_activated' => $comprehension_activated,
            'speaking_activated'      => $speaking_activated,
            'meaning_activated'       => $meaning_activated,
            'comprehension_limit'     => $this->input->post('comprehension_limit'),
            'produk_name'             => $this->input->post('produk_name'),
            'class_name'              => $this->input->post('class_name'),
            'custom_active_subject'   => $this->input->post('custom_active_subject'),
        ];
            // print_r($data);
            // die();
            $this->db->insert('siswa', $data);
    }

    public function edit()
    {
        $data = [
            'extended_class'          => $this->input->post('extended_class', TRUE),
            'custom_term_activated'   => $this->input->post('custom_term_activated', TRUE),
            'dialog_activated'        => $this->input->post('dialog_activated', TRUE),
            'comprehension_activated' => $this->input->post('comprehension_activated', TRUE),
            'speaking_activated'      => $this->input->post('speaking_activated', TRUE),
            'meaning_activated'      => $this->input->post('meaning_activated', TRUE),
            'clear_device'            => $this->input->post('clear_device', TRUE),
            'custom_story1'           => $this->input->post('custom_story1', TRUE),
            'custom_story2'           => $this->input->post('custom_story2', TRUE),
            'custom_story3'           => $this->input->post('custom_story3', TRUE)
        ];

        $custom_story = $data['custom_story1'].$data['custom_story2'].$data['custom_story3'];
        $custom_len = strlen($custom_story);

        if ($custom_len == 2) {
            $custom_story = substr_replace($custom_story, '-', 1, 0);
        } else if ($custom_len == 3) {
            $custom_story = substr_replace($custom_story, '-', 1, 0);
            $custom_story = substr_replace($custom_story, '-', 3, 0);
        }

        $extended_class = ($data['extended_class'] == "" || $data['extended_class'] == NULL) ? '0' : '1';
        $custom_term_activated = ($data['custom_term_activated'] == "" || $data['custom_term_activated'] == NULL) ? '0' : '1';
        $dialog_activated = ($data['dialog_activated'] == "" || $data['dialog_activated'] == NULL) ? "0" : '1';
        $comprehension_activated = ($data['comprehension_activated'] == "" || $data['comprehension_activated'] == NULL) ? '0' : '1';
        $speaking_activated = ($data['speaking_activated'] == "" || $data['speaking_activated'] == NULL) ? '0' : '1';
        $meaning_activated = ($data['meaning_activated'] == "" || $data['meaning_activated'] == NULL) ? '0' : '1';
        
        $id_siswa = $this->input->post('id_siswa');
        if ($data['clear_device'] == "" || $data['clear_device'] == NULL) {
            $clear_device =  "0";
        } else {
            $clear_device = "1";
            $this->db->where('id_siswa', $id_siswa);
            $this->db->delete('device_siswa');
        }

        if ($this->input->post('custom_term_from') == "" && $this->input->post('custom_term_to') == "") {
            $insert_data = [
                'id_siswa'                => $this->input->post('id_siswa'),
                'level'                   => $this->input->post('id_level'),
                'nama_siswa'              => $this->input->post('nama_siswa'),
                'password'                => $this->input->post('password'),
                'id_cabang'               => $this->input->post('nama_cabang'),
                'id_checker'              => $this->input->post('nama_checker'),
                'id_guru'                 => $this->input->post('nama_guru'),
                'extended_class'          => $extended_class,
                'custom_term_activated'   => $custom_term_activated,
                'dialog_activated'        => $dialog_activated,
                'dialog_limit'            => $this->input->post('dialog_limit'),
                'comprehension_activated' => $comprehension_activated,
                'comprehension_limit'     => $this->input->post('comprehension_limit'),
                'device_limit'            => $this->input->post('device_limit'),
                'send_limit'              => $this->input->post('max_recording'),
                'produk_name'             => $this->input->post('produk_name'),
                'class_name'              => $this->input->post('class_name'),
                'custom_active_subject'   => $this->input->post('custom_active_subject'),
                'custom_active_story'     => $custom_story,
                'speaking_activated'      => $speaking_activated,
                'meaning_activated'      => $meaning_activated
            ];
        } else {
            $insert_data = [
                'id_siswa'                => $this->input->post('id_siswa'),
                'level'                   => $this->input->post('id_level'),
                'nama_siswa'              => $this->input->post('nama_siswa'),
                'password'                => $this->input->post('password'),
                'id_cabang'               => $this->input->post('nama_cabang'),
                'id_checker'              => $this->input->post('nama_checker'),
                'id_guru'                 => $this->input->post('nama_guru'),
                'custom_term_from'        => $this->input->post('custom_term_from'),
                'custom_term_to'          => $this->input->post('custom_term_to'),
                'extended_class'          => $extended_class,
                'custom_term_activated'   => $custom_term_activated,
                'dialog_activated'        => $dialog_activated,
                'dialog_limit'            => $this->input->post('dialog_limit'),
                'comprehension_activated' => $comprehension_activated,
                'comprehension_limit'     => $this->input->post('comprehension_limit'),
                'device_limit'            => $this->input->post('device_limit'),
                'send_limit'              => $this->input->post('max_recording'),
                'produk_name'             => $this->input->post('produk_name'),
                'class_name'              => $this->input->post('class_name'),
                'custom_active_subject'   => $this->input->post('custom_active_subject'),
                'custom_active_story'     => $custom_story,
                'speaking_activated'      => $speaking_activated,
                'meaning_activated'      => $meaning_activated
            ];
        }

        // print_r($insert_data);
        // die();
        $this->db->where('id_siswa', $insert_data['id_siswa']);
        $this->db->update('siswa', $insert_data);

        $id_guru = $insert_data['id_guru'];
        $examiner = $this->db->query("SELECT id_examiner FROM guru WHERE id_guru = '$id_guru'")->row_array();
        $guru_fin_tes = $this->db->query("UPDATE final_test SET id_guru = '$examiner[id_examiner]' WHERE id_siswa = '$id_siswa' AND status = '0'");
    }

    public function device($id)
    {
        $query = $this->db->query(" SELECT device_type, device_unique_id FROM device_siswa WHERE id_siswa = '$id' ");
        return $query->result_array();
    }

    public function siswa_csv($data)
    {
        foreach ($data as $da) {
            $sql = $this->db->insert_string('siswa', $da) . ' ON DUPLICATE KEY UPDATE duplicate=duplicate+1';
            $this->db->query($sql);
            $id = $this->db->insert_id();
            echo $id;
        }
        die();
        return $this->db->insert_batch('siswa', $data);
    }

    public function profil_siswa($id)
    {
        $query = $this->db->query("SELECT nama_siswa, level, id_guru FROM siswa WHERE id_siswa = '$id'");
        return $query;
    }

    public function history_daily_reading($id, $level)
    {
        $query = $this->db->query("SELECT ROW_NUMBER () OVER (ORDER BY id_tugas), unit, story, time, speed, nada, try, status, jumlah_salah, tgl_upload, tgl_sebenarnya, note, waktu_periksa, jam, mode FROM tugas WHERE id_siswa = '$id' AND level = '$level' ORDER BY unit ASC, id_tugas ASC");
        return $query;
    }

    public function history_dialog($id, $level)
    {
        $query = $this->db->query("SELECT ROW_NUMBER () OVER (ORDER BY tgl_upload), time, speed, nada, try, status, jumlah_salah, tgl_upload, tgl_sebenarnya, note, waktu_periksa, jam, dialog_number, mode FROM dialog WHERE id_siswa = '$id' AND level = '$level' ORDER BY id_dialog ASC");
        return $query;
    }

    public function history_comprehension($id, $level)
    {
        return $this->db->query("SELECT ROW_NUMBER() OVER (ORDER BY id_comprehension), try, status, time, speed, nada, jumlah_salah, tgl_upload, tgl_sebenarnya, jam, note, waktu_periksa, mode FROM comprehension WHERE id_siswa = '$id' AND level = '$level' ORDER BY id_comprehension ASC");
    }

    public function history_exam($id, $level)
    {
        return $this->db->query("SELECT ROW_NUMBER() OVER (ORDER BY id_test), unit, story, try, status, time, jumlah_salah, tgl_upload, tgl_sebenarnya, waktu_periksa, jam FROM final_test WHERE id_siswa = '$id' AND level = '$level' ORDER BY id_test ASC");
    }

    public function history_quiz_dialog($id, $level)
    {
        return $this->db->query("SELECT ROW_NUMBER() OVER (ORDER BY id_quiz), id_dialog, try, completion, tgl_upload, tgl_sebenarnya, jam, mode FROM dialog_quiz WHERE level = '$level' and id_siswa = '$id'");
    }

    public function history_quiz_comprehension($id, $level)
    {
        return $this->db->query("SELECT ROW_NUMBER() OVER (ORDER BY id_quiz), id_comprehension, try, completion, tgl_upload, tgl_sebenarnya, jam, mode FROM comprehension_quiz WHERE id_siswa = '$id' and level = '$level'");
    }

    public function goal($id, $level)
    {
        $query = $this->db->query("SELECT ROW_NUMBER () OVER (ORDER BY unit), unit, story FROM goal WHERE id_siswa = '$id' AND level = '$level' ORDER BY id_goal");
        return $query;
    }
}