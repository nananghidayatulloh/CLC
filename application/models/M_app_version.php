<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_app_version extends CI_Model {
    public function getAppVersion()
    {
        return $this->db->get('app_version');
    }

    public function updateVersion($data)
    {
        $student      = $this->db->query("UPDATE  app_version set current_version = '$data[student]' where app_version_for ='student'");
        $student_ios  = $this->db->query("UPDATE  app_version set current_version = '$data[student_ios]' where app_version_for ='student_ios'");
        $teacher      = $this->db->query("UPDATE  app_version set current_version = '$data[teacher]' where app_version_for ='teacher'");
        $teacher_ios  = $this->db->query("UPDATE  app_version set current_version = '$data[teacher_ios]' where app_version_for ='teacher_ios'");
        $speaking     = $this->db->query("UPDATE  app_version set current_version = '$data[speaking]' where app_version_for ='speaking'");
        $speaking_ios = $this->db->query("UPDATE  app_version set current_version = '$data[speaking_ios]' where app_version_for ='speaking_ios'");
        $result = [
            'student' => $student,
            'student_ios' => $student_ios,
            'teacher' => $teacher,
            'teacher_ios' => $teacher_ios,
            'speaking' => $speaking,
            'speaking_ios' => $speaking_ios,
        ];
        return $student;
    }
}