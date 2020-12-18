<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['m_app_version', 'm_current', 'm_calendar']);
		$this->load->helper('download');
		// session();
	}

	public function index()
	{
			$dari = date("Y-m-d");
			$sampai = date("Y-m-d");
			$data = [
				'daily_reading' 		=> $this->m_log->data_log_daily($dari, $sampai)->num_rows(),
				'dialog_quiz'				=> $this->m_log->data_log_dialog_quiz($dari, $sampai)->num_rows(),
				'dialog_recording'	=> $this->m_log->data_log_dialog_recording($dari, $sampai)->num_rows(),
				'exam' 							=> $this->m_log->data_log_exam($dari, $sampai)->num_rows(),
				'comprehension_quiz' 			  => $this->m_log->data_log_comprehension_quiz($dari, $sampai)->num_rows(),
				'comprehension_recording' 	=> $this->m_log->data_log_comprehension_recording($dari, $sampai)->num_rows(),
				'daily_speaking' => $this->m_log->data_log_daily_speaking($dari, $sampai)->num_rows(),
				'daily_quiz' => $this->m_log->data_log_daily_quiz($dari, $sampai)->num_rows(),
				'selftest_meaning_quiz' 	 => $this->m_log->data_log_meaning($dari, $sampai)->num_rows(),
				'selftest_keyword_quiz' 	 => $this->m_log->data_log_keyword($dari, $sampai)->num_rows(),
				'selftest_arranging_quiz'  => $this->m_log->data_log_arranging($dari, $sampai)->num_rows(),
			];
			$this->load->view('layout/header', $data);
			$this->load->view('layout/sidebar');
			$this->load->view('dashboard');
			$this->load->view('layout/footer');
    }

	public function current_term_edit()
	{
		if (isset($_POST['submit'])) {
			$this->m_current->edit();
			$this->session->set_flashdata('simpan', 'Current Term Berhasil Diedit...');
			redirect('dashboard');
		}
	}

	public function app_version_edit()
	{
		$student 		= $this->input->post('student');
		$student_ios	= $this->input->post('student_ios');
		$teacher		= $this->input->post('teacher');
		$teacher_ios	= $this->input->post('teacher_ios');
		$speaking		= $this->input->post('speaking');
		$speaking_ios	= $this->input->post('speaking_ios');

		$response = "";
		if ($student == "" || $student_ios == "" || $teacher == "" || $teacher_ios == "") {
			$response = "Harap isi data!";
		} else {
			$data = [
				'student' 		=> $student,
				'student_ios'	=> $student_ios,
				'teacher'		=> $teacher,
				'teacher_ios'	=> $teacher_ios,
				'speaking'		=> $speaking,
				'speaking_ios'	=> $speaking_ios,
			];
				$result = $this->m_app_version->updateVersion($data);
				$response = "Update Data...";
			}
			echo $response;
	}

	public function data_calendar()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		if($_POST['id'] == "NEXT"){
			if ($bulan >= 12) {
				$bulan = 1;
				$tahun++;
			} else {
				$bulan++;
			}
			$data = [
				'bulan' => $bulan,
				'tahun' => $tahun
			];
		} else if ($_POST['id'] == "PREV") {
			if ($bulan <=1) {
				$bulan = 12;
				$tahun--;
			} else {
				$bulan--;
			}

			$data = [
				'bulan' => $bulan,
				'tahun' => $tahun
			];
		}
		echo json_encode($data);
	}

	public function calendar()
    {
		if (isset($_POST['submit'])) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
		} else {
			$bulan = date('m');
			$tahun = date('Y');
		}

			$total_hari = date('t',mktime(0,0,0,$bulan,1,$tahun));
			$hariKe = 1;
			$mingguKe = 1;
			$hariKeWD = 1;
			$mingguKeWD = 1;
			$hari_pertama = date('N', mktime(0,0,0,$bulan,1,$tahun));
			$hari = [];
			$hariWD = [];
			$result = $this->m_current->dataCalendar($bulan, $tahun)->result_array();

			for ($i=0; $i < count($result) ; $i++) {
				$hariWD[$hariKeWD] = $result[$i]['clc_format'];
				$hariKeWD++;
			}

			for ($j = -$hari_pertama+1; $j < $total_hari; $j++) {
				if ($j < 0) {
					$hari[$mingguKe][$hariKe] = 0;
				} elseif ($j >= $total_hari) {
					$hari[$mingguKe][$hariKe] = 0;
				} else {
					$hari[$mingguKe][$hariKe] = $j + 1;
				}
				$hariKe++;
				if ($hariKe > 7) {
					$hariKe = 1;
					$mingguKe++;
				}
			}
			$index = 0;
			$clc_format = [];
			for ($k = 1; $k < count($hari) +1; $k++) {
				if ($hari[$k][1] != 0) {
					$tgl = $tahun."-".$bulan."-".$hari[$k][1];
					$result_tgl = $this->m_current->tgl_CLC($tgl)->row_array();
					$clc_format[$index] = $result_tgl;
					// echo $tgl."</br>";
				} else {
					$tgl = $tahun."-".$bulan."-".$hari[$k][7];
					$result_tgl = $this->m_current->tgl_CLC($tgl)->row_array();
					$clc_format[$index] = $result_tgl;
				}
				$index++;
			}
			$exp = [];
			for ($l=0; $l < count($clc_format) ; $l++) {
				$clc = $clc_format[$l]['clc_format'];
				$exp[$l] = $clc;
				$exp[$l] = explode("D", $exp[$l])[0];
			}

			$nama_bulan = date('F',mktime(0,0,0,$bulan,1,$tahun))." - ".$tahun;

			$data = [
				'hari' => $hari,
				'bulan' => $bulan,
				'tahun' => $tahun,
				'bulan_tahun' => $nama_bulan,
				'clc_format' => $exp
			];

		echo json_encode($data);
	}

	public function post_calendar_clc()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$dayofweek0 = ""; if(isset($_POST['dayofweek0']) && $_POST['dayofweek0'] != "") $dayofweek0=$_POST['dayofweek0'];
		$dayofweek1 = ""; if(isset($_POST['dayofweek1']) && $_POST['dayofweek1'] != "") $dayofweek1=$_POST['dayofweek1'];
		$dayofweek2 = ""; if(isset($_POST['dayofweek2']) && $_POST['dayofweek2'] != "") $dayofweek2=$_POST['dayofweek2'];
		$dayofweek3 = ""; if(isset($_POST['dayofweek3']) && $_POST['dayofweek3'] != "") $dayofweek3=$_POST['dayofweek3'];
		$dayofweek4 = ""; if(isset($_POST['dayofweek4']) && $_POST['dayofweek4'] != "") $dayofweek4=$_POST['dayofweek4'];
		$dayofweek5 = ""; if(isset($_POST['dayofweek5']) && $_POST['dayofweek5'] != "") $dayofweek5=$_POST['dayofweek5'];

		$days = [];
		$startOfWeek = 0;
		$startOfDate = 1;

		if ($dayofweek0 == "0") {
			array_push($days, $dayofweek1, $dayofweek2, $dayofweek3, $dayofweek4);
			$startOfWeek = 1;
			$startOfDate = (int)$dayofweek1;
		} else {
			array_push($days, $dayofweek0, $dayofweek1, $dayofweek2, $dayofweek3, $dayofweek4);
		}

		$weeks = [];
		for ($i=0; $i <= 5; $i++) {
			if(isset($_POST['week'.$i]))
				array_push($weeks, $_POST['week'.$i]);
		}

		$myWeeks = [];
		$idx = 0;
		foreach ($weeks as $w) {
			if($w != "undefined") $myWeeks[$idx] = $w;
			$idx++;
		}

		$tgl = $startOfDate;
		$insert_data = "";
		$clc_format = "";
		for ($i = $startOfWeek; $i < count($myWeeks); $i++) {
			// echo "diperulangan i = ". $i." ";
			for ($j = 1; $j <=7; $j++) {
				// echo "diperulangan i = ". $i." dan perulangan j ".$j." ";
				if ($myWeeks[$i] != "") {
					$clc_format = $myWeeks[$i]."D".$j;
				} else {
					$clc_format = "";
				}

				$indo_format = $tahun."-".$bulan."-".date('d', mktime(0,0,0, $bulan, $tgl, $tahun));
				$indo_format = strtotime($indo_format);
				$indo_format = date('Y-m-d', $indo_format);
				// echo $indo_format." - ";
				$tgl++;

				if($tgl > date('t', mktime(0,0,0,$bulan, 1, $tahun))){
					$tgl = 1;
					$bulan++;
					if ($bulan > 12) {
						$bulan = 1;
						$tahun++;
					}
				}
				// echo $clc_format;
				if($clc_format != ""){
					$cek_calendar = $this->m_calendar->cekCalendar($indo_format)->num_rows();
					// echo $cek_calendar." - ";
					if ($cek_calendar == 0) {
						$insert_data = $this->m_calendar->insertData($clc_format, $indo_format);
						if ($insert_data == 1) {
							$insert_data = "Save Data";
						}
					} else {
						$insert_data = $this->m_calendar->updateData($clc_format, $indo_format);
						if ($insert_data == 1) {
							$insert_data = "Edit Data";
						}
					}
				} else {
					$insert_data = $this->m_calendar->deleteData($indo_format);
					if ($insert_data == 1) {
						$insert_data = "Delete Data";
					}
				}
			}
		}
		echo $insert_data;
	}
}
