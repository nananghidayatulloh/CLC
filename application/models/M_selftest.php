<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_selftest extends CI_Model {

    public function getAllDataConfig($level)
    {
        return $this->db->select('*')->from('selftest_config')->where('id_level', $level)->get();
    }

    public function getNameSubject($level, $exp_subject_active)
    {
        return $this->db->select('name')->where(['level' => $level, 'subject' => $exp_subject_active])->get('selftest_subject');
    }

    public function insertNameSubject($data)
    {
        return $this->db->insert('selftest_subject', $data);
    }

    public function updateNameSubject($level, $subject, $data_update)
    {
        $this->db->where(['level' => $level, 'subject' => $subject]);
        return $this->db->update('selftest_subject', $data_update);
    }

    public function getNameUnit($level, $subject, $exp_unit_active)
    {
        return  $this->db->select('subject, name')->get_where('selftest_unit', ['level' => $level, 'subject' => $subject, 'unit' => $exp_unit_active]);
    }

    public function insertNameUnit($data)
    {
        return $this->db->insert('selftest_unit', $data);
    }

    public function updateNameUnit($level, $subject, $unit, $data_update)
    {
        $this->db->where(['level' => $level, 'subject' => $subject, 'unit' => $unit]);
        return $this->db->update('selftest_unit', $data_update);
    }

    public function getContentConfig($level, $subject)
    {
        return $this->db->get_where('selftest_content_config', ['level' => $level, 'subject' => $subject]);
    }

    public function getContentConfigTime($subject, $content_type)
    {
        return $this->db->get_where('selftest_content_config', ['subject' => $subject, 'content_type' => $content_type]);
    }

    public function insertSettingSubject($cek_data, $data)
    {
        $get_data = $this->getContentConfig($cek_data['level'], $cek_data['subject'])->num_rows();
        if ($get_data > 0) {
            $this->db->where($cek_data);
            return $this->db->update('selftest_content_config', $data);
        } else {
            return $this->db->insert('selftest_content_config', $data);
        }
    }

    public function contentConfig($level, $subject)
    {
        $get_data = $this->getContentConfig($level, $subject)->row_array();

        if ($get_data == NULL || $get_data == "") {
            $get_data = [
                'time_limit'    => "1",
                'set_spontan'   => "0"
            ];
        } else {
            $get_data = [
                'content_type'      => $get_data['content_type'],
                'standart_goal'     => $get_data['standart_goal'],
                'standart_kuning'   => $get_data['standart_kuning'],
                'standart_merah'    => $get_data['standart_merah'],
                'standart_biru'     => $get_data['standart_biru'],
                'standart_hijau'    => $get_data['standart_hijau'],
                'time_limit'        => $get_data['time_limit'],
                'set_spontan'       => $get_data['set_spontan']
            ];
        }

        return $get_data;
    }

    public function getCountSpontan($id_siswa)
    {
        $spontan_meaning    = $this->db->get_where('selftest_meaning_quiz', ['id_siswa' => $id_siswa, 'mode' => 'spontan', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $spontan_keyword    = $this->db->get_where('selftest_keyword_quiz', ['id_siswa' => $id_siswa, 'mode' => 'spontan', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $spontan_arranging  = $this->db->get_where('selftest_arranging_quiz', ['id_siswa' => $id_siswa, 'mode' => 'spontan', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();

        return $spontan_meaning + $spontan_keyword + $spontan_arranging;
    }

    public function getCountPractice($id_siswa)
    {
        $practice_meaning    = $this->db->get_where('selftest_meaning_quiz', ['id_siswa' => $id_siswa, 'mode' => 'practice', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $practice_keyword    = $this->db->get_where('selftest_keyword_quiz', ['id_siswa' => $id_siswa, 'mode' => 'practice', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $practice_arranging  = $this->db->get_where('selftest_arranging_quiz', ['id_siswa' => $id_siswa, 'mode' => 'practice', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();

        return $practice_meaning + $practice_keyword + $practice_arranging;
    }

    public function getCountTest($id_siswa)
    {
        $test_meaning    = $this->db->get_where('selftest_meaning_quiz', ['id_siswa' => $id_siswa, 'mode' => 'test', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $test_keyword    = $this->db->get_where('selftest_keyword_quiz', ['id_siswa' => $id_siswa, 'mode' => 'test', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $test_arranging  = $this->db->get_where('selftest_arranging_quiz', ['id_siswa' => $id_siswa, 'mode' => 'test', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();

        return $test_meaning + $test_keyword + $test_arranging;
    }
    
    public function getCountReview($id_siswa)
    {
        $review_meaning    = $this->db->get_where('selftest_meaning_quiz', ['id_siswa' => $id_siswa, 'mode' => 'review', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $review_keyword    = $this->db->get_where('selftest_keyword_quiz', ['id_siswa' => $id_siswa, 'mode' => 'review', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();
        $review_arranging  = $this->db->get_where('selftest_arranging_quiz', ['id_siswa' => $id_siswa, 'mode' => 'review', 'tgl_sebenarnya' => date('Y-m-d')])->num_rows();

        return $review_meaning + $review_keyword + $review_arranging;
    }

    public function getLogMeaning($level, $id_siswa, $subject, $unit, $mode)
    {
        return $this->db->order_by('id_selftest_meaning_quiz', 'desc')->get_where('selftest_meaning_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => $mode]);
    }

    public function getLogKeyword($level, $id_siswa, $subject, $unit, $mode)
    {
        return $this->db->order_by('id_selftest_keyword_quiz', 'desc')->get_where('selftest_keyword_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => $mode]);
    }

    public function getLogArranging($level, $id_siswa, $subject, $unit, $mode)
    {
        return $this->db->order_by('id_selftest_arranging_quiz', 'desc')->get_where('selftest_arranging_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => $mode]);
    }

    public function getLogMeaningPractice($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_meaning_quiz', 'asc')->get_where('selftest_meaning_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'practice']);
    }
    
    public function getLogMeaningTest($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_meaning_quiz', 'desc')->get_where('selftest_meaning_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'test']);
    }

    public function getLogMeaningReview($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_meaning_quiz', 'desc')->get_where('selftest_meaning_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'review']);
    }

    public function getLogMeaningSpontan($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_meaning_quiz', 'desc')->get_where('selftest_meaning_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'spontan']);
    }

    public function getTryMeaning($id_siswa, $level, $subject, $unit, $mode)
    {
        return $this->db->order_by('id_selftest_meaning_quiz', 'desc')->get_where('selftest_meaning_quiz', ['id_siswa' => $id_siswa, 'level' => $level, 'subject' => $subject, 'unit' => $unit, 'mode' => $mode]);
    }

    public function getLogKeywordPractice($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_keyword_quiz', 'desc')->get_where('selftest_keyword_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'practice']);
    }
    
    public function getLogKeywordTest($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_keyword_quiz', 'desc')->get_where('selftest_keyword_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'test']);
    }

    public function getLogKeywordReview($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_keyword_quiz', 'desc')->get_where('selftest_keyword_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'review']);
    }

    public function getLogKeywordSpontan($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_keyword_quiz', 'desc')->get_where('selftest_keyword_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'spontan']);
    }

    public function getTryKeyword($id_siswa, $level, $subject, $unit, $mode)
    {
        return $this->db->order_by('id_selftest_keyword_quiz', 'desc')->get_where('selftest_keyword_quiz', ['id_siswa' => $id_siswa, 'level' => $level, 'subject' => $subject, 'unit' => $unit, 'mode' => $mode]);
    }

    public function getLogArrangingPractice($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_arranging_quiz', 'desc')->get_where('selftest_arranging_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'practice']);
    }
    
    public function getLogArrangingTest($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_arranging_quiz', 'desc')->get_where('selftest_arranging_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'test']);
    }

    public function getLogArrangingReview($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_arranging_quiz', 'desc')->get_where('selftest_arranging_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'review']);
    }

    public function getLogArrangingSpontan($level, $id_siswa, $subject, $unit)
    {
        return $this->db->order_by('id_selftest_arranging_quiz', 'desc')->get_where('selftest_arranging_quiz', ['level' => $level, 'id_siswa' => $id_siswa, 'subject' => $subject, 'unit' => $unit, 'mode' => 'spontan']);
    }

    public function getTryArranging($id_siswa, $level, $subject, $unit, $mode)
    {
        return $this->db->order_by('id_selftest_arranging_quiz', 'desc')->get_where('selftest_arranging_quiz', ['id_siswa' => $id_siswa, 'level' => $level, 'subject' => $subject, 'unit' => $unit, 'mode' => $mode]);
    }

    public function insertDataMeaning($data_insert)
    {
        return $this->db->insert('selftest_meaning_quiz', $data_insert);
    }

    public function insertDataKeyword($data_insert)
    {
        return $this->db->insert('selftest_keyword_quiz', $data_insert);
    }

    public function insertDataArranging($data_insert)
    {
        return $this->db->insert('selftest_arranging_quiz', $data_insert);
    }

    public function insertPinyin($subject, $unit, $content_type, $level)
    {
        $data = [
            'subject'       => $subject,
            'unit'          => $unit,
            'content_type'  => $content_type,
            'list_pinyin'   => json_encode($this->session->userdata('list_pinyin'), JSON_UNESCAPED_UNICODE),
            'list_inggris'  => json_encode($this->session->userdata('list_inggris'), JSON_UNESCAPED_UNICODE),
            'level'         => $level
        ];

        $get_data = $this->db->get_where('selftest_list_pinyin', ['subject' => $subject, 'unit' => $unit, 'content_type' => $content_type])->num_rows();
        if ($get_data > 0) {
            $this->db->where(['subject' => $subject, 'unit' => $unit, 'content_type' => $content_type]);
            return $this->db->update('selftest_list_pinyin', $data);
        } else {
            return $this->db->insert('selftest_list_pinyin', $data);
        }
    }

    public function dataPinyin($subject, $unit, $content_type)
    {
        return $this->db->get_where('selftest_list_pinyin', ['subject' => $subject, 'unit' => $unit, 'content_type' => $content_type]);
    }

    public function getDataTestMeaning($session)
    {
        return $this->db->get_where('selftest_meaning_quiz', ['session' => $session]);
    }

    public function getDataTestKeyword($session)
    {
        return $this->db->get_where('selftest_keyword_quiz', ['session' => $session]);
    }

    public function getDataTestArranging($session)
    {
        return $this->db->get_where('selftest_arranging_quiz', ['session' => $session]);
    }

    public function history_meaning($id_siswa, $level, $spontan)
    {
        return $this->db->order_by('id_selftest_meaning_quiz', 'desc')->get_where('selftest_meaning_quiz', ['id_siswa' => $id_siswa, 'level' => $level, 'mode' => $spontan]);
    }

    public function history_keyword($id_siswa, $level, $spontan)
    {
        return $this->db->order_by('id_selftest_keyword_quiz', 'desc')->get_where('selftest_keyword_quiz', ['id_siswa' => $id_siswa, 'level' => $level, 'mode' => $spontan]);
    }

    public function history_arranging($id_siswa, $level, $spontan)
    {
        return $this->db->order_by('id_selftest_arranging_quiz', 'desc')->get_where('selftest_arranging_quiz', ['id_siswa' => $id_siswa, 'level' => $level, 'mode' => $spontan]);
    }

    public function getPermissionSelftest($id_siswa)
    {
        return $this->db->get_where('permission_selftest', ['id_siswa' => $id_siswa]);
    }

}