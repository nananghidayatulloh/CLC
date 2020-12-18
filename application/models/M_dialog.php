<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_dialog extends CI_Model {
    public function get_id_Dialog($id)
    {
        $query = $this->db->query("SELECT id_dialog, note FROM dialog WHERE id_dialog = '$id'");
        return $query;
    }

    public function get_id_Tugas($id)
    {
        $query = $this->db->query("SELECT id_tugas, note FROM tugas WHERE id_tugas = '$id'");
        return $query;
    }

    public function editDaily($id, $data)
    {
        $this->db->where('id_tugas', $id);
        $query = $this->db->update('tugas', $data);
        return $query;
    }

    public function editDialog($id, $data)
    {
        $this->db->where('id_dialog', $id);
        $query = $this->db->update('dialog', $data);
        return $query;
    }

    //Daily Reading
    public function DeleteTugas($id)
    {
        $this->db->where('id_tugas', $id);
        $query = $this->db->delete('tugas');
        return $query;
    }

    public function DeleteKoreksi($id)
    {
        $cek_id_tugas = $this->db->query("SELECT id_tugas FROM koreksi WHERE id_tugas = '$id'")->num_rows();
        if ($cek_id_tugas == 1) {
            $this->db->where('id_tugas', $id);
            $query = $this->db->delete('koreksi');
        } else {
            $query = "Berhasil Menghapus";
        }
        return $query;
    }
    //End Reading

    //Dialog
    public function DeleteDialog($id)
    {
        $this->db->where('id_dialog', $id);
        $query = $this->db->delete('dialog');
        return $query;
    }

    public function DeleteQuiz($id)
    {
        $cek_id_dialog = $this->db->query("SELECT id_dialog FROM koreksi_dialog WHERE id_dialog = '$id'")->num_rows();
        if ($cek_id_dialog == 1) {
            $this->db->where('id_dialog', $id);
            $query = $this->db->delete('koreksi_dialog');
        } else {
            $query = "Berhasil Menghapus";
        }
        return $query;
    }
    //End Dialog

    //Exam
    public function DeleteTest($id)
    {
        $this->db->where('id_test', $id);
        $query = $this->db->delete('final_test');
        return $query;
    }
    //End Exam

    //Comprehension
    public function DeleteComprehension($id)
    {
        $this->db->where('id_comprehension', $id);
        $query = $this->db->delete('comprehension');
        return $query;
    }
    //End Comprehension

    //Speaking
    public function DeleteSpeaking($id)
    {
        $this->db->where('id_tugas', $id);
        $query = $this->db->delete('daily_speaking');
        return $query;
    }
    //End Speaking

    public function DeleteDailyQuiz($id)
    {
        $this->db->where('id_quiz', $id);
        $query = $this->db->delete('daily_quiz_matching'); 
        return $query;
    }
}