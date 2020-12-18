<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_soal extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('m_bank_soal');
          session();
    }

    public function index()
    {
        $data = [
          'bank_content' => $this->db->get('bank_content')->result()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('bank_soal/index', $data);
        $this->load->view('layout/footer');
    }

    function file_list($jenis="")
    {
      $bank_content='';
      if($jenis != "")
      {
        $bank_content = $this->db->get_where('bank_content', ['label' => $jenis])->result();
      }else {
        $bank_content = $this->db->get('bank_content')->result();
      }
      $data = [
        'page_title' => 'File List',
        'bank_content' => $bank_content
      ];
      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('bank_soal/file_list/index');
      $this->load->view('layout/footer');
    }

    function add_file()
    {
      $data = [
        'page_title' => 'Add File'
      ];
      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('bank_soal/file_list/add');
      $this->load->view('layout/footer');
    }

    function edit_file($id)
    {
      $data = [
        'page_title' => 'Edit File',
        'bank_content' => $this->db->get_where('bank_content', ['id' => $id])->row()
      ];
      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('bank_soal/file_list/edit');
      $this->load->view('layout/footer');
    }

    function lesson_plan()
    {
      $data = [
        'page_title' => 'Lesson Plan'
      ];
      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('bank_soal/lesson_plan/index');
      $this->load->view('layout/footer');
    }

    function cek_product_code($txt)
    {
      $this->db->where('code', $txt);
      $cek = $this->db->get('bank_content')->num_rows();
      if($cek > 0)
      {
        echo json_encode(['type' => 'false', 'msg' => '❌ Kode sudah ada']);
      }else {
        echo json_encode(['type' => 'true', 'msg' => '✔ OK']);
      }
    }

    function upload_filex($name, $code="", $jenis = "")
    {
      for ($i=0; $i < count($_FILES['file_audio']['name']); $i++) {
      $ext = pathinfo($_FILES['file_audio']['name'][$i], PATHINFO_EXTENSION);
      // echo count($_FILES['file_audio']['name']);
      // exit();

      $root = "/home/appclcco/public_html/clc_mandarin_ci/";
      	// $countFiles = count($_FILES[$name]['name']);
        // var_dump($countFiles); exit();

      $mime = "";
      $nama_file = '';

      if($ext == 'txt')
      {
        $mime = 'text';
        $nama_file = $root.'BankSoal/'.$jenis.'/'.strtoupper($code).'/'.$mime.'/1/'.strtoupper($code).'.'.$ext;
        // $nama_file = $root.'BankSoal/'.$jenis.'/'.$code.'/'.$mime.'/';
        $path = $root.'BankSoal/'.$jenis.'/'.strtoupper($code).'/'.$mime.'/1/';
        $config['file_name']    = strtoupper($code).'.'.$ext;
      }else {
        $mime = 'audio';
        $path = $root.'BankSoal/'.$jenis.'/'.strtoupper($code).'/'.$mime.'/';
        $nama_file = $root.'BankSoal/'.$jenis.'/'.strtoupper($code).'/'.$mime.'/'.$_FILES['file_audio']['name'][$i];
        // $nama_file = base_url().'BankSoal/'.$jenis.'/'.$code.'/'.$mime.'/';
      }

      if(!is_dir($path)){
        mkdir($path, 0777, true);
      }


      $config['upload_path']= $path;
      $config['max_size']   = 5140;
      $config['allowed_types'] = '*';
      $config['overwrite']	 = true;

      $this->load->library('upload',$config);
      if(!$this->upload->do_upload('file_audio')){
        echo $this->upload->display_errors();
      }else{
        $data = $this->upload->data();
        echo $nama_file;
      }
      }
    }

    public function upload_file($name, $code="", $jenis = "")
  	{
  		$data = [
  			'jenis'  => $this->input->post('jenis',TRUE),
  			'code' 	 => $this->input->post('code',TRUE),
  			'title'  => $this->input->post('title',TRUE),
  			'file' 	 => $_FILES['file_audio']
  		];

      $root = "/home/appclcco/public_html/clc_mandarin_ci/";
      $path = 'BankSoal/'.$data['jenis'].'/'.strtoupper($data['code']).'/audio/';

  		if (!file_exists($root.$path)) {
  			mkdir($root.$path, 0755, true);
  		}

  		$countFiles = count($data['file']['name']);

  		for ($i=0; $i < $countFiles; $i++) {
  			if (!empty($data['file']['name'][$i])) {
  				$_FILES['file']['name'] = $data['file']['name'][$i];
  				$_FILES['file']['type'] = $data['file']['type'][$i];
  				$_FILES['file']['tmp_name'] = $data['file']['tmp_name'][$i];
  				$_FILES['file']['error'] = $data['file']['error'][$i];
  				$_FILES['file']['size'] = $data['file']['size'][$i];

  				$config['upload_path'] 	 = $root.$path;
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
              $d = '<a onclick="remove_el(this, `'.$filename.'`)" data-path_audio="'.$root.$path.'" data-file="'.$root.$path.''.$filename.'" data-preview="preview_audio" href="#" style="margin-top:2px; margin-left:4px;" type="button" class="btn btn-xs bg-indigo waves-effect path_audio"><i style="font-size:13pt;" class="material-icons">delete</i><span> '.$filename.'</span></a>';
              echo $d;
  					} else {
              echo $this->upload->display_errors();
  					}
  				} else {
  					echo 'Ekstensi file tidak diizinkan!';
  				}
  			}
  		}
  	}

    public function upload_txt($name, $code="", $jenis = "")
  	{
  		$data = [
  			'jenis'  => $this->input->post('jenis',TRUE),
  			'code' 	 => $this->input->post('code',TRUE),
        'title'  => $this->input->post('title',TRUE),
  			'version'  => $this->input->post('version',TRUE),
  			'file' 	 => $_FILES['file_txt']
  		];

      $root = "/home/appclcco/public_html/clc_mandarin_ci/";
      $path = 'BankSoal/'.$data['jenis'].'/'.strtoupper($data['code']).'/text/'.$data['version'];

  		if (!file_exists($root.$path)) {
  			mkdir($root.$path, 0755, true);
  		}


  			if (!empty($data['file']['name'])) {
  				$_FILES['file']['name'] = strtoupper($data['code']).'.txt';
  				$_FILES['file']['type'] = $data['file']['type'];
  				$_FILES['file']['tmp_name'] = $data['file']['tmp_name'];
  				$_FILES['file']['error'] = $data['file']['error'];
  				$_FILES['file']['size'] = $data['file']['size'];

  				$config['upload_path'] 	 = $root.$path;
  				$config['allowed_types'] = 'txt';
  				$config['overwrite']	 = true;
  				$this->load->library('upload',$config);
  				$nama_file = $data['file']['name'];
  				$file_extension     =   pathinfo($nama_file, PATHINFO_EXTENSION);
  				$allowed_extension  =   array('txt');

  				if(in_array($file_extension, $allowed_extension)) {
  					if ($this->upload->do_upload('file')) {
  						$uploadData = $this->upload->data();
  						$filename = $uploadData['file_name'];
              $d = '<a onclick="remove_el(this, `'.$filename.'`)" data-path_txt="'.$root.$path.'" data-file="'.$root.$path.''.$filename.'" data-preview="preview_audio" href="#" style="margin-top:2px; margin-left:4px;" type="button" class="btn btn-xs bg-indigo waves-effect path_txt"><i style="font-size:13pt;" class="material-icons">delete</i><span> '.$filename.'</span></a>';
              echo $d;
  					} else {
              echo $this->upload->display_errors();
  					}
  				} else {
  					echo 'Ekstensi file tidak diizinkan!';
  				}
  			}
  	}

    function hapus($id)
    {
      $hapus = $this->db->delete('bank_content', ['id' => $id]);
      if($hapus)
      {
        redirect(base_url('bank_soal/file_list'));
      }
    }

    function save_file()
    {
      $data = [
        'label' => $this->input->post('label'),
        'code' => strtoupper($this->input->post('code')),
        'title' => $this->input->post('title'),
        'tgl_create' => date('Y-m-d H:i:s'),
        'tgl_update' => date('Y-m-d H:i:s'),
        'id_admin' => trim($this->session->userdata('username')),
        'version' => 1,
        'text_path' => $this->input->post('text_path'),
        'audio_path' => $this->input->post('audio_path')
      ];
      $save = $this->db->insert('bank_content', $data);
      if($save)
      {
        echo json_encode(['type' => 'success', 'msg' => 'Data berhasil disimpan']);
      }else {
        echo json_encode(['type' => 'danger', 'msg' => 'Data gagal disimpan']);
      }
    }

    function update_file($id)
    {
      $version = $this->db->get_where('bank_content', ['id' => $id])->row()->version;
      $pecah = explode('/', $this->input->post('text_path'));
      array_pop($pecah);
      $utuh = implode('/', $pecah);
      // var_dump($this->input->post('text_path'));
      // var_dump($utuh); exit();
      $data = [
        'label' => $this->input->post('label'),
        'code' => strtoupper($this->input->post('code')),
        'title' => $this->input->post('title'),
        'tgl_update' => date('Y-m-d H:i:s'),
        'id_admin' => trim($this->session->userdata('username')),
        'version' => ($version+1),
        'text_path' => $utuh.'/'.($version+1),
        'audio_path' => $this->input->post('audio_path')
      ];
      $save = $this->db->update('bank_content', $data, ['id' => $id]);
      if($save)
      {
        echo json_encode(['type' => 'success', 'msg' => 'Data berhasil diupdate']);
      }else {
        echo json_encode(['type' => 'danger', 'msg' => 'Data gagal diupdate']);
      }
    }

    function delete_file()
    {
      $file = $this->input->post('file');
      // var_dump($file); exit();
      $replace = str_replace(base_url(), FCPATH, $file);
      unlink($replace);
      echo "Deleted";
    }




}
