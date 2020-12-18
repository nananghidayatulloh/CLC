<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_bank_content extends CI_Model {
  
  public function list($data)
  {
    if($data == 'reading')
    {
      return $this->db->get_where('bank_content', ['label' => 'R']);
    }
  }

  public function getDataById($id)
  {
    return $this->db->get_where('bank_content', ['id' => $id]);
  }

  public function insert($data)
  {
    if($this->db->get_where('bank_content', ['code' => $data['code']])->num_rows() == 0) {
      return $this->db->insert('bank_content', $data);
    } else {
      return 2;
    }
  }
}