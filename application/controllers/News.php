<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_news');
        session();
    }

    public function index()
    {
        redirect('news/news','refresh');
    }

    public function news()
    {
        $data = [
			'news' => $this->m_news->data_news()->result_array()
        ];
        
        // print_r($data);
        // die();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('news/list_news');
		$this->load->view('layout/footer');
    }
    
    public function tambah_news()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required|xss_clean');
        if (empty($_FILES['image_large']['name'])) $this->form_validation->set_rules('image_large', 'Image Large', 'trim|required|xss_clean');
        // if (empty($_FILES['image_small']['name'])) $this->form_validation->set_rules('image_small', 'Image Small', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('layout/sidebar');
            $this->load->view('news/tambah_news');
            $this->load->view('layout/footer');
        } else {
            $data = $this->input->post();
            // $nama_file = [
                // 'image_large' => $_FILES['image_large']['name'],
                // // 'image_small' => $_FILES['image_small']['name']
            // ];
            $nama_file = $this->m_news->insert_news($data);
            $nama = $this->image_upload($nama_file);
            $this->db->where('id_news', $nama_file);
            $this->db->update('news', $nama);
            
            $this->session->set_flashdata('simpan', 'Anda Berhasil Simpan Data...');
            redirect('news/news');
        }
    }

    public function edit_news()
    {
        $eid = $this->uri->segment(3);
        $id   = decrypt_url($eid);
        
        $this->form_validation->set_rules('id_news', 'ID News', 'trim|required|xss_clean');
        $this->form_validation->set_rules('title', 'title', 'trim|required|xss_clean');
        if(empty($_FILES['image_large']['name'])) {$this->form_validation->set_rules('image_large', 'Image', 'trim|xss_clean');}
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['news'] = $this->db->get_where('news', ['id_news' => $id])->row_array();
            
            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('news/edit_news');
            $this->load->view('layout/footer');
        } else {
            $data_post = [
                'id_news' => $this->input->post('id_news', TRUE),
                'title' => $this->input->post('title', TRUE),
                'description' => $this->input->post('description', TRUE)
            ];
            $file = $_FILES['image_large']['tmp_name'];

            if ($file == "" || $file == NULL) {
                $this->m_news->update_news($data_post);
                $this->session->set_flashdata('simpan', 'Anda Berhasil Update Data...');
                redirect('news/news');
            } else {
                $result_upload = $this->image_upload($data_post['id_news']);
                $update_data = array_merge($data_post, $result_upload);

                $this->m_news->update_news($update_data);
                $this->session->set_flashdata('simpan', 'Anda Berhasil Update Data...');
                redirect('news/news');
            }
        }
    }

    public function image_upload($nama_file)
    {
        $this->data['notification'] = '';
        if($_FILES['image_large']['size'] != 0 || $_FILES['image_small']['size'] != 0){

            if (!file_exists(content_dir().'News')) {
                mkdir(content_dir().'News');
            } 
            $config['upload_path']   = content_dir().'News';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['overwrite']     = true;
            $config['max_size']	     = '5120';
            $config['file_name']     = $nama_file.".png";

            $this->load->library('upload', $config);
            $file_name['image_url_large'] = $this->lets_upload( 'image_large' );
            // $file_name['name'] = $this->lets_upload( 'image_small' );
            return $file_name;
        } else {
            $this->form_validation->set_message('image_upload', "No file selected");
            return false;
        }
    }

    public function lets_upload( $field_name )
    {
        if ( ! $this->upload->do_upload( $field_name ))
        {
            return $this->data['notification'] .= $this->upload->display_errors();
        } else {
            $upload_data = $this->upload->data();
            return  $this->data['notification'] .= content_url().'News/'.$upload_data['file_name'];
        }
    }

    public function hapus_news()
    {
        $e_id   = $this->uri->segment(3);
        $id     = decrypt_url($e_id);
        
        $result_hapus = $this->m_news->hapus_news($id);
        if ($result_hapus > 0) {
            $this->session->set_flashdata('simpan', 'Anda Berhasil Hapus Data');
        } else {
            $this->session->set_flashdata('error', 'Anda Gagal Hapus Data');
        }
        redirect('news/news');
    }
}