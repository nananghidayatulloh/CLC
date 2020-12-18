<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_template extends CI_Model {
    public function dataTemplate()
    {   
        $this->db->order_by('id');
        return $query = $this->db->get('template_comment');
    }

    public function save_template($comment)
    {
        $data = [
            'comment' => $comment
        ];
        $query = $this->db->insert('template_comment', $data);
        return $query;
    }

    public function update_template($id, $comment)
    {
        $data = [
            'comment' => $comment
        ];

        $this->db->where('id', $id);
        $query = $this->db->update('template_comment', $data);
        return $query;
    }

    public function delete_template($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('template_comment');
        return $query;
    }

    public function dataTemplateSpeaking()
    {   
        $this->db->order_by('id');
        return $query = $this->db->get('template_comment_ds');
    }

    public function save_template_speaking($comment)
    {
        $data = [
            'comment' => $comment
        ];
        $query = $this->db->insert('template_comment_ds', $data);
        return $query;
    }

    public function update_template_speaking($id, $comment)
    {
        $data = [
            'comment' => $comment
        ];

        $this->db->where('id', $id);
        $query = $this->db->update('template_comment_ds', $data);
        return $query;
    }

    public function delete_template_speaking($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('template_comment_ds');
        return $query;
    }
}