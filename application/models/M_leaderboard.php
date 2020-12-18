<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_leaderboard extends CI_Model {
    
    public function dataCurrentTerm()
    {
        $query = $this->db->get('current_term');
        return $query->result_array()[0];
    }

    public function dataNamaCabang($cabang)
    {
        $query = "SELECT nama_cabang FROM cabang_clc where id_cabang = '$cabang'";
        return $this->db->query($query)->result_array();
    }

    public function dataGetStudent($level, $cabang)
    {
        $query = "SELECT id_siswa, nama_siswa, nama_cabang FROM siswa, cabang_clc WHERE level = '$level' AND siswa.id_cabang != 4 AND cabang_clc.id_cabang = siswa.id_cabang ORDER BY id_siswa";
        return $this->db->query($query)->result_array();
    }

    public function dataGetStudent1($level, $cabang)
    {
        $query = "SELECT id_siswa, nama_siswa, nama_cabang FROM siswa, cabang_clc WHERE level = '$level' AND siswa.id_cabang = '$cabang' AND cabang_clc.id_cabang = siswa.id_cabang ORDER BY id_siswa";
        return $this->db->query($query)->result_array();
    }
    
    public function dataCrownList($id_siswa, $nama_siswa, $level, $from_date, $to_date, $nama_cabang)
    {
        $query = $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status = '3' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$to_date'")->result_array()[0];
        return $query;
    }

    public function dataFluentlist($id_siswa, $nama_siswa, $level, $from_date, $to_date, $nama_cabang)
    {
        $query = $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(speed) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$to_date'")->result_array()[0];
        return $query;
    }

    public function dataToneList($id_siswa, $nama_siswa, $level, $from_date, $to_date, $nama_cabang)
    {
        $query = $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(nada) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$to_date'")->result_array()[0];
        return $query;
    }

    public function dataDailyList($id_siswa, $nama_siswa, $level, $from_date, $to_date, $nama_cabang)
    {
        $query = $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$to_date'")->result_array()[0];
        return $query;
    }

    public function dataNoMistakeList($id_siswa, $nama_siswa, $level, $from_date, $to_date, $nama_cabang)
    {
        $query = $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != 0 AND status !=2 AND jumlah_salah = 0 AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND to_date(tgl_sebenarnya, 'YYYY MM DD') <= '$to_date'")->result_array()[0];
        return $query;
    }

    public function dataChampionList($id_siswa, $nama_siswa, $level, $from_date, $to_date, $nama_cabang)
    {
        $query = $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(champion_list.id_tugas) AS total, MAX(champion_list.id_tugas) AS lattest FROM champion_list, tugas WHERE champion_list.id_siswa = '$id_siswa' AND tugas.id_siswa = '$id_siswa' AND tugas.level = '$level' AND tugas.id_tugas = champion_list.id_tugas AND to_date(tugas.tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND to_date(tugas.tgl_sebenarnya, 'YYYY MM DD') <= '$to_date'")->result_array()[0];
        return $query;
    }

    public function dataTotalunitAndStory($level)
    {
        $query = $this->db->query("SELECT total_unit, story_aktif FROM level WHERE id_level = '$level'")->result_array()[0];
        return $query;
    }
    
    public function dataAssignment($id_siswa,$level, $i, $s)
    {
        $query = $this->db->query("SELECT SUM(CASE WHEN speed = 5 OR speed = 6 THEN 3 WHEN speed = 3 OR speed = 4 THEN 2 WHEN speed = 2 OR speed = 1 THEN 1 WHEN speed = 0 THEN 0 ELSE 0 END) AS scoreSpeed, 
        
        SUM(CASE WHEN nada = 5 OR nada = 6 THEN 3 WHEN nada = 3 OR nada = 4 THEN 2 WHEN nada = 2 OR nada = 1 THEN 1 WHEN nada = 0 THEN 0 ELSE 0 END) AS scoreNada, 
        
        SUM(CASE WHEN jumlah_salah = 0 THEN 3 ELSE 0 END) AS scoreBenar 
        
        FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND unit = $i AND story = $s AND status = 1")->result_array()[0];
        return $query;
    }

    public function dataCheckIfGoal($level, $i, $s)
    {
        $query = $this->db->query("SELECT id_siswa FROM goal WHERE level = '$level' AND unit = '$i' AND story = '$s' ORDER BY id_goal ASC")->result_array();
        return $query;
    }

    public function dataLattestReview($id_siswa, $level)
    {
        $query = $this->db->query("SELECT id_tugas FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level'")->num_rows();
        return $query;
    }

    public function data_get_student($level, $cabang)
    {
        return $this->db->select('id_siswa, nama_siswa, nama_cabang')->from('siswa')->join('cabang_clc', 'cabang_clc.id_cabang = siswa.id_cabang')->where(['level' => $level, 'siswa.id_cabang !=' => 4])->get();
    }

    public function data_get_student_by_id($level, $cabang)
    {
        return $this->db->select('id_siswa, nama_siswa, nama_cabang')->from('siswa')->join('cabang_clc', 'cabang_clc.id_cabang = siswa.id_cabang')->where(['level' => $level, 'siswa.id_cabang' => $cabang])->get();
    }

    public function data_crown_list($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status = '3' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode != 'extended'");
    }

    public function data_fluent_list($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(speed) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode != 'extended'");
    }

    public function data_tone_list($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(nada) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode != 'extended'");
    }

    public function data_daily_reading($id_siswa, $level, $from_date)
    {
        return $this->db->query("SELECT DISTINCT tgl_sebenarnya, MIN(jam) AS earliest FROM tugas, siswa WHERE tugas.id_siswa = '$id_siswa' AND siswa.id_siswa = '$id_siswa' AND tugas.level = '$level' AND siswa.level = '$level' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' GROUP BY tgl_sebenarnya ORDER BY tgl_sebenarnya ASC");
    }

    public function data_dialog($id_siswa, $level, $from_date)
    {
        return $this->db->query("SELECT DISTINCT tgl_sebenarnya, MIN(jam) AS earliest FROM dialog, siswa WHERE dialog.id_siswa = '$id_siswa' AND siswa.id_siswa = '$id_siswa' AND dialog.level = '$level' AND siswa.level = '$level' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' GROUP BY tgl_sebenarnya ORDER BY tgl_sebenarnya ASC");
    }

    public function data_comprehension($id_siswa, $level, $from_date)
    {
        return $this->db->query("SELECT DISTINCT tgl_sebenarnya, MIN(jam) AS earliest FROM comprehension, siswa WHERE comprehension.id_siswa = '$id_siswa' AND siswa.id_siswa = '$id_siswa' AND comprehension.level = '$level' AND siswa.level = '$level' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' GROUP BY tgl_sebenarnya ORDER BY tgl_sebenarnya ASC");
    }

    public function data_no_mistake_list($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != 0 AND status != 2 AND jumlah_salah = 0 AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode != 'extended'");
    }

    public function data_champion_list($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(champion_list.id_tugas) AS total, MAX(champion_list.id_tugas) AS lattest FROM champion_list, tugas WHERE champion_list.id_siswa = '$id_siswa' AND tugas.id_siswa = '$id_siswa' AND tugas.level = '$level' AND tugas.id_tugas = champion_list.id_tugas AND tugas.tgl_sebenarnya >= '$from_date' AND tugas.mode != 'extended' AND champion_list.mode != 'extended'");
    }

    public function data_dailyActive_list($id_siswa, $level, $from_date)
    {
        return $this->db->query("SELECT (SELECT COUNT(*) FROM daily_upload_counter WHERE id_siswa = '$id_siswa' AND level = '$level' AND date >= '$from_date') AS total, MAX(date) AS last_date, time FROM daily_upload_counter WHERE id_siswa = '$id_siswa' AND level = '$level' AND date >= '$from_date' GROUP BY time, no ORDER BY no DESC LIMIT 1");
    }

    public function getDataMaintenance()
    {
        return $this->db->get('maintenance_tracker');
    }

    public function data_crown_list_extended($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status = '3' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode = 'extended'");
    }

    public function data_fluent_list_extended($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(speed) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode = 'extended'");
    }

    public function data_tone_list_extended($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status = '3' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode = 'extended'");
    }

    public function data_no_mistake_list_extended($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_tugas) AS total, MAX(id_tugas) AS lattest FROM tugas WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != 0 AND status != 2 AND jumlah_salah = 0 AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date' AND mode = 'extended'");
    }

    public function data_champion_list_extended($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(champion_list.id_tugas) AS total, MAX(champion_list.id_tugas) AS lattest FROM champion_list, tugas WHERE champion_list.id_siswa = '$id_siswa' AND tugas.id_siswa = '$id_siswa' AND tugas.level = '$level' AND tugas.id_tugas = champion_list.id_tugas AND tugas.tgl_sebenarnya >= '$from_date' AND tugas.mode = 'extended' AND champion_list.mode = 'extended'");
    }

    public function data_crown_list_dialog($id_siswa, $level, $from_date)
    {
        return $this->db->query("SELECT dialog_number, (SELECT MAX(id_dialog) FROM dialog AS d WHERE d.id_siswa = '$id_siswa' AND d.tgl_sebenarnya >= '$from_date') AS lattest FROM dialog, siswa WHERE dialog.id_siswa = '$id_siswa' AND siswa.id_siswa = '$id_siswa' AND dialog.level = '$level' AND status = '3' AND tgl_sebenarnya >= '$from_date' ORDER BY dialog_number ASC");
    }

    public function data_fluent_list_dialog($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(speed) AS total, MAX(id_dialog) AS lattest FROM dialog WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date'");
    }
    
    public function data_tone_list_dialog($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(nada) AS total, MAX(id_dialog) AS lattest FROM dialog WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date'");

    }

    public function data_no_mistake_list_dialog($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_dialog) AS total, MAX(id_dialog) AS lattest FROM dialog WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != 0 AND status != 2 AND jumlah_salah = 0 AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date'");
    }
    
    public function data_crown_list_comprehension($id_siswa, $level, $from_date)
    {
        return $this->db->query("SELECT comprehension_number, (SELECT MAX(id_comprehension) FROM comprehension AS c WHERE c.id_siswa = '$id_siswa' AND c.level = '$level' AND c.tgl_sebenarnya >= '$from_date') AS lattest FROM comprehension, siswa WHERE comprehension.id_siswa = '$id_siswa' AND siswa.id_siswa = '$id_siswa' AND comprehension.level = '$level' AND status = '3' AND tgl_sebenarnya >= '$from_date' ORDER BY comprehension_number ASC");
    }

    public function data_fluent_list_comprehension($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(speed) AS total, MAX(id_comprehension) AS lattest FROM comprehension WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date'");
    }

    public function data_tone_list_comprehension($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, SUM(nada) AS total, MAX(id_comprehension) AS lattest FROM comprehension WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != '0' AND status != '2' AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date'");
    }

    public function data_no_mistake_list_comprehension($id_siswa, $nama_siswa, $level, $from_date, $nama_cabang)
    {
        return $this->db->query("SELECT '$id_siswa' AS id_siswa, '$nama_siswa' AS nama_siswa, '$nama_cabang' AS nama_cabang, COUNT(id_comprehension) AS total, MAX(id_comprehension) AS lattest FROM comprehension WHERE id_siswa = '$id_siswa' AND level = '$level' AND status != 0 AND status != 2 AND jumlah_salah = 0 AND to_date(tgl_sebenarnya, 'YYYY MM DD') >= '$from_date'");
    }
}