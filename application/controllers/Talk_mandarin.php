<?php defined('BASEPATH') or exit('No direct script access allowed');

class Talk_mandarin extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('m_level');
		session();
    }
    
    public function index()
	{
        $data = [
			'level' => $this->m_level->dataTalkmandarin()->result_array()
        ];
        
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('talk_mandarin/list_talk_mandarin');
		$this->load->view('layout/footer');
    }
    
    public function talk_mandarin_edit()
	{
        $result = $this->m_level->editTalk();
	}

	public function talk_mandarin_hapus()
	{
		
		$eid = $this->uri->segment(3);
		$id_level = decrypt_url($eid);
		
		$this->m_level->hapus_talk_mandarin($id_level);

		$this->session->set_flashdata('simpan', 'Level Talk Mandarin berhasil di hapus ...');
		redirect('talk_mandarin');
	}
}