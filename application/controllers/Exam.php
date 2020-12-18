<?php defined('BASEPATH') or exit('No direct script access allowed');

class Exam extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_level', 'm_unit']);
        session();
    }
    
    public function index()
    {
        redirect('exam/exam','refresh');
    }

    public function exam()
	{
		$data['level'] = $this->m_level->datalevel()->result_array();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('exam/list_exam');
		$this->load->view('layout/footer');
    }
    
    public function exam_unit()
	{
        $level = $this->input->post('level', TRUE);
        $mode = 'exam_unit';
        $unit = $this->m_level->unit_level($level, $mode)->row_array();
        $hasil[0] = " - Pilih Unit -";
        for ($i=1; $i <= $unit['total_unit']; $i++) { 
            $hasil[$i] = $i;
        }
        echo json_encode($hasil);
    }

    public function exam_unit2()
    {
        $level = $this->input->post('level', TRUE);
        $mode = 'exam_unit';
        $unit = $this->m_level->unit_level($level, $mode)->row_array();
        $hasil[0]['unit_number'] = " - Pilih Unit -";
        $hasil[0]['unit_title'] = "";
        $hasil[0]['story_uploaded'] = "";
        for ($i=1; $i <= $unit['total_unit']; $i++) { 
            $hasil[$i]['unit_number'] = $i;
            $hasil[$i]['unit_title'] = "";
            $getTitle = $this->db->query("SELECT name FROM exam_name WHERE level = '$level' AND unit = '$i'")->result_array();
            if (count($getTitle) > 0) $hasil[$i]['unit_title'] = $getTitle[0]['name'];
            $hasil[$i]['story_uploaded'] = "";
            if (file_exists('../Content/Exam/'.$level.'/'.$level.'U'.$i.'S1.txt')) {
                $hasil[$i]['story_uploaded'].="(1)";
            }
            if (file_exists('../Content/Exam/'.$level.'/'.$level.'U'.$i.'S2.txt')) {
                $hasil[$i]['story_uploaded'].="(2)";
            }
            if (file_exists('../Content/Exam/'.$level.'/'.$level.'U'.$i.'S3.txt')) {
                $hasil[$i]['story_uploaded'].="(3)";
            }
        }
        echo json_encode($hasil);
    }

    public function exam_story () {
        $level = $this->input->post('level', TRUE);
        $unit = $this->input->post('unit', TRUE);
        $hasil[0]['story_number'] = "- Pilih Story -";
        $hasil[0]['story_title'] = "";
        $hasil[0]['story_uploaded'] = "";

        for ($i=1; $i <= 3; $i++) { 
            $hasil[$i]['story_number'] = $i;
            $hasil[$i]['story_title'] = "";
            $getTitle = $this->db->query("SELECT name FROM exam_story_name WHERE  level = '$level' AND unit = '$unit' AND story = '$i'")->result_array();
            if (count($getTitle) > 0) $hasil[$i]['story_title'] = $getTitle[0]['name'];
            $hasil[$i]['story_uploaded'] = "";
            if (file_exists('../Content/Exam/'.$level.'/'.$level.'U'.$unit.'S'.$i.'.txt')) {
                $hasil[$i]['story_uploaded'].="✓";
            }
        }

        echo json_encode ($hasil);
    }
    
    public function exam_unit_name()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE)
        ];

        $result = $this->m_unit->unitExamName($data['level'], $data['unit']);
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
    }

    public function exam_story_name()
    {
        $data = [
            'level'  => $this->input->post('level', TRUE),
            'unit'   => $this->input->post('unit', TRUE),
            'story'  => $this->input->post('story', TRUE)
        ];

        $result = $this->m_unit->ExamStoryName($data['level'], $data['unit'], $data['story']);
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
    }
    
    public function exam_update_unit()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE),
            'name'  => $this->input->post('unit_name_baru', TRUE),
        ];

        // echo json_encode($data);
        $result = $this->m_unit->unitExamName($data['level'], $data['unit']);
        $hasil['name'] = [];
			if ($result->num_rows() == 0) {
				$result_insert = $this->m_unit->insert_unit_name_exam($data);
				if ($result_insert == "1") {
                    $hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
				} else {
                    $hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
				}
			} else {
                $result_update = $this->m_unit->update_unit_name_exam($data);
				if ($result_update == "1") {
					$hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
				} else {
					$hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
				}
            }
            
            echo json_encode($hasil);
    }

    public function exam_update_story()
    {
        $data = [
            'level' => $this->input->post('level', TRUE),
            'unit'  => $this->input->post('unit', TRUE),
            'story' => $this->input->post('story', TRUE),
            'name'  => $this->input->post('story_name_baru', TRUE),
        ];

        // echo json_encode($data);
        $result = $this->m_unit->ExamStoryName($data['level'], $data['unit'], $data['story']);
        $hasil['name'] = [];
			if ($result->num_rows() == 0) {
				$result_insert = $this->m_unit->insert_exam_story($data);
				if ($result_insert == "1") {
                    $hasil['name'] = "Berhasil Melakukan Perubahan Nama Story";
				} else {
                    $hasil['name'] = "Perubahan Nama Story Tidak Berhasil";
				}
			} else {
                $result_update = $this->m_unit->update_exam_story($data);
				if ($result_update == "1") {
					$hasil['name'] = "Berhasil Melakukan Perubahan Nama Story";
				} else {
					$hasil['name'] = "Perubahan Nama Story Tidak Berhasil";
				}
            }
            
            echo json_encode($hasil);
    }

    public function exam_list_file()
    {
        $level 	= $this->input->post('level', TRUE);
		$unit 	= $this->input->post('unit', TRUE);
		$story 	= $this->input->post('story', TRUE);

		$hasil = array();
		$file = $level."U".$unit."S".$story.".txt";
		$dir = content_dir()."Exam/".$level."/".$file;
		
		if (file_exists ($dir)) {
			array_push($hasil,$file);
		}
		$hasil['data'] = json_encode($hasil);
		echo json_encode ($hasil);
    }

    public function exam_download_file()
    {
        $this->load->helper('download');

        $level 	= $this->input->get('level', TRUE);
		$unit 	= $this->input->get('unit', TRUE);
		$story 	= $this->input->get('story', TRUE);

		$file = content_dir()."Exam/".$level."/".$level."U".$unit."S".$story.".txt";
		force_download($file, NULL);
    }

    public function upload_file_exam()
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
			$mkdir = content_dir().'Exam/'.$data['level'];
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
    
    public function exam_delete_file()
    {
        $file_name 	= $this->input->post('file_name', TRUE);
        $level 		= $this->input->post('level', TRUE);
        $result     = [];
        if ($file_name != "") {
			$fileLocation = content_dir()."Exam/".$level."/".$file_name;
			unlink($fileLocation);
			$result['data'] = "Berhasil Menghapus";
			} else {
			$result['data'] = "Data tidak lengkap!";
            }
        
        echo json_encode($result);
    }

    public function exam_clear_content()
    {
        $level  = $this->input->post('level', TRUE);
		$unit   = $this->input->post('unit', TRUE);
        $story  = $this->input->post('story', TRUE);
        
        $examDir = content_dir()."Exam/".$level."/";
        delete_directory($examDir);

        echo json_encode($result['data'] = "Berhasil Menghapus Data");
    }
}