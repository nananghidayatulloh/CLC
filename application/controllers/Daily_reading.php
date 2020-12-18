<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_reading extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_level', 'm_unit']);
        session();
    }

	public function index()
	{
			redirect('daily_reading/daily_reading','refresh');
	}

	public function daily_reading()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('daily_reading/list_daily_reading');
		$this->load->view('layout/footer');
	}

	public function daily_reading_unit()
	{
		$level = $this->input->post('level', TRUE);
		$unit = $this->m_level->unitlevel($level)->row_array();
		$hasil[0] = " - Pilih Unit -";
		for ($i=1; $i <= $unit['total_unit']; $i++) {
				$hasil[$i] = $i;
		}
		echo json_encode($hasil);
	}

	public function daily_reading_list()
	{
		$level 	= $this->input->post('level', TRUE);
		$hasil = array();
		$dir = content_dir()."DailyReading/".$level."/";

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

	public function daily_reading_unit_name()
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

	public function daily_reading_story_name()
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

	public function daily_reading_story_file()
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

	public function daily_reading_audio_file()
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

	public function daily_reading_update_unit()
	{
		$data = [
			'level' => $this->input->post('level', TRUE),
			'unit'  => $this->input->post('unit', TRUE),
			'name'  => $this->input->post('unit_name_baru', TRUE),
		];

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

	public function daily_reading_update_story()
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

	public function daily_reading_upload_story()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'unit' 	 => $this->input->post('unit', TRUE),
			'story'  => $this->input->post('story', TRUE),
			'file' 	 => $_FILES['files']
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

		public function daily_reading_upload_audio()
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

	public function daily_reading_delete_story()
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

	public function daily_reading_data_audio()
	{
		$level 		 = $this->input->post('level', TRUE);
		$unit 		 = $this->input->post('unit', TRUE);
		$story 		 = $this->input->post('story', TRUE);
		$file_name 	 = $this->input->post('file_name', TRUE);
		$speed_level = $this->input->post('speed', TRUE);

		$folder = $level."U".$unit."S".$story;
		$dir = content_dir()."DailyReading/AudioFolder/".$level."/".$folder."/".$speed_level."/".$file_name;
		$result = [];
		if (file_exists ($dir)) {
			unlink ($dir);
			$result['ADD_INFO'] = "Berhasil Menghapus";
		} else {
			$result['ADD_INFO'] = "Gagal Menghapus";
		}
		echo json_encode($result);
	}

	public function daily_reading_download_story_file()
	{
		$this->load->helper('download');
		$level 	= $this->input->get('level');
		$unit 	= $this->input->get('unit');
		$story 	= $this->input->get('story');

		$file = content_dir()."DailyReading/StoryFolder/".$level."/".$level."U".$unit."S".$story.".txt";
		force_download($file, NULL);
	}

	public function daily_reading_clear_data_content()
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

	public function daily_reading_unit_new()
	{
		$level = $this->input->post('level', TRUE);
		$mode  = $this->input->post('mode', TRUE);
        $unit = $this->m_level->unit_level($level, $mode)->row_array();
        $hasil[0] = " - Pilih Unit -";
        for ($i=1; $i <= $unit['total_unit']; $i++) {
            $hasil[$i] = $i;
        }
        echo json_encode($hasil);
	}

	public function daily_reading_unit_new2()
	{
		$level = $this->input->post('level', TRUE);
		$mode  = $this->input->post('mode', TRUE);
        $unit = $this->m_level->unit_level($level, $mode)->row_array();
        $mode2 = ucfirst(explode('_', $mode)[2]);
        $hasil[0]['unit_number'] = " - Pilih Unit -";
        $hasil[0]['unit_title']  = "";
        $hasil[0]['story_uploaded'] ="";
        for ($i=1; $i <= $unit['total_unit']; $i++) {
            $hasil[$i]['unit_number'] = $i;
            $hasil[$i]['unit_title'] = "";
            $getTitle = $this->db->query("SELECT name FROM unit_name WHERE level = '$level' AND unit = '$i' AND mode = LOWER('$mode2')")->result_array();
            if (count($getTitle) > 0) $hasil[$i]['unit_title'] = $getTitle[0]['name'];
            $hasil[$i]['story_uploaded'] = "";
            if (file_exists('../Content/DailyReading/'.$mode2.'/StoryFolder/'.$level.'/'.$level.'U'.$i.'S1.txt')) {
            	$hasil[$i]['story_uploaded'].="(1)";
            }
            if (file_exists('../Content/DailyReading/'.$mode2.'/StoryFolder/'.$level.'/'.$level.'U'.$i.'S2.txt')) {
            	$hasil[$i]['story_uploaded'].="(2)";
            }
            if (file_exists('../Content/DailyReading/'.$mode2.'/StoryFolder/'.$level.'/'.$level.'U'.$i.'S3.txt')) {
            	$hasil[$i]['story_uploaded'].="(3)";
            }
        }
        echo json_encode($hasil);
	}

	public function dialy_reading_story ()
	{
		$level = $this->input->post('level', TRUE);
		$mode = $this->input->post('mode', TRUE);
		$unit = $this->input->post('unit', TRUE);
		$hasil[0]['story_number'] = "- Pilih Story -";
		$hasil[0]['story_title'] = "";
		$hasil[0]['story_uploaded'] = "";

		for ($i=1; $i <= 3; $i++) {
			$hasil[$i]['story_number'] = $i;
			$hasil[$i]['story_title'] = "";
			$getTitle = $this->db->query("SELECT name FROM story_name WHERE level = '$level' AND unit = '$unit' AND story = '$i' AND mode = LOWER('$mode')")->result_array();
			if (count($getTitle) > 0) $hasil[$i]['story_title'] = $getTitle[0]['name'];
			$hasil[$i]['story_uploaded'] = "";
			if (file_exists('../Content/DailyReading/'.ucfirst($mode).'/StoryFolder/'.$level.'/'.$level.'U'.$unit.'S'.$i.'.txt')) {
            	$hasil[$i]['story_uploaded'].="✓";
            }
		}

		echo json_encode ($hasil);
	}

	public function daily_reading_main()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
        ];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('daily_reading/main/list_daily_reading_main');
		$this->load->view('layout/footer');
	}

	public function daily_reading_extra()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
        ];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('daily_reading/extra/list_daily_reading_extra');
		$this->load->view('layout/footer');
	}

	public function daily_reading_extended()
	{
		$data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
        ];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('daily_reading/extended/list_daily_reading_extended');
		$this->load->view('layout/footer');
	}

	public function daily_reading_unit_name_new()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE),
            'mode'  => $this->input->post('mode', TRUE)
		];

        $result = $this->m_unit->unit_name($data);
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
	}

	public function daily_reading_story_name_new()
    {
        $data = [
            'level'  => $this->input->post('level', TRUE),
            'unit'   => $this->input->post('unit', TRUE),
            'story'  => $this->input->post('story', TRUE),
            'mode'   => $this->input->post('mode', TRUE)
        ];

        $result = $this->m_unit->story_name($data);
        if ($result->num_rows() > 0 ) {
            $story_name['name'] = $result->row_array()['name'];
        } else {
            $story_name['name'] 	= "";
        }

        echo json_encode($story_name);
	}

	public function daily_reading_update_unit_new()
	{
			$data = [
					'level' => $this->input->post('level', TRUE),
					'unit'  => $this->input->post('unit', TRUE),
					'name'  => $this->input->post('unit_name_baru', TRUE),
					'mode'  => $this->input->post('mode', TRUE),
			];

			$result = $this->m_unit->unit_name($data);
			$hasil['name'] = [];
		if ($result->num_rows() == 0) {
			$result_insert = $this->m_unit->insert_unit($data);
			if ($result_insert == "1") {
									$hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
			} else {
									$hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
			}
		} else {
							$result_update = $this->m_unit->update_unit_name($data);
			if ($result_update == "1") {
				$hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
			} else {
				$hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
			}
					}

					echo json_encode($hasil);
	}

	public function daily_reading_update_story_new()
	{
			$data = [
					'level' => $this->input->post('level', TRUE),
					'unit'  => $this->input->post('unit', TRUE),
					'story' => $this->input->post('story', TRUE),
					'name'  => $this->input->post('story_name_baru', TRUE),
					'mode'  => $this->input->post('mode', TRUE),
			];

			$result = $this->m_unit->story_name($data);
			$hasil['name'] = [];
		if ($result->num_rows() == 0) {
			$result_insert = $this->m_unit->insert_story_name($data);
			if ($result_insert == "1") {
									$hasil['name'] = "Berhasil Melakukan Perubahan Nama Story";
			} else {
									$hasil['name'] = "Perubahan Nama Story Tidak Berhasil";
			}
		} else {
							$result_update = $this->m_unit->update_story_name($data);
			if ($result_update == "1") {
				$hasil['name'] = "Berhasil Melakukan Perubahan Nama Story";
			} else {
				$hasil['name'] = "Perubahan Nama Story Tidak Berhasil";
			}
					}

					echo json_encode($hasil);
	}

	public function daily_reading_upload_story_new()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'unit' 	 => $this->input->post('unit', TRUE),
			'story'  => $this->input->post('story', TRUE),
			'mode'	 => $this->input->post('mode', TRUE),
			'file' 	 => $_FILES['files']
		];

		$temp = $data['file']['tmp_name'];
		$nama = $data['file']['name'];

		$mkdir = "";
		$nama_file = "";
		if ($data['mode'] == "da_story_main") {
			$mkdir = content_dir().'DailyReading/Main/StoryFolder/'.$data['level'];
			$nama_file = $data['level']."U".$data['unit']."S".$data['story'].".txt";
		} else if ($data['mode'] == "da_story_extra") {
			$mkdir = content_dir().'DailyReading/Extra/StoryFolder/'.$data['level'];
			$nama_file = $data['level']."U".$data['unit']."S".$data['story'].".txt";
		} else if ($data['mode'] == "da_story_extended") {
			$mkdir = content_dir().'DailyReading/Extended/StoryFolder/'.$data['level'];
			$nama_file = $data['level']."U".$data['unit']."S".$data['story'].".txt";
		}

		if(!file_exists($mkdir)){
			mkdir($mkdir, 0755, true);
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
					$error = $this->upload->display_errors();
            		echo $error;
            	}
            } else {
            	echo 'please upload valid file';
            }
        }
	}

	public function daily_reading_story_file_new()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'unit'   => $this->input->post('unit', TRUE),
			'story'  => $this->input->post('story', TRUE),
			'mode'	 => $this->input->post('mode', TRUE)
		];

		$hasil['name'] = array();
		$file = $data['level']."U".$data['unit']."S".$data['story'].".txt";

		if ($data['mode'] == "da_story_main") {
			$dir = content_dir()."DailyReading/Main/StoryFolder/".$data['level']."/".$file;
		} else if ($data['mode'] == "da_story_extra") {
			$dir = content_dir()."DailyReading/Extra/StoryFolder/".$data['level']."/".$file;
		} else if ($data['mode'] == "da_story_extended") {
			$dir = content_dir()."DailyReading/Extended/StoryFolder/".$data['level']."/".$file;
		}

		if (file_exists ($dir)) {
			array_push($hasil['name'],$file);
				}

				echo json_encode($hasil);
	}

	public function daily_reading_download_story_file_new()
	{
		$this->load->helper('download');
		$level 	= $this->input->get('level', TRUE);
		$unit 	= $this->input->get('unit', TRUE);
		$story 	= $this->input->get('story', TRUE);
		$mode 	= $this->input->get('mode', TRUE);

		$file = "";
		if ($mode == "da_story_main") {
			$file = content_dir()."DailyReading/Main/StoryFolder/".$level."/".$level."U".$unit."S".$story.".txt";
		} else if ($mode == "da_story_extra") {
			$file = content_dir()."DailyReading/Extra/StoryFolder/".$level."/".$level."U".$unit."S".$story.".txt";
		} else if ($mode == "da_story_extended") {
			$file = content_dir()."DailyReading/Extended/StoryFolder/".$level."/".$level."U".$unit."S".$story.".txt";
		}
		force_download($file, NULL);
	}

	public function daily_reading_delete_story_new()
	{
		$data = [
			'file_name' => $this->input->post('file_name', TRUE),
			'level' => $this->input->post('level', TRUE),
			'mode'	=> $this->input->post('mode', TRUE)
		];
		$result = [];
		if ($data['file_name'] != "") {
			// echo json_encode($coba['coba'] = content_dir()."DailyReading/StoryFolder/".$data['level']."/".$data['file_name']);
			if ($data['mode'] == "da_story_main") {
				$fileLocation = content_dir()."DailyReading/Main/StoryFolder/".$data['level']."/".$data['file_name'];
				unlink($fileLocation);
				$result['ADD_INFO'] = "Berhasil Di hapus ...";
			} else if ($data['mode'] == "da_story_extra") {
				$fileLocation = content_dir()."DailyReading/Extra/StoryFolder/".$data['level']."/".$data['file_name'];
				unlink($fileLocation);
				$result['ADD_INFO'] = "Berhasil Di hapus ...";
			} else if ($data['mode'] == "da_story_extended") {
				$fileLocation = content_dir()."DailyReading/Extended/StoryFolder/".$data['level']."/".$data['file_name'];
				unlink($fileLocation);
				$result['ADD_INFO'] = "Berhasil Di hapus ...";
			}
		} else {
			echo json_encode($coba['coba'] = "hasil coba 1");
				// $result['ADD_INFO'] = "Data tidak lengkap!";
			}
		echo json_encode($result);
	}

	public function daily_reading_audio_file_new()
	{
		$data = [
			'level'  => $this->input->post('level', TRUE),
			'unit'   => $this->input->post('unit', TRUE),
			'story'  => $this->input->post('story', TRUE),
			'speed'  => $this->input->post('speed', TRUE),
			'mode'   => $this->input->post('mode', TRUE)
		];

		$hasil = array();
		$folder = $data['level']."U".$data['unit']."S".$data['story'];

		$dir = "";
		if ($data['mode'] == "da_audio_main") {
			$dir = content_dir()."DailyReading/Main/AudioFolder/".$data['level']."/".$folder."/".$data['speed']."/";
		} else if ($data['mode'] == "da_audio_extra") {
			$dir = content_dir()."DailyReading/Extra/AudioFolder/".$data['level']."/".$folder."/".$data['speed']."/";
		} else if ($data['mode'] == "da_audio_extended") {
			$dir = content_dir()."DailyReading/Extended/AudioFolder/".$data['level']."/".$folder."/".$data['speed']."/";
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

	public function daily_reading_upload_audio_new()
	{
		$data = [
			'level'  => $this->input->post('level',TRUE),
			'unit' 	 => $this->input->post('unit',TRUE),
			'story'  => $this->input->post('story',TRUE),
			'speed'  => $this->input->post('speed',TRUE),
			'mode' 	 => $this->input->post('mode',TRUE),
			'file' 	 => $_FILES['files_audio']
		];

		//echo count($data['file']['name']);
		//die();

		if ($data['mode'] == "da_audio_main") {
			$mkdir = content_dir().'DailyReading/Main/AudioFolder/'.$data['level'];
			$mkdir1 = content_dir().'DailyReading/Main/AudioFolder/'.$data['level'].'/'.$data['level']."U".$data['unit']."S".$data['story'].'/'.$data['speed'];
		} else if ($data['mode'] == "da_audio_extra") {
			$mkdir = content_dir().'DailyReading/Extra/AudioFolder/'.$data['level'];
			$mkdir1 = content_dir().'DailyReading/Extra/AudioFolder/'.$data['level'].'/'.$data['level']."U".$data['unit']."S".$data['story'].'/'.$data['speed'];
		} else if ($data['mode'] == "da_audio_extended") {
			$mkdir = content_dir().'DailyReading/Extended/AudioFolder/'.$data['level'];
			$mkdir1 = content_dir().'DailyReading/Extended/AudioFolder/'.$data['level'].'/'.$data['level']."U".$data['unit']."S".$data['story'].'/'.$data['speed'];
		}

		if (!file_exists($mkdir)) {
			mkdir($mkdir, 0755, true);
		}
		if (!file_exists($mkdir1)) {
			mkdir($mkdir1, 0755, true);
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

	public function daily_reading_data_audio_new()
	{
		$data = [
			'level' 	  => $this->input->post('level', TRUE),
			'unit' 		  => $this->input->post('unit', TRUE),
			'story' 	  => $this->input->post('story', TRUE),
			'file_name'   => $this->input->post('file_name', TRUE),
			'speed_level' => $this->input->post('speed', TRUE),
			'mode' 		  => $this->input->post('mode', TRUE)
		];

		$folder = $data['level']."U".$data['unit']."S".$data['story'];
		$dir = '';

		if ($data['mode'] == "da_audio_main") {
			$dir = content_dir()."DailyReading/Main/AudioFolder/".$data['level']."/".$folder."/".$data['speed_level']."/".$data['file_name'];
		} else if ($data['mode'] == "da_audio_extra") {
			$dir = content_dir()."DailyReading/Extra/AudioFolder/".$data['level']."/".$folder."/".$data['speed_level']."/".$data['file_name'];
		} else if ($data['mode'] == "da_audio_extended") {
			$dir = content_dir()."DailyReading/Extended/AudioFolder/".$data['level']."/".$folder."/".$data['speed_level']."/".$data['file_name'];
		}

		$result = [];
		if (file_exists ($dir)) {
			unlink ($dir);
			$result['ADD_INFO'] = "Berhasil Menghapus";
		} else {
			$result['ADD_INFO'] = "Gagal Menghapus";
		}
		echo json_encode($result);
	}

	public function daily_reading_clear_data_content_new()
	{
		$level 	= $this->input->post('level', TRUE);
		$unit 	= $this->input->post('unit', TRUE);
		$story 	= $this->input->post('story', TRUE);
		$mode   = $this->input->post('mode', TRUE);

		$folder = $level."U".$unit."S".$story;

		$audioDir = "";
		$storyDir = "";
		if ($mode == "da_main") {
			$audioDir = content_dir()."DailyReading/Main/AudioFolder/".$level."/".$folder."/";
			$storyDir = content_dir()."DailyReading/Main/StoryFolder/".$level."/".$folder.".txt";
			$data['audio'] = $audioDir;
			$data['story'] = $storyDir;
			$data['mode'] = "da_main";
		} else if ($mode == "da_extra") {
			$audioDir = content_dir()."DailyReading/Extra/AudioFolder/".$level."/".$folder."/";
			$storyDir = content_dir()."DailyReading/Extra/StoryFolder/".$level."/".$folder.".txt";
			$data['audio'] = $audioDir;
			$data['story'] = $storyDir;
			$data['mode'] = "da_extra";
		} else if ($mode == "da_extended") {
			$audioDir = content_dir()."DailyReading/Extended/AudioFolder/".$level."/".$folder."/";
			$storyDir = content_dir()."DailyReading/Extended/StoryFolder/".$level."/".$folder.".txt";
			$data['audio'] = $audioDir;
			$data['story'] = $storyDir;
			$data['mode'] = "da_extended";
		}
		if (file_exists($storyDir)) unlink($storyDir);
		$data['delete_dir'] = delete_directory($audioDir);
		// if (file_exists($storyDir)) unlink($storyDir);
		echo json_encode($result['data'] = "Berhasil Menghapus Data");
	}
}
