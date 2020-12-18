<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_plan_config extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('m_bank_soal');
        session();
    }

    function index()
    {
      $data = [
        'page_title' => 'Lesson Plan Config',
        'data' => $this->db->get('lesson_plan_config')->result()
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan_config/index', $data);
      $this->load->view('layout/footer');
    }

    function edit($id)
    {
      $data = [
        'page_title' => 'Edit | Lesson Plan Config',
        'data' => $this->db->get_where('lesson_plan_config', ['id' => $id])->row(),
        'level'      => $this->db->get('level')->result()

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan_config/edit', $data);
      $this->load->view('layout/footer');
    }

    function add()
    {
      $data = [
        'page_title' => 'Add | Lesson Plan Config',
        'level'      => $this->db->get('level')->result()
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan_config/add', $data);
      $this->load->view('layout/footer');
    }

    function save($id = null)
    {
      $time= $this->input->post('recording_time_limit')*1;
      $menit = ($time < 10? '0'.$time: $time);
      $data1 = [
        'code' => $this->input->post('code'),
        'label' => $this->input->post('label'),
        'recording_time_limit' => $menit,
        'total_main_unit' => $this->input->post('main_unit_total'),
        'total_extra_unit' => $this->input->post('extra_unit_total'),
        'total_extended_unit' => $this->input->post('extended_unit_total'),
        'level' => $this->input->post('level')
      ];
      $data2 = [
        'level' => $this->input->post('level'),
        'code' => $this->input->post('code'),
        'label' => $this->input->post('label')
      ];
      $param = [
        'level' => $this->input->post('level'),
        'code' => $this->input->post('code')
      ];
      // var_dump($data); exit();
      $cek = $this->db->get_where('lesson_plan_code', $param)->row();
      if($cek)
      {
        $this->db->update('lesson_plan_code', $data2, $param);
      }else {
        $this->db->insert('lesson_plan_code', $data2);
      }
      if($id != null)
      {
        $this->db->update('lesson_plan_config', $data1, ['id' => $id]);
        echo json_encode('Data berhasil diupdate.');
      }else {
        $this->db->insert('lesson_plan_config', $data1);
        echo json_encode('Data berhasil disimpan.');
      }
    }

    function save_config($id = null)
    {
      $time= $this->input->post('recording_time_limit')*1;
      $menit = ($time < 10? '0'.$time: $time);
      $data = [
        'recording_time_limit' => $menit
      ];
      if($id != null)
      {
        $this->db->update('lesson_plan_config', $data, ['id' => $id]);
        echo json_encode('Data berhasil diupdate.');
      }else {
        $this->db->insert('lesson_plan_config', $data);
        echo json_encode('Data berhasil disimpan.');
      }
    }

    function delete($id)
    {
      $this->db->delete('lesson_plan_config', ['id' => $id]);
      redirect(base_url('lesson_plan_config'));
    }
  }
