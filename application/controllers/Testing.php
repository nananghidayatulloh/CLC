<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_level');
        session_testing();
    }

    public function index()
    {
        $session        = trim($this->session->userdata('role_user'));
        $data = [];
        
        $get = $this->m_level->datalevel()->result_array();

        if ($session == 'admin') {
            foreach($get as $array) {
                if ($array['id_level'] == 'TES_1') {
                    $data['level'][0]  = $array;
                    break;
                }
            }
        }

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('daily_reading/main/list_daily_reading_main');
		$this->load->view('layout/footer');
    }
}