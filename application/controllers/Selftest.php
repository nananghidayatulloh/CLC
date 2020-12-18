<?php defined('BASEPATH') or exit('No direct script access allowed');

class Selftest extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model(['m_level', 'm_selftest']);
        session();
    }

    public function index()
    {
        redirect('selftest/selftest','refresh');
    }

    public function selftest()
    {
        $data = [
			'level'   	=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('selftest/list_selftest');
		$this->load->view('layout/footer');
	}
	
    public function selftest_subject()
    {
        $level    = $this->input->post('level', TRUE);
        $subject  = $this->m_selftest->getAllDataConfig($level)->row_array();
		$hasil[0]['subject_number'] = " - Pilih Subject - ";
		$hasil[0]['subject_title']  = "";
        for ($i=1; $i <= $subject['total_subject']; $i++) {
			$hasil[$i]['subject_number'] = $i;
			$hasil[$i]['subject_title'] = "";
			$getTitle = $this->db->select("name")->from("selftest_subject")->where(['level' => $level, 'subject' => $i])->get();
            if ($getTitle->num_rows() > 0) $hasil[$i]['subject_title'] = $getTitle->row_array()['name'];
        }
        echo json_encode($hasil);
	}

	public function selftest_content_config()
	{
		$level 		= $this->input->post('level', TRUE);
		$subject  	= $this->input->post('subject', TRUE) ;

		$get_content = $this->m_selftest->contentConfig($level, $subject);
		echo json_encode($get_content);
	}

	public function submit_setting_subject()
	{
		$cek_data = [
			'level'				=> $this->input->post('level'),
			'subject'			=> $this->input->post('subject')
		];
		
		$data = [
			'level'				=> $cek_data['level'],
			'subject'			=> $cek_data['subject'],
			'content_type'		=> $this->input->post('content_type'),
			'standart_goal'		=> $this->input->post('standart_goal'),
			'standart_kuning'	=> $this->input->post('standart_kuning'),
			'standart_merah'	=> $this->input->post('standart_merah'),
			'standart_biru'		=> $this->input->post('standart_biru'),
			'standart_hijau'	=> $this->input->post('standart_hijau'),
			'time_limit'		=> $this->input->post('time_limit'),
			'set_spontan'		=> $this->input->post('spontan'),
		];

		$result = $this->m_selftest->insertSettingSubject($cek_data, $data);
		if ($result > 0) {
			$callback['callback'] = "Simpan Setting Subject";
		} else {
			$callback['callback'] = "Gagal Setting Subject";
		}

		echo json_encode($callback);
	}

	public function selftest_subject_name()
	{
		$data = [
            'level' 	=> $this->input->post('level', TRUE),
            'subject'  	=> $this->input->post('subject', TRUE),
		];
		$result = $this->m_selftest->getNameSubject($data['level'], $data['subject']);
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
	}

	public function selftest_unit_name()
	{
		$data = [
            'level' 	=> $this->input->post('level', TRUE),
            'subject'  	=> $this->input->post('subject', TRUE),
            'unit'  	=> $this->input->post('unit', TRUE),
		];

		$result = $this->m_selftest->getNameUnit($data['level'], $data['subject'], $data['unit']);
        if ($result->num_rows() > 0 ) {
            $unit_name['name'] = $result->row_array()['name'];
        } else {
            $unit_name['name'] 	= "";
        }

        echo json_encode($unit_name);
	}

	public function selftest_submit_subject()
	{
		$data = [
            'level' 	=> $this->input->post('level', TRUE),
            'subject' 	=> $this->input->post('subject', TRUE),
            'name'  	=> $this->input->post('subject_name', TRUE),
		];

		$hasil['name'] = [];

		$result = $this->m_selftest->getNameSubject($data['level'], $data['subject']);
		if ($result->num_rows() == 0) {
			$result_insert = $this->m_selftest->insertNameSubject($data);
			if ($result_insert == "1") {
				$hasil['name'] = "Berhasil Melakukan Perubahan Nama Subject";
			} else {
				$hasil['name'] = "Perubahan Nama Subject Tidak Berhasil";
			}
		} else {
			$data_update = [
				'level'		=> $data['level'],
				'subject'	=> $data['subject'],
				'name'		=> $data['name']
			];
			$result_update = $this->m_selftest->updateNameSubject($data['level'], $data['subject'], $data_update);
			if ($result_update == "1") {
				$hasil['name'] = "Berhasil Melakukan Perubahan Nama Subject";
			} else {
				$hasil['name'] = "Perubahan Nama Subject Tidak Berhasil";
			}
		}
		echo json_encode($hasil);
	}

	public function selftest_submit_unit()
	{
		$data = [
            'level' 	=> $this->input->post('level', TRUE),
            'subject' 	=> $this->input->post('subject', TRUE),
            'unit' 		=> $this->input->post('unit', TRUE),
            'name'  	=> $this->input->post('unit_name', TRUE),
		];

		$hasil['name'] = [];

		$result = $this->m_selftest->getNameUnit($data['level'], $data['subject'], $data['unit']);
		if ($result->num_rows() == 0) {
			$result_insert = $this->m_selftest->insertNameUnit($data);
			if ($result_insert == "1") {
				$hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
			} else {
				$hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
			}
		} else {
			$data_update = [
				'level'		=> $data['level'],
				'subject'	=> $data['subject'],
				'unit'		=> $data['unit'],
				'name'		=> $data['name']
			];
			$result_update = $this->m_selftest->updateNameUnit($data['level'], $data['subject'], $data['unit'], $data_update);
			if ($result_update == "1") {
				$hasil['name'] = "Berhasil Melakukan Perubahan Nama Unit";
			} else {
				$hasil['name'] = "Perubahan Nama Unit Tidak Berhasil";
			}
		}
		echo json_encode($hasil);
	}

    public function upload_file_selftest()
	{
		$data = [
			'level'  		 => $this->input->post('level', TRUE),
			'subject'		 => $this->input->post('subject', TRUE),
			'unit'		 	 => $this->input->post('unit', TRUE),
			'content_type'   => $this->input->post('content_type', TRUE),
			'file' 	 		 => $_FILES['files']
		];

		$nama_file = 'S'.$data['subject'].'U'.$data['unit'].'.txt';
		$dir = "";

		if ($data['content_type'] == 1) {
			$dir = content_dir()."SelfTest/Meaning/".$data['level']."/Subject".$data['subject'];
		} else if($data['content_type'] == 2) {
			$dir = content_dir()."SelfTest/Keyword/".$data['level']."/Subject".$data['subject'];
		} else {
			$dir = content_dir()."SelfTest/Arranging/".$data['level']."/Subject".$data['subject'];
		}

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

    public function selftest_download_file()
	{
		$this->load->helper('download');
		$level 			= $this->input->get('level', TRUE);
		$subject 		= $this->input->get('subject', TRUE);
		$content_type 	= $this->input->get('content_type', TRUE);
		$file_name		= $this->input->get('file_name', TRUE);

		$file = "";
		if ($content_type == 1) {
			$file = content_dir()."SelfTest/Meaning/".$level."/Subject".$subject."/".$file_name;
		} else if ($content_type == 2) {
			$file = content_dir()."SelfTest/Keyword/".$level."/Subject".$subject."/".$file_name;
		} else {
			$file = content_dir()."SelfTest/Arranging/".$level."/Subject".$subject."/".$file_name;
		}
		force_download($file, NULL);
    }
    
    public function selftest_delete_file()
	{
		$data = [
			'file_name' 	=> $this->input->post('file_name', TRUE),
			'level' 		=> $this->input->post('level', TRUE),
			'subject'		=> $this->input->post('subject', TRUE),
			'content_type'	=> $this->input->post('content_type', TRUE)
		];
		$result = [];
		$fileLocation = "";
		if ($data['file_name'] != "") {
			if ($data['content_type'] == 1) {
				$fileLocation = content_dir()."SelfTest/Meaning/".$data['level']."/Subject".$data['subject']."/".$data['file_name'];
			} else if ($data['content_type'] == 2) {
				$fileLocation = content_dir()."SelfTest/Keyword/".$data['level']."/Subject".$data['subject']."/".$data['file_name'];
			} else {
				$fileLocation = content_dir()."SelfTest/Arranging/".$data['level']."/Subject".$data['subject']."/".$data['file_name'];
			}
			unlink($fileLocation);
			$result['ADD_INFO'] = "Berhasil Di hapus ...";
		} else {
            $result['ADD_INFO'] = "Data tidak lengkap!";
        }
		echo json_encode($result);
	}

	public function selftest_clear_data_content()
	{
		$level = $this->input->post('level', TRUE);
		$unit  = $this->input->post('unit', TRUE);
		$mode  = $this->input->post('mode', TRUE);

		$dir = "";
		if ($mode == "matching_quiz") {
			$dir = content_dir()."SelfTest/MatchingQuiz/".$level."/Unit".$unit;
		} elseif ($mode == "arrange_quiz") {
			$dir = content_dir()."SelfTest/ArrangeQuiz/".$level."/Unit".$unit;
		}

		delete_directory($dir);
		echo json_encode($data['result'] = "Berhasil Menghapus Data");
	}

	private function sistem_content($level, $subject, $unit, $content_type)
    {
			$nama_file = "S".$subject."U".$unit.".txt";
            // $get_user_agent = $this->db->get_where('user_agent')
            if ($content_type == 1) {
                $folder = "Meaning";
            } else if($content_type == 2) {
                $folder = "Keyword";
            } else {
                $folder = "Arranging";
            }

            $cek_directory = content_dir()."SelfTest/".$folder."/".$level."/Subject".$subject."/".$nama_file;
            $test = [];
            if (file_exists($cek_directory)) {
                $directory = content_url()."SelfTest/".$folder."/".$level."/Subject".$subject."/".$nama_file;
                    $fn = fopen($directory,"r");
                        $kamus = array();        
                        $pageNumber = -1;
                        $arrayPertanyaan = array();
                        $arrayJawaban = array();
                        $list_pertanyaan = [];
                        $idx = 0;
                        
                        $list_kamus       = [];
                        $random_arranging = [];
                        $array_pinyin     = [];
                        $array_inggris    = [];
                        $array_inggris2    = [];
                        $pinyin_test = "0";
                        $pinyin_result = "0";                        
                        
                        while(!feof($fn)) {
                            $result = fgets($fn);
                            if (strpos(trim($result), 'pinyin_test') !== false) {
                                $pinyin_test =  explode(":", trim($result))[1];                                
                            }
                            
                            if (strpos(trim($result), 'pinyin_result') !== false) {
                                $pinyin_result =  explode(":", trim($result))[1];                                
                            }

                            if (strpos(trim($result), '%') !== false) {
                                $pageNumber++;
                                $idx = 0;
                            } else {
                                if ($pageNumber > -1) {
                                    if ($folder == "Meaning") {
                                        $qna = explode(":", trim($result));

                                        $exp_spasi = explode(" ", trim($qna[0]));
                                        
                                        $index_pertanyaan   = "";
                                        $combine_pertanyaan = "";
                                        $list_pinyin        = "";

                                        if(count($qna) > 1 ) {
                                            foreach ($exp_spasi as $spasi) {
                                                if (strpos($spasi, '(') !== false) {
                                                    $exp_buka_kurung    = explode("(", $spasi);
                                                    $index_pertanyaan   = str_replace(")", "", $exp_buka_kurung[0]);
                                                    $combine_pertanyaan.= str_replace(")", "", $exp_buka_kurung[0])." ";
                                                    if(count($exp_buka_kurung) > 1) {
                                                        $list_pinyin        = str_replace(")", " ", $exp_buka_kurung[1]);
                                                        $array_pinyin[$index_pertanyaan] = rtrim($list_pinyin, " ");
                                                    }
                                                } else {
                                                    $combine_pertanyaan .= $spasi;
                                                        if (!isset($array_pinyin[$spasi])) {
                                                            $array_pinyin[$spasi] = "";
                                                        }
                                                }
                                            }
    
                                            $combine_jawaban = "";
    
                                            $kamus[$pageNumber][rtrim($combine_pertanyaan, " ")] = trim($qna[1]);
                                                    $list_pertanyaan[$pageNumber][$idx]  = rtrim($combine_pertanyaan, " ");
                                                        $arrayPertanyaan[$pageNumber][$idx] = rtrim($combine_pertanyaan, " ");
    
                                                shuffle($arrayPertanyaan[$pageNumber]);
                                                    $arrayJawaban[$pageNumber][$idx] = trim($qna[1]);
                                                        shuffle($arrayJawaban[$pageNumber]);
                                            $idx++;
                                        }
                                    } else if($folder == "Keyword") {
                                    	//echo "[".$result."] len:".strlen($result)."<br>";
                                        $qna = explode(":", trim($result));
                                        if (count($qna) > 1) {
	                                        $exp_spasi = explode(" ", trim(explode("-", trim($qna[0]))[0]));

	                                        $index_pertanyaan   = "";
	                                        $combine_pertanyaan = "";
	                                        $list_pinyin        = "";

	                                        foreach ($exp_spasi as $spasi) {
                                                if (strpos($spasi, '(') !== false) {
                                                    $exp_buka_kurung    = explode("(", $spasi);
                                                    $index_pertanyaan   = str_replace(")", "", $exp_buka_kurung[0]);
                                                    $combine_pertanyaan .= str_replace(")", "", $exp_buka_kurung[0])." ";
                                                    $list_pinyin        = str_replace(")", " ", $exp_buka_kurung[1]);
                                                    $array_pinyin[$index_pertanyaan] = rtrim($list_pinyin, " ");
                                                } else {                                                                                              
                                                    $combine_pertanyaan .= $spasi;
                                                    if (!isset($array_pinyin[$spasi])) {
                                                        $array_pinyin[$spasi] = "";
                                                    }
                                                }
                                            }
                                            

	                                        $exp_inggris0   = explode('-', trim($qna[0]));
	                                        $combine_jawaban0 = "";
	                                        
	                                        $exp_next_spasi0 = explode(" ", trim($exp_inggris0[0]));
	                                            foreach ($exp_next_spasi0 as $next_pinyin0) {
                                                    if (strpos($next_pinyin0, '(') !== false) {
                                                        $exp_kurung0              = explode("(", $next_pinyin0);
                                                        $index_next_pertanyaan0   = str_replace(")", "", $exp_kurung0[0]);
                                                        $combine_jawaban0         .= str_replace(")", "", $exp_kurung0[0])." ";
                                                        $list_next_pinyin0        = str_replace(")", " ", $exp_kurung0[1]);
                                                        $array_pinyin[$index_next_pertanyaan0] = rtrim($list_next_pinyin0, " ");
                                                    } else {
                                                        $combine_jawaban0 .= $next_pinyin0;
                                                        if (!isset($array_pinyin[$next_pinyin0])) {
                                                            $array_pinyin[$next_pinyin0] = "";
                                                        }
                                                    }
	                                            }

	                                        $exp_inggris    = explode('-', trim($qna[1]));
	                                        
	                                        $combine_jawaban = "";
	                                        $exp_next_spasi = explode(" ", trim($exp_inggris[0]));
	                                            foreach ($exp_next_spasi as $next_pinyin) {
                                                    if (strpos($next_pinyin, '(') !== false) {
                                                        $exp_kurung              = explode("(", $next_pinyin);
                                                        $index_next_pertanyaan   = str_replace(")", "", $exp_kurung[0]);
                                                        $combine_jawaban         .= str_replace(")", "", $exp_kurung[0])." ";
                                                        $list_next_pinyin        = str_replace(")", " ", $exp_kurung[1]);
                                                        $array_pinyin[$index_next_pertanyaan] = rtrim($list_next_pinyin, " ");
                                                    } else {
                                                        $combine_jawaban .= $next_pinyin;
                                                        if (!isset($array_pinyin[$next_pinyin])) {
                                                            $array_pinyin[$next_pinyin] = "";
                                                        }
                                                    }
	                                            }
	                                        
	                                        $kamus[$pageNumber][rtrim($combine_pertanyaan, " ")] = rtrim($combine_jawaban, " ");

	                                            $array_inggris2[rtrim($combine_pertanyaan, " ")] = $exp_inggris[1];
	                                            $array_inggris[rtrim($combine_pertanyaan, " ")] = $exp_inggris0[1];
	                                                $list_pertanyaan[$pageNumber][$idx]  = rtrim($combine_pertanyaan, " ");
	                                                    $arrayPertanyaan[$pageNumber][$idx] = rtrim($combine_pertanyaan, " ");

	                                            shuffle($arrayPertanyaan[$pageNumber]);
	                                                $arrayJawaban[$pageNumber][$idx] = trim($combine_jawaban);
	                                                    shuffle($arrayJawaban[$pageNumber]);
	                                        $idx++;
	                                    }
                                    } else if($folder == "Arranging") {
                                        $list_kamus[$pageNumber][$idx] = "";
                                        $arrayPertanyaan[$pageNumber][$idx] = "";
                                        
                                            $explode_arranging = explode(" ", $result);
                                            $j = 0;
                                            foreach ($explode_arranging as $arranging) {
                                                $index_pertanyaan   = "";
                                                $list_pinyin        = "";

                                                    $arrayPertanyaan[$pageNumber][$idx][$j] = "";
                                                    $exp_tutup_kurung    = explode(")", trim($arranging));

                                                    for ($i=0; $i < count($exp_tutup_kurung) - 1 ; $i++) { 
                                                        $exp_buka_kurung = explode("(", $exp_tutup_kurung[$i]);
                                                        $index_pertanyaan   .= $exp_buka_kurung[0];
                                                        $list_pinyin        .= $exp_buka_kurung[1]." ";
                                                            $array_pinyin[$index_pertanyaan] = rtrim($list_pinyin, " ");
                                                            $list_kamus[$pageNumber][$idx] .= trim($exp_buka_kurung[0]);
                                                            $arrayPertanyaan[$pageNumber][$idx][$j] .= trim($exp_buka_kurung[0]);
                                                            if ($i >= count($exp_tutup_kurung)- 2 && $j < count ($explode_arranging) - 1) $list_kamus[$pageNumber][$idx] .= " ";
                                                            // if ($i >= count($exp_tutup_kurung)- 2 && $j < count ($explode_arranging) - 1) $arrayPertanyaan[$pageNumber][$idx] .= " ";
                                                        }
                                                        $j++;
                                                    }
                                                $random_arranging[$pageNumber][$idx] = $idx;
                                        shuffle($random_arranging[$pageNumber]);

                                        $idx++;
                                    }
                                }
                            }                                     
                        }

                        if ($folder == 'Arranging') {
                            for ($l=0; $l < count($random_arranging); $l++) { 
                                for ($m=0; $m < count($random_arranging[$l]); $m++) { 
                                    $kamus[$l][$m] = $list_kamus[$l][$random_arranging[$l][$m]];
                                }
                            }
                        }

                        $dataQuiz = array (
                            "kamus"             => $kamus,            
                            "list_pertanyaan"   => $arrayPertanyaan,
                            "list_jawaban"      => $arrayJawaban,
                            "random_arranging"  => $random_arranging,
                            "array_pinyin"      => $array_pinyin,
                            "array_inggris"     => $array_inggris,
                            "array_inggris2"    => $array_inggris2,
                            "pinyin_test"       => $pinyin_test,
                            "pinyin_result"     => $pinyin_result,
                        );
                    fclose($fn);
                    // echo json_encode($dataQuiz);
                    // die();
                return $dataQuiz;
            } else {
                $this->load->view('content_siswa/404');
            }
    }

	public function selftest_print()
	{
		$this->load->helper(array('dompdf'));
		$this->form_validation->set_rules('content_type', 'Content Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('session', 'Session', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('content_siswa/404');
            } else {
                $content_type = $this->input->post('content_type', TRUE);
                $session      = $this->input->post('session', TRUE);
    
                if ($content_type == 1) {
                    $data_test = $this->m_selftest->getDataTestMeaning($session)->row_array();
                    $content   = "Meaning";
                    $content_table = 'content_siswa/table_hasil/table_meaning1';
                } else if($content_type == 2) {
                    $data_test = $this->m_selftest->getDataTestKeyword($session)->row_array();
                    $content   = "Keyword";
                    $content_table = 'content_siswa/table_hasil/table_keyword';
                } else {
                    $data_test = $this->m_selftest->getDataTestArranging($session)->row_array();
                    $content   = "Arranging";
                    $content_table = 'content_siswa/table_hasil/table_arranging';
				}
				
				$result_sistem_content = $this->sistem_content($data_test['level'], $data_test['subject'], $data_test['unit'], $content_type);
                $pinyin       = $result_sistem_content['array_pinyin'];
                $inggris      = $result_sistem_content['array_inggris'];
                $inggris2     = $result_sistem_content['array_inggris2'];
                $pinyin_result= $result_sistem_content['pinyin_result'];
    
                $get_content_config = $this->m_selftest->contentConfig($data_test['level'], $data_test['subject']);
                if($data_test['completion'] >= $get_content_config['standart_kuning']) {
                    $color = '#fff46e';
                } else if($data_test['completion'] >= $get_content_config['standart_hijau']){
                    $color = '#c3ff7d';
                } else if($data_test['completion'] >= $get_content_config['standart_biru']) {
                    $color = '#7bd0f7';
                } else {
                    $color = '#ff6e6e';
                }
    
                $data = [
                    'content_type'  => $content,
                    'session'       => $session,
                    'color'         => $color,
                    'content_table' => $content_table,
					'data'          => $data_test,
					'list_pinyin'   => $pinyin,
                    'list_inggris'  => $inggris,
                    'list_inggris2' => $inggris2,
                    'pinyin_result' => $pinyin_result,
				];
				
                $session_hasil_test['from']       = 'log_selftest';
        		$this->session->set_userdata($session_hasil_test);
				$html = $this->load->view('content_siswa/hasil_test2', $data, true);
      			pdf_create((string)$html, 'filename');
			}
	}

	public function selftest_jumlah_unit()
	{
		$data = [
            'level' 		=> $this->input->post('level', TRUE),
            'subject'  		=> $this->input->post('subject', TRUE),
            'content_type'  => $this->input->post('content_type', TRUE),
		];

		$hasil = [];

		$result = $this->m_level->data_selftest_quiz($data['level']);

        if ($result->num_rows() > 0 ) {
			$total_unit = $result->row_array()['total_unit'];
			for ($i=1; $i <= $total_unit; $i++) { 
				$unit = $i;

				$nama_file = 'S'.$data['subject'].'U'.$unit.'.txt';

				$dir = "";
				if($data['content_type'] == 1) {
					$dir = content_dir()."SelfTest/Meaning/".$data['level']."/Subject".$data['subject']."/".$nama_file;
				} else if($data['content_type'] == 2) {
					$dir = content_dir()."SelfTest/Keyword/".$data['level']."/Subject".$data['subject']."/".$nama_file;
				} else {
					$dir = content_dir()."SelfTest/Arranging/".$data['level']."/Subject".$data['subject']."/".$nama_file;
				}

				$result = $this->m_selftest->getNameUnit($data['level'], $data['subject'], $unit);
				if ($result->num_rows() > 0 ) {
					$unit_name = $result->row_array()['name'];
					$hasil[$unit]['unit_name'] = $unit_name;
				} else {
					$hasil[$unit]['unit_name'] = "";
				}
				if (file_exists ($dir)) {
					$hasil[$unit]['file_name'] = $nama_file;
				} else {
					$hasil[$unit]['file_name'] = 'No File';
				}
			}
        }

        echo json_encode($hasil);
	}

	public function selftest_file_content()
    {
        $data = [
            'level'  		 => $this->input->post('level', TRUE),
			'subject'   	 => $this->input->post('subject', TRUE),
			'unit'			 => $this->input->post('unit', TRUE),
            'content_type'   => $this->input->post('content_type', TRUE)
		];

		$nama_file = 'S'.$data['subject'].'U'.$data['unit'].'.txt';

		$dir = "";
		if($data['content_type'] == 1) {
			$dir = content_dir()."SelfTest/Meaning/".$data['level']."/Subject".$data['subject']."/".$nama_file;
		} else if($data['content_type'] == 2) {
			$dir = content_dir()."SelfTest/Keyword/".$data['level']."/Subject".$data['subject']."/".$nama_file;
		} else {
			$dir = content_dir()."SelfTest/Arranging/".$data['level']."/Subject".$data['subject']."/".$nama_file;
		}
		
		$hasil['data'] = [];

		if (file_exists ($dir)) {
			// $hasil['name'] = [];
			
			// $result = $this->m_selftest->getNameUnit($data['level'], $data['subject'], $data['unit']);
			// if ($result->num_rows() > 0 ) {
			// 	$unit_name = $result->row_array()['name'];
			// } else {
			// 	$unit_name = "";
			// }
			
			array_push($hasil['data'], $nama_file);
			// array_push($hasil['name'], $unit_name);
		} else {
			$hasil['data'] = 'No File';
		}
		echo json_encode ($hasil);
    }
}