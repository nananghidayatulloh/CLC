<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('role'))
        {
            redirect(site_url(), 'login', 'refresh');
        }
    }

    public function index()
    {
        $data = [
          'page_title' => 'Menus',
          'menu' => $this->db->get('tb_menus')->result()
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('menus/index', $data);
        $this->load->view('layout/footer');
    }

    function add()
    {
      $data = [
        'page_title' => 'Add Menu'
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('menus/add', $data);
      $this->load->view('layout/footer');
    }

    function save($id = null)
    {
      $data = [
        'menu' => $this->input->post('menu'),
        'url' => $this->input->post('url'),
        'urutan' => $this->input->post('urutan'),
        'icon' => $this->input->post('icon')

      ];
      // var_dump($data); die();
      if($id == null)
      {
        $this->db->insert('tb_menus', $data);
        echo json_encode('Data saved.');
      }else {
        $this->db->update('tb_menus', $data, ['id' => $id]);
        echo json_encode('Data updated.');
      }
    }

    function edit($id)
    {
      $data = [
        'page_title' => 'Edit Menu',
        'data' => $this->db->get_where('tb_menus', ['id' => $id])->row()
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('menus/edit', $data);
      $this->load->view('layout/footer');
    }

    function delete($id)
    {
      $this->db->delete('tb_menus', ['id' => $id]);
      redirect(base_url('menus'));
    }

    function delete_sub($id, $url)
    {
      $this->db->delete('tb_sub_menu', ['id' => $id]);
      redirect(base_url('menus/sub_menu/'.$url));
    }

    function sub_menu($id)
    {
      $menu = $this->db->get_where('tb_menus', ['id' => $id])->row();
      $data = [
        'page_title' => 'Sub Menu '.$menu->menu,
        'sub_menu' => $this->db->get_where('tb_sub_menu', ['menu_id' => $id])->result()
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('menus/sub_menu', $data);
      $this->load->view('layout/footer');
    }

    function add_sub_menu($id)
    {
      $menu = $this->db->get_where('tb_menus', ['id' => $id])->row();
      $data = [
        'page_title' => 'Add Sub Menu '.$menu->menu,
        'role' => $this->db->get('tb_role')->result()
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('menus/add_sub_menu', $data);
      $this->load->view('layout/footer');
    }

    function save_sub($id = null)
    {
      $data = [
        'menu_id' => $this->input->post('menu_id'),
        'title' => $this->input->post('title'),
        'url' => $this->input->post('url'),
        'order' => $this->input->post('order'),
        'is_active' => 1,
        'role_id' => $this->input->post('role_id')
        ];
      // var_dump($data); die();
      if($id == null)
      {
        $this->db->insert('tb_sub_menu', $data);
        echo json_encode('Data saved.');
      }else {
        $this->db->update('tb_sub_menu', $data, ['id' => $id]);
        echo json_encode('Data updated.');
      }
    }

    function child_menu($id)
    {
      $menu = $this->db->get_where('tb_sub_menu', ['id' => $id])->row();
      $data = [
        'page_title' => 'Sub Sub Menu '.$menu->title,
        'child_menu' => $this->db->get_where('tb_childmenu', ['sub_id' => $id])->result()
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('menus/child_menu', $data);
      $this->load->view('layout/footer');
    }

    function add_childmenu($id)
    {
      $menu = $this->db->get_where('tb_sub_menu', ['id' => $id])->row();
      $data = [
        'page_title' => 'Add Sub Sub Menu '.$menu->title,
        'role' => $this->db->get('tb_role')->result()
            ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('menus/add_childmenu', $data);
      $this->load->view('layout/footer');
    }

    function save_childmenu($id = null)
    {
      $data = [
        'sub_id' => $this->input->post('sub_id'),
        'title' => $this->input->post('title'),
        'url' => $this->input->post('url'),
        'order' => $this->input->post('order'),
        'is_active' => 1,
        'role_id' => $this->input->post('role_id')
        ];
      // var_dump($data); die();
      if($id == null)
      {
        $this->db->insert('tb_childmenu', $data);
        echo json_encode('Data saved.');
      }else {
        $this->db->update('tb_childmenu', $data, ['id' => $id]);
        echo json_encode('Data updated.');
      }
    }



}
