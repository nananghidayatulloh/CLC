<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Previlege extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // session();
        if(!$this->session->userdata('role'))
        {
            redirect(site_url(), 'login', 'refresh');
        }
    }

    public function index()
    {
        $data = [
          'page_title' => 'Privilege',
          'role' => $this->db->get('tb_role')->result()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('previlege/index', $data);
        $this->load->view('layout/footer');
    }

    function add()
    {
      $data = [
        'page_title' => 'Add Privilege'
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('previlege/add', $data);
      $this->load->view('layout/footer');
    }

    function save($id = null)
    {
      $data = [
        'role' => $this->input->post('role')
      ];
      if($id == null)
      {
        $this->db->insert('tb_role', $data);
        echo json_encode('Data saved.');
      }else {
        $this->db->update('tb_role', $data, ['id' => $id]);
        echo json_encode('Data updated.');
      }
    }

    function edit($id)
    {
      $data = [
        'page_title' => 'Edit Privilege',
        'role' => $this->db->get_where('tb_role', ['id' => $id])->row()
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('previlege/edit', $data);
      $this->load->view('layout/footer');
    }

    function access($id)
    {
      $data = [
        'page_title' => 'Access Privilege',
        'menu' => $this->db->get('tb_menus')->result(),
        'role' => $this->db->get_where('tb_role', ['id' => $id])->row()
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('previlege/access', $data);
      $this->load->view('layout/footer');
    }

    function save_access()
    {
      $akses = $this->input->post('access[]');
      // var_dump($this->input->post('access_serial[]')); die();
      $this->db->delete('tb_acces_menu', ['role_id' => $this->input->post('role_id')]);
      for ($i=0; $i < count($akses); $i++) {
      $data = [
        'role_id' => $this->input->post('role_id'),
        'menu_id' => $akses[$i]
      ];
      $this->db->insert('tb_acces_menu', $data);
    }

    $this->db->update('tb_role', ['access' => serialize($this->input->post('access_serial[]'))], ['id' => $this->input->post('role_id')]);
    echo json_encode('Data Saved.');
    }





}
