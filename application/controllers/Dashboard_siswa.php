<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_siswa extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model(['m_user_agent_mngmnt', 'm_siswa', 'm_level', 'm_selftest']);
        session_siswa();
    }

    public function index()
    {   
        if ($this->agent->is_browser()){
			$agent = $this->agent->browser().' '.$this->agent->version();
		} elseif ($this->agent->is_mobile()){
			$agent = $this->agent->mobile();
		} else {
			$agent = 'Data user gagal di dapatkan';
        }

        $ip = $this->input->ip_address();
        $get_location = file_get_contents('http://ip-api.com/json/'.$ip);
        $data_loc = json_decode($get_location, TRUE);

        
        $user_agent['sistem_operasi'] = $this->agent->platform();
        $user_agent['browser']        = $agent;
        $user_agent['ip_address']     = $ip;
        $user_agent['kota']           = $data_loc['city'];
        $user_agent['timezone']       = $data_loc['timezone'];
        $user_agent['datetime']       = date('l Y-m-d H:i:s');
        
        
        $id_siswa   = $this->session->userdata('id_siswa');
        $result     = $this->m_user_agent_mngmnt->insert_user_agent($user_agent, $id_siswa);

        if (!empty($this->session->userdata('kamus'))) {
            redirect('dashboard_siswa/submit_content');
        } else {
            $data = [
                'title'               => 'Web Test',
                'content'             => 'content_siswa/index',
                'user_agent'          => $user_agent,
            ];

            $this->load->view('layout/siswa/MainView', $data);
        }
    }

    public function select_subject()
    {   
        $this->form_validation->set_rules('level', 'Level', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            redirect('dashboard_siswa');
        } else {
            $level      = $this->input->post('level', TRUE);
            $get_config = $this->m_selftest->getAllDataConfig($level)->row_array();
    
            if ($get_config == NULL) {
                $data = [
                    'header_content'      => 'content_siswa/header_content',
                    'content'             => 'content_siswa/persiapan_content',
                ];
            } else {
                $exp_subject_active = explode('-', $get_config['subject_active']);
        
                $selftest_subject = [];
                for ($i=0; $i < count($exp_subject_active) ; $i++) {
                    $selftest_subject_name = $this->m_selftest->getNameSubject($level, $exp_subject_active[$i])->row_array();
                    if ($selftest_subject_name['name'] != NULL) {
                        $selftest_subject[$i]['name'] = $selftest_subject_name['name'];
                        $selftest_subject[$i]['subject'] = $exp_subject_active[$i];
                    } else {
                        $selftest_subject[$i]['name'] = "Subject ".$exp_subject_active[$i];
                        $selftest_subject[$i]['subject'] = $exp_subject_active[$i];
                    }
                }
        
                $data = [
                    'title'          => 'Self Test',
                    'content'        => 'content_siswa/select_subject',
                    'subject_active' => $selftest_subject,
                ];

            }
            $this->load->view('layout/siswa/MainView', $data);
        }

    }

    public function select_unit()
    {
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            redirect('dashboard_siswa/submit_content');
        } else {
            $subject  = $this->input->post('subject', TRUE);
            $id_siswa = decrypt_url($this->session->userdata('id_siswa'));

            $selftest_unit = [];
            $unlock_unit = true;
            $unlock_test = true;

            $data = [
                'level'         => $this->session->userdata('level'),
                'subject'       => $subject,
            ];

            $get_config = $this->m_selftest->getAllDataConfig($data['level'])->row_array();
    
            $exp_unit_active = explode('-', $get_config['unit_active']);

            for ($i=0; $i < count($exp_unit_active) ; $i++) {
                // $selftest_unit_name = $this->m_selftest->getNameUnit($data['level'], $data['subject'], $exp_unit_active[$i])->row_array();
                $nama_file = "S".$data['subject']."U".$exp_unit_active[$i].".txt";
                $get_name = $this->m_selftest->getNameSubject($data['level'], $data['subject'])->row_array();
                $get_unit_name = $this->m_selftest->getNameUnit($data['level'], $data['subject'], $exp_unit_active[$i])->row_array();
                $get_content_type = $this->m_selftest->getContentConfig($data['level'], $data['subject'])->row_array();

                if ($get_content_type['content_type'] == 1) {
                    $content_type   = "Meaning";
                } else if($get_content_type['content_type'] == 2) {
                    $content_type   = "Keyword";
                } else {
                    $content_type   = "Arranging";
                }
                
                $directory = content_dir()."SelfTest/".$content_type."/".$data['level']."/Subject".$subject."/".$nama_file;

                if (file_exists($directory)) {

                    $selftest_unit[$i]['content'] = 1; 
                    if ($unlock_test == true) {
                        $selftest_unit[$i]['unlock_test'] = 1; 
                    } else {
                        $selftest_unit[$i]['unlock_test'] = 0; 
                    }
                    
                    if ($get_content_type['content_type'] == 1) {
                        $get_data_test      = $this->m_selftest->getLogMeaningTest($data['level'], $id_siswa, $subject, $exp_unit_active[$i])
                        ->row_array();
                        $get_data_spontan   = $this->m_selftest->getLogMeaningSpontan($data['level'], $id_siswa, $subject, $exp_unit_active[$i])->row_array();
                        if ($get_data_test != NULL) {
                            if ($get_data_test['completion'] >= $get_content_type['standart_goal']) {
                                $unlock_test = true;
                            } else {
                                $unlock_test = ($get_data_spontan != NULL) ? (($get_data_spontan['completion'] == '100') ? true : false)  : false ;
                            }
                        } else {
                            $unlock_test = ($get_data_spontan != NULL) ? (($get_data_spontan['completion'] == '100') ? true : false)  : false ;
                        }
                    }
                    
                } else {
                    $selftest_unit[$i]['content'] = 0;
                    $selftest_unit[$i]['unlock_test'] = 0;
                }
                
                $selftest_unit[$i]['subject']   = $data['subject'];
                $selftest_unit[$i]['name']      = ($get_unit_name['name'] == '') ? "Unit ".$exp_unit_active[$i] : $get_unit_name['name'];
                $selftest_unit[$i]['unit']      = $exp_unit_active[$i];
                }

            $parse = [
                'subject'        => $subject,
                'title'          => $get_name['name'],
                'content_type'   => $get_content_type['content_type'],
                'content'        => 'content_siswa/select_unit',
                'unit_active'    => $selftest_unit,
            ];

            $this->load->view('layout/siswa/MainView', $parse);
        }
        
        
    }

    public function get_custom()
    {
        $subject  = $this->input->post('subject');
        $id_siswa = decrypt_url($this->input->post('id_siswa'));

        $active_subject = [];
        $get_custom     = getCustomeActiveSubject($id_siswa)->row_array()['custom_active_subject'];

        if ($get_custom != null) {
            $exp_spasi      = explode('_', $get_custom);
    
            foreach($exp_spasi as $spasi) {
                $exp_titik_dua = explode(':', $spasi);
                $active_subject['Subject'.$exp_titik_dua[0]] = [];
                
                $exp_persen = explode('%', $exp_titik_dua[1]);
                $active_subject['Subject'.$exp_titik_dua[0]]['mulai_dari'] = $exp_persen[0];
                $active_subject['Subject'.$exp_titik_dua[0]]['unit_aktif'] = [];
                
                $exp_strip = explode('-', $exp_persen[1]);

                $no = 0;
                foreach ($exp_strip as $strip) {
                    $active_subject['Subject'.$exp_titik_dua[0]]['unit_aktif'][$no] = $strip;
                    $no++;
                }
            }
            if (array_key_exists('Subject'.$subject, $active_subject)) {
                echo json_encode($active_subject['Subject'.$subject]);
            } else {
                $return = [];
                echo json_encode($return);
            }
        } else {
            echo json_encode($active_subject);
        }
            
    }

    public function selftest_select_mode()
    {
        $level      = $this->session->userdata('level');
        $id_siswa   = decrypt_url($this->session->userdata('id_siswa'));

        if (!empty($this->session->userdata('subject'))) {
            $subject = $this->session->userdata('subject');
        } else {
            $subject = $this->input->post('subject');
        
        }

        if (!empty($this->session->userdata('unit'))) {
            $unit = $this->session->userdata('unit');
        } else {
            $unit = $this->input->post('unit');
        }

        if (!empty($this->session->userdata('content_mode'))) {
            $content_mode = $this->session->userdata('content_mode');
        } else {
            $content_mode = $this->input->post('content_mode');
        }
        
        $mode = $this->input->post('mode');

        if ($content_mode == 1) {
            $get_data_log  = $this->m_selftest->getLogMeaning($level, $id_siswa, $subject, $unit, $mode)->row_array();
        } else if($content_mode == 2) {
            $get_data_log  = $this->m_selftest->getLogKeyword($level, $id_siswa, $subject, $unit, $mode)->row_array();
        } else {
            $get_data_log  = $this->m_selftest->getLogArranging($level, $id_siswa, $subject, $unit, $mode)->row_array();
        }

        if ($get_data_log == NULL) {
            $jumlah_benar   = "-";
            $jumlah_soal    = "-";
            $completion     = "-";
            $date           = "-";
            $jam            = "-";
            $try            = "-";
        } else {
            $jumlah_benar   = $get_data_log['jumlah_benar'];
            $jumlah_soal    = $get_data_log['jumlah_benar']+$get_data_log['jumlah_salah'];
            $completion     = $get_data_log['completion'];
            $date           = $get_data_log['tgl_sebenarnya'];
            $jam            = $get_data_log['jam'];
            $try            = $get_data_log['try'];
        }

        $result = [
            'jumlah_benar'      => $jumlah_benar,
            'jumlah_soal'       => $jumlah_soal,
            'completion'        => $completion,
            'date'              => $date,
            'time'              => $jam,
            'try'               => $try,
            'mode'              => $mode,
            'content_mode'      => $content_mode,
        ];
        echo json_encode($result);
    }

    public function permission_selftest()
    {
        $level        = $this->session->userdata('level');
        $id_siswa     = decrypt_url($this->session->userdata('id_siswa'));
        $subject      = $this->input->post('subject');
        $unit         = $this->input->post('unit');
        $content_type = $this->input->post('content_type');

        $getPermissionSelftest = $this->db->get_where('permission_selftest', ['id_siswa' => $id_siswa])->row_array();

        $get_data       = $this->m_selftest->getContentConfig($level, $subject, $content_type)->row_array();
        if ($content_type == 1) {
            $get_data_log       = $this->m_selftest->getLogMeaning($level, $id_siswa, $subject, $unit, 'spontan');
            $get_data_practice  = $this->m_selftest->getLogMeaning($level, $id_siswa, $subject, $unit, 'practice')->row_array();
            $get_data_test      = $this->m_selftest->getLogMeaning($level, $id_siswa, $subject, $unit, 'test')->row_array();
        } else if ($content_type == 2) {
            $get_data_log       = $this->m_selftest->getLogKeyword($level, $id_siswa, $subject, $unit, 'spontan');
            $get_data_practice  = $this->m_selftest->getLogKeyword($level, $id_siswa, $subject, $unit, 'practice')->row_array();
            $get_data_test      = $this->m_selftest->getLogKeyword($level, $id_siswa, $subject, $unit, 'test')->row_array();
        } else {
            $get_data_log       = $this->m_selftest->getLogArranging($level, $id_siswa, $subject, $unit, 'spontan');
            $get_data_practice  = $this->m_selftest->getLogArranging($level, $id_siswa, $subject, $unit, 'practice')->row_array();
            $get_data_test      = $this->m_selftest->getLogArranging($level, $id_siswa, $subject, $unit, 'test')->row_array();
        }

        $goal_spontan = 0;
        if ($get_data_log->num_rows() > 0) {
            $get_data['set_spontan'] = 0;
        }

        if ($get_data_practice != NULL) {
            $access_practice = ($get_data_log->row_array()['tgl_sebenarnya'] != date('Y-m-d')) ? 1 : 0;
            if ($access_practice == 1) {
                $access_practice = ($get_data_practice['tgl_sebenarnya'] != date('Y-m-d')) ? 1 : 0;
            }
            // $goal_practice = ($get_data_practice['completion'] >= $get_data['standart_goal']) ? 0 : 1 ;
        } else {
            // $goal_practice   = 1;
            $access_practice = ($get_data_log->row_array()['tgl_sebenarnya'] != date('Y-m-d')) ? 1 : 0;
        }
        
        if ($get_data_test['completion'] >= $get_data['standart_goal']) {
            $goal_test = 1;
        } else {
            $goal_test = 0;
            if ($get_data_log->row_array()['completion'] == '100') $goal_test = 1;
        }

        $access_test = ($get_data_test['tgl_sebenarnya'] == date('Y-m-d') ? 1 : 0);

        if ($getPermissionSelftest['date'] != date('d-m-Y')) {
            $access = 1;
            $data_update = [
                'spontan'  => 0,
                'practice' => 0,
                'test'     => 0,
                'review'   => 0,
            ];
            $this->db->where('id_siswa', $id_siswa);
            $this->db->update('permission_selftest', $data_update);
        } else {
            $access = 0;
            $data_update = [
                'spontan'           => $getPermissionSelftest['spontan'],
                'practice'          => $getPermissionSelftest['practice'],
                'test'              => $getPermissionSelftest['test'],
                'review'            => $getPermissionSelftest['review']
            ];
        }

        $data = [
            'access'            => $access,
            'get_data_test'     => $get_data_test,
            'access_spontan'    => $get_data['set_spontan'],
            'access_practice'   => $access_practice,
            'access_test'       => $access_test,
            'goal_test'         => $goal_test,
            'spontan'           => $data_update['spontan'],
            'practice'          => $data_update['practice'],
            'test'              => $data_update['test'],
            'review'            => $data_update['review']
        ];

        echo json_encode($data);
    }

    public function submit_content()
    {   
        $id_siswa     = decrypt_url($this->session->userdata('id_siswa'));
        $getPermissionSelftest = $this->db->get_where('permission_selftest', ['id_siswa' => $id_siswa])->row_array();

        if ($this->input->post('subject') == NULL) {
            if (empty($this->session->userdata('kamus'))) {
                redirect('dashboard_siswa');
            } else {
                $subject      = $this->session->userdata('subject');
                $subject_name = $this->session->userdata('subject_name');
                $unit         = $this->session->userdata('unit');
                $content_type = $this->session->userdata('content_type');
                $mode         = $this->session->userdata('mode');

                $this->get_content($subject, $subject_name, $unit, $content_type, $mode);
            }
        } else {
            $subject      = $this->input->post('subject', TRUE);
            $subject_name = $this->input->post('subject_name', TRUE);
            $unit         = $this->input->post('unit', TRUE);
            $content_type = $this->input->post('content_type', TRUE);
            $mode         = $this->input->post('mode', TRUE);

            $data_update  = [];
            if ($mode == "spontan") {
                $getCountSpontan    = $this->m_selftest->getCountSpontan($id_siswa);
                $pengurangan        = $getPermissionSelftest['spontan'] - 1;
                $data_update[$mode] = ( $pengurangan < 0) ? 0 : $pengurangan ;
                $this->db->where('id_siswa', $id_siswa);
                $this->db->update('permission_selftest', $data_update);
            } else if ($mode == "practice") {
                $getCountPractice   = $this->m_selftest->getCountPractice($id_siswa);
                $pengurangan        = $getPermissionSelftest['practice'] - 1;
                $data_update[$mode] = ( $pengurangan < 0) ? 0 : $pengurangan ;
                $this->db->where('id_siswa', $id_siswa);
                $this->db->update('permission_selftest', $data_update);
            } else if ($mode == "test") {
                $getCountTest       = $this->m_selftest->getCountTest($id_siswa);
                $pengurangan        = $getPermissionSelftest['test'] - 1;
                $data_update[$mode] = ( $pengurangan < 0) ? 0 : $pengurangan ;
                $this->db->where('id_siswa', $id_siswa);
                $this->db->update('permission_selftest', $data_update);
            } else if ($mode == "review") {
                $getCountReview     = $this->m_selftest->getCountReview($id_siswa);
                $pengurangan        = $getPermissionSelftest['review'] - 1;
                $data_update[$mode] = ( $pengurangan < 0) ? 0 : $pengurangan ;
                $this->db->where('id_siswa', $id_siswa);
                $this->db->update('permission_selftest', $data_update);
            }
            
            $session_content = [
                'subject'       => $subject,
                'subject_name'  => $subject_name,
                'unit'          => $unit,
                'content_type'  => $content_type,
                'mode'          => $mode,
            ];

            $this->session->set_userdata($session_content);

            $this->get_content($subject, $subject_name, $unit, $content_type, $mode);
        }
    }

    private function get_content($subject, $subject_name, $unit, $content_type, $mode)
    {
        // $get_user_agent = $this->db->get_where('user_agent')
        if ($content_type == 1) {
            $view_content = 'content_siswa/content_quiz';
        } else if($content_type == 2) {
            $view_content = 'content_siswa/content_quiz';
        } else {
            $view_content = 'content_siswa/content_arranging2';
        }

            $result_sistem_content = $this->sistem_content($subject, $unit, $content_type);

                $this->session->set_userdata('kamus', $result_sistem_content['kamus']);
                $this->session->set_userdata('kamus_list_pertanyaan', $result_sistem_content['list_pertanyaan']);
                $this->session->set_userdata('random_arranging', $result_sistem_content['random_arranging']);
                $this->session->set_userdata('list_pinyin', $result_sistem_content['array_pinyin']);
                $this->session->set_userdata('list_inggris', $result_sistem_content['array_inggris']);
                
            $get_time_limit = $this->m_selftest->getContentConfigTime($subject, $content_type)->row_array()['time_limit'];
            
            $waktu['time_limit'] = strtotime(date('H:i:s')) + $get_time_limit * 60;
            $waktu['time_click'] = strtotime(date('H:i:s'));
            if (empty($this->session->userdata('time_limit'))) {
                $this->session->set_userdata($waktu);
            }

            $dataQuiz = [
                'kamus'             => $result_sistem_content['kamus'],
                "list_pertanyaan"   => $result_sistem_content['list_pertanyaan'],
                "list_jawaban"      => $result_sistem_content['list_jawaban'],
                "list_pinyin"       => $result_sistem_content['array_pinyin'],
                'pinyin_test'       => $result_sistem_content['pinyin_test'],
                'pinyin_result'     => $result_sistem_content['pinyin_result']
            ];

            $data['data_quiz']        = $dataQuiz;
            $data['random_arranging'] = $result_sistem_content['random_arranging'];
            $data['jawaban']          = $result_sistem_content['list_pertanyaan'];
            $data['subject']          = $subject;
            $data['unit']             = $unit;
            $data['content_type']     = $content_type;
            $data['title']            = $subject_name." Unit ".$unit;
            $data['mode']             = $mode;
            $data['content']          = $view_content;
            
            $this->load->view('layout/siswa/MainView', $data);
    }

    private function sistem_content($subject, $unit, $content_type)
    {
        $level = $this->session->userdata('level');
    
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
                                        $arrayPertanyaan[$pageNumber][$idx] = [];
                                        
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
                return $dataQuiz;
            } else {
                $this->load->view('content_siswa/404');
            }
    }

    public function submit_answer_quiz()
    {
        $data = [
            'id_siswa'     => decrypt_url($this->session->userdata('id_siswa')),
            'level'        => $this->session->userdata('level'),
            'subject'      => $this->input->post('subject'),
            'unit'         => $this->input->post('unit'),
            'content_type' => $this->input->post('content_type'),
            'mode'         => $this->input->post('mode')
        ];

        $jawaban_user      = json_decode($this->input->post('jawaban_user'), TRUE);
        $kamus             = $this->session->userdata('kamus');

        $time_submit = (int)strtotime(date('H:i:s'));

        $convert_time = $time_submit - $this->session->userdata('time_click');
        $time   = date('i:s', $convert_time);

        if ($data['content_type'] == 1) {
            // array_multisort($jawaban_user, SORT_ASC, SORT_STRING);
            $content_type = "Meaning";
            $list_pertanyaan = setListPertanyaan();

            $test['kamus']      = $kamus;
            $test['jawaban'] = $jawaban_user;
            $test['pertanyaan'] = $list_pertanyaan;

            $result_sistem_data = $this->sistem_data($jawaban_user, $kamus, $list_pertanyaan);

            $get_try = $this->m_selftest->getTryMeaning($data['id_siswa'], $data['level'], $data['subject'], $data['unit'], $data['mode'])->row_array();
            $try = $get_try['try'] + 1;

            $result_set_data_insert = setDataInsert($data, $try, $time, $content_type, $result_sistem_data);
            $result = $this->m_selftest->insertDataMeaning($result_set_data_insert);
        } else if ($data['content_type'] == 2) {
            $content_type = "Keyword";
            $list_pertanyaan = setListPertanyaan();
            $result_sistem_data =  $this->sistem_data($jawaban_user, $kamus, $list_pertanyaan);

            $get_try = $this->m_selftest->getTryKeyword($data['id_siswa'], $data['level'], $data['subject'], $data['unit'], $data['mode'])->row_array();
            $try = $get_try['try'] + 1;

            $result_set_data_insert = setDataInsert($data, $try, $time, $content_type, $result_sistem_data);
            $result = $this->m_selftest->insertDataKeyword($result_set_data_insert);
        } else {
            $content_type   = "Arranging";
            
            $get_try        = $this->m_selftest->getTryArranging($data['id_siswa'], $data['level'], $data['subject'], $data['unit'], $data['mode'])->row_array();
            $try            = $get_try['try'] + 1;
            
            $random         = $this->session->userdata('random_arranging');

            $result_sistem_data     = $this->sistem_data_arranging($kamus, $jawaban_user, $random);

            $result_set_data_insert = setDataInsertArranging($data, $try, $time, $content_type, $result_sistem_data);
            $result = $this->m_selftest->insertDataArranging($result_set_data_insert);
        }

        $this->session->unset_userdata('kamus');
        $this->session->unset_userdata('kamus_list_pertanyaan');
        $this->session->unset_userdata('time_limit');
        $this->session->unset_userdata('time_click');
        $this->session->unset_userdata('subject');
        $this->session->unset_userdata('subject_name');
        $this->session->unset_userdata('unit');
        $this->session->unset_userdata('content_type');
        $this->session->unset_userdata('mode');
        $this->session->unset_userdata('random_arranging');

        $session_hasil_test['hasil_test'] = 1;
        $this->session->set_userdata($session_hasil_test);
        $callback['session']      = $result_set_data_insert['session'];
        $callback['content_type'] = $data['content_type'];
        echo json_encode($callback);
    }

    private function sistem_data($jawaban_user, $kamus, $list_pertanyaan)
    {
        $jumlah_salah = 0;
        $jumlah_benar = 0;
        $array_jawaban_benar = "";
        $array_jawaban_salah = "";
        $array_jawaban_sebenarnya = "";
        $array_hasil_test = array(); 

        for ($x=0; $x < count($kamus) ; $x++) { 
            $array_hasil_test[$x] = array(); 
            for ($i=0; $i < count($list_pertanyaan[$x]); $i++) { 
                $array_hasil_test[$x][$i]["pertanyaan"] = $list_pertanyaan[$x][$i];

                if (isset($jawaban_user[$x+1])) {
                    $jawaban = $jawaban_user[$x+1][$list_pertanyaan[$x][$i]];
                } else {
                    $jawaban = "";
                }
                
                $array_hasil_test[$x][$i]["jawaban_user"] = $jawaban;
                $array_hasil_test[$x][$i]["jawaban_sebenarnya"] = $kamus[$x][$list_pertanyaan[$x][$i]];
                $array_hasil_test[$x][$i]["hasil"] = ($array_hasil_test[$x][$i]["jawaban_user"] == $array_hasil_test[$x][$i]["jawaban_sebenarnya"]) ? "benar" : "salah";
            }
            
            foreach ($array_hasil_test[$x] as $hasil_test) {
                if ($hasil_test['hasil'] == "benar") {
                    $jumlah_salah += 0;
                    $jumlah_benar += 1;
                    $array_jawaban_benar .= $hasil_test['pertanyaan']."?".$hasil_test['jawaban_user']."%";
                } else {
                    $jumlah_salah += 1;
                    $jumlah_benar += 0;
                    $array_jawaban_salah      .= $hasil_test['pertanyaan']."?".$hasil_test['jawaban_user']."%";
                    $array_jawaban_sebenarnya .= $hasil_test['pertanyaan']."?".$hasil_test['jawaban_sebenarnya']."%";
                }
            }
        }

        $data_return = [
            'jumlah_salah'              => $jumlah_salah,
            'jumlah_benar'              => $jumlah_benar,
            'array_jawaban_benar'       => $array_jawaban_benar,
            'array_jawaban_salah'       => $array_jawaban_salah,
            'array_jawaban_sebenarnya'  => $array_jawaban_sebenarnya
        ];

        return $data_return;
    }

    private function sistem_data_arranging($kamus, $jawaban_user, $random)
    {
        $jumlah_salah = 0;
        $jumlah_benar = 0;
        $array_koreksi = "";

        for ($i=0; $i < count($random); $i++) { 
            for ($j=0; $j < count($random[$i]); $j++) { 
                if($kamus[$i][$random[$i][$j]] == trim($jawaban_user[$i][$random[$i][$j]])) {
                    $jumlah_salah   += 0;
                    $jumlah_benar   += 1;
                    $array_koreksi  .= trim($jawaban_user[$i][$random[$i][$j]])."? %";
                } else {
                    $jumlah_salah   += 1;
                    $jumlah_benar   += 0;
                    $array_koreksi  .= trim($jawaban_user[$i][$random[$i][$j]])."?".$kamus[$i][$random[$i][$j]]."%";
                }
            }
        }

        $data = [
            'jumlah_salah'  => $jumlah_salah,
            'jumlah_benar'  => $jumlah_benar,
            'array_koreksi' => $array_koreksi,
        ];

        return $data;
    }

    public function callback_test()
    {
        if (empty($this->session->userdata('hasil_test'))) {
            redirect('dashboard_siswa');
        } else {
            $this->form_validation->set_rules('session', 'Session', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('content_siswa/404');
            } else {
                $content_type = $this->input->post('content_type', TRUE);
                $session      = $this->input->post('session', TRUE);
    
                if ($content_type == 1) {
                    $data_test = $this->m_selftest->getDataTestMeaning($session)->row_array();
                    $content   = "Meaning";
                    $content_table = 'content_siswa/table_hasil/table_meaning';
                } else if($content_type == 2) {
                    $data_test = $this->m_selftest->getDataTestKeyword($session)->row_array();
                    $content   = "Keyword";
                    $content_table = 'content_siswa/table_hasil/table_keyword';
                } else {
                    $data_test = $this->m_selftest->getDataTestArranging($session)->row_array();
                    $content   = "Arranging";
                    $content_table = 'content_siswa/table_hasil/table_arranging';
                }

                $result_sistem_content = $this->sistem_content($data_test['subject'], $data_test['unit'], $content_type);
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
                    'pinyin_result' => $pinyin_result
                ];

                // echo json_encode($data);
                // die();
                $this->session->unset_userdata('hasil_test');
                // $this->load->view('content_siswa/hasil_test', $data);

                $this->load->helper(array('dompdf', 'file'));
                $html = $this->load->view('content_siswa/hasil_test', $data, true);
                pdf_create((string)$html, 'Report Selftest '.$data['content_type'], TRUE);
            }
        }
    }

    public function history()
    {
        $id_siswa = decrypt_url($this->session->userdata('id_siswa'));
        $level    = $this->session->userdata('level');
        
        $history_meaning_spontan    = $this->m_selftest->history_meaning($id_siswa, $level, 'spontan')->result_array();
        $history_meaning_practice   = $this->m_selftest->history_meaning($id_siswa, $level, 'practice')->result_array();
        $history_meaning_test       = $this->m_selftest->history_meaning($id_siswa, $level, 'test')->result_array();
        $history_meaning_review     = $this->m_selftest->history_meaning($id_siswa, $level, 'review')->result_array();
        

        $history_keyword_spontan    = $this->m_selftest->history_keyword($id_siswa, $level, 'spontan')->result_array();
        $history_keyword_practice   = $this->m_selftest->history_keyword($id_siswa, $level, 'practice')->result_array();
        $history_keyword_test       = $this->m_selftest->history_keyword($id_siswa, $level, 'test')->result_array();
        $history_keyword_review     = $this->m_selftest->history_keyword($id_siswa, $level, 'review')->result_array();

        $history_arranging_spontan  = $this->m_selftest->history_arranging($id_siswa, $level, 'spontan')->result_array();
        $history_arranging_practice = $this->m_selftest->history_arranging($id_siswa, $level, 'practice')->result_array();
        $history_arranging_test     = $this->m_selftest->history_arranging($id_siswa, $level, 'test')->result_array();
        $history_arranging_review   = $this->m_selftest->history_arranging($id_siswa, $level, 'review')->result_array();

        $data = [
            'title'             => 'History',
            'content'           => 'content_siswa/history/list_history',
            'meaning_spontan'   => $history_meaning_spontan,
            'meaning_practice'  => $history_meaning_practice,
            'meaning_test'      => $history_meaning_test,
            'meaning_review'    => $history_meaning_review,
            'keyword_spontan'   => $history_keyword_spontan,
            'keyword_practice'  => $history_keyword_practice,
            'keyword_test'      => $history_keyword_test,
            'keyword_review'    => $history_keyword_review,
            'arranging_spontan' => $history_arranging_spontan,
            'arranging_practice'=> $history_arranging_practice,
            'arranging_test'    => $history_arranging_test,
            'arranging_review'  => $history_arranging_review,
        ];

        $session_hasil_test['hasil_test'] = 1;
        $session_hasil_test['from']       = 'history';
        $this->session->set_userdata($session_hasil_test);
        $this->load->view('layout/siswa/MainView', $data);
    }
}