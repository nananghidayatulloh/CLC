<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  function session_testing()
  {
    $CI = & get_instance();
    $session = $CI->session->userdata('token');
    if (decrypt_url($session) == 'admin') {
      return TRUE;
    } else {
      redirect(site_url(), 'login', 'refresh');
    }
  }

  function session()
  {
    $ci = & get_instance();
    $session = $ci->session->userdata('role');
    if(!$ci->session->userdata('role'))
    {
        redirect(site_url(), 'login', 'refresh');
    }

  }

  function session_siswa()
  {
    $CI =& get_instance();
    $session = $CI->session->userdata('token');
    if (decrypt_url($session) == 'siswa') {
      return TRUE;
    } else {
      redirect(site_url(), 'login', 'refresh');
    }
  }

  function session_quiz()
  {
    $CI =& get_instance();
    if($CI->session->userdata('kamus')) {

      // redirect(site_url(),'dashboard_siswa', 'refresh');
    } else {
      return FALSE;
    }
  }

  function getGuru($id_guru)
  {
    $CI =& get_instance();
    $ambil = $CI->db->get_where('guru', ['id_guru' => $id_guru])->row_array();
    return $ambil['nama_guru'];
  }

  function getNamaCabang($id_cabang)
  {
    $CI =& get_instance();
    $ambil = $CI->db->get_where('cabang_clc', ['id_cabang' => $id_cabang])->row_array();
    return $ambil['nama_cabang'];
  }

  function content_dir()
  {
	  return "../Content/";
  }

  function assignment_dir()
  {
		return "../Assignment/";
	}

  function content_url()
  {
    $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url .= "://" . $_SERVER['HTTP_HOST']."/clc_mandarin_ci/Content/";
		return $base_url;
	}

  function assignment_url()
  {
		$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url .= "://" . $_SERVER['HTTP_HOST']."/clc_mandarin_ci/Assignment/";
		return $base_url;
  }

  function delete_directory($dirname)
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
              delete_directory($dirname.'/'.$file);
          }
      }
      closedir($dir_handle);
      rmdir($dirname);
      return true;
  }

  function GetArrayIndexBasedOnKeyAndValue ($array, $key, $value) {
		$index = -1;
		for ($i=0; $i < count($array); $i++) {
			if ($array[$i][$key] == $value) {
				$index = $i;
				break;
			}
		}

		return $index;
  }

  function getCalendarClc($date)
  {
    $CI =& get_instance();
    return $CI->db->get_where('calendar', ['indo_format' => $date])->row_array()['clc_format'];
  }

  function getNamaSiswa($id_siswa)
  {
    $CI =& get_instance();
    return $CI->db->get_where('siswa', ['id_siswa' => $id_siswa])->row_array()['nama_siswa'];
  }

  function getIdSiswa($nama_siswa)
  {
    $CI =& get_instance();
    return $CI->db->get_where('siswa', ['nama_siswa' => $nama_siswa])->row_array()['id_siswa'];
  }

  function getNameSubject($subject, $level)
  {
    $CI =& get_instance();
    return $CI->db->get_where('selftest_subject', ['subject' => $subject, 'level' => $level])->row_array()['name'];
  }

  function getNameUnit($subject, $unit)
  {
    $CI =& get_instance();
    return $CI->db->get_where('selftest_unit', ['subject' => $subject, 'unit' => $unit])->row_array()['name'];
  }

  function setListPertanyaan()
  {
    $CI =& get_instance();
    $array_pertanyaan   = $CI->session->userdata('kamus_list_pertanyaan');
    return $array_pertanyaan;
    die();
    $list_pertanyaan = [];
    $no = 0;
    foreach($array_pertanyaan as $pertanyaan) {
        foreach($pertanyaan as $tanya) {
            $list_pertanyaan[$no] = $tanya;
            $no++;
        }
    }

    return $list_pertanyaan;
  }

  function setDataInsert($data, $try, $time, $content_type, $result_sistem_data)
  {
    $jumlah_soal = $result_sistem_data['jumlah_benar'] + $result_sistem_data['jumlah_salah'];
    $data_insert = [
      'level'              => $data['level'],
      'subject'            => $data['subject'],
      'unit'               => $data['unit'],
      'id_siswa'           => $data['id_siswa'],
      'try'                => $try,
      'time'               => $time,
      'jumlah_salah'       => $result_sistem_data['jumlah_salah'],
      'jumlah_benar'       => $result_sistem_data['jumlah_benar'],
      'jawaban_benar'      => $result_sistem_data['array_jawaban_benar'],
      'jawaban_salah'      => $result_sistem_data['array_jawaban_salah'],
      'jawaban_sebenarnya' => $result_sistem_data['array_jawaban_sebenarnya'],
      'completion'         => round($result_sistem_data['jumlah_benar'] / $jumlah_soal * 100),
      'tgl_upload'         => getCalendarClc(date('Y-m-d')),
      'tgl_sebenarnya'     => date('Y-m-d'),
      'jam'                => date('H:i'),
      'session'            => $data['id_siswa']."_".$data['level']."_SELFTEST_".$content_type."_".$data['mode']."_S".$data['subject']."_U".$data['unit']."_try(".$try.")"."_".str_replace(' ', '_', date('d-m-Y H:i:s A')),
      'mode'               => $data['mode'],
    ];

    return $data_insert;
  }

  function setDataInsertArranging($data, $try, $time, $content_type, $result_sistem_data)
  {
    $jumlah_soal = $result_sistem_data['jumlah_benar'] + $result_sistem_data['jumlah_salah'];
    $data_insert = [
      'level'              => $data['level'],
      'subject'            => $data['subject'],
      'unit'               => $data['unit'],
      'id_siswa'           => $data['id_siswa'],
      'try'                => $try,
      'time'               => $time,
      'jumlah_salah'       => $result_sistem_data['jumlah_salah'],
      'jumlah_benar'       => $result_sistem_data['jumlah_benar'],
      'jawaban_sebenarnya' => $result_sistem_data['array_koreksi'],
      'completion'         => round($result_sistem_data['jumlah_benar'] / $jumlah_soal * 100),
      'tgl_upload'         => getCalendarClc(date('Y-m-d')),
      'tgl_sebenarnya'     => date('Y-m-d'),
      'jam'                => date('H:i'),
      'session'            => $data['id_siswa']."_".$data['level']."_SELFTEST_".$content_type."_".$data['mode']."_S".$data['subject']."_U".$data['unit']."_try(".$try.")"."_".str_replace(' ', '_', date('d-m-Y H:i:s A')),
      'mode'               => $data['mode'],
    ];

    return $data_insert;
  }

  function getContentConfig($level, $subject)
  {
    $CI =& get_instance();
    $result = $CI->db->get_where('selftest_content_config', ['level' => $level, 'subject' => $subject])->row_array()['content_type'];
    return $result;
  }

  function tcpdf()
  {
    require_once('tcpdf/config/lang/eng.php');
    require_once('tcpdf/tcpdf.php');
  }

  function getSiswaDailyActive ($id_siswa) {
    $CI =& get_instance();

    $results = array();
    $currentTerm = getSiswaTerm($id_siswa);

    $totalDayInATerm = abs(strtotime($currentTerm['from_date']) - strtotime($currentTerm['to_date']));
    $totalDayInATerm = $totalDayInATerm/86400;
    $totalDayInATerm = intval($totalDayInATerm);

    $totalDayPassed = abs(strtotime($currentTerm['from_date']) - strtotime(date('Y-m-d')));
    $totalDayPassed = $totalDayPassed/86400;
    $totalDayPassed = intval($totalDayPassed + 1);

    $totalDayUpload = $CI->db->query ("SELECT DISTINCT date FROM daily_upload_counter, siswa WHERE daily_upload_counter.id_siswa = '$id_siswa' AND siswa.id_siswa = '$id_siswa' AND daily_upload_counter.level = siswa.level AND date >= '$currentTerm[from_date]' GROUP BY date")->num_rows();

    $totalDayMaintenance = 0;
        $maintenanceTracker = $CI->db->query("SELECT * FROM maintenance_tracker")->result_array();
        if (count($maintenanceTracker) > 0) {
          $totalDayMaintenance = $maintenanceTracker[0]['maintenance_days'];
        }

        $totalDayPassed -= $totalDayMaintenance;
        if ($totalDayUpload > $totalDayPassed) $totalDayUpload = $totalDayPassed;

    $results["record"] = $totalDayUpload;
    $results["total_day"] = $totalDayPassed;
    $results["percentage"] = round(($totalDayUpload * 100/$totalDayPassed), 1);

    return $results;
  }

  function getSiswaTerm ($id_siswa) {
    $CI =& get_instance();

    $currentTerm = $CI->db->query("SELECT * FROM current_term")->result_array()[0];
    $dataSiswa = $CI->db->query("SELECT * FROM siswa WHERE id_siswa = '$id_siswa'")->result_array();
    $results = array();
    $results['from_date'] = $currentTerm['from_date'];
    $results['to_date'] = $currentTerm['to_date'];
    if (count($dataSiswa) > 0) {
      if ($dataSiswa[0]['custom_term_activated'] > 0) {
        $results['from_date'] = $dataSiswa[0]['custom_term_from'];
        $results['to_date'] = $dataSiswa[0]['custom_term_to'];
      }
    }

    return $results;
  }

  function getCustomeActiveSubject($id_siswa)
  {
    $CI =& get_instance();
    return $CI->db->get_where('siswa', ['id_siswa' => $id_siswa]);
  }

  function getProdukName($id_siswa)
  {
    $CI =& get_instance();
    return $CI->db->get_where('siswa', ['id_siswa' => $id_siswa])->row_array()['produk_name'];
  }

  function getClassName($id_siswa)
  {
    $CI =& get_instance();
    return $CI->db->get_where('siswa', ['id_siswa' => $id_siswa])->row_array()['class_name'];
  }

  function preg($string) {
    $string = str_replace(' ', '_', $string);
    $string = str_replace('/', '', $string);
    $preg = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

    if ($preg == NULL || $preg == '') {
      $data = $string;
    } else {
      $data = $preg;
    }
    return $data;
  }
