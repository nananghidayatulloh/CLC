<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_unit extends CI_Model {

        public function unitName($level, $unit)
        {
            return $this->db->where(['level' => $level, 'unit' => $unit])->get('unit_name');
        }

        public function insertUnit($data)
        {
            $query = $this->db->insert('unit_name', $data);
            return $query;
        }

        public function updateUnitName($data)
        {
            $query = $this->db->update('unit_name', $data);
            return $query;
        }

        public function storyName($level, $unit, $story)
        {
            $query = $this->db->query("SELECT name FROM story_name WHERE level = '$level' AND unit = '$unit' AND story = '$story'");
            return $query;
        }

        public function insertStoryName($data)
        {
            $query = $this->db->insert('story_name', $data);
            return $query;
        }

        public function updateStoryName($data)
        {
            $query = $this->db->update('story_name', $data);
            return $query;
        }

        public function unitExamName($level, $unit)
        {
            return $this->db->where(['level' => $level, 'unit' => $unit])->get('exam_name');
        }

        public function insert_unit_name_exam($data)
        {
            $query = $this->db->insert('exam_name', $data);
            return $query;
        }

        public function update_unit_name_exam($data)
        {
            $this->db->where(['unit' => $data['unit'], 'level' => $data['level']]);
            $query = $this->db->update('exam_name', $data);
            return $query;
        }

        public function ExamStoryName($level, $unit, $story)
        {
            return $this->db->where(['level' => $level, 'unit' => $unit, 'story' => $story])->get('exam_story_name');
        }

        public function insert_exam_story($data)
        {
            unset($data['mode']);
            $query = $this->db->insert('exam_story_name', $data);
            return $query;
        }

        public function update_exam_story($data)
        {
            unset($data['mode']);
            $this->db->where(['unit' => $data['unit'], 'level' => $data['level'], 'story' => $data['story']]);
            $query = $this->db->update('exam_story_name', $data);
            return $query;
        }

        public function unit_name($data)
        {
            return $this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'mode' => $data['mode']])->get('unit_name');
        }

        public function insert_unit($data)
        {
            $query = $this->db->insert('unit_name', $data);
            return $query;
        }

        public function update_unit_name($data)
        {
            $this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'mode' => $data['mode']]);
            $query = $this->db->update('unit_name', $data);
            return $query;
        }


        public function story_name($data)
        {
             return $this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'story' => $data['story'], 'mode' => $data['mode']])->get('story_name');
        }

        public function insert_story_name($data)
        {
            $query = $this->db->insert('story_name', $data);
            return $query;
        }

        public function update_story_name($data)
        {
            $this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'story' => $data['story'], 'mode' => $data['mode']]);
            $query = $this->db->update('story_name', $data);
            return $query;
        }
    }
