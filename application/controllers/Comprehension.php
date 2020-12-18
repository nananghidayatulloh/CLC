<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprehension extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_comprehension', 'm_level', 'm_unit']);
        session();
    }

    public function index()
    {
        redirect('comprehension/comprehension','refresh');
    }

    public function comprehension()
    {
        $data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
        ];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('comprehension/list_comprehension');
		$this->load->view('layout/footer');
    }

	public function comprehension_list_file()
	{
		$level 	= $this->input->post('level');
		// $level 	= '41';
		$hasil = array();
		$dir = content_dir()."Comprehension/".$level."/";
		
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
	
	public function upload_file_comprehension()
	{
		$data = [
			'level'  => $this->input->post('level'),
			'file' 	 => $_FILES['files']
		];
		$dir = content_dir()."Comprehension/".$data['level'];
		if(!file_exists($dir)){
			mkdir($dir,0777);
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

	public function delete_comprehension_file()
	{
		$file_name = $this->input->post('file_name');
		$level	   = $this->input->post('level');

        $result = [];
		if (isset ($level) && isset ($file_name)) {
		$dir = content_dir()."Comprehension/".$level."/".$file_name;
			if (file_exists ($dir)) {
				unlink ($dir);
				$result['data'] = "Berhasil Menghapus";
			} else {
				$result['data'] = "Gagal Menghapus";
			}
        }
        
        echo json_encode($result);
	}
	
	public function download_comprehension_file()
	{
        $this->load->helper('download');
        
		$level 		= $this->input->get('level', TRUE);
		$file_name 	= $this->input->get('file_name', TRUE);

		$file = content_dir()."Comprehension/".$level."/".$file_name;
		force_download($file, NULL);
	}

	public function comprehension_clear_data_content()
	{
		$level = $this->input->post('level', TRUE);

		$dir = content_dir()."Comprehension/".$level."/";
		// echo file_exists($dir);
		delete_directory($dir);
		echo json_encode($data['result'] = "Berhasil Menghapus Data");
	}

	public function comprehension_main()
    {
        $data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
        ];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('comprehension/main/list_comprehension_main');
		$this->load->view('layout/footer');
	}
	
	public function comprehension_extra()
    {
        $data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
        ];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('comprehension/extra/list_comprehension_extra');
		$this->load->view('layout/footer');
	}
	
	public function comprehension_list_file_new()
	{
		$level 	= $this->input->post('level', TRUE);
		$mode 	= $this->input->post('mode', TRUE);

		$hasil = [];
		$dir   = "";

		if ($mode == "comprehension_main") {
			$dir = content_dir()."Comprehension/Main/".$level."/";
		} elseif ($mode == "comprehension_extra") {
			$dir = content_dir()."Comprehension/Extra/".$level."/";
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
	
	public function upload_file_comprehension_new()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'mode'   => $this->input->post('mode', TRUE),
			'file' 	 => $_FILES['files']
		];

		$dir = "";
		if ($data['mode'] == "comprehension_main") {
			$dir = content_dir()."Comprehension/Main/".$data['level'];
		} elseif ($data['mode'] == "comprehension_extra") {
			$dir = content_dir()."Comprehension/Extra/".$data['level'];
		}
		if(!file_exists($dir)){
			mkdir($dir,0777, TRUE);
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

	public function delete_comprehension_file_new()
	{
		$file_name = $this->input->post('file_name', TRUE);
		$level	   = $this->input->post('level', TRUE);
		$mode	   = $this->input->post('mode', TRUE);

		$result = [];
		$dir = "";

		if (isset ($level) && isset ($file_name)) {
			if ($mode  == "comprehension_main") {
				$dir = content_dir()."Comprehension/Main/".$level."/".$file_name;
			} elseif ($mode == "comprehension_extra") {
				$dir = content_dir()."Comprehension/Extra/".$level."/".$file_name;
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
	
	public function download_comprehension_file_new()
	{
        $this->load->helper('download');
        
		$level 		= $this->input->get('level', TRUE);
		$file_name 	= $this->input->get('file_name', TRUE);
		$mode 		= $this->input->get('mode', TRUE);

		$file = "";
		if ($mode == "comprehension_main") {
			$file = content_dir()."Comprehension/Main/".$level."/".$file_name;
		} elseif ($mode == "comprehension_extra") {
			$file = content_dir()."Comprehension/Extra/".$level."/".$file_name;
		}
		force_download($file, NULL);
	}

	public function comprehension_clear_data_content_new()
	{
		$level = $this->input->post('level', TRUE);
		$mode = $this->input->post('mode', TRUE);

		$dir = "";
		if ($mode == "comprehension_main") {
			$dir = content_dir()."Comprehension/Main/".$level."/";
		} elseif ($mode == "comprehension_extra") {
			$dir = content_dir()."Comprehension/Extra/".$level."/";
		}
		// echo file_exists($dir);
		delete_directory($dir);
		echo json_encode($data['result'] = "Berhasil Menghapus Data");
	}
	







	// ######## lama
    public function comprehension_unit()
	{
		$level = $this->input->post('level', TRUE);
        $unit = $this->m_level->unitlevel($level)->row_array();
        $hasil[0] = " - Pilih Unit -";
        for ($i=1; $i <= $unit['total_unit']; $i++) { 
            $hasil[$i] = $i;
        }
        echo json_encode($hasil);
	}

    public function comprehension_list()
    {
        $level 	= $this->input->post('level', TRUE);
		$hasil = array();
		$dir = content_dir()."Dialog/".$level."/";
		
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

    public function comprehension_unit_name()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE)
        ];

        $result = $this->m_unit->unitName($data['level'], $data['unit']);
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
    }

    public function comprehension_story_name()
    {
        $data = [
            'level'  => $this->input->post('level', TRUE),
            'unit'   => $this->input->post('unit', TRUE),
            'story'  => $this->input->post('story', TRUE)
        ];

        $result = $this->m_unit->storyName($data['level'], $data['unit'], $data['story']);
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
    }

    public function comprehension_story_file()
    {
        $data = [
            'level'  => $this->input->post('level', TRUE),
            'unit'   => $this->input->post('unit', TRUE),
            'story'  => $this->input->post('story', TRUE)
        ];

        $hasil['name'] = array();
		$file = $data['level']."U".$data['unit']."S".$data['story'].".txt";
		$dir = content_dir()."DailyReading/StoryFolder/".$data['level']."/".$file;
		
		if (file_exists ($dir)) {
			array_push($hasil['name'],$file);
        }
        
        echo json_encode($hasil);
    }

    public function comprehension_audio_file()
    {
        $data = [
            'level'  => $this->input->post('level', TRUE),
            'unit'   => $this->input->post('unit', TRUE),
            'story'  => $this->input->post('story', TRUE),
            'speed'  => $this->input->post('speed', TRUE)
        ];

        $hasil = array();
		$folder = $data['level']."U".$data['unit']."S".$data['story'];
		$dir = content_dir()."DailyReading/AudioFolder/".$data['level']."/".$folder."/".$data['speed']."/";
		
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

    public function comprehension_update_unit()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE),
            'name'  => $this->input->post('unit_name_baru', TRUE),
        ];

        // echo json_encode($data);
        $result = $this->m_unit->unitName($data['level'], $data['unit']);
        $hasil['name'] = [];
			if ($result->num_rows() == 0) {
				$result_insert = $this->m_unit->insertUnit($data);
				if ($result_insert == "1") {
                    $hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
				} else {
                    $hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
				}
			} else {
                $result_update = $this->m_unit->updateUnitName($data);
				if ($result_update == "1") {
					$hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
				} else {
					$hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
				}
            }
            
            echo json_encode($hasil);
    }

    public function comprehension_update_story()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE),
            'story' => $this->input->post('story', TRUE),
            'name'  => $this->input->post('story_name_baru', TRUE),
        ];

        // echo json_encode($data);
        $result = $this->m_unit->storyName($data['level'], $data['unit'], $data['story']);
        $hasil['name'] = [];
			if ($result->num_rows() == 0) {
				$result_insert = $this->m_unit->insertStoryName($data);
				if ($result_insert == "1") {
                    $hasil['name'] = "Berhasil Melakukan Perubahan Nama Story";
				} else {
                    $hasil['name'] = "Perubahan Nama Story Tidak Berhasil";
				}
			} else {
                $result_update = $this->m_unit->updateStoryName($data);
				if ($result_update == "1") {
					$hasil['name'] = "Berhasil Melakukan Perubahan Nama Story";
				} else {
					$hasil['name'] = "Perubahan Nama Story Tidak Berhasil";
				}
            }
            
            echo json_encode($hasil);
    }

    // public function comprehension_clear_data()
    // {
    //     $level = $this->input->post('level');
	// 	$unit = $this->input->post('unit');
	// 	$story = $this->input->post('story');
	// 	$mode = $this->input->post('mode');
	// 		if (isset($level)&&isset($unit)&&isset($story)&&isset($mode)) {
	// 			if ($mode == '1') {
	// 				$folder = $level."U".$unit."S".$story;
	// 				$audioDir = content_dir()."DailyReading/AudioFolder/".$level."/".$folder."/";
	// 				$story = content_dir()."DailyReading/StoryFolder/".$level."/".$folder.".txt";
	// 				if (file_exists($story)) unlink($story);
	// 				$this->delete_directory($audioDir);
	// 				echo "Berhasil Menghapus Data";
	// 			} 
	// 		} elseif ($mode == '2') {
	// 			$dialogDir = content_dir()."Dialog/".$level."/";
	// 			$this->delete_directory($dialogDir);
	// 			echo "Berhasil Menghapus Data";
	// 		} elseif ($mode = '3') {
	// 			$examDir = content_dir()."Exam/".$level."/";
	// 			$this->delete_directory($examDir);
	// 			echo "Berhasil Menghapus Data";
	// 		}
    // }

    public function comprehension_upload_story()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'unit' 	 => $this->input->post('unit', TRUE),
			'story'  => $this->input->post('story', TRUE),
			'file' 	 => $_FILES['files_story']
        ];
        
		$temp = $data['file']['tmp_name'];
		$nama = $data['file']['name'];

		$mkdir = '';
		$mkdir = content_dir().'DailyReading/StoryFolder/'.$data['level'];
		$nama_file = $data['level']."U".$data['unit']."S".$data['story'].".txt";
		
		if(!file_exists($mkdir)){
			mkdir($mkdir, 0777, true);
		}
		
		if(!empty($_FILES['files']['name'])) { 	
        	$config['upload_path']   = $mkdir; 
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
    
    public function comprehension_upload_audio()
    {
		$data = [
			'level'  => $this->input->post('level',TRUE),
			'unit' 	 => $this->input->post('unit',TRUE),
			'story'  => $this->input->post('story',TRUE),
			'speed'  => $this->input->post('speed',TRUE),
			// 'status' => $this->input->post('status',TRUE),
			'file' 	 => $_FILES['files_audio']
		];

		$mkdir = content_dir().'DailyReading/AudioFolder/'.$data['level'];
		$mkdir1 = content_dir().'DailyReading/AudioFolder/'.$data['level'].'/'.$data['level']."U".$data['unit']."S".$data['story'].'/'.$data['speed'];

		if (!file_exists($mkdir)) {
			mkdir($mkdir, 0777, true);
		}
		if (!file_exists($mkdir1)) {
			mkdir($mkdir1, 0777, true);
		}
		$countFiles = count($data['file']['name']);
		for ($i=0; $i < $countFiles; $i++) {
			if (!empty($data['file']['name'][$i])) {
				$_FILES['file']['name'] = $data['file']['name'][$i];
				$_FILES['file']['type'] = $data['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $data['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $data['file']['error'][$i];
				$_FILES['file']['size'] = $data['file']['size'][$i];

				$config['upload_path'] 	 = $mkdir1; 
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
	
	public function comprehension_delete_story()
	{
		$data = [
			'file_name' => $this->input->post('file_name', TRUE),
			'level' => $this->input->post('level', TRUE)
		];
		$result = [];
		if ($data['file_name'] != "") {
			// echo json_encode($coba['coba'] = content_dir()."DailyReading/StoryFolder/".$data['level']."/".$data['file_name']);
			$fileLocation = content_dir()."DailyReading/StoryFolder/".$data['level']."/".$data['file_name'];
			unlink($fileLocation);
			$result['ADD_INFO'] = "Berhasil Di hapus ...";
		} else {
			echo json_encode($coba['coba'] = "hasil coba 1");
				// $result['ADD_INFO'] = "Data tidak lengkap!";
			}
		echo json_encode($result);
	}

	public function comprehension_download_story_file()
	{
		$this->load->helper('download');
		$level 	= $this->input->get('level');
		$unit 	= $this->input->get('unit');
		$story 	= $this->input->get('story');

		$file = content_dir()."DailyReading/StoryFolder/".$level."/".$level."U".$unit."S".$story.".txt";
		force_download($file, NULL);
	}

	public function comprehension_clear_data_content1()
	{
		$level 	= $this->input->post('level', TRUE);
		$unit 	= $this->input->post('unit', TRUE);
		$story 	= $this->input->post('story', TRUE);

		$folder = $level."U".$unit."S".$story;
		$audioDir = content_dir()."DailyReading/AudioFolder/".$level."/".$folder."/";
		$story = content_dir()."DailyReading/StoryFolder/".$level."/".$folder.".txt";
		if (file_exists($story)) unlink($story);
		delete_directory($audioDir);
		echo json_encode($result['data'] = "Berhasil Menghapus Data");
	}
}