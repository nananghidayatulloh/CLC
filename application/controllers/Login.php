<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	//Fungsi konstruk
	public function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        // if (decrypt_url($this->session->userdata('token')) == 'administrator') {
        //     redirect('dashboard');
        // } else if (decrypt_url($this->session->userdata('token')) == 'siswa') {
        //     redirect('dashboard_siswa');
        // } else {
        //     redirect('login');
        // }
    }

	public function index() {
        if (decrypt_url($this->session->userdata('role')) == 1) {//superuser
            redirect('dashboard');
        } else if (decrypt_url($this->session->userdata('role')) == 5) {//Siswa
            redirect('dashboard_siswa');
        } else {
		    $this->load->view('layout/header');
		    $this->load->view('v_login');
		}
	}

	//Fungsi checkAuth
    public function checkLogin() {
        if (isset($_POST['submit'])) {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $loginUser   = $this->m_login->checkLogin($username, $password)->row_array();
            $loginSiswa  = $this->m_login->checkLoginSiswa($username, $password)->row_array();
            if (!empty($loginUser)) {
                // $loginUser['token'] = encrypt_url('admin');
                // $this->session->set_userdata($loginUser);
                // $this->session->set_flashdata('sukses', 'Anda berhasil login ...');
                // redirect('testing');
                // } else {
                    $data = [
											'role' => $loginUser['role_user'],
											'username' => $username
										];
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('sukses', 'Anda berhasil login ...');
										$access = $this->db->get('tb_acces_menu', ['role_id' => $loginUser['role_user']])->row();
										$redirect_to_menu = $this->db->get('tb_menus', ['id' => $acces->menu_id])->row();
										// var_dump($redirect_to_menu); exit();
                    if(trim($loginUser['role_user']) == 1) {
											redirect('dashboard');
                    } else {
											redirect(base_url($redirect_to_menu->url));
                    }
                // }
            } else if(!empty($loginSiswa)){
                unset($loginSiswa['password']);
                unset($loginSiswa['password_admin']);
                $_sess = [
                    'id_siswa'      => encrypt_url($loginSiswa['id_siswa']),
                    'nama_siswa'    => $loginSiswa['nama_siswa'],
                    'level'         => $loginSiswa['level'],
                    'tgl_daftar'    => $loginSiswa['tgl_daftar'],
                    'id_cabang'     => $loginSiswa['id_cabang'],
                    'id_guru'       => $loginSiswa['id_guru'],
                    'id_checker'    => $loginSiswa['id_checker'],
                    'token'         => encrypt_url('siswa')
                ];

                $this->session->set_userdata($_sess);
                $this->session->set_flashdata('sukses', 'Anda berhasil login ...');
                redirect('dashboard_siswa');
            } else {
                $this->session->set_flashdata('gagal', 'username / password kamu salah !');
                redirect();
            }

        } else {
            $this->session->set_flashdata('gagal', 'username / password kamu salah !');
            redirect();
        }
    }

    public function download_apk()
    {
        $this->load->helper(array('download'));
        force_download('assets/apk/CLCTeacher.apk',NULL);
    }

    public function signout() {
        $this->session->sess_destroy();
        // $session_logout = "Berhasil logout";
        // $this->index($session_logout);
        redirect();
    }
}
