<?php defined('BASEPATH') or exit('No direct script access allowed');

class Level extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->model(['m_app_version', 'm_template', 'm_unit', 'm_current', 'm_dialog', 'm_administrator']);
		// $this->load->helper('download');
		session();
    }
    
    public function daily_reading_rules_story()
    {
        
        $id_level  = $this->input->post('id_level', TRUE);
        $mode      = $this->input->post('mode', TRUE);

        $get_data = $this->m_level->data_daily_reading_main($id_level)->row_array();
        $result = [];
        $no_mistake = "";
        $min_record = "";
        $max_record = "";

        if ($mode == 'main') {
            if ($get_data != '' || $get_data != null) {
                $rules  = $get_data['main_story_goal_rules'];
            } else {
                $rules  = "1:0-0-0_2:0-0-0_3:0-0-0";
            }
        } else if ($mode == 'extra') {
            if ($get_data != '' || $get_data != null) {
                $rules  = $get_data['extra_story_goal_rules'];
            } else {
                $rules  = "1:0-0-0_2:0-0-0_3:0-0-0";
            }
        } else if ($mode == 'extended') {
            if ($get_data != '' || $get_data != null) {
                $rules  = $get_data['extended_story_goal_rules'];
            } else {
                $rules  = "1:0-0-0_2:0-0-0_3:0-0-0";
            }
        }
        
        $exp1   = explode('_', $rules);
        $no = 0;
        foreach($exp1 as $pertama) {
            $exp2 = explode(':', $pertama);
                $result[$exp2[0] - 1] = [];
                $exp3 = explode('-', $exp2[1]);
                    $result[$exp2[0] - 1]['no_mistake'] = $exp3[0];
                    $result[$exp2[0] - 1]['min_record'] = $exp3[1];
                    $result[$exp2[0] - 1]['max_record'] = $exp3[2];
        }
            $no++;
        echo json_encode($result);
    }
    
    public function daily_reading_update()
    {
        $id_level    = $this->input->get('id_level', TRUE);
        $total_unit  = $this->input->get('total_unit', TRUE);
        $unit        = $this->input->get('unit', TRUE);
        $story       = $this->input->get('story', TRUE);
        $mode        = $this->input->get('mode', TRUE);
        $rules_story = $this->input->get('rules_story', TRUE);

        if ($unit == NULL) { $unit = []; } 
        
        if ($story == NULL) { $story = [];  }

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

        if ($units == "" || $units == NULL) $units = "0";
        if ($stories == "" || $stories == NULL) $stories = "0";
        $result['unit'] = $units;
        $result['story'] = $stories;
        $result = $this->m_level->update($id_level, $total_unit, $units, $stories, $mode, $rules_story);
        echo json_encode($result);
    }

    public function level_dialog_update()
    {
        $main_total_unit  = $this->input->post('main_total_unit', TRUE);
        $extra_total_unit = $this->input->post('extra_total_unit', TRUE);
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'main_total_unit'   => ($main_total_unit == '') ? 0 : $main_total_unit,
            'extra_total_unit'  => ($extra_total_unit == '') ? 0 : $extra_total_unit
        ];

        $result = $this->m_level->level_dialog_update($data);
        echo json_encode($result);
    }
    
    public function level_comprehension_update()
    {
        $main_total_unit  = $this->input->post('main_total_unit', TRUE);
        $extra_total_unit = $this->input->post('extra_total_unit', TRUE);
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'main_total_unit'   => ($main_total_unit == '') ? 0 : $main_total_unit,
            'extra_total_unit'  => ($extra_total_unit == '') ? 0 : $extra_total_unit
        ];
    
        $result = $this->m_level->level_comprehension_update($data);
        echo json_encode($result);
    }

    public function level_speaking_update()
    {   
        $main_total_unit  = $this->input->post('main_total_unit', TRUE);
        $extra_total_unit = $this->input->post('extra_total_unit', TRUE);
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'main_total_unit'   => ($main_total_unit == '') ? 0 : $main_total_unit,
            'extra_total_unit'  => ($extra_total_unit == '') ? 0 : $extra_total_unit,
            'main_submitcount_freepass'  => $this->input->post('main_submitcount_freepass', TRUE)
        ];
    
        $result = $this->m_level->level_speaking_update($data);
        echo json_encode($result);
    }

    public function lock_dialog_activated()
    {
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'dialog_activated'  => $this->input->post('value', TRUE)
        ];

        echo json_encode($this->m_level->lock_dialog_activated($data));
    }

    public function unlock_dialog_activated()
    {
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'dialog_activated'  => $this->input->post('value', TRUE)
        ];

        echo json_encode($this->m_level->unlock_dialog_activated($data));
    }

    public function lock_comprehension_activated()
    {
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'comprehension_activated'  => $this->input->post('value', TRUE)
        ];

        echo json_encode($this->m_level->lock_comprehension_activated($data));
    }

    public function unlock_comprehension_activated()
    {
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'comprehension_activated'  => $this->input->post('value', TRUE)
        ];

        echo json_encode($this->m_level->unlock_comprehension_activated($data));
    }

    public function lock_speaking_activated()
    {
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'speaking_activated'  => $this->input->post('value', TRUE)
        ];

        echo json_encode($this->m_level->lock_speaking_activated($data));
    }

    public function unlock_speaking_activated()
    {
        $data = [
            'id_level'          => $this->input->post('id_level', TRUE),
            'speaking_activated'  => $this->input->post('value', TRUE)
        ];

        echo json_encode($this->m_level->unlock_speaking_activated($data));
    }

    public function clear_log_daily_reading_main()
    {
        $data = [
            'id_level'  => $this->input->post('id_level', TRUE),
            'mode'      => $this->input->post('mode', TRUE)
        ];

        echo json_encode($this->m_level->clear_log_daily_reading_main($data));
    }

    public function clear_log_daily_reading_extra()
    {
        $data = [
            'id_level'  => $this->input->post('id_level', TRUE),
            'mode'      => $this->input->post('mode', TRUE)
        ];

        echo json_encode($this->m_level->clear_log_daily_reading_extra($data));
    }

    public function clear_log_daily_reading_extended()
    {
        $data = [
            'id_level'  => $this->input->post('id_level', TRUE),
            'mode'      => $this->input->post('mode', TRUE)
        ];

        echo json_encode($this->m_level->clear_log_daily_reading_extended($data));
    }

    public function clear_log_dialog()
    {
        $data = [
            'id_level'  => $this->input->post('id_level', TRUE),
        ];

        echo json_encode($this->m_level->clear_log_dialog($data));
    }

    public function clear_log_comprehension()
    {
        $data = [
            'id_level'  => $this->input->post('id_level', TRUE),
        ];

        echo json_encode($this->m_level->clear_log_comprehension($data));
    }

    public function clear_log_speaking()
    {
        $data = [
            'id_level'  => $this->input->post('id_level', TRUE),
        ];

        echo json_encode($this->m_level->clear_log_speaking($data));
    }

    public function selftest_update()
    {
        $id_level       = $this->input->get('id_level', TRUE);
        $total_subject  = $this->input->get('total_subject', TRUE);
        $subject        = $this->input->get('subject', TRUE);
        $total_unit     = $this->input->get('total_unit', TRUE);
        $unit           = $this->input->get('unit', TRUE);

        if ($subject == NULL) { $subject = []; } 
        if ($unit == NULL) { $unit = []; } 
        
        $subjects = "";
        foreach($subject as $key) {
            $subjects = $subjects."-".$key;
        }
        $subjects = substr($subjects, 1);

        $units = "";
        foreach($unit as $key) {
            $units = $units."-".$key;
        }
        $units = substr($units, 1);

        if ($subjects == "" || $subjects == NULL) $subjects = "0";
        if ($units == "" || $units == NULL) $units = "0";
        $result['subject'] = $subjects;
        $result['unit'] = $units;
        $result = $this->m_level->update_selftest($id_level, $total_unit, $units, $total_subject, $subjects);
        echo json_encode($result);
    }

    public function clear_log_selftest()
    {
        $data = [
            'id_level'  => $this->input->post('id_level', TRUE),
            'mode'      => $this->input->post('mode', TRUE)
        ];

        echo json_encode($this->m_level->clear_log_selftest($data));
    }
}