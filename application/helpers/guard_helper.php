<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

	function encrypt_url($string) {
		
		$output = false;

		$guard				= parse_ini_file("guard.ini");
		$guard_key			= $guard["encryption_key"];
		$guard_iv			= $guard["iv"];
		$encrypt_method		= $guard["encryption_mechanism"];

		$key  	= hash("sha256", $guard_key);

		$iv     = substr(hash("sha256", $guard_iv), 0, 16);

		$result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($result);
		return $output;
	}

	function decrypt_url($string) {
		
		$output = false;

		$guard				= parse_ini_file("guard.ini");
		$guard_key			= $guard["encryption_key"];
		$guard_iv			= $guard["iv"];
		$encrypt_method		= $guard["encryption_mechanism"];

		$key  	= hash("sha256", $guard_key);

		$iv     = substr(hash("sha256", $guard_iv), 0, 16);

		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		return $output;
	}