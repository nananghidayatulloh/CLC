<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_news extends CI_Model {
    public function data_news()
    {
        return $this->db->get('news');
    }

    public function insert_news($data)
    {
        $data_insert = [
            'title'             => $data['title'],
            'description'       => $data['description'],
            'image_url_large'   => "",
            // 'image_url_large'   => content_url()."News/".str_replace(" ", "_",$nama_file['image_large']),
            // 'image_url_small'   => content_url()."News/".$news[1]
        ];
        $this->db->insert('news', $data_insert);

        return $this->db->insert_id();
    }

    public function update_news($data_post)
    {
            $this->db->where('id_news',$data_post['id_news']);
            unset($data_post['id_news']);
            $this->db->update('news',$data_post);
    }

    public function hapus_news($id)
    {
        $result = $this->db->query("SELECT * FROM news WHERE id_news = '$id'")->row_array();
        $nama_file = $result['image_url_large'];
        $substr = substr($nama_file,53);
        unlink("../Content/News/".$substr);
        return $this->db->delete('news', array('id_news' => $id)); 
    }
}