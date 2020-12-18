<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_level extends CI_Model {
    
    public function datalevel()
    {
        $query = $this->db->query("SELECT * FROM level WHERE id_level != 'TC' ORDER BY id_level ASC");
        return $query;
    }

    public function unitlevel($level)
    {
        $query = $this->db->query("SELECT total_unit FROM level WHERE id_level = '$level'");
        return $query;
    }

    public function dataperlevel()
    {
        $query = $this->db->query("SELECT id_level FROM level WHERE id_level != 'TC' ORDER BY id_level ASC");
        return $query->result_array();
    }

    public function data_level_exam($id_level)
    {
        $query = $this->db->query("SELECT * FROM exam_list WHERE id_level = '$id_level' ORDER BY id_level");
        return $query;
    }

    public function unit_level($level, $mode)
    {
        if ($mode == "daily_reading_main") {
            return $this->db->query("SELECT main_total_unit AS total_unit FROM daily_reading_config WHERE id_level = '$level'");
        }elseif ($mode == "daily_reading_extra") {
            return $this->db->query("SELECT extra_total_unit AS total_unit FROM daily_reading_config WHERE id_level = '$level'");
        }elseif ($mode == "daily_reading_extended") {
            return $this->db->query("SELECT extended_total_unit AS total_unit FROM daily_reading_config WHERE id_level = '$level'");
        } elseif($mode == "exam_unit") {
            return $this->db->query("SELECT total_unit AS total_unit FROM exam_list WHERE id_level = '$level'");
        }
    }

    public function data_daily_reading_main($id_level)
    {
        return $this->db->select('*')->from('daily_reading_config')->where('id_level', $id_level)->order_by('id_level', 'asc')->get();
    }

    public function data_level_dialog($id_level)
    {
        return $this->db->select('*')->from('dialog_config')->where('id_level', $id_level)->order_by('id_level', 'asc')->get();
    }
    
    public function data_level_comprehension($id_level)
    {
        return $this->db->select('*')->from('comprehension_config')->where('id_level', $id_level)->order_by('id_level', 'asc')->get();
    }

    public function data_level_speaking($id_level)
    {
        return $this->db->select('*')->from('daily_speaking_config')->where('id_level', $id_level)->order_by('id_level', 'asc')->get();
    }

    public function simpan()
    {
        $data = array(
            'id_level'     	=> str_replace(' ', '_', $this->input->post('id_level')),
            'time_limit'    => $this->input->post('time_limit'),
        );
        
            $this->db->insert('level', $data);
    }

    public function edit() 
    {
        $level = "";
        $total_unit = "";
        $unit = [];
        $story = [];
        $time_limit = 8;
        $total_dialog = 0;
        $total_comprehension = 0;
        $total_exam = 0;
        $mode = "";

        if(isset($_GET['total_unit']))$total_unit = $_GET['total_unit'];
        if(isset($_GET['id_level']))$level = $_GET['id_level'];
        if(isset($_GET['unit']))$unit = $_GET['unit'];
        if(isset($_GET['story']))$story = $_GET['story'];
        if(isset($_GET['time_limit'])) $time_limit = $_GET['time_limit'];
        if(isset($_GET['total_dialog'])) $total_dialog = $_GET['total_dialog'];
        if(isset($_GET['total_comprehension'])) $total_comprehension = $_GET['total_comprehension'];
        if(isset($_GET['mode'])) $mode = $_GET['mode'];

        $units = "";
        foreach($unit as $key) {
            $units = $units."-".$key;
        }
        $units = substr($units, 1);

        $stories = "";
        foreach($story as $key) {
            $stories = $stories."-".$key;
        }
        $stories = substr($stories,1);

        if ($mode == "level_edit") {
            $cekLevel = $this->db->query("SELECT * FROM level WHERE id_level = '$level'")->num_rows();
            if ($units == "" || $units == NULL) $units = "0";
            if ($stories == "" || $stories == NULL) $stories = "0";
            if ($cekLevel > 0) {
                $data = [
                    // 'total_unit'     => $total_unit,
                    // 'unit_aktif'     => $units,
                    // 'story_aktif'    => $stories,
                    'time_limit'     => $time_limit,
                    // 'total_dialog'   => $total_dialog,
                    // 'total_comprehension'   => $total_comprehension
                ];

                $this->db->where('id_level', $level);
                $this->db->update('level', $data);
            } else {
                $data = [
                    'id_level'       => $level,
                    'total_unit'     => $total_unit,
                    'unit_aktif'     => $units,
                    'story_aktif'    => $stories,
                    'time_limit'     => $time_limit,
                    'total_dialog'   => $total_dialog,
                    'total_comprehension'   => $total_comprehension
                ];

                $this->db->insert('level', $data);
            }
        } else if ($mode == "exam_edit") {
            $cekLevel = $this->db->query("SELECT * FROM exam_list WHERE id_level = '$level'")->num_rows();
            if ($units == "" || $units == NULL) $units = "0";
            if ($stories == "" || $stories == NULL) $stories = "0";
            
            if ($cekLevel > 0) {
                $data = [
                    'total_unit'  => $total_unit,
                    'unit_aktif'  => $units,
                    'story_aktif' => $stories
                ];
                
                $this->db->where('id_level', $level);
                $this->db->update('exam_list', $data);
            } else {
                if ($total_unit == "" || $total_unit == NULL) $total_unit = "0";
                
                $data = [
                    'id_level'    => $level,
                    'total_unit'  => $total_unit,
                    'unit_aktif'  => $units,
                    'story_aktif' => $stories
                ];

                $this->db->insert('exam_list', $data);
            }
        }
    }

    public function update($id_level, $total_unit, $units, $stories, $mode, $rules_story)
    {
        $result = [];
        $cek_level = $this->data_daily_reading_main($id_level)->num_rows();;

        if ($mode == "main_edit") {
            if ($cek_level > 0) {
                $data = [
                    'main_total_unit'       => $total_unit,
                    'main_unit_active'      => $units,
                    'main_story_active'     => $stories,
                    'main_story_goal_rules' => $rules_story
                ];
    
                $this->db->where('id_level', $id_level);
                $this->db->update('daily_reading_config', $data);
                $result['STATUS'] = "Simpan Data...";
            } else {
                $data = [
                    'id_level'              => $id_level,
                    'main_total_unit'       => $total_unit,
                    'main_unit_active'      => $units,
                    'main_story_active'     => $stories,
                    'main_story_goal_rules' => $rules_story
                ];
                
                $this->db->insert('daily_reading_config', $data);
                $result['STATUS'] = "Simpan Data...";
            }
        } else if($mode == "extra_edit") {
            if ($cek_level > 0) {
                $data = [
                    'extra_total_unit'     => $total_unit,
                    'extra_unit_active'    => $units,
                    'extra_story_active'   => $stories,
                    'extra_story_goal_rules' => $rules_story
                ];
    
                $this->db->where('id_level', $id_level);
                $this->db->update('daily_reading_config', $data);
                $result['STATUS'] = "Simpan Data...";
            } else {
                $data = [
                    'id_level'            => $id_level,
                    'extra_total_unit'     => $total_unit,
                    'extra_unit_active'    => $units,
                    'extra_story_active'   => $stories,
                    'extra_story_goal_rules' => $rules_story
                ];
                
                $this->db->insert('daily_reading_config', $data);
                $result['STATUS'] = "Simpan Data...";
            }
        } else if($mode == "extended_edit") {
            if ($cek_level > 0) {
                $data = [
                    'extended_total_unit'     => $total_unit,
                    'extended_unit_active'    => $units,
                    'extended_story_active'   => $stories,
                    'extended_story_goal_rules' => $rules_story
                ];
    
                $this->db->where('id_level', $id_level);
                $this->db->update('daily_reading_config', $data);
                $result['STATUS'] = "Simpan Data...";
            } else {
                $data = [
                    'id_level'            => $id_level,
                    'extended_total_unit'     => $total_unit,
                    'extended_unit_active'    => $units,
                    'extended_story_active'   => $stories,
                    'extended_story_goal_rules' => $rules_story
                ];
                
                $this->db->insert('daily_reading_config', $data);
                $result['STATUS'] = "Simpan Data...";
            }
        } 

        return $result;
    }

    public function level_dialog_update($data) 
    {
        $result = [];
        $cek_level = $this->data_level_dialog($data['id_level'])->num_rows();
        if($cek_level > 0) {
            $data_insert = [
                'main_total_unit'  => $data['main_total_unit'],
                'extra_total_unit' => $data['extra_total_unit']
            ];

            $this->db->where('id_level', $data['id_level']);
            $this->db->update('dialog_config', $data_insert);
            $result['STATUS'] = "Simpan Data...";
        } else {
            $this->db->insert('dialog_config', $data);
            $result['STATUS'] = "Simpan Data...";
        }
        return $result;
    }

    public function lock_dialog_activated($data)
    {
        $result = [];
        $update['dialog_activated']     = $data['dialog_activated'];
        $this->db->where('level', $data['id_level']);
        $result_update = $this->db->update('siswa', $update);

        if ($result_update > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function unlock_dialog_activated($data)
    {
        $result = [];
        $update['dialog_activated'] = $data['dialog_activated'];
        $update['dialog_limit']     = 5;
        $this->db->where('level', $data['id_level']);
        $result_update = $this->db->update('siswa', $update);

        if ($result_update > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function level_comprehension_update($data) 
    {
        $result = [];
        $cek_level = $this->data_level_comprehension($data['id_level'])->num_rows();
        if($cek_level > 0) {
            $data_insert = [
                'main_total_unit'  => $data['main_total_unit'],
                'extra_total_unit' => $data['extra_total_unit']
            ];

            $this->db->where('id_level', $data['id_level']);
            $this->db->update('comprehension_config', $data_insert);
            $result['STATUS'] = "Simpan Data...";
        } else {
            $this->db->insert('comprehension_config', $data);
            $result['STATUS'] = "Simpan Data...";
        }
        return $result;
    }

    public function lock_comprehension_activated($data)
    {
        $result = [];
        $update['comprehension_activated']     = $data['comprehension_activated'];
        $this->db->where('level', $data['id_level']);
        $result_update = $this->db->update('siswa', $update);

        if ($result_update > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function unlock_comprehension_activated($data)
    {
        $result = [];
        $update['comprehension_activated'] = $data['comprehension_activated'];
        $update['comprehension_limit']     = 5;
        $this->db->where('level', $data['id_level']);
        $result_update = $this->db->update('siswa', $update);

        if ($result_update > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function level_speaking_update($data) 
    {
        $result = [];
        $cek_level = $this->data_level_speaking($data['id_level'])->num_rows();
        if($cek_level > 0) {
            $data_insert = [
                'main_total_unit'  => $data['main_total_unit'],
                'extra_total_unit' => $data['extra_total_unit'],
                'main_submitcount_freepass' => $data['main_submitcount_freepass']
            ];

            $this->db->where('id_level', $data['id_level']);
            $this->db->update('daily_speaking_config', $data_insert);
            $result['STATUS'] = "Simpan Data...";
        } else {
            $this->db->insert('daily_speaking_config', $data);
            $result['STATUS'] = "Simpan Data...";
        }
        return $result;
    }

    public function lock_speaking_activated($data)
    {
        $result = [];
        $update['speaking_activated']     = $data['speaking_activated'];
        $this->db->where('level', $data['id_level']);
        $result_update = $this->db->update('siswa', $update);

        if ($result_update > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function unlock_speaking_activated($data)
    {
        $result = [];
        $update['speaking_activated'] = $data['speaking_activated'];
        $this->db->where('level', $data['id_level']);
        $result_update = $this->db->update('siswa', $update);

        if ($result_update > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function clear_log_daily_reading_main($data)
    {
        $this->db->where(['level' => $data['id_level'], 'mode' => $data['mode']]);
        $result_delete = $this->db->delete('tugas');
        if ($result_delete > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function clear_log_daily_reading_extra($data)
    {
        $this->db->where(['level' => $data['id_level'], 'mode' => $data['mode']]);
        $result_delete = $this->db->delete('tugas');
        if ($result_delete > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function clear_log_daily_reading_extended($data)
    {
        $this->db->where(['level' => $data['id_level'], 'mode' => $data['mode']]);
        $result_delete = $this->db->delete('tugas');
        if ($result_delete > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function clear_log_dialog($data)
    {
        $this->db->where(['level' => $data['id_level']]);
        $result_delete = $this->db->delete('dialog');
        if ($result_delete > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function clear_log_speaking($data)
    {
        $this->db->where(['level' => $data['id_level']]);
        $result_delete = $this->db->delete('daily_speaking');
        if ($result_delete > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function clear_log_comprehension($data)
    {
        $this->db->where(['level' => $data['id_level']]);
        $result_delete = $this->db->delete('comprehension');
        if ($result_delete > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function hapus($id_level)
    {
        if (!empty($id_level)) {
            if($this->db->query("DELETE from level where id_level = '$id_level'")){
                $this->db->query("DELETE FROM unit_name WHERE level = '$id_level'");
                $this->db->query("DELETE FROM story_name WHERE level = '$id_level'");

                $audioDir   = FCPATH."assets/Content/AudioFolder/".$id_level."/";
                $storyDir   = FCPATH."assets/Content/StoryFolder/".$id_level."/";
                $dialogDir  = FCPATH."assets/Content/DialogFolder/".$id_level."/";
                
                rmdir($audioDir);
                rmdir($storyDir);
                rmdir($dialogDir);
                // $this->delete_directory ($storyDir);
                // delete_directory ($dialogDir);
            }
            echo "Harap Di Ini!..";
        }
    }

    public function getCountFile($folder, $sub_folder, $id_level)
    {
        $this->load->model('m_selftest');

        $dir = "";

        if ($folder == "DailyReading") {
            $dir = content_dir().$folder."/".$sub_folder."/StoryFolder/".$id_level;
        } else if ($folder == "Dialog") {
            $dir = content_dir().$folder."/".$sub_folder."/".$id_level;
        } else if ($folder == "Comprehension") {
            $dir = content_dir().$folder."/".$sub_folder."/".$id_level;
        } else if ($folder == "DailySpeaking") {
            $dir = content_dir().$folder."/".$sub_folder."/StoryFolder/".$id_level;
        } else if ($folder == "Exam") {
            $dir = content_dir().$folder."/".$id_level;
        } 

        if (file_exists($dir)) {
            $files = scandir($dir);
            $num_files = count($files) - 2; 
        } else {
            $num_files = 0;
        }
        return $num_files;
    }

    public function getCountFileSelftest($total_subject, $id_level)
    {
        $dir = "";
        $num_files = [];
        $content_type = "";

        for ($i=1; $i <= $total_subject ; $i++) { 
            $getContentConfig = $this->m_selftest->getContentConfig($id_level, $i)->row_array();

            if ($getContentConfig != NULL) {
                $num_files[$i] = [];
                if ($getContentConfig['content_type'] == '1') {
                    $content_type = "Meaning";
                    $dir = content_dir()."SelfTest/".$content_type."/".$id_level."/Subject".$getContentConfig['subject'];
                } else if ($getContentConfig['content_type'] == '2') {
                    $content_type = "Keyword";
                    $dir = content_dir()."SelfTest/".$content_type."/".$id_level."/Subject".$getContentConfig['subject'];
                } else if ($getContentConfig['content_type'] == '3') {
                    $content_type = "Arranging";
                    $dir = content_dir()."SelfTest/".$content_type."/".$id_level."/Subject".$getContentConfig['subject'];
                } else {
                    $content_type = "";
                    $dir      = "";
                }

                if (file_exists($dir)) {
                    $files = scandir($dir);
                    $num_files[$i]['subject']       = $getContentConfig['subject'];
                    $num_files[$i]['content_type']  = $content_type;
                    $num_files[$i][$content_type]   = count($files) - 2;
                }
            }
        }

        return $num_files;
    }

    public function data_selftest_quiz($id_level)
    {
        return $this->db->select('*')->from('selftest_config')->where('id_level', $id_level)->order_by('id_level', 'asc')->get();
    }

    public function update_selftest($id_level, $total_unit, $units, $total_subject, $subjects)
    {
        $result = [];
        $cek_level = $this->data_selftest_quiz($id_level)->num_rows();;

        if ($cek_level > 0) {
            $data = [
                'total_subject'  => $total_subject,
                'subject_active' => $subjects,
                'total_unit'     => $total_unit,
                'unit_active'    => $units,
            ];

            $this->db->where('id_level', $id_level);
            $this->db->update('selftest_config', $data);
            $result['STATUS'] = "Simpan Data...";
        } else {
            $data = [
                'id_level'       => $id_level,
                'total_subject'  => $total_subject,
                'subject_active' => $subjects,
                'total_unit'     => $total_unit,
                'unit_active'    => $units,
            ];
            
            $this->db->insert('selftest_config', $data);
            $result['STATUS'] = "Simpan Data...";
        }
        return $result;
    }

    public function clear_log_selftest($data)
    {
        $this->db->where(['level' => $data['id_level']]);
        $result_delete = $this->db->delete('selftest_quiz');
        if ($result_delete > 0) {
            $result['STATUS'] = "Simpan Data...";
        } else {
            $result['STATUS'] = "Gagal Simpan Data...";
        }

        return $result;
    }

    public function dataTalkmandarin()
    {
        $query = $this->db->query('SELECT id_level, total_unit, unit_talk_mandarin FROM level_old');
        return $query;
    }

    public function editTalk()
    {
        $level = "";
        $total_unit = "";
        $units = [];

        if(isset($_GET['total_unit']))$total_unit = $_GET['total_unit'];
        if(isset($_GET['id_level']))$level = $_GET['id_level'];
        if(isset($_GET['unit']))$unit = $_GET['unit'];

        $cekLevel = $this->db->query("SELECT * FROM level_old WHERE id_level = '$level'")->row_array();

        $units = "";
        foreach($unit as $key) {
            $units = $units."-".$key;
        }
        $units = substr($units, 1);

        if (count($cekLevel) > 0) {
            $data = [
                'total_unit'             => $total_unit,
                'unit_talk_mandarin'     => $units,
            ];
            $this->db->where('id_level', $level);
            $this->db->update('level_old', $data);
        }
    }

    public function hapus_talk_mandarin($id_level)
    {
        if (!empty($id_level)) {
            if($this->db->query("DELETE from level_old where id_level = '$id_level'")){

                $audioDir   = FCPATH."assets/Content/AudioFolder/".$id_level."/";
                $storyDir   = FCPATH."assets/Content/StoryFolder/".$id_level."/";
                $dialogDir  = FCPATH."assets/Content/DialogFolder/".$id_level."/";
                
                rmdir($audioDir);
                rmdir($storyDir);
                rmdir($dialogDir);
                // $this->delete_directory ($storyDir);
                // delete_directory ($dialogDir);
            }
            echo "Harap Di Ini!..";
        }
    }
}