<?php defined('BASEPATH') or exit('No direct script access allowed');

class Daily_Speaking extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_level']);
        session();
	}
	
    public function index()
    {
        redirect('daily_speaking/daily_speaking_main','refresh');
	}

	public function daily_speaking_unit()
	{
		$level = $this->input->post('level', TRUE);
		$mode  = $this->input->post('mode', TRUE);
		$mode2 = ucfirst(explode('_', $mode)[2]);

		$hasil[0]['unit_number'] 	= " - Pilih Unit -";
		$hasil[0]['unit_title']  	= "";
		$hasil[0]['story_uploaded']	= "";

		if ($mode ==  'daily_speaking_main') {
			$unit = $this->db->select('main_total_unit as total_unit')->from('daily_speaking_config')->where('id_level', $level)->get()->row_array();
		} else if ($mode == 'daily_speaking_extra') {
			$unit = $this->db->select('extra_total_unit as total_unit')->from('daily_speaking_config')->where('id_level', $level)->get()->row_array();
		}

        for ($i=1; $i <= $unit['total_unit']; $i++) { 
			$hasil[$i]['unit_number'] = $i;
			$hasil[$i]['unit_title']  = "";
			$getTitle = $this->db->query("SELECT name FROM daily_speaking_unit_name WHERE level = '$level' AND unit = '$i' AND mode = LOWER('$mode2')")->result_array();

			if (count($getTitle) > 0) $hasil[$i]['unit_title'] = $getTitle[0]['name'];
			$hasil[$i]['story_uploaded'] = "";
            if (file_exists('../Content/DailySpeaking/'.$mode2.'/StoryFolder/'.$level.'/'.$level.'U'.$i.'.txt')) {
            	$hasil[$i]['story_uploaded'].="✓";
            }
        }
        echo json_encode($hasil);
	}

	public function daily_speaking_content_freeze()
	{
		$data = [
			'level' => $this->input->post('level', TRUE),
			'unit'  => $this->input->post('unit', TRUE),
			'mode'  => $this->input->post('mode', TRUE)
		];

		$result['freeze'] = $this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'mode' => $data['mode']])->get('daily_speaking_freezed_content')->num_rows();

		echo json_encode($result);
	}

	public function daily_speaking_submit_freeze()
	{
		$data = [
			'level' => $this->input->post('level', TRUE),
			'unit'  => $this->input->post('unit', TRUE),
			'mode'  => $this->input->post('mode', TRUE)
		];

		$result = $this->db->insert('daily_speaking_freezed_content', $data);
		if ($result == "1") {
			$hasil = "Berhasil";
		} else {
			$hasil = "Tidak Berhasil";
		}

		echo json_encode($hasil);
	}

	public function daily_speaking_unit_name()
	{
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE),
            'mode'  => $this->input->post('mode', TRUE)
		];
		
        $result = $this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'mode' => $data['mode']])->get('daily_speaking_unit_name');
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
	}

	public function daily_speaking_update_unit()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE),
            'name'  => $this->input->post('unit_name_baru', TRUE),
            'mode'  => $this->input->post('mode', TRUE),
		];
        $result = $this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'mode' => $data['mode']])->get('daily_speaking_unit_name')->num_rows();
		$hasil['name'] = [];
			if ($result == 0) {
				$result_insert = $this->db->insert('daily_speaking_unit_name', $data);
				if ($result_insert == "1") {
                    $hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
				} else {
                    $hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
				}
			} else {
				$this->db->where(['level' => $data['level'], 'unit' => $data['unit'], 'mode' => $data['mode']]);
                $result_update = $this->db->update('daily_speaking_unit_name', ['name' => $data['name']]);
				if ($result_update == "1") {
					$hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
				} else {
					$hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
				}
            }
            
            echo json_encode($hasil);
    }
	
	public function daily_speaking_main()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('daily_speaking/main/list_daily_speaking_main');
		$this->load->view('layout/footer');
	}

	public function daily_speaking_extra()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('daily_speaking/extra/list_daily_speaking_extra');
		$this->load->view('layout/footer');
	}

	 public function daily_speaking_list_file_story()
	{
		$level 	= $this->input->post('level', TRUE);
		$unit 	= $this->input->post('unit', TRUE);
		$mode 	= $this->input->post('mode', TRUE);

		$hasil 	= [];
		$file 	= $level.'U'.$unit.'.txt';
		$dir 	= "";

		if ($mode == "daily_speaking_main") {
			$dir = content_dir()."DailySpeaking/Main/StoryFolder/".$level."/".$file;
		} elseif ($mode == "daily_speaking_extra") {
			$dir = content_dir()."DailySpeaking/Extra/StoryFolder/".$level."/".$file;
		}
		
		if (file_exists ($dir)) {
			array_push($hasil, $file);
		}
		$hasil['data'] = json_encode($hasil);
		echo json_encode ($hasil);
	}
	
	public function upload_daily_speaking()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'unit'   => $this->input->post('unit', TRUE),
			'mode'   => $this->input->post('mode', TRUE),
			'file' 	 => $_FILES['files']
		];

		$dir = "";
		if ($data['mode'] == "daily_speaking_main") {
			$dir = content_dir()."DailySpeaking/Main/StoryFolder/".$data['level'];
		} elseif ($data['mode'] == "daily_speaking_extra") {
			$dir = content_dir()."DailySpeaking/Extra/StoryFolder/".$data['level'];
		}
		$nama_file = $data['level']."U".$data['unit'].".txt";
		
		if(!file_exists($dir)){
			mkdir($dir,0755, TRUE);
		}

		if(!empty($_FILES['files']['name'])) { 	
        	$config['upload_path']   = $dir; 
        	$config['allowed_types'] = '*';
        	$config['overwrite']	 = true;
        	$config['file_name']	 = $nama_file;
			
			$this->load->library('upload', $config);
            $file_extension     =   pathinfo($nama_file, PATHINFO_EXTENSION);
            $allowed_extension  =   array('txt');

            if(in_array($file_extension, $allowed_extension)) {
            	if ($this->upload->do_upload('files')) {
            		echo $config['file_name'];
            	} else {
            		echo 'something went !wrong';
            	}	
            } else {
            	echo 'please upload valid file';
            }	
        }
	}
	
	public function download_daily_speaking_file()
	{
        $this->load->helper('download');
        
		$level 		= $this->input->get('level', TRUE);
		$file_name 	= $this->input->get('file_name', TRUE);
		$mode 		= $this->input->get('mode', TRUE);

		$file = "";
		if ($mode == "daily_speaking_main") {
			$file = content_dir()."DailySpeaking/Main/StoryFolder/".$level."/".$file_name;
		} elseif ($mode == "daily_speaking_extra") {
			$file = content_dir()."DailySpeaking/Extra/StoryFolder/".$level."/".$file_name;
		}

		force_download($file, NULL);
	}

	public function delete_daily_speaking_file()
	{
		$file_name = $this->input->post('file_name', TRUE);
		$level	   = $this->input->post('level', TRUE);
		$mode	   = $this->input->post('mode', TRUE);

        $result = [];
		if (isset ($level) && isset ($file_name)) 
		{
			$dir = "";
			if ($mode == "daily_speaking_main") {
				$dir = content_dir()."DailySpeaking/Main/StoryFolder/".$level."/".$file_name;
			} elseif ($mode == "daily_speaking_extra") {
				$dir = content_dir()."DailySpeaking/Extra/StoryFolder/".$level."/".$file_name;
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

	public function daily_speaking_upload_audio()
    {
		$data = [
			'level'  => $this->input->post('level',TRUE),
			'unit' 	 => $this->input->post('unit',TRUE),
			'mode' 	 => $this->input->post('mode',TRUE),
			'file' 	 => $_FILES['files_audio']
		];

		if ($data['mode'] == "daily_speaking_audio_main") {
			$mkdir = content_dir().'DailySpeaking/Main/AudioFolder/'.$data['level']."/".$data['level'].'U'.$data['unit'];
		} else if ($data['mode'] == "daily_speaking_audio_extra") {
			$mkdir = content_dir().'DailySpeaking/Extra/AudioFolder/'.$data['level']."/".$data['level'].'U'.$data['unit'];
		}

		if (!file_exists($mkdir)) {
			mkdir($mkdir, 0755, true);
		}

		$countFiles = count($data['file']['name']);
		for ($i=0; $i < $countFiles; $i++) {
			if (!empty($data['file']['name'][$i])) {
				$_FILES['file']['name'] = $data['file']['name'][$i];
				$_FILES['file']['type'] = $data['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $data['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $data['file']['error'][$i];
				$_FILES['file']['size'] = $data['file']['size'][$i];

				$config['upload_path'] 	 = $mkdir; 
				$config['allowed_types'] = 'ogg';
				$config['overwrite']	 = true;
				$this->load->library('upload',$config);
				$nama_file = $data['file']['name'][$i];
				$file_extension     =   pathinfo($nama_file, PATHINFO_EXTENSION);
				$allowed_extension  =   array('ogg');

				if(in_array($file_extension, $allowed_extension)) {
					

					if ($this->upload->do_upload('file')) {
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

	public function daily_speaking_audio_file()
    {
        $data = [
            'level'  => $this->input->post('level', TRUE),
            'unit'   => $this->input->post('unit', TRUE),
            'mode'   => $this->input->post('mode', TRUE)
        ];

        $hasil = array();
		$folder = $data['level']."U".$data['unit'];

		$dir = "";
		if ($data['mode'] == "daily_speaking_audio_main") {
			$dir = content_dir()."DailySpeaking/Main/AudioFolder/".$data['level']."/".$folder."/";
		} else if ($data['mode'] == "daily_speaking_audio_extra") {
			$dir = content_dir()."DailySpeaking/Extra/AudioFolder/".$data['level']."/".$folder."/";
		}
		
		if (file_exists ($dir)) {
		$files = preg_grep('/^([^.])/', scandir ($dir));
		foreach ($files as $file) {
			array_push($hasil, $file);
			}	
		}
		array_multisort(array_values($hasil),SORT_NATURAL,$hasil);
		$hasil = json_encode($hasil);
		echo $hasil;
	}

	public function delete_daily_speaking_file_audio()
	{
		$level = $this->input->post('level', TRUE);
		$unit  = $this->input->post('unit', TRUE);
		$mode  = $this->input->post('mode', TRUE);
		$file  = $this->input->post('file_name', TRUE);

		$folder = $level."U".$unit;

		$dir = "";

		if ($mode == 'daily_speaking_main') {
			$dir = content_dir()."DailySpeaking/Main/AudioFolder/".$level."/".$folder."/".$file;
		} else if($mode == 'daily_speaking_extra') {
			$dir = content_dir()."DailySpeaking/Extra/AudioFolder/".$level."/".$folder."/".$file;
		}

		$result = [];
		if (file_exists ($dir)) {
			unlink ($dir);
			$result['data'] = "Berhasil Menghapus";
		} else {
			$result['data'] = "Gagal Menghapus";
		}
		echo json_encode($result);
	}
	
	public function daily_speaking_clear_data_content()
	{
		$level = $this->input->post('level', TRUE);
		$unit  = $this->input->post('unit', TRUE);
		$mode  = $this->input->post('mode', TRUE);

		$folder = $level."U".$unit;

		$storyDir = "";
		$audioDir = "";

		if ($mode == "daily_speaking_main") {
			$storyDir = content_dir()."DailySpeaking/Main/StoryFolder/".$level."/".$folder.".txt";
			$audioDir = content_dir()."DailySpeaking/Main/AudioFolder/".$level."/".$folder."/";
		} elseif ($mode == "daily_speaking_extra") {
			$storyDir = content_dir()."DailySpeaking/Extra/StoryFolder/".$level."/".$folder.".txt";
			$audioDir = content_dir()."DailySpeaking/Extra/AudioFolder/".$level."/".$folder."/";
		}

		if (file_exists($storyDir)) unlink($storyDir);
		$data['delete_dir'] = delete_directory($audioDir);
		echo json_encode($result['result'] = "Berhasil Menghapus Data");
	}
}