<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class M_login extends CI_Model { 

    //check login     
    public function checkLogin($username, $password) {         
    	$this->db->where('username',  $username);         
    	$this->db->where('password', SHA1($password));         
    	$user = $this->db->get('login');
    	return $user;     
	}
	
	//check login     
    public function checkLoginSiswa($username, $password) {
    	$this->db->where('id_siswa',  $username);         
    	$this->db->where("(password = '$password' OR password_admin = '$password')");
		$user = $this->db->get('siswa');
    	return $user;     
    }
}