<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dialog extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_level']);
        session();
	}
	
    public function index()
    {
        redirect('dialog/dialog','refresh');
	}
	
	public function dialog()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('dialog/list_dialog');
		$this->load->view('layout/footer');
	}

    public function dialog_list_file()
	{
		$level 	= $this->input->post('level');
		// $level 	= '41';
		$hasil = array();
		$dir = content_dir()."Dialog/".$level."/";
		
		if (file_exists ($dir)) {
			$files = preg_grep('/^([^.])/', scandir ($dir));
			foreach ($files as $file) {
				array_push($hasil, $file);
			}	
		}
		array_multisort(array_values($hasil),SORT_NATURAL,$hasil);
		$hasil['data'] = json_encode($hasil);
		echo json_encode ($hasil);
    }
    
    public function upload_file_dialog()
	{
		$data = [
			'level'  => $this->input->post('level'),
			'file' 	 => $_FILES['files']
		];

		$dir = content_dir()."Dialog/".$data['level'];
		if(!file_exists($dir)){
			mkdir($dir,0755, true);
		}
		
		$countFiles = count($data['file']['name']);
		for ($i=0; $i < $countFiles; $i++) {
			if (!empty($data['file']['name'][$i])) {
				$_FILES['file']['name'] = $data['file']['name'][$i];
				$_FILES['file']['type'] = $data['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $data['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $data['file']['error'][$i];
				$_FILES['file']['size'] = $data['file']['size'][$i];

				$config['upload_path'] 	 = $dir; 
				$config['allowed_types'] = '*';
				$config['overwrite']	 = true;
				$this->load->library('upload',$config);
				$nama_file = $data['file']['name'][$i];
				$file_extension     =   pathinfo($nama_file, PATHINFO_EXTENSION);
				$allowed_extension  =   array('txt');

				if(in_array($file_extension, $allowed_extension)) {
					$do_upload = $this->upload->do_upload('file');
					if ($do_upload) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						echo "<ul class='list-group'>";
						echo "<li class='list-group-item'>".$filename ;
						echo "</li>";
						echo "</ul>";
					} else {
						echo 'something went !wrong';
					}	
				} else {
					echo 'please upload valid file';
				}
			}
		}
    }
    
    public function delete_dialog_file()
	{
		$file_name = $this->input->post('file_name');
		$level	   = $this->input->post('level');

        $result = [];
		if (isset ($level) && isset ($file_name)) {
		$dir = content_dir()."Dialog/".$level."/".$file_name;
			if (file_exists ($dir)) {
				unlink ($dir);
				$result['data'] = "Berhasil Menghapus";
			} else {
				$result['data'] = "Gagal Menghapus";
			}
        }
        
        echo json_encode($result);
    }
    
    public function download_dialog_file()
	{
        $this->load->helper('download');
        
		$level 		= $this->input->get('level', TRUE);
		$file_name 	= $this->input->get('file_name', TRUE);

		$file = content_dir()."Dialog/".$level."/".$file_name;
		force_download($file, NULL);
	}

	public function dialog_clear_data_content()
	{
		$level = $this->input->post('level', TRUE);

		$dialogDir = content_dir()."Dialog/".$level."/";
		// echo file_exists($dialogDir);
		delete_directory($dialogDir);
		echo json_encode($data['result'] = "Berhasil Menghapus Data");
	}

	public function dialog_main()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('dialog/main/list_dialog_main');
		$this->load->view('layout/footer');
	}

	public function dialog_extra()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('dialog/extra/list_dialog_extra');
		$this->load->view('layout/footer');
	}

	 public function dialog_list_file_new()
	{
		$level 	= $this->input->post('level', TRUE);
		$mode 	= $this->input->post('mode', TRUE);

		$hasil 	= [];
		$dir 	= "";

		if ($mode == "dialog_main") {
			$dir = content_dir()."Dialog/Main/".$level."/";
		} elseif ($mode == "dialog_extra") {
			$dir = content_dir()."Dialog/Extra/".$level."/";
		}
		
		if (file_exists ($dir)) {
			$files = preg_grep('/^([^.])/', scandir ($dir));
			foreach ($files as $file) {
				array_push($hasil, $file);
			}	
		}
		array_multisort(array_values($hasil),SORT_NATURAL,$hasil);
		$hasil['data'] = json_encode($hasil);
		echo json_encode ($hasil);
	}
	
	public function upload_file_dialog_new()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'mode'   => $this->input->post('mode', TRUE),
			'file' 	 => $_FILES['files']
		];

		$dir = "";
		if ($data['mode'] == "dialog_main") {
			$dir = content_dir()."Dialog/Main/".$data['level'];
		} elseif ($data['mode'] == "dialog_extra") {
			$dir = content_dir()."Dialog/Extra/".$data['level'];
		}

		if(!file_exists($dir)){
			mkdir($dir,0755, TRUE);
		}

		$countFiles = count($data['file']['name']);
		for ($i=0; $i < $countFiles; $i++) {
			if (!empty($data['file']['name'][$i])) {

				$_FILES['file']['name'] 	= $data['file']['name'][$i];
				$_FILES['file']['type'] 	= $data['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $data['file']['tmp_name'][$i];
				$_FILES['file']['error'] 	= $data['file']['error'][$i];
				$_FILES['file']['size'] 	= $data['file']['size'][$i];

				$config['upload_path'] 	 = $dir; 
				$config['allowed_types'] = '*';
				$config['overwrite']	 = true;

				$this->load->library('upload',$config);
				$nama_file = $data['file']['name'][$i];
				$file_extension     =   pathinfo($nama_file, PATHINFO_EXTENSION);
				$allowed_extension  =   array('txt');

				if(in_array($file_extension, $allowed_extension)) {
					$do_upload = $this->upload->do_upload('file');
					if ($do_upload) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						echo "<ul class='list-group'>";
						echo "<li class='list-group-item'>".$filename ;
						echo "</li>";
						echo "</ul>";
					} else {
						echo 'something went !wrong';
					}	
				} else {
					echo 'please upload valid file';
				}
			}
		}
	}
	
	public function download_dialog_file_new()
	{
        $this->load->helper('download');
        
		$level 		= $this->input->get('level', TRUE);
		$file_name 	= $this->input->get('file_name', TRUE);
		$mode 		= $this->input->get('mode', TRUE);

		$file = "";
		if ($mode == "dialog_main") {
			$file = content_dir()."Dialog/Main/".$level."/".$file_name;
		} elseif ($mode == "dialog_extra") {
			$file = content_dir()."Dialog/Extra/".$level."/".$file_name;
		}

		force_download($file, NULL);
	}

	public function delete_dialog_file_new()
	{
		$file_name = $this->input->post('file_name', TRUE);
		$level	   = $this->input->post('level', TRUE);
		$mode	   = $this->input->post('mode', TRUE);

        $result = [];
		if (isset ($level) && isset ($file_name)) 
		{
			$dir = "";
			if ($mode == "dialog_main") {
				$dir = content_dir()."Dialog/Main/".$level."/".$file_name;
			} elseif ($mode == "dialog_extra") {
				$dir = content_dir()."Dialog/Extra/".$level."/".$file_name;
			}
			if (file_exists ($dir)) {
				unlink ($dir);
				$result['data'] = "Berhasil Menghapus";
			} else {
				$result['data'] = "Gagal Menghapus";
			}
        }
        
        echo json_encode($result);
	}
	
	public function dialog_clear_data_content_new()
	{
		$level = $this->input->post('level', TRUE);
		$mode  = $this->input->post('mode', TRUE);

		$dialogDir = "";
		if ($mode == "dialog_main") {
			$dialogDir = content_dir()."Dialog/Main/".$level."/";
		} elseif ($mode == "dialog_extra") {
			$dialogDir = content_dir()."Dialog/Extra/".$level."/";
		}

		delete_directory($dialogDir);
		echo json_encode($data['result'] = "Berhasil Menghapus Data");
	}
}