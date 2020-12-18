<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['m_app_version', 'm_template', 'm_unit', 'm_current', 'm_dialog', 'm_administrator', 'm_selftest']);
		$this->load->helper('download');
		session();
	}

	public function index()
	{
		redirect('dashboard', 'refresh');
	}

	public function setting_maintance()
	{
		$data['maintenance_days'] = $this->input->post('maintenance_days', TRUE);

		$result_truncate = $this->db->query('TRUNCATE maintenance_tracker');
		if ($result_truncate > 0) {
			$result_insert = $this->db->insert('maintenance_tracker', $data);
			if ($result_insert > 0) {
				$this->session->set_flashdata('simpan', 'Maintenance Berhasil Di Ubah ...');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('gagal', 'Maintenance Gagal Di Ubah ...');
				redirect('dashboard');
			}
		} else {
			$this->session->set_flashdata('gagal', 'Maintenance Gagal Di Ubah ...');
			redirect('dashboard');
		}

	}

	public function administrator()
	{
		$data = array(
			'adm' 		=> $this->m_administrator->data_administrator()
		);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('admin/list_administrator');
		$this->load->view('layout/footer');
	}

	public function administrator_tambah()
	{
		if (isset($_POST['submit'])) {
			$username = $this->input->post('username');
			$query = $this->db->get_where('login', array('username' => $username));

			if ($query->num_rows() == 0) {
				$this->m_administrator->simpan_administrator();
				$this->session->set_flashdata('simpan', 'Administrator Berhasil Ditambah ...');
				redirect('admin/administrator');
			} else {
				$this->session->set_flashdata('salah', 'Terjadi Kesalahan, Administrator Sudah Ada');
				redirect('admin/administrator');
			}
		} else {

			$data = array(
				'title' => 'Tambah Administrator',
				'role' => $this->db->get('tb_role')->result()
			);
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar');
			$this->load->view('admin/tambah_administrator');
			$this->load->view('layout/footer');
		}
	}

	public function administrator_edit()
	{
		$eid = $this->uri->segment(3);
		$id = decrypt_url($eid);

		if (isset($_POST['submit'])) {
			$this->m_administrator->edit_administrator();
			$this->session->set_flashdata('simpan', 'Administrator berhasil diedit...');
			redirect('admin/administrator');
		} else {
			if ($id) {
				$data = array(
					'adm' => $this->db->get_where('login', array('username' => $id))->row_array(),
				);

				$this->load->view('layout/header', $data);
				$this->load->view('layout/sidebar');
				$this->load->view('admin/edit_administrator');
				$this->load->view('layout/footer');
			}
		}
	}

	public function administrator_hapus()
	{
		$enc_username = $this->uri->segment(3);
		$username = decrypt_url($enc_username);

		if ($username) {

			if (!empty($username)) {
				$this->db->where('username', $username);
				$this->db->delete('login');
			}

			$this->session->set_flashdata('simpan', 'Administrator berhasil di hapus ...');
			redirect('admin/administrator');
		} else {
			redirect('admin/administrator');
		}
	}

	public function kantor_cabang()
	{
		$data = array (
			'kantor_cabang' => $this->m_kantor->datakantor()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('kantor_cabang/list_kantor');
		$this->load->view('layout/footer');

	}

	public function kantor_cabang_tambah()
	{
		if (isset($_POST['submit'])) {
			$id_cabang = $this->input->post('id_cabang');
			$query = $this->db->get_where('cabang_clc', array('id_cabang' => $id_cabang));
			if ($query->num_rows() == 0) {
				$this->m_kantor->simpan();
				$this->session->set_flashdata('simpan', 'Kantor Cabang Berhasil Ditambah ...');
				redirect('admin/kantor_cabang');
			} else {
				$this->session->set_flashdata('salah', 'Terjadi Kesalahan, Kantor Cabang Sudah Ada');
				redirect('admin/kantor_cabang');
			}
		} else {

			$data = array(
				'title' => 'Tambah Kantor Cabang',
			);
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar');
			$this->load->view('kantor_cabang/tambah_kantor');
			$this->load->view('layout/footer');
		}
	}

	public function kantor_cabang_edit()
	{
		$eid = $this->uri->segment(3);
		$id_cabang = decrypt_url($eid);

		if (isset($_POST['submit'])) {
			$this->m_kantor->edit();
			$this->session->set_flashdata('simpan', 'Kantor Cabang berhasil diedit...');
			redirect('admin/kantor_cabang');
		} else {
			if ($id_cabang) {
				$data = array(
					'kantor_cabang' => $this->db->get_where('cabang_clc', array('id_cabang' => $id_cabang))->row_array(),
				);

				$this->load->view('layout/header', $data);
				$this->load->view('layout/sidebar');
				$this->load->view('kantor_cabang/edit_kantor');
				$this->load->view('layout/footer');
			}
		}
	}

	public function kantor_cabang_hapus()
	{
		$eid_cabang = $this->uri->segment(3);
		$id_cabang = decrypt_url($eid_cabang);

		if ($id_cabang) {

			if (!empty($id_cabang)) {
				$this->db->where('id_cabang', $id_cabang);
				$this->db->delete('cabang_clc');
			}

			$this->session->set_flashdata('simpan', 'Kantor Cabang Berhasil Di Hapus ...');
			redirect('admin/kantor_cabang');
		} else {
			redirect('admin/kantor_cabang');
		}
	}

	public function template_comment()
	{
		$data_post = [
			'id' 	 	=> $this->input->post('id'),
			'comment' 	=> str_replace("'", "", $this->input->post('comment')),
			'mode' 	 	=> $this->input->post('mode')
		];

		if ($data_post['mode'] == '0') {
			if ($data_post['id'] == 'new') {
				$result = $this->m_template->save_template($data_post['comment']);
				echo "Simpan Data...";
			} else {
				$result = $this->m_template->update_template($data_post['id'], $data_post['comment']);
				echo "Update Data...";
			}
		} elseif ($data_post['mode'] == '1') {
			$result = $this->m_template->delete_template($data_post['id']);
			echo "Delete Data...";
		} else {
			$data = [
				'template' => $this->m_template->dataTemplate()->result_array()
			];

			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar');
			$this->load->view('template_comment/list_comment');
			$this->load->view('layout/footer');
		}
	}

	public function template_comment_speaking()
	{
		$data_post = [
			'id' 	 	=> $this->input->post('id'),
			'comment' 	=> str_replace("'", "", $this->input->post('comment')),
			'mode' 	 	=> $this->input->post('mode')
		];

		if ($data_post['mode'] == '0') {
			if ($data_post['id'] == 'new') {
				$result = $this->m_template->save_template_speaking($data_post['comment']);
				echo "Simpan Data...";
			} else {
				$result = $this->m_template->update_template_speaking($data_post['id'], $data_post['comment']);
				echo "Update Data...";
			}
		} elseif ($data_post['mode'] == '1') {
			$result = $this->m_template->delete_template_speaking($data_post['id']);
			echo "Delete Data...";
		} else {
			$data = [
				'template' => $this->m_template->dataTemplateSpeaking()->result_array()
			];

			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar');
			$this->load->view('template_comment/list_comment_speaking');
			$this->load->view('layout/footer');
		}
	}

	public function level_siswa()
	{
		$data = [
			'level' 		=> $this->m_level->datalevel()->result_array(),
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('level_siswa/list_level');
		$this->load->view('layout/footer');
	}

	public function level_siswa_tambah()
	{
		if (isset($_POST['submit'])) {
			$id_level = str_replace(' ', '_', $this->input->post('id_level', TRUE));
			$query = $this->db->get_where('level', array('id_level' => $id_level));

			if ($query->num_rows() == 0) {
				$this->m_level->simpan();
				$this->session->set_flashdata('simpan', 'Level Berhasil Ditambah ...');
				redirect('admin/level_siswa');
			} else {
				$this->session->set_flashdata('salah', 'Terjadi Kesalahan, Level Sudah Ada');
				redirect('admin/level_siswa');
			}
		} else {

			$data = array(
				'title' => 'Tambah Level Siswa',
			);
			$this->load->view('layout/header');
			$this->load->view('layout/sidebar');
			$this->load->view('level_siswa/tambah_level');
			$this->load->view('layout/footer');
		}
	}

	public function level_siswa_edit()
	{
		$this->m_level->edit();
	}

	public function level_siswa_hapus()
	{

		$eid = $this->uri->segment(3);
		$id_level = decrypt_url($eid);

		$this->m_level->hapus($id_level);

		$this->session->set_flashdata('simpan', 'Level berhasil di hapus ...');
		redirect('admin/level_siswa');
	}

	public function guru()
	{
		$data = array(
			'guru' => $this->m_guru->dataguru()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('guru/list_guru');
		$this->load->view('layout/footer');

	}

	public function guru_tambah()
	{

		if (isset($_POST['submit'])) {
			$id_guru = $this->input->post('id_guru');
			$query = $this->db->get_where('guru', array('id_guru' => $id_guru));

			if ($query->num_rows() == 0) {
				$this->m_guru->simpan();
				$this->session->set_flashdata('simpan', 'Guru Berhasil Ditambah ...');
				redirect('admin/guru');
			} else {
				$this->session->set_flashdata('salah', 'Terjadi Kesalahan, Guru Sudah Ada');
				redirect('admin/guru');
			}
		} else {

			$data = array(
				'title' => 'Tambah Guru',
				'guru' => $this->m_guru->dataguru()
			);
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar');
			$this->load->view('guru/tambah_guru');
			$this->load->view('layout/footer');
		}

	}

	public function guru_edit()
	{
		$eid = $this->uri->segment(3);
		$id = decrypt_url($eid);

		if (isset($_POST['submit'])) {
			$result = $this->m_guru->edit();
			if ($result == "Berhasil") {
				$this->session->set_flashdata('simpan', 'Guru berhasil diedit...');
			} elseif ($result == "Gagal") {
				$this->session->set_flashdata('salah', 'Gagal Di Edit');
			}
			redirect('admin/guru');
		} else {
			if ($id) {
				$data = array(
					'guru' 			=> $this->db->get_where('guru', array('id_guru' => $id))->row_array(),
					'id_guru' 		=> $this->m_guru->dataperguru(),
					'device_guru'	=> $this->m_guru->datadevice($id)->result_array()
				);
				$this->load->view('layout/header', $data);
				$this->load->view('layout/sidebar');
				$this->load->view('guru/edit_guru');
				$this->load->view('layout/footer');

			}
		}
	}

	public function guru_hapus()
	{
		$eid = $this->uri->segment(3);
		$id_guru = decrypt_url($eid);

		if ($id_guru) {

			if (!empty($id_guru)) {
				$this->db->where('id_guru', $id_guru);
				$this->db->delete('guru');
			}

			$this->session->set_flashdata('simpan', 'Guru berhasil di hapus ...');
			redirect('admin/guru');
		} else {
			redirect('admin/guru');
		}
	}


	public function siswa()
	{
		$get_siswa = $this->m_siswa->datasiswa()->result_array();

		$data = [];
		$no   = 0;
		foreach($get_siswa as $siswa) {
			$result_permission = $this->m_selftest->getPermissionSelftest($siswa['id_siswa'])->row_array();

			$data[$no]['id_siswa'] 		= $siswa['id_siswa'];
			$data[$no]['nama_siswa'] 	= $siswa['nama_siswa'];
			$data[$no]['level'] 		= $siswa['level'];
			$data[$no]['id_cabang']	 	= $siswa['id_cabang'];
			$data[$no]['nama_cabang'] 	= $siswa['nama_cabang'];
			$data[$no]['id_guru'] 		= $siswa['id_guru'];
			$data[$no]['nama_guru'] 	= $siswa['nama_guru'];
			$data[$no]['nama_checker'] 	= $siswa['nama_checker'];
			$data[$no]['nama_examiner'] = $siswa['nama_examiner'];
			$data[$no]['spontan'] 		= $result_permission['spontan'];
			$data[$no]['practice'] 		= $result_permission['practice'];
			$data[$no]['test']	 		= $result_permission['test'];
			$data[$no]['review'] 		= $result_permission['review'];
			$data[$no]['data_permission'] 	= $result_permission['date'];
			$data[$no]['daily_active'] = getSiswaDailyActive($siswa['id_siswa'])['percentage'];
			$data[$no]['produk_name'] 	= $siswa['produk_name'];
			$data[$no]['class_name'] 	= $siswa['class_name'];
			// $data[$no]['custom_active_subject'] 	= $siswa['custom_active_subject'];
			$no++;
		}
		sleep(1);
		$parse = [
			'siswa' => $data
		];

		$this->load->view('layout/header', $parse);
		$this->load->view('layout/sidebar');
		$this->load->view('siswa/list_siswa');
		$this->load->view('layout/footer');
	}

	public function siswa_tambah()
	{
		if (isset($_POST['submit'])) {
			$id_siswa = $this->input->post('id_siswa');
			$query = $this->db->get_where('siswa', array('id_siswa' => $id_siswa));

			if ($query->num_rows() == 0) {
				$this->m_siswa->simpan();
				$this->session->set_flashdata('simpan', 'Siswa Berhasil Ditambah ...');
				redirect('admin/pencarian_siswa', 'refresh');
			} else {
				$this->session->set_flashdata('salah', 'Terjadi Kesalahan, Siswa Sudah Ada');
				redirect('admin/pencarian_siswa', 'refresh');
			}
		} else {

			$data = array(
				'title' => 'Tambah Guru',
				'level' => $this->m_level->dataperlevel(),
				'guru' => $this->m_guru->dataperguru(),
				'cabang' => $this->m_cabang->datacabang()
			);
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar');
			$this->load->view('siswa/tambah_siswa');
			$this->load->view('layout/footer');

		}
	}

	public function siswa_edit()
	{
		$eid = $this->uri->segment(3);
		$id = decrypt_url($eid);

		if (isset($_POST['submit'])) {
			$this->m_siswa->edit();
			$this->session->set_flashdata('simpan', 'Siswa berhasil diedit...');
			redirect('admin/pencarian_siswa', 'refresh');
		} else {
			if ($id) {
				$data = [
					'siswa' 		=> $this->db->get_where('siswa', array('id_siswa' => $id))->row_array(),
					'id_guru'  		=> $this->m_guru->dataguru(),
					'id_level'  	=> $this->m_level->dataperlevel(),
					'id_cabang'		=> $this->m_cabang->datacabang(),
					'device_siswa'	=> $this->m_siswa->device($id)
				];

				$this->load->view('layout/header', $data);
				$this->load->view('layout/sidebar');
				$this->load->view('siswa/edit_siswa');
				$this->load->view('layout/footer');
			}
		}
	}

	public function siswa_hapus()
	{
		$eid = $this->uri->segment(3);
		$id_siswa = decrypt_url($eid);

		if ($id_siswa) {

			if (!empty($id_siswa)) {
				$this->db->where('id_siswa', $id_siswa);
				$this->db->delete('siswa');
				$this->db->where('id_siswa', $id_siswa);
				$this->db->delete('device_siswa');
			}

			$this->session->set_flashdata('simpan', 'Siswa berhasil di hapus ...');
			redirect('admin/pencarian_siswa', 'refresh');
		} else {
			redirect('admin/pencarian_siswa', 'refresh');
		}
	}

	public function pencarian_siswa()
	{
		$data = [];
		$keyword = $this->input->post('keyword');
		if ($keyword != '') {
			$get_siswa = $this->m_siswa->pencarian_siswa($keyword)->result_array();
			$no   = 0;
			foreach($get_siswa as $siswa) {
				$result_permission = $this->m_selftest->getPermissionSelftest($siswa['id_siswa'])->row_array();

				$data[$no]['id_siswa'] 		= $siswa['id_siswa'];
				$data[$no]['nama_siswa'] 	= $siswa['nama_siswa'];
				$data[$no]['level'] 		= $siswa['level'];
				$data[$no]['id_cabang']	 	= $siswa['id_cabang'];
				$data[$no]['nama_cabang'] 	= $siswa['nama_cabang'];
				$data[$no]['id_guru'] 		= $siswa['id_guru'];
				$data[$no]['nama_guru'] 	= $siswa['nama_guru'];
				$data[$no]['nama_checker'] 	= $siswa['nama_checker'];
				$data[$no]['nama_examiner'] = $siswa['nama_examiner'];
				$data[$no]['spontan'] 		= $result_permission['spontan'];
				$data[$no]['practice'] 		= $result_permission['practice'];
				$data[$no]['test']	 		= $result_permission['test'];
				$data[$no]['review'] 		= $result_permission['review'];
				$data[$no]['data_permission'] 	= $result_permission['date'];
				$data[$no]['daily_active']  = getSiswaDailyActive($siswa['id_siswa'])['percentage'];
				$data[$no]['produk_name'] 	= $siswa['produk_name'];
				$data[$no]['class_name'] 	= $siswa['class_name'];
				// $data[$no]['custom_active_subject'] 	= $siswa['custom_active_subject'];
				$no++;
			}
		}

		$parse = [
			'siswa' => $data
		];
		$this->load->view('layout/header', $parse);
		$this->load->view('layout/sidebar');
		$this->load->view('siswa/pencarian_siswa');
		$this->load->view('layout/footer');
	}

	public function permission_selftest()
	{
		$data = [
			'id_siswa' => getIdSiswa($this->input->post('nama_siswa')),
			'username' => trim($this->input->post('admin')),
			'spontan'  => ($this->input->post('spontan') == '') ? 0 : $this->input->post('spontan'),
			'practice' => ($this->input->post('practice') == '') ? 0 : $this->input->post('practice'),
			'test'     => ($this->input->post('test') == '') ? 0 : $this->input->post('test'),
			'review'   => ($this->input->post('review') == '') ? 0 : $this->input->post('review'),
			'date'	   => date('d-m-Y')
		];

		$get_data_permission = $this->m_selftest->getPermissionSelftest($data['id_siswa'])->num_rows();

		if ($get_data_permission > 0) {
			$id_siswa = $data['id_siswa'];

			$data_update = [
				'username'	=> $data['username'],
				'spontan'	=> $data['spontan'],
				'practice'	=> $data['practice'],
				'test'		=> $data['test'],
				'review'	=> $data['review'],
				'date'		=> date('d-m-Y')
			];

			$this->db->where('id_siswa', $id_siswa);
			$result = $this->db->update('permission_selftest', $data_update);
		} else {
			$result = $this->db->insert('permission_selftest', $data);
		}

		if ($result > 0) {
			$this->session->set_flashdata('simpan', 'Permission Selftest Siswa Berhasil Ditambah ...');
		} else {
			$this->session->set_flashdata('salah', 'Permission Selftest Siswa Berhasil Ditambah ...');
		}
		redirect('admin/siswa');
	}

	public function get_permission_selftest()
	{
		$id_siswa = $this->input->post('id_siswa');

		$get_data_permission = $this->m_selftest->getPermissionSelftest($id_siswa)->row_array();
		echo json_encode($get_data_permission);
	}

	public function clear_all_permission()
	{
		$array_selected = $this->input->post('array_selected');
		$count 			= count($array_selected);

		$data 	= [];
		$no 	= 0;

		$return = 0;
		if($count > 0 ) {
			for ($i=0; $i < $count ; $i++) {
				$get_data = $this->m_selftest->getPermissionSelftest($array_selected[$i])->num_rows();
				if ($get_data > 0) {
					$data[$no]['id_siswa'] 	= $array_selected[$i];
					$data[$no]['spontan'] 	= 0;
					$data[$no]['practice']  = 0;
					$data[$no]['test']      = 0;
					$data[$no]['review']    = 0;
					$no++;
				}
			}
			$return = (count($data) != 0) ? $this->db->update_batch('permission_selftest', $data, 'id_siswa') : 0;
		}

		echo $return;
	}

	public function download_template_siswa()
	{
		force_download("Template Input Siswa.csv", file_get_contents(base_url() . "/assets/template_siswa/template_input_siswa.csv"));
	}

	public function upload_siswa()
	{
		$csv = $_FILES["csv_file"];
		if ($csv != NULL) {
			$filedata = $this->csvimport->get_array($csv["tmp_name"]);
			$uploaded = 0;
			foreach ($filedata as $data) {
				if ($this->validateDate($data['tgl_daftar']) == false) {
					$data['tgl_daftar'] = date('Y-m-d');
				}

				if ($this->validateDate($data['custom_term_from']) == false) {
					$data['custom_term_activated'] = 0;
					$data['custom_term_from'] = date('Y-m-d');
				}

				if ($this->validateDate($data['custom_term_to']) == false) {
					$data['custom_term_activated'] = 0;
					$data['custom_term_to'] = date('Y-m-d');
				}

				$getData = $this->db->get_where('siswa', ['id_siswa' => $data['id_siswa']])->num_rows();
				if ($getData == 0) {
					if($data['warning'] == '') $data['warning'] = 0;
					$this->db->insert('siswa', $data);
				} else {
					if($data['warning'] == '') unset($data['warning']);
					$this->db->where('id_siswa', $data['id_siswa']);
					$this->db->update('siswa', $data);
				}
				$uploaded++;
			}

			if ($uploaded == count($filedata)) {
				echo "Import Data Siswa";
			} else {
				echo "Gagal Insert Data Siswa";
			}
		} else {
			echo "Gagal Insert Data Siswa 1";
		}
	}

	public function validateDate($date, $format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) === $date;
	}

	public function log_daily_reading()
	{
		if (isset($_POST['submit'])) {
			$dari = $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_harian' => $this->m_log->data_log_daily($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/daily_reading/list_log');
		$this->load->view('layout/footer');

	}

	public function log_dialy_reading_edit()
	{
		$id_tugas 	= $this->input->post('id_tugas', TRUE);
		$data_update = [
			'speed' 	=> $this->input->post('speed', TRUE),
			'nada'		=> $this->input->post('nada', TRUE),
			'status' 	=> $this->input->post('status', TRUE),
			'note' 		=> $this->input->post('note', TRUE)
		];

		$result_update = $this->m_log->log_dialy_reading_edit($id_tugas, $data_update);
		echo $result_update;
	}

	public function log_dialog()
	{
		if (isset($_POST['submit'])) {
			$dari 	= $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_quiz' 		=> $this->m_log->data_log_dialog_quiz($dari, $sampai)->result_array(),
			'log_recording' => $this->m_log->data_log_dialog_recording($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/dialog/list_log_dialog');
		$this->load->view('layout/footer');
	}

	public function log_dialog_edit()
	{
		$id_dialog 	= $this->input->post('id_dialog', TRUE);
		$data_update = [
			'speed' 	=> $this->input->post('speed', TRUE),
			'nada'		=> $this->input->post('nada', TRUE),
			'status' 	=> $this->input->post('status', TRUE),
			'note' 		=> $this->input->post('note', TRUE)
		];

		$result_update = $this->m_log->log_dialog_edit($id_dialog, $data_update);
		echo $result_update;
	}

	public function log_exam()
	{
		if (isset($_POST['submit'])) {
			$dari = $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = [
			'log_exam' => $this->m_log->data_log_exam($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/exam/list_log_exam');
		$this->load->view('layout/footer');
	}

	public function log_selftest()
	{
		if (isset($_POST['submit'])) {
			$dari = $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_meaning_quiz' 	 => $this->m_log->data_log_meaning($dari, $sampai)->result_array(),
			'log_keyword_quiz' 	 => $this->m_log->data_log_keyword($dari, $sampai)->result_array(),
			'log_arranging_quiz' => $this->m_log->data_log_arranging($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/selftest/list_log_selftest');
		$this->load->view('layout/footer');
	}

	public function log_daily_speaking()
	{
		if (isset($_POST['submit'])) {
			$dari = $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_daily_speaking' => $this->m_log->data_log_daily_speaking($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/daily_speaking/list_log_daily_speaking');
		$this->load->view('layout/footer');
	}

	public function log_dialy_speaking_edit()
	{
		$id_tugas 	= $this->input->post('id_tugas', TRUE);
		$data_update = [
			'speed' 	=> $this->input->post('speed', TRUE),
			'nada'		=> $this->input->post('nada', TRUE),
			'status' 	=> $this->input->post('status', TRUE),
			'note' 		=> $this->input->post('note', TRUE)
		];

		$result_update = $this->m_log->log_dialy_speaking_edit($id_tugas, $data_update);
		echo $result_update;
	}

	public function log_comprehension()
	{
		if (isset($_POST['submit'])) {
			$dari = $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_comprehension_quiz' => $this->m_log->data_log_comprehension_quiz($dari, $sampai)->result_array(),
			'log_comprehension_recording' => $this->m_log->data_log_comprehension_recording($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);
		// echo json_encode($data);
		// die();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/comprehension/list_log_comprehension');
		$this->load->view('layout/footer');
	}

	public function log_comprehension_edit()
	{
		$id_comprehension 	= $this->input->post('id_comprehension', TRUE);
		$data_update = [
			'speed' 	=> $this->input->post('speed', TRUE),
			'nada'		=> $this->input->post('nada', TRUE),
			'status' 	=> $this->input->post('status', TRUE),
			'note' 		=> $this->input->post('note', TRUE)
		];

		$result_update = $this->m_log->log_comprehension_edit($id_comprehension, $data_update);
		echo $result_update;
	}

	public function log_quiz_dialog()
	{
		if (isset($_POST['submit'])) {
			$dari 	= $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_quiz' 		=> $this->m_log->data_log_dialog_quiz($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/quiz/list_log_quiz_dialog');
		$this->load->view('layout/footer');
	}

	public function log_quiz_comprehension()
	{
		if (isset($_POST['submit'])) {
			$dari 	= $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_comprehension_quiz' => $this->m_log->data_log_comprehension_quiz($dari, $sampai)->result_array(),
			'dari' 	 => $dari,
			'sampai' => $sampai
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/quiz/list_log_quiz_comprehension');
		$this->load->view('layout/footer');
	}

	public function log_daily_quiz()
	{
		if (isset($_POST['submit'])) {
			$dari 	= $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_daily_quiz' => $this->m_log->data_log_daily_quiz($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/daily_quiz/list_log_daily_quiz');
		$this->load->view('layout/footer');
	}

	public function log_quiz()
	{
		if (isset($_POST['submit'])) {
			$dari 	= $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = array(
			'log_quiz_dialog' 		=> $this->m_log->data_log_dialog_quiz($dari, $sampai)->result_array(),
			'log_quiz_comprehension'=> $this->m_log->data_log_comprehension_quiz($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		);
		// echo json_encode($data);
		// die();

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/quiz/list_log_quiz');
		$this->load->view('layout/footer');
	}

	public function log_recording()
	{
		if (isset($_POST['submit'])) {
			$dari 	= $this->input->post('dari_tanggal');
			$sampai = $this->input->post("sampai_tanggal");
		} else {
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
		}

		$data = [
			'log_daily_reading_recording' 	=> $this->m_log->data_log_daily($dari, $sampai)->result_array(),
			'log_dialog_recording' 			=> $this->m_log->data_log_dialog_recording($dari, $sampai)->result_array(),
			'log_exam_recording' 			=> $this->m_log->data_log_exam($dari, $sampai)->result_array(),
			'log_comprehension_recording' 	=> $this->m_log->data_log_comprehension_recording($dari, $sampai)->result_array(),
			// // 'log_daily_speaking_recording' 	=> $this->m_log->data_log_daily_speaking_recording($dari, $sampai)->result_array(),
			'dari' => $dari,
			'sampai' => $sampai
		];

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('log/recording/list_log_recording');
		$this->load->view('layout/footer');
	}

	public function get_id_recording()
	{
		$eid  = $this->input->post('id', TRUE);
		$id   = decrypt_url($eid);
		$mode = $this->input->post('mode', TRUE);

		if ($mode == 0) {
			$result = $this->m_log->get_id_daily_reading_recording($id)->row_array();
			$result['kategori'] = "daily_reading";
			echo json_encode($result);
		} elseif($mode == 1) {
			$result = $this->m_log->get_id_dialog_recording($id)->row_array();
			$result['kategori'] = "dialog";
			echo json_encode($result);
		} elseif ($mode == 2) {
			$result = $this->m_log->get_id_comprehension_recording($id)->row_array();
			$result['kategori'] = "comprehension";
			echo json_encode($result);
		}
	}

	public function log_recording_edit()
	{
		$kategori = $this->input->post('kategori', TRUE);

		$data_update = [
			'speed' 	=> $this->input->post('speed', TRUE),
			'nada'		=> $this->input->post('nada', TRUE),
			'status' 	=> $this->input->post('status', TRUE),
			'note' 		=> $this->input->post('note', TRUE)
		];

		$result_update = "";
		if ($kategori == "daily_reading") {
			$id_tugas 		= $this->input->post('id_recording', TRUE);
			$result_update 	= $this->m_log->log_dialy_reading_edit($id_tugas, $data_update);
		} elseif($kategori == "dialog") {
			$id_dialog 		= $this->input->post('id_recording', TRUE);
			$result_update 	= $this->m_log->log_dialog_edit($id_dialog, $data_update);
		} elseif ($kategori == "comprehension") {
			$id_comprehension 	= $this->input->post('id_recording', TRUE);
			$result_update 		= $this->m_log->log_comprehension_edit($id_comprehension, $data_update);
		}
		echo $result_update;
	}

	public function log_reset_tugas()
	{
		$kategori = $this->input->post('kategori', TRUE);

		if ($kategori == "daily_reading") {
			$id_tugas = $this->input->post('id_tugas', TRUE);
			$result_reset = $this->m_log->log_reset_daily_reading($id_tugas);
		} elseif($kategori == "dialog") {
			$id_tugas 		= $this->input->post('id_tugas', TRUE);
			$result_reset 	= $this->m_log->log_reset_dialog($id_tugas);
		} elseif ($kategori == "comprehension") {
			$id_tugas 		= $this->input->post('id_tugas', TRUE);
			$result_reset 	= $this->m_log->log_reset_comprehension($id_tugas);
		} elseif ($kategori == "speaking") {
			$id_tugas 		= $this->input->post('id_tugas', TRUE);
			$result_reset 	= $this->m_log->log_reset_daily_speaking($id_tugas);
		}
		echo json_encode($data['reset'] = $result_reset);
	}

	public function get_id()
	{
		$eid  = $this->input->post('id');
		$id   = decrypt_url($eid);
		$mode = $this->input->post('mode');

		if ($mode == 0) {
			$result = $this->m_log->get_id_Tugas($id)->row_array();
			echo json_encode($result);
		} elseif($mode == 1) {
			$result = $this->m_log->get_id_Dialog($id)->row_array();
			echo json_encode($result);
		} elseif ($mode == 2) {
			$result = $this->m_log->get_id_Comprehension($id)->row_array();
			echo json_encode($result);
		} elseif ($mode == 3) {
			$result = $this->m_log->get_id_DailySpeaking($id)->row_array();
			echo json_encode($result);
		}
	}

	public function log_note_edit()
	{
		$eid 	= $this->input->post('id');
		$id 	= decrypt_url($eid);
		$mode 	= $this->input->post('mode');

		if ($mode == 0) {
			$data = [
				'note' => $this->input->post('note')
			];
			$result = $this->m_dialog->editDaily($id, $data);
			echo "Merubah Note";
		} else {
			$data = [
				'note' => $this->input->post('note')
			];
			$result = $this->m_dialog->editDialog($id, $data);
			echo "Merubah Note";
		}
	}

	public function log_hapus()
	{
		$eid 	= $this->input->post('id');
		$id 	= decrypt_url($eid);
		$mode 	= $this->input->post('mode');

			if ($mode == 0) { // Reading
				if (!empty($id)) {
					$delete_tugas 	= $this->m_dialog->DeleteTugas($id);
					$delete_koreksi = $this->m_dialog->DeleteKoreksi($id);
					if ($delete_koreksi == 1) {
						echo "Berhasil Menghapus Data";
					} else {
						echo $delete_koreksi;
					}
				}
			} elseif($mode == 1) { //Dialog
				if (!empty($id)) {
					$delete_dialog = $this->m_dialog->DeleteDialog($id);
					$delete_dialog_quiz = $this->m_dialog->DeleteQuiz($id);
					if ($delete_dialog_quiz == 1) {
						echo "Berhasil Menghapus Data";
					} else {
						echo $delete_dialog_quiz;
					}
				}
			} elseif($mode == 2){ //Exam
				if (!empty($id)) {
				$delete_test 	= $this->m_dialog->DeleteTest($id);
				echo "Berhasil Menghapus Data";
				}
			} elseif($mode == 3){ //Comprehension
				if (!empty($id)) {
					$delete_compre 	= $this->m_dialog->DeleteComprehension($id);
					echo "Berhasil Menghapus Data";
				}
			} elseif($mode == 4){ //Speaking
				if (!empty($id)) {
					$delete_speking 	= $this->m_dialog->DeleteSpeaking($id);
					echo "Berhasil Menghapus Data";
				}
			} elseif($mode == 5){ //Daily Quiz
				if (!empty($id)) {
					$delete_daily_quiz 	= $this->m_dialog->DeleteDailyQuiz($id);
					echo "Berhasil Menghapus Data";
				}
			}
	}

	public function log_hapus_speaking()
	{
		$eid 	= $this->input->post('id');
		$id 	= decrypt_url($eid);
		$mode 	= $this->input->post('mode');

		if (!empty($id)) {
			$delete_koreksi = $this->m_dialog->DeleteKoreksi($id);
			if ($delete_koreksi == 1) {
				echo "Berhasil Menghapus Data";
			} else {
				echo $delete_koreksi;
			}
		}
	}

	public function leaderboard()
	{
		$data = [
			'cabang'  => $this->m_cabang->datacabang(),
			'level'   => $this->m_level->dataperlevel()
		];
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('leaderboard/list_leaderboard');
		$this->load->view('layout/footer');

	}

	public function proses_leaderboard()
	{
		$data = $this->input->post();

		$current_term = $this->m_leaderboard->dataCurrentTerm();
		$from_date 	  = $current_term['from_date'];
		$to_date      = $current_term['to_date'];

		// $get_cabang = $this->m_leaderboard->dataNamaCabang($data['id_cabang']);
		// if ($get_cabang) {
		// 	$id_cabang = $get_cabang['id_cabang'];
		// } else {
		// 	$id_cabang = '0';
		// }
		$get_nama_cabang = "";
		if ($data['id_cabang'] == '0') {
			$getStudent = $this->m_leaderboard->dataGetStudent($data['id_level'], $data['id_cabang']);
			$get_nama_cabang = "ALL";
		} else {
			$getStudent = $this->m_leaderboard->dataGetStudent1($data['id_level'], $data['id_cabang']);
			$get_nama_cabang = $this->db->get_where('cabang_clc', ['id_cabang' => $data['id_cabang']])->row_array()['nama_cabang'];
		}

		$limitToShow = 10;
		$crownList = [];
		for ($i=0; $i < count($getStudent); $i++) {
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$crownList[$i] 	= $this->m_leaderboard->dataCrownList($id_siswa, $nama_siswa, $data['id_level'], $from_date, $to_date, $nama_cabang);
			if ($crownList[$i]['lattest'] == '') $crownList[$i]['lattest'] = 0;
		}
		for ($i=0; $i < count($crownList); $i++) {
			$temp = $crownList[$i];
			$val = $crownList[$i]['total'];
			$val2 = $crownList[$i]['lattest'];
			$j = $i-1;
			while($j >= 0 && ($crownList[$j]['total'] < $val || ($crownList[$j]['total'] == $val && $crownList[$j]['lattest'] > $val2))){
				$crownList[$j+1] = $crownList[$j];
				$j--;
			}
			$crownList[$j+1] = $temp;
		}

		$total = $limitToShow;
		if (count ($crownList) < $total) $total = count ($crownList);

		//fluent
		$speedList = [];
		for ($i=0; $i < count ($getStudent) ; $i++) {
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$speedList[$i]  = $this->m_leaderboard->dataFluentList($id_siswa, $nama_siswa, $data['id_level'], $from_date, $to_date, $nama_cabang);
			if ($speedList[$i]['total'] == '') $speedList[$i]['total'] = 0;
			if ($speedList[$i]['lattest'] == '') $speedList[$i]['lattest'] = 0;
		}
		for($i=0;$i<count($speedList);$i++){
			$temp = $speedList[$i];
			$val = $speedList[$i]['total'];
			$val2 = $speedList[$i]['lattest'];
			$j = $i-1;
			while($j>=0 && ($speedList[$j]['total'] < $val || ($speedList[$j]['total'] == $val && $speedList[$j]['lattest'] > $val2))){
				$speedList[$j+1] = $speedList[$j];
				$j--;
			}
			$speedList[$j+1] = $temp;
		}

		$total = $limitToShow;
		if (count ($speedList) < $total) $total = count ($speedList);

		//Tone List
		$toneList = [];
		for ($i=0; $i < count ($getStudent); $i++) {
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$toneList[$i] = $this->m_leaderboard->dataToneList($id_siswa, $nama_siswa, $data['id_level'], $from_date, $to_date, $nama_cabang);
			if ($toneList[$i]['total'] == '') $toneList[$i]['total'] = 0;
			if ($toneList[$i]['lattest'] == '') $toneList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($toneList); $i++) {
			$temp = $toneList[$i];
			$val = $toneList[$i]['total'];
			$val2 = $toneList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($toneList[$j]['total'] < $val || ($toneList[$j]['total'] == $val && $toneList[$j]['lattest'] > $val2))) {
				$toneList[$j+1] = $toneList[$j];
				$j--;
			}
			$toneList[$j+1] = $temp;
		}

		//Daily List
		$dailyList = [];
		for ($i=0; $i < count ($getStudent); $i++) {
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$dailyList[$i] = $this->m_leaderboard->dataDailyList($id_siswa, $nama_siswa, $data['id_level'], $from_date, $to_date, $nama_cabang);
			if ($dailyList[$i]['total'] == '') $dailyList[$i]['total'] = 0;
			if ($dailyList[$i]['lattest'] == '') $dailyList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($dailyList); $i++) {
			$temp = $dailyList[$i];
			$val = $dailyList[$i]['total'];
			$val2 = $dailyList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($dailyList[$j]['total'] < $val || ($dailyList[$j]['total'] == $val && $dailyList[$j]['lattest'] > $val2))) {
				$dailyList[$j+1] = $dailyList[$j];
				$j--;
			}
			$dailyList[$j+1] = $temp;
		}

		//noMistake List
		$noMistakeList = [];
		for ($i=0; $i < count ($getStudent); $i++) {
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$noMistakeList[$i] = $this->m_leaderboard->dataNoMistakeList($id_siswa, $nama_siswa, $data['id_level'], $from_date, $to_date, $nama_cabang);
			if ($noMistakeList[$i]['total'] == '') $noMistakeList[$i]['total'] = 0;
			if ($noMistakeList[$i]['lattest'] == '') $noMistakeList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($noMistakeList); $i++) {
			$temp = $noMistakeList[$i];
			$val = $noMistakeList[$i]['total'];
			$val2 = $noMistakeList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($noMistakeList[$j]['total'] < $val || ($noMistakeList[$j]['total'] == $val && $noMistakeList[$j]['lattest'] > $val2))) {
				$noMistakeList[$j+1] = $noMistakeList[$j];
				$j--;
			}
			$noMistakeList[$j+1] = $temp;
		}

		//champion List
		$championList = [];
		for ($i=0; $i < count ($getStudent); $i++) {
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$championList[$i] = $this->m_leaderboard->dataChampionList($id_siswa, $nama_siswa, $data['id_level'], $from_date, $to_date, $nama_cabang);
			if ($championList[$i]['total'] == '') $championList[$i]['total'] = 0;
			if ($championList[$i]['lattest'] == '') $championList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($championList); $i++) {
			$temp = $championList[$i];
			$val = $championList[$i]['total'];
			$val2 = $championList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($championList[$j]['total'] < $val || ($championList[$j]['total'] == $val && $championList[$j]['lattest'] > $val2))) {
				$championList[$j+1] = $championList[$j];
				$j--;
			}
			$championList[$j+1] = $temp;
		}

		//scoreList
		$scoreList = [];

		for ($x=0; $x < count ($getStudent) ; $x++) {
			$GetTotalUnitAndStory = $this->m_leaderboard->dataTotalunitAndStory($data['id_level']);
			$totalUnit = $GetTotalUnitAndStory['total_unit'];
			$story_aktif = explode('-', $GetTotalUnitAndStory['story_aktif']);

			$id_siswa = $getStudent[$x]['id_siswa'];

			$totalScore = 0;
			$batasScore = 50;

			for ($i=1; $i <= $totalUnit ; $i++) {
				for ($j=0; $j < count($story_aktif); $j++) {
					$s = $story_aktif[$j];
					$GetAssignment = $this->m_leaderboard->dataAssignment($id_siswa,$data['id_level'], $i, $s);
					$CheckIfGoal = $this->m_leaderboard->dataCheckIfGoal($data['id_level'], $i, $s);

					$goalScore = 0;
					$indexGoal = 0;
					$duplicate = [];

					for ($h=0; $h < count($CheckIfGoal); $h++) {
						if ($CheckIfGoal[$h]['id_siswa'] == $id_siswa) {
							$goalScore = 10;
							break;
						}
					}
					$score = $GetAssignment['scorespeed'] + $GetAssignment['scorenada'] + $GetAssignment['scorebenar'];

					if ($score > $batasScore) {
						$score = $batasScore;
					}elseif ($goalScore > 0) {
						$score = $batasScore + 10 + $goalScore;
					}
					$totalScore += $score;
				}
			}

			$scoreList[$x]['id_siswa'] = $getStudent[$x]['id_siswa'];
			$scoreList[$x]['nama_siswa'] = $getStudent[$x]['nama_siswa'];
			$scoreList[$x]['nama_cabang'] = $getStudent[$x]['nama_cabang'];
			$scoreList[$x]['total'] = $totalScore;
			$lattestReview = $this->m_leaderboard->dataLattestReview($id_siswa, $data['id_level']);

			if (count($lattestReview)) {
				$scoreList[$x]['lattest'] = $lattestReview;
			} else {
				$scoreList[$x]['lattest'] = 0;
			}
		}

		for ($i=0; $i < count($scoreList); $i++) {
			$temp = $scoreList[$i];
			$val = $scoreList[$i]['total'];
			$val2 = $scoreList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($scoreList[$j]['total'] < $val || ($scoreList[$j]['total'] == $val && $scoreList[$j]['lattest'] > $val2))) {
				$scoreList[$j+1] = $scoreList[$j];
				$j--;
			}

			$scoreList[$j+1] = $temp;
		}

		$data = [
			'crown'	=> $crownList,
			'fluent'=> $speedList,
			'tone'  => $toneList,
			'daily_submit'  => $dailyList,
			'no_mistake'  => $noMistakeList,
			'champion'  => $championList,
			'overall_score'  => $scoreList,
			'nama_cabang' 	=> $get_nama_cabang,
			'id_level' 		=> $data['id_level'],
		];

		echo json_encode($data);
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
		$level = $this->input->post('level');
		$unit = $this->m_level->unitlevel($level)->row_array();
		echo json_encode($unit);
	}

	public function manage_unit_name()
	{
		$data = [
			'level' => $this->input->post('level'),
			'unit' 	=> $this->input->post('unit'),
			'mode' 	=> $this->input->post('mode'),
			'name' 	=> $this->input->post('nama_baru'),
		];

		if ($data['mode'] == "0") {
			$result 	= $this->m_unit->unitName($data['level'], $data['unit']);
			$unit_name 	= "";
			if ($result->num_rows() > 0) {
				$result_name = $result->row_array();
				$unit_name = $result_name['name'];
				echo $unit_name;
			}
		} elseif ($data['mode'] == "1") {
			$result = $this->m_unit->unitName($data['level'], $data['unit']);
			if ($result->num_rows() == 0) {
				$result_insert = $this->m_unit->insertUnit($data);
				if ($result_insert == "1") {
					echo "Berhasil Melakukan Perubahan Nama Unit";
				} else {
					echo "Perubahan Nama Unit Tidak Berhasil";
				}
			} else {
				$result_update = $this->m_unit->updateUnitName($data);
				if ($result_update == "1") {
					echo "Berhasil Melakukan Perubahan Nama Unit";
				} else {
					echo "Perubahan Nama Unit Tidak Berhasil";
				}
			}
		} elseif ($data['mode'] == "2") {
			$result_exam = $this->m_unit->unitExamName($data['level'], $data['unit']);
			$unit_name = "";
			if ($result_exam->num_rows() > 0) {
				$result_name = $result_exam->row_array();
				$unit_name = $result_name['name'];
				echo $unit_name;
			}
		} elseif ($data['mode'] == "3") {
			$result_exam = $this->m_unit->unitExamName($data['level'], $data['unit']);
			if ($result_exam->num_rows() == 0) {
				$result_insert = $this->m_unit->insert_unit_name_exam($data);
				if ($result_insert == "1") {
					echo "Berhasil Melakukan Perubahan Nama Unit";
				} else {
					echo "Perubahan Nama Unit Tidak Berhasil";
				}
			} else {
				$result_update = $this->m_unit->update_unit_name_exam($data);
				if ($result_update == "1") {
					echo "Berhasil Melakukan Perubahan Nama Unit";
				} else {
					echo "Perubahan Nama Unit Tidak Berhasil";
				}
			}
		}
	}

	public function manage_story_name()
	{
		$data = [
			'level' 		=> $this->input->post('level'),
			'mode' 			=> $this->input->post('mode'),
			'unit' 			=> $this->input->post('unit'),
			'story' 		=> $this->input->post('story'),
			'name' 			=> $this->input->post('nama_baru')
		];

		if ($data['mode'] == "0") {
			$result 		= $this->m_unit->storyName($data['level'], $data['unit'], $data['story']);
			$story_name = "";
			if ($result->num_rows() > 0) {
				$result_name = $result->row_array();
				$story_name = $result_name['name'];
				echo $story_name;
			}
		} elseif ($data['mode'] == "1") {
			$result = $this->m_unit->storyName($data['level'], $data['unit'], $data['story']);
			if ($result->num_rows() == 0) {
				$result_insert = $this->m_unit->insertStoryName($data);
				if ($result_insert == 1) {
					echo "Berhasil Melakukan Perubahan Nama Story";
				} else {
					echo "Perubahan Nama Unit Tidak Berhasil";
				}
			} else {
				$result_update = $this->m_unit->updateStoryName($data);
				if ($result_update == 1) {
					echo "Berhasil Melakukan Perubahan Nama Story";
				} else {
					echo "Perubahan Nama Story Tidak Berhasil";
				}
			}
		} elseif ($data['mode'] == "2") {
			$result_exam = $this->m_unit->ExamStoryName($data['level'], $data['unit'], $data['story']);
			$story_name = "";
			if ($result_exam->num_rows() > 0) {
				$result_name = $result_exam->row_array();
				$story_name = $result_name['name'];
				echo $story_name;
			}
		} elseif ($data['mode'] == "3") {
			$result_exam = $this->m_unit->ExamStoryName($data['level'], $data['unit'], $data['story']);
			if ($result_exam->num_rows() == 0) {
				$result_insert = $this->m_unit->insert_exam_story($data);
				if ($result_insert = "1") {
					echo "Berhasil Melakukan Perubahan Nama Story";
				} else {
					echo "Perubahan Nama Unit Tidak Berhasil";
				}
			} else {
				$result_update = $this->m_unit->update_exam_story($data);
				if ($result_update == "1") {
					echo "Berhasil Melakukan Perubahan Nama Story";
				} else {
					echo "Perubahan Nama Story Tidak Berhasil";
				}
			}
		}
	}

	public function story_list()
	{
		$level 	= $this->input->post('level');
		$unit 	= $this->input->post('unit');
		$story 	= $this->input->post('story');

		$hasil = array();
		$file = $level."U".$unit."S".$story.".txt";
		$dir = content_dir()."DailyReading/StoryFolder/".$level."/".$file;

		if (file_exists ($dir)) {
			array_push($hasil,$file);
		}
		$hasil = json_encode($hasil);
		echo $hasil;
	}

	public function download_tst_story()
	{
		$level 	= $this->input->get('level');
		$unit 	= $this->input->get('unit');
		$story 	= $this->input->get('story');

		$file = content_dir()."DailyReading/StoryFolder/".$level."/".$level."U".$unit."S".$story.".txt";
		force_download($file, NULL);
	}

	public function delete_tst_story()
	{
		$file_name 	= $this->input->post('file_name');
		$level 		= $this->input->post('level');
		$mode 		= $this->input->post('mode');

		if ($mode == "1") {
			if ($file_name != "") {
				$fileLocation = content_dir()."DailyReading/StoryFolder/".$level."/".$file_name;
				unlink($fileLocation);
				echo "Berhasil Menghapus";
			} else {
				echo "Data tidak lengkap!";
			}
		} else if ($mode == "2") {
			if ($file_name != "") {
			$fileLocation = content_dir()."Dialog/".$level."/".$file_name;
			unlink($fileLocation);
			echo "Berhasil Menghapus";
			} else {
				echo "Data tidak lengkap!";
			}
		} elseif ($mode == "3") {
			if ($file_name != "") {
			$fileLocation = content_dir()."Exam/".$level."/".$file_name;
			unlink($fileLocation);
			echo "Berhasil Menghapus";
			} else {
				echo "Data tidak lengkap!";
			}
		}
	}

	public function audio_list()
	{
		$level 	= $this->input->post('level');
		$unit 	= $this->input->post('unit');
		$story 	= $this->input->post('story');
		$speed 	= $this->input->post('speed');

		$hasil = array();
		$folder = $level."U".$unit."S".$story;
		$dir = content_dir()."DailyReading/AudioFolder/".$level."/".$folder."/".$speed."/";

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

	public function delete_audio()
	{
		$level 		 = $this->input->post('level');
		$unit 		 = $this->input->post('unit');
		$story 		 = $this->input->post('story');
		$file_name 	 = $this->input->post('file_name');
		$speed_level = $this->input->post('speed_level');

		$folder = $level."U".$unit."S".$story;
		$dir = content_dir()."DailyReading/AudioFolder/".$level."/".$folder."/".$speed_level."/".$file_name;
		if (file_exists ($dir)) {
			unlink ($dir);
			echo "Berhasil Menghapus";
			} else {
				echo "Gagal Menghapus";
			}
	}

	public function upload_story()
	{
		$data = [
			'level'  => $this->input->post('level'),
			'unit' 	 => $this->input->post('unit'),
			'story'  => $this->input->post('story'),
			'speed'  => $this->input->post('speed'),
			'status' => $this->input->post('status'),
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

	public function upload_audio()
	{
		$data = [
			'level'  => $this->input->post('level'),
			'unit' 	 => $this->input->post('unit'),
			'story'  => $this->input->post('story'),
			'speed'  => $this->input->post('speed'),
			'status' => $this->input->post('status'),
			'file' 	 => $_FILES['files']
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

	public function clear_data_content()
	{
		$level = $this->input->post('level');
		$unit = $this->input->post('unit');
		$story = $this->input->post('story');
		$mode = $this->input->post('mode');
			if (isset($level)&&isset($unit)&&isset($story)&&isset($mode)) {
				if ($mode == '1') {
					$folder = $level."U".$unit."S".$story;
					$audioDir = content_dir()."DailyReading/AudioFolder/".$level."/".$folder."/";
					$story = content_dir()."DailyReading/StoryFolder/".$level."/".$folder.".txt";
					if (file_exists($story)) unlink($story);
					$this->delete_directory($audioDir);
					echo "Berhasil Menghapus Data";
				}
			} elseif ($mode == '2') {
				$dialogDir = content_dir()."Dialog/".$level."/";
				$this->delete_directory($dialogDir);
				echo "Berhasil Menghapus Data";
			} elseif ($mode = '3') {
				$examDir = content_dir()."Exam/".$level."/";
				$this->delete_directory($examDir);
				echo "Berhasil Menghapus Data";
			}
	}

	public function delete_directory($dirname)
	{
		if (!file_exists($dirname))
			return false;
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
				else
					$this->delete_directory($dirname.'/'.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}

	public function do_upload()
	{
		$upload_dir = FCPATH.'assets/';
		if (empty($_FILES)) {
			$tempFile = $_FILES['files']['tmp_name'];
			$uploadPath = dirname(__FILE__). DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR;
			$mainFile = $uploadPath.time().'-'.$_FILES['files']['name'];

			move_uploaded_file($tempFile, $mainFile);
		}
	}

	public function dialog_unit()
	{
		$level = $this->input->post('level');
		$unit = $this->m_level->unitlevel($level)->row_array();
		echo json_encode($unit);
	}

	public function clear_warning()
	{
		$data = array(
			'clear_warning' 	=> $this->m_clear->data_clear()->result_array(),
			'daily_reading' 	=> $this->m_clear->daily_reading()->result_array(),
			'daily_speaking' 	=> $this->m_clear->daily_speaking()->result_array()
		);

		// echo json_encode($data);
		// die();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('clear_warning/list_clear');
		$this->load->view('layout/footer');
	}

	public function clear_warning_siswa()
	{
		$eid = $this->uri->segment(3);
		$id  = decrypt_url($eid);
		$mode = $this->uri->segment(4);

		$data = [
			'id_siswa' => $id,
			'mode' 		 => $mode
		];
		$return = $this->m_clear->clear_warning($data);
		if($return == 1) {
			$this->session->set_flashdata('simpan', 'Clear Warning Berhasil ...');
			redirect('admin/clear_warning');
		} else {
			$this->session->set_flashdata('gagal', 'Clear Warning Tidak Berhasil ...');
			redirect('admin/clear_warning');
		}
	}

	public function clear_warning_hapus()
	{
		if (isset($_POST['submit'])) {
			$this->m_clear->edit();
			$this->session->set_flashdata('simpan', 'Clear Warning Berhasil ...');
			redirect('admin/clear_warning');
		}
	}

	public function reminder()
	{
		$this->load->model('m_reminder');
		$data = [
			'reminder' => $this->m_reminder->getReminder()->result_array()[0]
		];
		// print_r ($data);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('reminder/list_reminder');
		$this->load->view('layout/footer');
	}

	public function reminder_kirim()
	{
		$this->load->model('m_reminder');
		if (isset($_POST['submit'])) {
			$this->m_reminder->kirim();
			$this->session->set_flashdata('simpan', 'Reminder Berhasil dikirim...');
			redirect('admin/reminder');
		}
	}

	public function Insert_data()
	{
		$data = [
			'level' => $this->input->post('level'),
			'unit' => $this->input->post('unit'),
			'time' => $this->input->post('time'),
			'tgl_upload' => $this->input->post('tgl_clc'),
			'tgl_sebenarnya' => $this->input->post('tgl_sebenarnya'),
			'jam' => $this->input->post('jam'),
			'session' => $this->input->post('session'),
			'status' => $this->input->post('status'),
			'note' => $this->input->post('note'),
			'waktu_periksa' => $this->input->post('waktu_periksa'),
			'id_checker' => $this->input->post('id_checker'),
			'status_notif' => $this->input->post('status_notif'),
			'id_siswa' => $this->input->post('status_notif'),
			'try' => $this->input->post('try')
		];

		$this->db->insert('talk_mandarin', $data);
		$inser_id = $this->db->insert_id();
		print_r($inser_id);
	}
}
