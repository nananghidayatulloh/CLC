<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_log extends CI_Model {
    
    public function data_log_daily($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, ROW_NUMBER() OVER (ORDER BY id_tugas), tugas.id_checker AS id_checker_t, siswa.id_checker AS id_checker_s FROM tugas LEFT JOIN siswa ON tugas.id_siswa = siswa.id_siswa LEFT JOIN cabang_clc ON siswa.id_cabang = cabang_clc.id_cabang WHERE to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_tugas ASC");
        return $query;
        
    }

    public function data_log_daily_reading_by_id($id)
    {
        return $this->db->query("SELECT *, tugas.level level_t from tugas, siswa, cabang_clc where siswa.id_siswa = tugas.id_siswa  and siswa.id_cabang = cabang_clc.id_cabang and id_tugas = '$id'");
    }

    public function get_id_Dialog($id)
    {
        $query = $this->db->query("SELECT id_dialog, note, speed, nada, status FROM dialog WHERE id_dialog = '$id'");
        return $query;
    }

    public function get_id_Tugas($id)
    {
        $query = $this->db->query("SELECT id_tugas, note, speed, nada, status FROM tugas WHERE id_tugas = '$id'");
        return $query;
    }

    public function get_id_Comprehension($id)
    {
        $query = $this->db->query("SELECT id_comprehension, note, speed, nada, status FROM comprehension WHERE id_comprehension = '$id'");
        return $query;
    }

    public function get_id_DailySpeaking($id)
    {
        $query = $this->db->query("SELECT id_tugas, note, speed, nada, status FROM daily_speaking WHERE id_tugas = '$id'");
        return $query;
    }

    public function log_dialy_speaking_edit($id_tugas, $data_update)
    {   
        $result = [];
        $this->db->where('id_tugas', $id_tugas);
        $update = $this->db->update('daily_speaking', $data_update);
        if ($update > 0) {
            $result = "EDIT DATA LOG DAILY SPEAKING";
        } else {
            $result = "GAGAL EDIT DATA LOG DAILY SPEAKING";
        }

        return $result;
    }

    public function get_id_daily_reading_recording($id)
    {
        return $this->db->select('id_tugas AS id_recording, note, speed, nada, status')->where('id_tugas', $id)->get('tugas');
    }

    public function get_id_dialog_recording($id)
    {
        return $this->db->select('id_dialog AS id_recording, note, speed, nada, status')->where('id_dialog', $id)->get('dialog');
    }

    public function get_id_comprehension_recording($id)
    {
        return $this->db->select('id_comprehension AS id_recording, note, speed, nada, status')->where('id_comprehension', $id)->get('comprehension');
    }
    
    public function get_id_daily_speaking_recording($id)
    {
        return $this->db->select('id_tugas AS id_recording, note, speed, nada, status')->where('id_tugas', $id)->get('daily_speaking');
    }

    public function log_dialy_reading_edit($id_tugas, $data_update)
    {   
        $result = [];
        $this->db->where('id_tugas', $id_tugas);
        $update = $this->db->update('tugas', $data_update);
        if ($update > 0) {
            $result = "EDIT DATA LOG DAILY READING";
        } else {
            $result = "GAGAL EDIT DATA LOG DAILY READING";
        }

        return $result;
    }

    public function log_reset_daily_reading($id_tugas)
    {
        $data_reset['status'] = 0;
        $this->db->where('id_tugas', $id_tugas);
        $reset = $this->db->update('tugas', $data_reset);
        if ($reset > 0) {
            $result = "RESET DATA LOG DAILY READING";
        } else {
            $result = "GAGAL RESET DATA LOG DAILY READING";
        }

        return $result;
    }

    public function log_reset_daily_speaking($id_tugas)
    {
        $data_reset['status'] = 0;
        $this->db->where('id_tugas', $id_tugas);
        $reset = $this->db->update('daily_speaking', $data_reset);
        if ($reset > 0) {
            $result = "RESET DATA LOG DAILY SPEAKING";
        } else {
            $result = "GAGAL RESET DATA LOG DAILY SPEAKING";
        }

        return $result;
    }

    public function log_dialog_edit($id_dialog, $data_update)
    {   
        $result = [];
        $this->db->where('id_dialog', $id_dialog);
        $update = $this->db->update('dialog', $data_update);
        if ($update > 0) {
            $result = "EDIT DATA LOG DIALOG";
        } else {
            $result = "GAGAL EDIT DATA LOG DIALOG";
        }

        return $result;
    }

    public function log_reset_dialog($id_tugas)
    {
        $data_reset['status'] = 0;
        $this->db->where('id_dialog', $id_tugas);
        $reset = $this->db->update('dialog', $data_reset);
        if ($reset > 0) {
            $result = "RESET DATA LOG DIALOG";
        } else {
            $result = "GAGAL RESET DATA LOG DIALOG";
        }

        return $result;
    }

    public function log_comprehension_edit($id_comprehension, $data_update)
    {   
        $result = [];
        $this->db->where('id_comprehension', $id_comprehension);
        $update = $this->db->update('comprehension', $data_update);
        if ($update > 0) {
            $result = "EDIT DATA LOG COMPREHENSION";
        } else {
            $result = "GAGAL EDIT DATA LOG COMPREHENSION";
        }

        return $result;
    }

    public function log_reset_comprehension($id_tugas)
    {
        $data_reset['status'] = 0;
        $this->db->where('id_comprehension', $id_tugas);
        $reset = $this->db->update('comprehension', $data_reset);
        if ($reset > 0) {
            $result = "RESET DATA LOG COMPREHENSION";
        } else {
            $result = "GAGAL RESET DATA LOG COMPREHENSION";
        }

        return $result;
    }

    public function edit()
    {
        $data = array(
            'note'     => $this->input->post('note'),
        );
        
        $id_tugas   = $this->input->post('id_tugas');
        $this->db->where('id_tugas', $id_tugas);
        $this->db->update('tugas', $data);
    }

    public function data_log_dialog_quiz($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, ROW_NUMBER() OVER (ORDER BY id_quiz) FROM dialog_quiz LEFT JOIN siswa ON dialog_quiz.id_siswa = siswa.id_siswa LEFT JOIN cabang_clc ON siswa.id_cabang = cabang_clc.id_cabang WHERE to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_quiz DESC");

        return $query;
    }

    public function data_log_dialog_recording($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, ROW_NUMBER() OVER (ORDER BY id_dialog), dialog.id_checker AS id_checker_dialog FROM dialog LEFT JOIN siswa ON dialog.id_siswa = siswa.id_siswa LEFT JOIN cabang_clc ON siswa.id_cabang = cabang_clc.id_cabang LEFT JOIN guru ON guru.id_guru = dialog.id_checker WHERE to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_dialog ASC");

        return $query;
    }

    public function data_log_exam($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, ROW_NUMBER() OVER (ORDER BY id_test), final_test.id_guru AS id_guru_final_test FROM final_test LEFT JOIN siswa ON final_test.id_siswa = siswa.id_siswa LEFT JOIN cabang_clc ON siswa.id_cabang = cabang_clc.id_cabang LEFT JOIN guru ON final_test.id_guru = guru.id_guru WHERE to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_test ASC");

        return $query;
    }

    public function data_log_comprehension_recording($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, ROW_NUMBER() OVER (ORDER BY id_comprehension), comprehension.id_checker AS id_checker_comprehension FROM comprehension LEFT JOIN siswa ON comprehension.id_siswa = siswa.id_siswa LEFT JOIN cabang_clc ON siswa.id_cabang = cabang_clc.id_cabang LEFT JOIN guru ON comprehension.id_checker = guru.id_guru WHERE to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_comprehension ASC");
        
        return $query;
    }

    public function data_log_daily_speaking($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, ROW_NUMBER() OVER (ORDER BY id_tugas), daily_speaking.id_checker AS id_checker_daily_speaking FROM daily_speaking LEFT JOIN siswa ON daily_speaking.id_siswa = siswa.id_siswa LEFT JOIN cabang_clc ON siswa.id_cabang = cabang_clc.id_cabang LEFT JOIN guru ON daily_speaking.id_checker = guru.id_guru WHERE to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_tugas ASC");

        return $query;
    }

    public function data_log_comprehension_quiz($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, comprehension_quiz.level as level_d, ROW_NUMBER () OVER (ORDER BY id_quiz) FROM comprehension_quiz, siswa, cabang_clc WHERE siswa.id_siswa = comprehension_quiz.id_siswa AND siswa.id_cabang = cabang_clc.id_cabang AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_quiz DESC");
        return $query;
    }

    public function data_log_daily_quiz($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, daily_quiz_matching.level as level_d, ROW_NUMBER () OVER (ORDER BY id_quiz) FROM daily_quiz_matching, siswa, cabang_clc WHERE siswa.id_siswa = daily_quiz_matching.id_siswa AND siswa.id_cabang = cabang_clc.id_cabang AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY id_quiz DESC");
        return $query;
    }

    public function data_log_meaning($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, selftest_meaning_quiz.level as level_d, ROW_NUMBER () OVER (ORDER BY id_selftest_meaning_quiz) FROM selftest_meaning_quiz, siswa, cabang_clc WHERE siswa.id_siswa = selftest_meaning_quiz.id_siswa AND siswa.id_cabang = cabang_clc.id_cabang AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY selftest_meaning_quiz DESC");
        return $query;
    }

    public function data_log_keyword($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, selftest_keyword_quiz.level as level_d, ROW_NUMBER () OVER (ORDER BY id_selftest_keyword_quiz) FROM selftest_keyword_quiz, siswa, cabang_clc WHERE siswa.id_siswa = selftest_keyword_quiz.id_siswa AND siswa.id_cabang = cabang_clc.id_cabang AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY selftest_keyword_quiz DESC");
        return $query;
    }

    public function data_log_arranging($dari, $sampai)
    {
        $query = $this->db->query("SELECT *, selftest_arranging_quiz.level as level_d, ROW_NUMBER () OVER (ORDER BY id_selftest_arranging_quiz) FROM selftest_arranging_quiz, siswa, cabang_clc WHERE siswa.id_siswa = selftest_arranging_quiz.id_siswa AND siswa.id_cabang = cabang_clc.id_cabang AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$dari' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$sampai' ORDER BY selftest_arranging_quiz DESC");
        return $query;
    }
}