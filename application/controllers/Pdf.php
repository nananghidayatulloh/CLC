<?php defined('BASEPATH') OR exit('No direct script access allowed');
        
class Pdf extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
          $this->load->library('pdf');
          $data['users']=array(
                array('firstname'=>'I am','lastname'=>'Programmer','email'=>'iam@programmer.com'),
                array('firstname'=>'I am','lastname'=>'Designer','email'=>'iam@designer.com'),
                array('firstname'=>'I am','lastname'=>'User','email'=>'iam@user.com'),
                array('firstname'=>'I am','lastname'=>'Quality Assurance','email'=>'iam@qualityassurance.com')
          );
          echo json_encode($data);
          die();
          $html = $this->load->view('table_report', '', true);
          $filename = 'report_'.time();
          $this->pdf->generate($html, $filename, true, 'A4', 'portrait');
    }

    public function testing_dompdf()
    {
      $this->load->helper(array('dompdf', 'file'));
      // page info here, db calls, etc.     
      $data['content_type'] = 'html';
      $data['session'] = 'session';
      $html = $this->load->view('welcome_message', $data, true);
      pdf_create(html_entity_decode($html), 'filename');

      // $this->load->view('welcome_message', $data);
    }

    public function testing_dompdf_i()
    {
      $this->load->helper(array('dompdf', 'file'));
      // page info here, db calls, etc.     
      $data['content_type'] = 'html';
      $data['session'] = 'session';
      $html = $this->load->view('testing_dom', $data, true);
      pdf_create((string)$html, 'filename');
    }
}