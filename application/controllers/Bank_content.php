<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_content extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_bank_content');
    }

    public function index()
    {   
        redirect('bank_content/content_reading');
    }

    public function scanFolder($dir)
    {
        $hasil = [];
        if (file_exists ($dir)) {
			$files = preg_grep('/^([^.])/', scandir ($dir));
			foreach ($files as $file) {
				array_push($hasil, $file);
			}	
		}
        array_multisort(array_values($hasil),SORT_NATURAL,$hasil);
        return $hasil;
    }

    public function upload_content($file, $dir, $ext, $nama_file)
    {
        if(!file_exists($dir)) mkdir($dir, 0777, true);
        
        $return = "";
        $countFiles = count($file['name']);
        for ($i=0; $i < $countFiles; $i++) {
            if (!empty($file['name'][$i])) {
				$_FILES['file']['name'] = $file['name'][$i];
				$_FILES['file']['type'] = $file['type'][$i];
				$_FILES['file']['tmp_name'] = $file['tmp_name'][$i];
				$_FILES['file']['error'] = $file['error'][$i];
				$_FILES['file']['size'] = $file['size'][$i];

				$config['upload_path'] 	 = $dir; 
				$config['allowed_types'] = '*';
                $config['overwrite']	 = true;
                $config['file_name']	 = "(".$i.")".$nama_file;

				$this->load->library('upload',$config);
				$file_extension     =   pathinfo($nama_file, PATHINFO_EXTENSION);
				$allowed_extension  =   array($ext);

				if(in_array($file_extension, $allowed_extension)) {
                    $this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
                        $return = ($countFiles == $i) ? 'Berhasil' : '';
					} else {
                        $return = $this->upload->display_errors();
					}
				} else {
                    $return = 'Gagal';
				}
			}
        }

        echo json_encode($return);
        die();

        //Lama
        if(!empty($file['name'])) { 	
        	$config['upload_path']   = $dir; 
        	$config['allowed_types'] = '*';
        	$config['overwrite']	 = false;
        	$config['file_name']	 = $nama_file;
			
            $this->load->library('upload', $config);
            $file_extension     =   pathinfo($nama_file, PATHINFO_EXTENSION);
            $allowed_extension  =   array($ext);

            if(in_array($file_extension, $allowed_extension)) {
                $this->upload->initialize($config);
            	if ($this->upload->do_upload($ext)) {
                    return "Berhasil";
            	} else {
                    return "Gagal";
            	}	
            } else {
                return "Gagal";
            }
        }
    }
    
    public function content_reading()
    {
        $getData    = $this->m_bank_content->list('reading')->result_array();

        foreach($getData as $key =>  $data) {
            $dirTxt     = content_dir()."BankContent/".$data['code']."/text/".$data['version']."/";
            $getData[$key]['list_txt']  = $this->scanFolder($dirTxt);
            
            $dirAudio   = content_dir()."BankContent/".$data['code']."/audio/";
            $getData[$key]['list_audio']  = $this->scanFolder($dirAudio);
        }
        
        $data = [
            'list_content' => $getData
        ];
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('bank_content/daily_reading/list_content_reading');
        $this->load->view('layout/footer');
    }

    public function content_reading_tambah()
    {
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('bank_content/daily_reading/tambah_content_reading');
        $this->load->view('layout/footer');
    }

    public function content_reading_create()
    {
        $data = [
			'label'  => 'R',
			'code' 	 => $this->input->post('code'),
			'title'  => $this->input->post('title'),
			'tgl_create'  => date('Y-m-d H:i:s'),
            'id_admin'    => trim($this->session->userdata('username')),
            'version'     => 1
        ];
        // $ogg = $_FILES['txt'];
        echo json_encode($data);
        die();
        
        // $insert = $this->m_bank_content->insert($data);
        $insert = 1;
        $return = [
            'success' => "",
            'data'    => []
        ];
        if($insert == 1) {
            $return = [
                'success' => "Berhasil",
                'data'    => ['code' => $data['code']]
            ];
        } else if($insert == 2) {
            $return['success'] = "Ada";
            echo "Ada";
        } else {
            $return['success'] = "Ada";
        }
        echo json_encode($return);
        die();

        //Lama
        if($insert > 0) {
            $txt    = $_FILES['txt'];
            $dirTxt = content_dir().'BankContent/'.$data['code'].'/text/'.$data['version'];
            $nama_txt   = $data['code'].'.txt';
            $upload_txt     = $this->upload_content($txt, $dirTxt, 'txt', $nama_txt);
            
            if($upload_txt == "Berhasil") {
                $audio 	  = $_FILES['ogg'];
                $dirAudio = content_dir().'BankContent/'.$data['code'].'/audio';
                $nama_audio = $data['code'].'.ogg';

                $upload_audio   = $this->upload_content($audio, $dirAudio, 'ogg', $nama_audio);
                if($upload_audio == "Berhasil") {
                    $this->session->set_flashdata('simpan', 'Content Berhasil Diupload ...');
                    redirect('bank_content/content_reading');
                } else {
                    $this->session->set_flashdata('salah', 'Terjadi Kesalahan, Content Gagal Diupload');
                    redirect('bank_content/content_reading');
                }
            } else {
                $this->session->set_flashdata('salah', 'Terjadi Kesalahan, Content Gagal Diupload');
                redirect('bank_content/content_reading');
            }
        }

        $this->session->set_flashdata('salah', 'Terjadi Kesalahan, Content Gagal Diupload');
        redirect('bank_content/content_reading');
    }
    
    public function content_reading_upload_txt()
    {
        $data = [
			'code' 	    => $this->input->post('code'),
            'version'   => 1,
            'txt'       => $_FILES['txt']
        ];

        echo json_encode($data);
    }
    public function content_reading_edit()
    {
        $eid = $this->uri->segment(3);
        $id  = decrypt_url($eid);

        $getData = $this->m_bank_content->getDataById($id)->row_array();
        $dirTxt     = content_dir()."BankContent/".$getData['code']."/text/".$getData['version']."/";
        $getData['list_txt']  = $this->scanFolder($dirTxt);
        
        $dirAudio   = content_dir()."BankContent/".$getData['code']."/audio/";
        $getData['list_audio']  = $this->scanFolder($dirAudio);

        $data['list_content'] = $getData;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('bank_content/daily_reading/edit_content_reading');
        $this->load->view('layout/footer');
    }
}