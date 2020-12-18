<?php defined('BASEPATH') or exit('No direct script access allowed');

class Leaderboard extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		// $this->load->model(['m_app_version', 'm_template', 'm_unit', 'm_current', 'm_dialog', 'm_administrator']);
		session();
    }

    public function index()
    {
        redirect('leaderboard/leaderboard_dailyreading');
    }
    
    public function leaderboard_dailyreading()
	{
		$data = [
			'cabang'  => $this->m_cabang->datacabang(),
			'level'   => $this->m_level->dataperlevel()
		];
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('leaderboard/list_leaderboard_dailyreading');
		$this->load->view('layout/footer');
		
	}

    public function proses_leaderboard_dailyreading()
	{
		$idCabang 	= $this->input->post('id_cabang');
		$idLevel 	= $this->input->post('id_level');

		$current_term = $this->m_leaderboard->dataCurrentTerm();
		$from_date 	  = $current_term['from_date'];
		$to_date      = $current_term['to_date'];
		
		$get_nama_cabang = "";
		if ($idCabang == '0') {
			$getStudent = $this->m_leaderboard->data_get_student($idLevel, $idCabang)->result_array();
			$get_nama_cabang = "ALL";
		} else {
			$getStudent = $this->m_leaderboard->data_get_student_by_id($idLevel, $idCabang)->result_array();
			$get_nama_cabang = $this->db->get_where('cabang_clc', ['id_cabang' => $idCabang])->row_array()['nama_cabang'];
		}

        $limitToShow = count($getStudent);
        
		$crownList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$crownList[$i] 	= $this->m_leaderboard->data_crown_list($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($crownList[$i]['lattest'] == '') $crownList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($crownList); $i++) { 
			$temp = $crownList[$i];
			$val = $crownList[$i]['total'];
			$val2 = $crownList[$i]['lattest'];
			$j = $i-1;
			while($j >= 0 && ($crownList[$j]['total'] < $val || ($crownList[$j]['total'] == $val && $crownList[$j]['lattest'] > $val2))){
				$crownList[$j+1] = $crownList[$j];
				$j--;
			}
			$crownList[$j+1] = $temp;
		}

        $total = $limitToShow;
        $results = [];

        if (count ($crownList) < $total) $total = count ($crownList);
        for($i = 0; $i < $total; $i++){
            if ($crownList[$i]['total'] != '0') {
                $results['data_crown_list'][$i]['id_siswa'] = $crownList[$i]['id_siswa'];
                $results['data_crown_list'][$i]['nama_siswa'] = $crownList[$i]['nama_siswa'];
                $results['data_crown_list'][$i]['nama_cabang'] = $crownList[$i]['nama_cabang'];
                $results['data_crown_list'][$i]['total'] = $crownList[$i]['total'];
            }
		}
		
        //fluent
		$speedList = [];
		for ($i=0; $i < count ($getStudent) ; $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$speedList[$i]  = $this->m_leaderboard->data_fluent_list($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($speedList[$i]['total'] == '') $speedList[$i]['total'] = 0;
			if ($speedList[$i]['lattest'] == '') $speedList[$i]['lattest'] = 0;
		}

		for($i=0;$i<count($speedList);$i++){
			$temp = $speedList[$i];
			$val = $speedList[$i]['total'];
			$val2 = $speedList[$i]['lattest'];
			$j = $i-1;
			while($j>=0 && ($speedList[$j]['total'] < $val || ($speedList[$j]['total'] == $val && $speedList[$j]['lattest'] > $val2))){
				$speedList[$j+1] = $speedList[$j];
				$j--;
			}
			$speedList[$j+1] = $temp;
        }
        
        if (count ($speedList) < $total) $total = count ($speedList);
        for($i=0;$i<$total;$i++){
            if ($speedList[$i]['total'] != '0') {
                $results['data_fluent_list'][$i]['id_siswa'] = $speedList[$i]['id_siswa'];
                $results['data_fluent_list'][$i]['nama_siswa'] = $speedList[$i]['nama_siswa'];
                $results['data_fluent_list'][$i]['nama_cabang'] = $speedList[$i]['nama_cabang'];
                $results['data_fluent_list'][$i]['total'] = $speedList[$i]['total'];
            }
        }
        
        //Tone List
        $toneList = [];
        for ($i=0; $i < count ($getStudent); $i++) { 
            $id_siswa = $getStudent[$i]['id_siswa'];
            $nama_siswa = $getStudent[$i]['nama_siswa'];
            $nama_cabang = $getStudent[$i]['nama_cabang'];
            $toneList[$i] = $this->m_leaderboard->data_tone_list($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
            if ($toneList[$i]['total'] == '') $toneList[$i]['total'] = 0;
            if ($toneList[$i]['lattest'] == '') $toneList[$i]['lattest'] = 0;
        }

        for ($i=0; $i < count($toneList); $i++) { 
            $temp = $toneList[$i];
            $val = $toneList[$i]['total'];
            $val2 = $toneList[$i]['lattest'];
            $j = $i-1;
            while ($j >= 0 && ($toneList[$j]['total'] < $val || ($toneList[$j]['total'] == $val && $toneList[$j]['lattest'] > $val2))) {
                $toneList[$j+1] = $toneList[$j];
                $j--;
            }
            $toneList[$j+1] = $temp;
        }

        if (count ($toneList) < $total) $total = count ($toneList);
        for($i=0; $i < $total; $i++){
            if ($toneList[$i]['total'] != '0') {
                $results['data_tone_list'][$i]['id_siswa'] = $toneList[$i]['id_siswa'];
                $results['data_tone_list'][$i]['nama_siswa'] = $toneList[$i]['nama_siswa'];
                $results['data_tone_list'][$i]['nama_cabang'] = $toneList[$i]['nama_cabang'];
                $results['data_tone_list'][$i]['total'] = $toneList[$i]['total'];
            }
        }

        //Daily List
        $dailyList = [];
        for ($i=0; $i < count ($getStudent); $i++) { 
            $id_siswa     = $getStudent[$i]['id_siswa'];
            $nama_siswa   = $getStudent[$i]['nama_siswa'];
            $nama_cabang  = $getStudent[$i]['nama_cabang'];
            $data_tanggal = [];

            //Get tanggal upload Daily Reading
            $data_daily_reading = $this->m_leaderboard->data_daily_reading($id_siswa, $idLevel, $from_date)->result_array();		

            //Get tanggal upload Dialog
            $data_dialog 		= $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

            //Get tanggal upload Comprehension
            $data_comprehension = $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

            //Daftarkan tanggal dan jam
            foreach ($data_daily_reading as $data) {
                if (count($data) > 0)							
                    array_push($data_tanggal, $data);
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_dialog as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_comprehension as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Sorting data_tanggal
			for($k=0;$k<count($data_tanggal);$k++){
				$temp = $data_tanggal[$k];
				$val = $data_tanggal[$k]['tgl_sebenarnya'];							
				$j = $k-1;
				while($j>=0 && $data_tanggal[$j]['tgl_sebenarnya'] < $val){
					$data_tanggal[$j+1] = $data_tanggal[$j];
					$j--;
				}
				$data_tanggal[$j+1] = $temp;
			}

			$totalPoint = 0;
			$totalCombo = 0;
			$lastDate = "";
			$earliest = "";

			foreach ($data_tanggal as $d) {
				if ($d['tgl_sebenarnya'] != $lastDate)
					$totalPoint++;

				$earliest = $d['earliest'];
				
				if ($lastDate != "") {
					$datediff = strtotime($d['tgl_sebenarnya']) - strtotime($lastDate);
					$dayDiff = round($datediff / (60 * 60 * 24));

					if ($dayDiff == 1) {
						$totalCombo++;
					} else if ($dayDiff > 1) {
						$totalCombo = 0;
					}

					if ($totalCombo >= 2) {
						$totalPoint += 5;
						$totalCombo = 0;
						$lastDate = "";
					}
				} 

				$lastDate = $d['tgl_sebenarnya'];						
			}
				$dailyList[$i]['id_siswa'] = $id_siswa;
				$dailyList[$i]['nama_siswa'] = $nama_siswa;
				$dailyList[$i]['nama_cabang'] = $nama_cabang;
				$dailyList[$i]['total'] = $totalPoint;
				$dailyList[$i]['earliest'] = $earliest;

				if ($dailyList[$i]['total'] == '') $dailyList[$i]['total'] = 0;
				if ($dailyList[$i]['earliest'] == '') $dailyList[$i]['earliest'] = "99:99";

		}
		
		//Sort based on total and lattest entry
		for($i=0; $i < count($dailyList); $i++){
			$temp = $dailyList[$i];
			$val = $dailyList[$i]['total'];
			$val2 = $dailyList[$i]['earliest'];
			$j = $i-1;
			while($j>=0 && ($dailyList[$j]['total'] < $val || ($dailyList[$j]['total'] == $val && $dailyList[$j]['earliest'] < $val2))){
				$dailyList[$j+1] = $dailyList[$j];
				$j--;
			}
			$dailyList[$j+1] = $temp;
		}

		if (count ($dailyList) < $total) $total = count ($dailyList);
        for($i=0; $i < $total; $i++){
            if ($dailyList[$i]['total'] != '0') {
                $results['data_daily_submit_list'][$i]['id_siswa'] = $dailyList[$i]['id_siswa'];
                $results['data_daily_submit_list'][$i]['nama_siswa'] = $dailyList[$i]['nama_siswa'];
                $results['data_daily_submit_list'][$i]['nama_cabang'] = $dailyList[$i]['nama_cabang'];
                $results['data_daily_submit_list'][$i]['total'] = $dailyList[$i]['total'];
            }
		}
		
		//noMistake List
		$noMistakeList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$noMistakeList[$i] = $this->m_leaderboard->data_no_mistake_list($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($noMistakeList[$i]['total'] == '') $noMistakeList[$i]['total'] = 0;
			if ($noMistakeList[$i]['lattest'] == '') $noMistakeList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($noMistakeList); $i++) { 
			$temp = $noMistakeList[$i];
			$val = $noMistakeList[$i]['total'];
			$val2 = $noMistakeList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($noMistakeList[$j]['total'] < $val || ($noMistakeList[$j]['total'] == $val && $noMistakeList[$j]['lattest'] > $val2))) {
				$noMistakeList[$j+1] = $noMistakeList[$j];
				$j--;
			}
			$noMistakeList[$j+1] = $temp;
		}

		if (count ($noMistakeList) < $total) $total = count ($noMistakeList);
        for($i=0; $i < $total; $i++){
            if ($noMistakeList[$i]['total'] != '0') {
                $results['data_no_mistake_list'][$i]['id_siswa'] = $noMistakeList[$i]['id_siswa'];
                $results['data_no_mistake_list'][$i]['nama_siswa'] = $noMistakeList[$i]['nama_siswa'];
                $results['data_no_mistake_list'][$i]['nama_cabang'] = $noMistakeList[$i]['nama_cabang'];
                $results['data_no_mistake_list'][$i]['total'] = $noMistakeList[$i]['total'];
            }
		}
		
		//champion List
		$championList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$championList[$i] = $this->m_leaderboard->data_champion_list($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($championList[$i]['total'] == '') $championList[$i]['total'] = 0;
			if ($championList[$i]['lattest'] == '') $championList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($championList); $i++) { 
			$temp = $championList[$i];
			$val = $championList[$i]['total'];
			$val2 = $championList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($championList[$j]['total'] < $val || ($championList[$j]['total'] == $val && $championList[$j]['lattest'] > $val2))) {
				$championList[$j+1] = $championList[$j];
				$j--;
			}
			$championList[$j+1] = $temp;
		}

		if (count ($championList) < $total) $total = count ($championList);
        for($i=0; $i < $total; $i++){
            if ($championList[$i]['total'] != '0') {
                $results['data_champion_list'][$i]['id_siswa'] = $championList[$i]['id_siswa'];
                $results['data_champion_list'][$i]['nama_siswa'] = $championList[$i]['nama_siswa'];
                $results['data_champion_list'][$i]['nama_cabang'] = $championList[$i]['nama_cabang'];
                $results['data_champion_list'][$i]['total'] = $championList[$i]['total'];
            }
		}

		//Daily Active
		$dailyActiveList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$getTotalDayUpload = $this->m_leaderboard->data_dailyActive_list($id_siswa, $idLevel, $from_date)->result_array();

			if (count($getTotalDayUpload) > 0) {
				$totalDayUpload = $getTotalDayUpload[0]['total'];
				$ld = $getTotalDayUpload[0]['last_date'];
				$lt = $getTotalDayUpload[0]['time'];

				$totalDayInATerm = abs(strtotime($from_date) - strtotime($to_date));
				$totalDayInATerm = $totalDayInATerm/86400;				
				$totalDayInATerm = intval($totalDayInATerm);
				
				
				$totalDayPassed = abs(strtotime($from_date) - strtotime(date('Y-m-d')));
				$totalDayPassed = $totalDayPassed/86400;				
				$totalDayPassed = intval($totalDayPassed + 1);
				
				$totalDayMaintenance = 0;
				$maintenanceTracker = $this->m_leaderboard->getDataMaintenance()->result_array();

				
				if(count($maintenanceTracker) > 0) $totalDayMaintenance = $maintenanceTracker[0]['maintenance_days'];

				
				$totalDayPassed -= $totalDayMaintenance;
				if ($totalDayUpload > $totalDayPassed) $totalDayUpload = $totalDayPassed;
				
				$totalPoint = round(($totalDayUpload * 100/$totalDayPassed), 1);
				$earliest = $ld." ".$lt;

			}
			
			$dailyActiveList[$i]['id_siswa'] = $id_siswa;
			$dailyActiveList[$i]['nama_siswa'] = $nama_siswa;
			$dailyActiveList[$i]['nama_cabang'] = $nama_cabang;
			$dailyActiveList[$i]['total'] = $totalPoint."%";
			$dailyActiveList[$i]['earliest'] = $earliest;

			if ($dailyActiveList[$i]['total'] == '') $dailyActiveList[$i]['total'] = 0;
			if ($dailyActiveList[$i]['earliest'] == '') $dailyActiveList[$i]['earliest'] = "99:99";
		}

		
		for ($i=0; $i < count($dailyActiveList); $i++) { 
			$temp = $dailyActiveList[$i];
			$val = $dailyActiveList[$i]['total'];
			$val2 = $dailyActiveList[$i]['earliest'];
			$j = $i-1;
			while ($j >= 0 && ((float)$dailyActiveList[$j]['total'] < (float)$val || ((float)$dailyActiveList[$j]['total'] == (float)$val && $dailyActiveList[$j]['earliest'] > $val2))) {
				$dailyActiveList[$j+1] = $dailyActiveList[$j];
				$j--;
			}
			$dailyActiveList[$j+1] = $temp;
		}

		if (count ($dailyActiveList) < $total) $total = count ($dailyActiveList);
        for($i=0; $i < $total; $i++){
            if ($dailyActiveList[$i]['total'] != '0%') {
                $results['data_daily_active_list'][$i]['id_siswa'] = $dailyActiveList[$i]['id_siswa'];
                $results['data_daily_active_list'][$i]['nama_siswa'] = $dailyActiveList[$i]['nama_siswa'];
                $results['data_daily_active_list'][$i]['nama_cabang'] = $dailyActiveList[$i]['nama_cabang'];
                $results['data_daily_active_list'][$i]['total'] = $dailyActiveList[$i]['total'];
            }
		}

        $data = [
            'crown'	        => (isset($results['data_crown_list'])) ? $results['data_crown_list'] : array(),
            'fluent'	    => (isset($results['data_fluent_list'])) ? $results['data_fluent_list'] : array(),
            'tone'	        => (isset($results['data_tone_list'])) ? $results['data_tone_list'] : array(),
            'daily_submit'	=> (isset($results['data_daily_submit_list'])) ? $results['data_daily_submit_list'] : array(),
            'no_mistake'	=> (isset($results['data_no_mistake_list'])) ? $results['data_no_mistake_list'] : array(),
            'champion'		=> (isset($results['data_champion_list'])) ? $results['data_champion_list'] : array(),
            'daily_active'	=> (isset($results['data_daily_active_list'])) ? $results['data_daily_active_list'] : array(),
            'nama_cabang' 	=> $get_nama_cabang,
            'id_level' 		=> $idLevel,
        ];

        echo json_encode($data);
	}

	public function leaderboard_dailyreading_extended()
	{
		$data = [
			'cabang'  => $this->m_cabang->datacabang(),
			'level'   => $this->m_level->dataperlevel()
		];
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('leaderboard/list_leaderboard_dailyreading_extended');
		$this->load->view('layout/footer');
	}

	public function proses_leaderboard_dailyreading_extended()
	{
		$idCabang 	= $this->input->post('id_cabang');
		$idLevel 	= $this->input->post('id_level');

		$current_term = $this->m_leaderboard->dataCurrentTerm();
		$from_date 	  = $current_term['from_date'];
		$to_date      = $current_term['to_date'];
		
		$get_nama_cabang = "";
		if ($idCabang == '0') {
			$getStudent = $this->m_leaderboard->data_get_student($idLevel, $idCabang)->result_array();
			$get_nama_cabang = "ALL";
		} else {
			$getStudent = $this->m_leaderboard->data_get_student_by_id($idLevel, $idCabang)->result_array();
			$get_nama_cabang = $this->db->get_where('cabang_clc', ['id_cabang' => $idCabang])->row_array()['nama_cabang'];
		}

		$limitToShow = count($getStudent);
		
		$crownList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$crownList[$i] 	= $this->m_leaderboard->data_crown_list_extended($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($crownList[$i]['lattest'] == '') $crownList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($crownList); $i++) { 
			$temp = $crownList[$i];
			$val = $crownList[$i]['total'];
			$val2 = $crownList[$i]['lattest'];
			$j = $i-1;
			while($j >= 0 && ($crownList[$j]['total'] < $val || ($crownList[$j]['total'] == $val && $crownList[$j]['lattest'] > $val2))){
				$crownList[$j+1] = $crownList[$j];
				$j--;
			}
			$crownList[$j+1] = $temp;
		}

        $total = $limitToShow;
        $results = [];

        if (count ($crownList) < $total) $total = count ($crownList);
        for($i = 0; $i < $total; $i++){
            if ($crownList[$i]['total'] != '0') {
                $results['data_crown_list'][$i]['id_siswa'] = $crownList[$i]['id_siswa'];
                $results['data_crown_list'][$i]['nama_siswa'] = $crownList[$i]['nama_siswa'];
                $results['data_crown_list'][$i]['nama_cabang'] = $crownList[$i]['nama_cabang'];
                $results['data_crown_list'][$i]['total'] = $crownList[$i]['total'];
            }
		}
		
        //fluent
		$speedList = [];
		for ($i=0; $i < count ($getStudent) ; $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$speedList[$i]  = $this->m_leaderboard->data_fluent_list_extended($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($speedList[$i]['total'] == '') $speedList[$i]['total'] = 0;
			if ($speedList[$i]['lattest'] == '') $speedList[$i]['lattest'] = 0;
		}

		for($i=0;$i<count($speedList);$i++){
			$temp = $speedList[$i];
			$val = $speedList[$i]['total'];
			$val2 = $speedList[$i]['lattest'];
			$j = $i-1;
			while($j>=0 && ($speedList[$j]['total'] < $val || ($speedList[$j]['total'] == $val && $speedList[$j]['lattest'] > $val2))){
				$speedList[$j+1] = $speedList[$j];
				$j--;
			}
			$speedList[$j+1] = $temp;
        }
        
        if (count ($speedList) < $total) $total = count ($speedList);
        for($i=0;$i<$total;$i++){
            if ($speedList[$i]['total'] != '0') {
                $results['data_fluent_list'][$i]['id_siswa'] = $speedList[$i]['id_siswa'];
                $results['data_fluent_list'][$i]['nama_siswa'] = $speedList[$i]['nama_siswa'];
                $results['data_fluent_list'][$i]['nama_cabang'] = $speedList[$i]['nama_cabang'];
                $results['data_fluent_list'][$i]['total'] = $speedList[$i]['total'];
            }
        }
        
        //Tone List
        $toneList = [];
        for ($i=0; $i < count ($getStudent); $i++) { 
            $id_siswa = $getStudent[$i]['id_siswa'];
            $nama_siswa = $getStudent[$i]['nama_siswa'];
            $nama_cabang = $getStudent[$i]['nama_cabang'];
            $toneList[$i] = $this->m_leaderboard->data_tone_list_extended($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
            if ($toneList[$i]['total'] == '') $toneList[$i]['total'] = 0;
            if ($toneList[$i]['lattest'] == '') $toneList[$i]['lattest'] = 0;
        }

        for ($i=0; $i < count($toneList); $i++) { 
            $temp = $toneList[$i];
            $val = $toneList[$i]['total'];
            $val2 = $toneList[$i]['lattest'];
            $j = $i-1;
            while ($j >= 0 && ($toneList[$j]['total'] < $val || ($toneList[$j]['total'] == $val && $toneList[$j]['lattest'] > $val2))) {
                $toneList[$j+1] = $toneList[$j];
                $j--;
            }
            $toneList[$j+1] = $temp;
        }

        if (count ($toneList) < $total) $total = count ($toneList);
        for($i=0; $i < $total; $i++){
            if ($toneList[$i]['total'] != '0') {
                $results['data_tone_list'][$i]['id_siswa'] = $toneList[$i]['id_siswa'];
                $results['data_tone_list'][$i]['nama_siswa'] = $toneList[$i]['nama_siswa'];
                $results['data_tone_list'][$i]['nama_cabang'] = $toneList[$i]['nama_cabang'];
                $results['data_tone_list'][$i]['total'] = $toneList[$i]['total'];
            }
		}

		//Daily List
		$dailyList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa     = $getStudent[$i]['id_siswa'];
			$nama_siswa   = $getStudent[$i]['nama_siswa'];
			$nama_cabang  = $getStudent[$i]['nama_cabang'];
			$data_tanggal = [];

			//Get tanggal upload Daily Reading
			$data_daily_reading = $this->m_leaderboard->data_daily_reading($id_siswa, $idLevel, $from_date)->result_array();		

			//Get tanggal upload Dialog
			$data_dialog 		= $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

			//Get tanggal upload Comprehension
			$data_comprehension = $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

			//Daftarkan tanggal dan jam
			foreach ($data_daily_reading as $data) {
				if (count($data) > 0)							
					array_push($data_tanggal, $data);
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_dialog as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_comprehension as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Sorting data_tanggal
			for($k=0;$k<count($data_tanggal);$k++){
				$temp = $data_tanggal[$k];
				$val = $data_tanggal[$k]['tgl_sebenarnya'];							
				$j = $k-1;
				while($j>=0 && $data_tanggal[$j]['tgl_sebenarnya'] < $val){
					$data_tanggal[$j+1] = $data_tanggal[$j];
					$j--;
				}
				$data_tanggal[$j+1] = $temp;
			}

			$totalPoint = 0;
			$totalCombo = 0;
			$lastDate = "";
			$earliest = "";

			foreach ($data_tanggal as $d) {
				if ($d['tgl_sebenarnya'] != $lastDate)
					$totalPoint++;

				$earliest = $d['earliest'];
				
				if ($lastDate != "") {
					$datediff = strtotime($d['tgl_sebenarnya']) - strtotime($lastDate);
					$dayDiff = round($datediff / (60 * 60 * 24));

					if ($dayDiff == 1) {
						$totalCombo++;
					} else if ($dayDiff > 1) {
						$totalCombo = 0;
					}

					if ($totalCombo >= 2) {
						$totalPoint += 5;
						$totalCombo = 0;
						$lastDate = "";
					}
				} 

				$lastDate = $d['tgl_sebenarnya'];						
			}
				$dailyList[$i]['id_siswa'] = $id_siswa;
				$dailyList[$i]['nama_siswa'] = $nama_siswa;
				$dailyList[$i]['nama_cabang'] = $nama_cabang;
				$dailyList[$i]['total'] = $totalPoint;
				$dailyList[$i]['earliest'] = $earliest;

				if ($dailyList[$i]['total'] == '') $dailyList[$i]['total'] = 0;
				if ($dailyList[$i]['earliest'] == '') $dailyList[$i]['earliest'] = "99:99";

		}
		
		//Sort based on total and lattest entry
		for($i=0; $i < count($dailyList); $i++){
			$temp = $dailyList[$i];
			$val = $dailyList[$i]['total'];
			$val2 = $dailyList[$i]['earliest'];
			$j = $i-1;
			while($j>=0 && ($dailyList[$j]['total'] < $val || ($dailyList[$j]['total'] == $val && $dailyList[$j]['earliest'] < $val2))){
				$dailyList[$j+1] = $dailyList[$j];
				$j--;
			}
			$dailyList[$j+1] = $temp;
		}

		if (count ($dailyList) < $total) $total = count ($dailyList);
		for($i=0; $i < $total; $i++){
			if ($dailyList[$i]['total'] != '0') {
				$results['data_daily_submit_list'][$i]['id_siswa'] = $dailyList[$i]['id_siswa'];
				$results['data_daily_submit_list'][$i]['nama_siswa'] = $dailyList[$i]['nama_siswa'];
				$results['data_daily_submit_list'][$i]['nama_cabang'] = $dailyList[$i]['nama_cabang'];
				$results['data_daily_submit_list'][$i]['total'] = $dailyList[$i]['total'];
			}
		}
		
		//noMistake List
		$noMistakeList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$noMistakeList[$i] = $this->m_leaderboard->data_no_mistake_list_extended($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($noMistakeList[$i]['total'] == '') $noMistakeList[$i]['total'] = 0;
			if ($noMistakeList[$i]['lattest'] == '') $noMistakeList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($noMistakeList); $i++) { 
			$temp = $noMistakeList[$i];
			$val = $noMistakeList[$i]['total'];
			$val2 = $noMistakeList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($noMistakeList[$j]['total'] < $val || ($noMistakeList[$j]['total'] == $val && $noMistakeList[$j]['lattest'] > $val2))) {
				$noMistakeList[$j+1] = $noMistakeList[$j];
				$j--;
			}
			$noMistakeList[$j+1] = $temp;
		}

		if (count ($noMistakeList) < $total) $total = count ($noMistakeList);
		for($i=0; $i < $total; $i++){
			if ($noMistakeList[$i]['total'] != '0') {
				$results['data_no_mistake_list'][$i]['id_siswa'] = $noMistakeList[$i]['id_siswa'];
				$results['data_no_mistake_list'][$i]['nama_siswa'] = $noMistakeList[$i]['nama_siswa'];
				$results['data_no_mistake_list'][$i]['nama_cabang'] = $noMistakeList[$i]['nama_cabang'];
				$results['data_no_mistake_list'][$i]['total'] = $noMistakeList[$i]['total'];
			}
		}
		
		//champion List
		$championList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$championList[$i] = $this->m_leaderboard->data_champion_list_extended($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($championList[$i]['total'] == '') $championList[$i]['total'] = 0;
			if ($championList[$i]['lattest'] == '') $championList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($championList); $i++) { 
			$temp = $championList[$i];
			$val = $championList[$i]['total'];
			$val2 = $championList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($championList[$j]['total'] < $val || ($championList[$j]['total'] == $val && $championList[$j]['lattest'] > $val2))) {
				$championList[$j+1] = $championList[$j];
				$j--;
			}
			$championList[$j+1] = $temp;
		}

		if (count ($championList) < $total) $total = count ($championList);
		for($i=0; $i < $total; $i++){
			if ($championList[$i]['total'] != '0') {
				$results['data_champion_list'][$i]['id_siswa'] = $championList[$i]['id_siswa'];
				$results['data_champion_list'][$i]['nama_siswa'] = $championList[$i]['nama_siswa'];
				$results['data_champion_list'][$i]['nama_cabang'] = $championList[$i]['nama_cabang'];
				$results['data_champion_list'][$i]['total'] = $championList[$i]['total'];
			}
		}

		//Daily Active
		$dailyActiveList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$getTotalDayUpload = $this->m_leaderboard->data_dailyActive_list($id_siswa, $idLevel, $from_date)->result_array();

			if (count($getTotalDayUpload) > 0) {
				$totalDayUpload = $getTotalDayUpload[0]['total'];
				$ld = $getTotalDayUpload[0]['last_date'];
				$lt = $getTotalDayUpload[0]['time'];

				$totalDayInATerm = abs(strtotime($from_date) - strtotime($to_date));
				$totalDayInATerm = $totalDayInATerm/86400;				
				$totalDayInATerm = intval($totalDayInATerm);
				
				
				$totalDayPassed = abs(strtotime($from_date) - strtotime(date('Y-m-d')));
				$totalDayPassed = $totalDayPassed/86400;				
				$totalDayPassed = intval($totalDayPassed + 1);
				
				$totalDayMaintenance = 0;
				$maintenanceTracker = $this->m_leaderboard->getDataMaintenance()->result_array();

				
				if(count($maintenanceTracker) > 0) $totalDayMaintenance = $maintenanceTracker[0]['maintenance_days'];

				
				$totalDayPassed -= $totalDayMaintenance;
				if ($totalDayUpload > $totalDayPassed) $totalDayUpload = $totalDayPassed;
				
				$totalPoint = round(($totalDayUpload * 100/$totalDayPassed), 1);
				$earliest = $ld." ".$lt;

			}
			
			$dailyActiveList[$i]['id_siswa'] = $id_siswa;
			$dailyActiveList[$i]['nama_siswa'] = $nama_siswa;
			$dailyActiveList[$i]['nama_cabang'] = $nama_cabang;
			$dailyActiveList[$i]['total'] = $totalPoint."%";
			$dailyActiveList[$i]['earliest'] = $earliest;

			if ($dailyActiveList[$i]['total'] == '') $dailyActiveList[$i]['total'] = 0;
			if ($dailyActiveList[$i]['earliest'] == '') $dailyActiveList[$i]['earliest'] = "99:99";
		}

		
		for ($i=0; $i < count($dailyActiveList); $i++) { 
			$temp = $dailyActiveList[$i];
			$val = $dailyActiveList[$i]['total'];
			$val2 = $dailyActiveList[$i]['earliest'];
			$j = $i-1;
			while ($j >= 0 && ((float)$dailyActiveList[$j]['total'] < (float)$val || ((float)$dailyActiveList[$j]['total'] == (float)$val && $dailyActiveList[$j]['earliest'] > $val2))) {
				$dailyActiveList[$j+1] = $dailyActiveList[$j];
				$j--;
			}
			$dailyActiveList[$j+1] = $temp;
		}

		if (count ($dailyActiveList) < $total) $total = count ($dailyActiveList);
        for($i=0; $i < $total; $i++){
            if ($dailyActiveList[$i]['total'] != '0%') {
                $results['data_daily_active_list'][$i]['id_siswa'] = $dailyActiveList[$i]['id_siswa'];
                $results['data_daily_active_list'][$i]['nama_siswa'] = $dailyActiveList[$i]['nama_siswa'];
                $results['data_daily_active_list'][$i]['nama_cabang'] = $dailyActiveList[$i]['nama_cabang'];
                $results['data_daily_active_list'][$i]['total'] = $dailyActiveList[$i]['total'];
            }
		}

		$data = [
            'crown'	        => (isset($results['data_crown_list'])) ? $results['data_crown_list'] : array(),
            'fluent'	    => (isset($results['data_fluent_list'])) ? $results['data_fluent_list'] : array(),
            'tone'	        => (isset($results['data_tone_list'])) ? $results['data_tone_list'] : array(),
            'daily_submit'	=> (isset($results['data_daily_submit_list'])) ? $results['data_daily_submit_list'] : array(),
            'no_mistake'	=> (isset($results['data_no_mistake_list'])) ? $results['data_no_mistake_list'] : array(),
            'champion'		=> (isset($results['data_champion_list'])) ? $results['data_champion_list'] : array(),
            'daily_active'	=> (isset($results['data_daily_active_list'])) ? $results['data_daily_active_list'] : array(),
            'nama_cabang' 	=> $get_nama_cabang,
            'id_level' 		=> $idLevel,
        ];

		echo json_encode($data);
	}

	public function leaderboard_dialog()
	{
		$data = [
			'cabang'  => $this->m_cabang->datacabang(),
			'level'   => $this->m_level->dataperlevel()
		];
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('leaderboard/list_leaderboard_dialog');
		$this->load->view('layout/footer');
		
	}

	public function proses_leaderboard_dialog()
	{
		$idCabang 	= $this->input->post('id_cabang');
		$idLevel 	= $this->input->post('id_level');

		$current_term = $this->m_leaderboard->dataCurrentTerm();
		$from_date 	  = $current_term['from_date'];
		$to_date      = $current_term['to_date'];
		
		$get_nama_cabang = "";
		if ($idCabang == '0') {
			$getStudent = $this->m_leaderboard->data_get_student($idLevel, $idCabang)->result_array();
			$get_nama_cabang = "ALL";
		} else {
			$getStudent = $this->m_leaderboard->data_get_student_by_id($idLevel, $idCabang)->result_array();
			$get_nama_cabang = $this->db->get_where('cabang_clc', ['id_cabang' => $idCabang])->row_array()['nama_cabang'];
		}

		$limitToShow = count($getStudent);
		
		$crownList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$goalData 		= $this->m_leaderboard->data_crown_list_dialog($id_siswa, $idLevel, $from_date)->result_array();

			$totalCrown = 0;
			$lattest = 0;
			if(count($goalData) > 0) {
				$totalGoal = 1;
				$lastDialogNumber = "";
				foreach ($goalData as $gd) {
					if ($gd['dialog_number'] == $lastDialogNumber) {
						$totalGoal++;
					} else {
						$totalGoal = 1;
					}
					if ($totalGoal > 1) {
						$totalCrown++;
					}

					$lastDialogNumber = $gd['dialog_number'];
					$lattest = $gd['lattest'];
				}
			}

			$crownList[$i]['id_siswa'] = $id_siswa;
			$crownList[$i]['nama_siswa'] = $nama_siswa;
			$crownList[$i]['nama_cabang'] = $nama_cabang;
			$crownList[$i]['total'] = $totalCrown; 
			$crownList[$i]['lattest'] = $lattest;
		}

		for ($i=0; $i < count($crownList); $i++) { 
			$temp = $crownList[$i];
			$val = $crownList[$i]['total'];
			$val2 = $crownList[$i]['lattest'];
			$j = $i-1;
			while($j >= 0 && ($crownList[$j]['total'] < $val || ($crownList[$j]['total'] == $val && $crownList[$j]['lattest'] > $val2))){
				$crownList[$j+1] = $crownList[$j];
				$j--;
			}
			$crownList[$j+1] = $temp;
		}

        $total = $limitToShow;
        $results = [];

        if (count ($crownList) < $total) $total = count ($crownList);
        for($i = 0; $i < $total; $i++){
            if ($crownList[$i]['total'] != '0') {
                $results['data_crown_list_dialog'][$i]['id_siswa'] = $crownList[$i]['id_siswa'];
                $results['data_crown_list_dialog'][$i]['nama_siswa'] = $crownList[$i]['nama_siswa'];
                $results['data_crown_list_dialog'][$i]['nama_cabang'] = $crownList[$i]['nama_cabang'];
                $results['data_crown_list_dialog'][$i]['total'] = $crownList[$i]['total'];
            }
		}

        //fluent
		$speedList = [];
		for ($i=0; $i < count ($getStudent) ; $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$speedList[$i]  = $this->m_leaderboard->data_fluent_list_dialog($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($speedList[$i]['total'] == '') $speedList[$i]['total'] = 0;
			if ($speedList[$i]['lattest'] == '') $speedList[$i]['lattest'] = 0;
		}

		for($i=0;$i<count($speedList);$i++){
			$temp = $speedList[$i];
			$val = $speedList[$i]['total'];
			$val2 = $speedList[$i]['lattest'];
			$j = $i-1;
			while($j>=0 && ($speedList[$j]['total'] < $val || ($speedList[$j]['total'] == $val && $speedList[$j]['lattest'] > $val2))){
				$speedList[$j+1] = $speedList[$j];
				$j--;
			}
			$speedList[$j+1] = $temp;
        }
        
        if (count ($speedList) < $total) $total = count ($speedList);
        for($i=0;$i<$total;$i++){
            if ($speedList[$i]['total'] != '0') {
                $results['data_fluent_list_dialog'][$i]['id_siswa'] = $speedList[$i]['id_siswa'];
                $results['data_fluent_list_dialog'][$i]['nama_siswa'] = $speedList[$i]['nama_siswa'];
                $results['data_fluent_list_dialog'][$i]['nama_cabang'] = $speedList[$i]['nama_cabang'];
                $results['data_fluent_list_dialog'][$i]['total'] = $speedList[$i]['total'];
            }
        }
        
        //Tone List
        $toneList = [];
        for ($i=0; $i < count ($getStudent); $i++) { 
            $id_siswa = $getStudent[$i]['id_siswa'];
            $nama_siswa = $getStudent[$i]['nama_siswa'];
            $nama_cabang = $getStudent[$i]['nama_cabang'];
            $toneList[$i] = $this->m_leaderboard->data_tone_list_dialog($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
            if ($toneList[$i]['total'] == '') $toneList[$i]['total'] = 0;
            if ($toneList[$i]['lattest'] == '') $toneList[$i]['lattest'] = 0;
        }

        for ($i=0; $i < count($toneList); $i++) { 
            $temp = $toneList[$i];
            $val = $toneList[$i]['total'];
            $val2 = $toneList[$i]['lattest'];
            $j = $i-1;
            while ($j >= 0 && ($toneList[$j]['total'] < $val || ($toneList[$j]['total'] == $val && $toneList[$j]['lattest'] > $val2))) {
                $toneList[$j+1] = $toneList[$j];
                $j--;
            }
            $toneList[$j+1] = $temp;
        }

        if (count ($toneList) < $total) $total = count ($toneList);
        for($i=0; $i < $total; $i++){
            if ($toneList[$i]['total'] != '0') {
                $results['data_tone_list_dialog'][$i]['id_siswa'] = $toneList[$i]['id_siswa'];
                $results['data_tone_list_dialog'][$i]['nama_siswa'] = $toneList[$i]['nama_siswa'];
                $results['data_tone_list_dialog'][$i]['nama_cabang'] = $toneList[$i]['nama_cabang'];
                $results['data_tone_list_dialog'][$i]['total'] = $toneList[$i]['total'];
            }
		}

		//Daily List
		$dailyList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa     = $getStudent[$i]['id_siswa'];
			$nama_siswa   = $getStudent[$i]['nama_siswa'];
			$nama_cabang  = $getStudent[$i]['nama_cabang'];
			$data_tanggal = [];

			//Get tanggal upload Daily Reading
			$data_daily_reading = $this->m_leaderboard->data_daily_reading($id_siswa, $idLevel, $from_date)->result_array();		

			//Get tanggal upload Dialog
			$data_dialog 		= $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

			//Get tanggal upload Comprehension
			$data_comprehension = $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

			//Daftarkan tanggal dan jam
			foreach ($data_daily_reading as $data) {
				if (count($data) > 0)							
					array_push($data_tanggal, $data);
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_dialog as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_comprehension as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Sorting data_tanggal
			for($k=0;$k<count($data_tanggal);$k++){
				$temp = $data_tanggal[$k];
				$val = $data_tanggal[$k]['tgl_sebenarnya'];							
				$j = $k-1;
				while($j>=0 && $data_tanggal[$j]['tgl_sebenarnya'] < $val){
					$data_tanggal[$j+1] = $data_tanggal[$j];
					$j--;
				}
				$data_tanggal[$j+1] = $temp;
			}

			$totalPoint = 0;
			$totalCombo = 0;
			$lastDate = "";
			$earliest = "";

			foreach ($data_tanggal as $d) {
				if ($d['tgl_sebenarnya'] != $lastDate)
					$totalPoint++;

				$earliest = $d['earliest'];
				
				if ($lastDate != "") {
					$datediff = strtotime($d['tgl_sebenarnya']) - strtotime($lastDate);
					$dayDiff = round($datediff / (60 * 60 * 24));

					if ($dayDiff == 1) {
						$totalCombo++;
					} else if ($dayDiff > 1) {
						$totalCombo = 0;
					}

					if ($totalCombo >= 2) {
						$totalPoint += 5;
						$totalCombo = 0;
						$lastDate = "";
					}
				} 

				$lastDate = $d['tgl_sebenarnya'];						
			}
				$dailyList[$i]['id_siswa'] = $id_siswa;
				$dailyList[$i]['nama_siswa'] = $nama_siswa;
				$dailyList[$i]['nama_cabang'] = $nama_cabang;
				$dailyList[$i]['total'] = $totalPoint;
				$dailyList[$i]['earliest'] = $earliest;

				if ($dailyList[$i]['total'] == '') $dailyList[$i]['total'] = 0;
				if ($dailyList[$i]['earliest'] == '') $dailyList[$i]['earliest'] = "99:99";

		}
		
		//Sort based on total and lattest entry
		for($i=0; $i < count($dailyList); $i++){
			$temp = $dailyList[$i];
			$val = $dailyList[$i]['total'];
			$val2 = $dailyList[$i]['earliest'];
			$j = $i-1;
			while($j>=0 && ($dailyList[$j]['total'] < $val || ($dailyList[$j]['total'] == $val && $dailyList[$j]['earliest'] < $val2))){
				$dailyList[$j+1] = $dailyList[$j];
				$j--;
			}
			$dailyList[$j+1] = $temp;
		}

		if (count ($dailyList) < $total) $total = count ($dailyList);
		for($i=0; $i < $total; $i++){
			if ($dailyList[$i]['total'] != '0') {
				$results['data_daily_submit_list'][$i]['id_siswa'] = $dailyList[$i]['id_siswa'];
				$results['data_daily_submit_list'][$i]['nama_siswa'] = $dailyList[$i]['nama_siswa'];
				$results['data_daily_submit_list'][$i]['nama_cabang'] = $dailyList[$i]['nama_cabang'];
				$results['data_daily_submit_list'][$i]['total'] = $dailyList[$i]['total'];
			}
		}
		
		//noMistake List
		$noMistakeList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$noMistakeList[$i] = $this->m_leaderboard->data_no_mistake_list_dialog($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($noMistakeList[$i]['total'] == '') $noMistakeList[$i]['total'] = 0;
			if ($noMistakeList[$i]['lattest'] == '') $noMistakeList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($noMistakeList); $i++) { 
			$temp = $noMistakeList[$i];
			$val = $noMistakeList[$i]['total'];
			$val2 = $noMistakeList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($noMistakeList[$j]['total'] < $val || ($noMistakeList[$j]['total'] == $val && $noMistakeList[$j]['lattest'] > $val2))) {
				$noMistakeList[$j+1] = $noMistakeList[$j];
				$j--;
			}
			$noMistakeList[$j+1] = $temp;
		}

		if (count ($noMistakeList) < $total) $total = count ($noMistakeList);
		for($i=0; $i < $total; $i++){
			if ($noMistakeList[$i]['total'] != '0') {
				$results['data_no_mistake_list_dialog'][$i]['id_siswa'] = $noMistakeList[$i]['id_siswa'];
				$results['data_no_mistake_list_dialog'][$i]['nama_siswa'] = $noMistakeList[$i]['nama_siswa'];
				$results['data_no_mistake_list_dialog'][$i]['nama_cabang'] = $noMistakeList[$i]['nama_cabang'];
				$results['data_no_mistake_list_dialog'][$i]['total'] = $noMistakeList[$i]['total'];
			}
		}
		
		//QUIZ PASS
		$quizPassList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];

			$dialogQuizData = $this->db->select('*')->from('dialog_quiz')->where(['id_siswa' => $id_siswa, 'level' => $idLevel])->order_by('tgl_sebenarnya', 'asc')->get()->result_array();
			$totalPass = 0;
			$lattest = 0;
			$currentCheckDate = [];				
			foreach ($dialogQuizData as $dq) {
				if (!isset($currentCheckDate[$dq['id_dialog']])) $currentCheckDate[$dq['id_dialog']] = "";
				if ($currentCheckDate[$dq['id_dialog']] != $dq['tgl_sebenarnya']) {
					$currentCheckDate[$dq['id_dialog']] = $dq['tgl_sebenarnya'];
					
					if ($dq['completion'] == 100) {
						$totalPass++;
						$lattest = $dq['id_quiz'];
					}
				}					
			}

			$quizPassList[$i]['id_siswa'] = $id_siswa;
			$quizPassList[$i]['nama_siswa'] = $nama_siswa;
			$quizPassList[$i]['nama_cabang'] = $nama_cabang;
			$quizPassList[$i]['total'] = $totalPass;
			$quizPassList[$i]['lattest'] = $lattest;
		}

		//Sort based on total and lattest entry
		for($i=0;$i<count($quizPassList);$i++){
			$temp = $quizPassList[$i];
			$val = $quizPassList[$i]['total'];
			$val2 = $quizPassList[$i]['lattest'];
			$j = $i-1;
			while($j>=0 && ($quizPassList[$j]['total'] < $val || ($quizPassList[$j]['total'] == $val && $quizPassList[$j]['lattest'] > $val2))){
				$quizPassList[$j+1] = $quizPassList[$j];
				$j--;
			}
			$quizPassList[$j+1] = $temp;
		}

		if (count ($quizPassList) < $total) $total = count ($quizPassList);
		for($i=0; $i < $total; $i++){
			if ($quizPassList[$i]['total'] != '0') {
				$results['data_quiz_pass_list_dialog'][$i]['id_siswa'] = $quizPassList[$i]['id_siswa'];
				$results['data_quiz_pass_list_dialog'][$i]['nama_siswa'] = $quizPassList[$i]['nama_siswa'];
				$results['data_quiz_pass_list_dialog'][$i]['nama_cabang'] = $quizPassList[$i]['nama_cabang'];
				$results['data_quiz_pass_list_dialog'][$i]['total'] = $quizPassList[$i]['total'];
			}
		}

		//Daily Active
		$dailyActiveList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$getTotalDayUpload = $this->m_leaderboard->data_dailyActive_list($id_siswa, $idLevel, $from_date)->result_array();

			if (count($getTotalDayUpload) > 0) {
				$totalDayUpload = $getTotalDayUpload[0]['total'];
				$ld = $getTotalDayUpload[0]['last_date'];
				$lt = $getTotalDayUpload[0]['time'];

				$totalDayInATerm = abs(strtotime($from_date) - strtotime($to_date));
				$totalDayInATerm = $totalDayInATerm/86400;				
				$totalDayInATerm = intval($totalDayInATerm);
				
				
				$totalDayPassed = abs(strtotime($from_date) - strtotime(date('Y-m-d')));
				$totalDayPassed = $totalDayPassed/86400;				
				$totalDayPassed = intval($totalDayPassed + 1);
				
				$totalDayMaintenance = 0;
				$maintenanceTracker = $this->m_leaderboard->getDataMaintenance()->result_array();

				
				if(count($maintenanceTracker) > 0) $totalDayMaintenance = $maintenanceTracker[0]['maintenance_days'];

				
				$totalDayPassed -= $totalDayMaintenance;
				if ($totalDayUpload > $totalDayPassed) $totalDayUpload = $totalDayPassed;
				
				$totalPoint = round(($totalDayUpload * 100/$totalDayPassed), 1);
				$earliest = $ld." ".$lt;

			}
			
			$dailyActiveList[$i]['id_siswa'] = $id_siswa;
			$dailyActiveList[$i]['nama_siswa'] = $nama_siswa;
			$dailyActiveList[$i]['nama_cabang'] = $nama_cabang;
			$dailyActiveList[$i]['total'] = $totalPoint."%";
			$dailyActiveList[$i]['earliest'] = $earliest;

			if ($dailyActiveList[$i]['total'] == '') $dailyActiveList[$i]['total'] = 0;
			if ($dailyActiveList[$i]['earliest'] == '') $dailyActiveList[$i]['earliest'] = "99:99";
		}

		
		for ($i=0; $i < count($dailyActiveList); $i++) { 
			$temp = $dailyActiveList[$i];
			$val = $dailyActiveList[$i]['total'];
			$val2 = $dailyActiveList[$i]['earliest'];
			$j = $i-1;
			while ($j >= 0 && ((float)$dailyActiveList[$j]['total'] < (float)$val || ((float)$dailyActiveList[$j]['total'] == (float)$val && $dailyActiveList[$j]['earliest'] > $val2))) {
				$dailyActiveList[$j+1] = $dailyActiveList[$j];
				$j--;
			}
			$dailyActiveList[$j+1] = $temp;
		}

		if (count ($dailyActiveList) < $total) $total = count ($dailyActiveList);
        for($i=0; $i < $total; $i++){
            if ($dailyActiveList[$i]['total'] != '0%') {
                $results['data_daily_active_list'][$i]['id_siswa'] = $dailyActiveList[$i]['id_siswa'];
                $results['data_daily_active_list'][$i]['nama_siswa'] = $dailyActiveList[$i]['nama_siswa'];
                $results['data_daily_active_list'][$i]['nama_cabang'] = $dailyActiveList[$i]['nama_cabang'];
                $results['data_daily_active_list'][$i]['total'] = $dailyActiveList[$i]['total'];
            }
		}

		$data = [
            'crown'	        => (isset($results['data_crown_list_dialog'])) ? $results['data_crown_list_dialog'] : array(),
            'fluent'	    => (isset($results['data_fluent_list_dialog'])) ? $results['data_fluent_list_dialog'] : array(),
            'tone'	        => (isset($results['data_tone_list_dialog'])) ? $results['data_tone_list_dialog'] : array(),
            'daily_submit'	=> (isset($results['data_daily_submit_list'])) ? $results['data_daily_submit_list'] : array(),
            'no_mistake'	=> (isset($results['data_no_mistake_list_dialog'])) ? $results['data_no_mistake_list_dialog'] : array(),
            'quiz_pass'		=> (isset($results['data_quiz_pass_list_dialog'])) ? $results['data_quiz_pass_list_dialog'] : array(),
            'daily_active'	=> (isset($results['data_daily_active_list'])) ? $results['data_daily_active_list'] : array(),
            'nama_cabang' 	=> $get_nama_cabang,
            'id_level' 		=> $idLevel,
        ];

		echo json_encode($data);
	}

	public function leaderboard_comprehension()
	{
		$data = [
			'cabang'  => $this->m_cabang->datacabang(),
			'level'   => $this->m_level->dataperlevel()
		];
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar');
		$this->load->view('leaderboard/list_leaderboard_comprehension');
		$this->load->view('layout/footer');
		
	}

	public function proses_leaderboard_comprehension()
	{
		$idCabang 	= $this->input->post('id_cabang');
		$idLevel 	= $this->input->post('id_level');

		$current_term = $this->m_leaderboard->dataCurrentTerm();
		$from_date 	  = $current_term['from_date'];
		$to_date      = $current_term['to_date'];
		
		$get_nama_cabang = "";
		if ($idCabang == '0') {
			$getStudent = $this->m_leaderboard->data_get_student($idLevel, $idCabang)->result_array();
			$get_nama_cabang = "ALL";
		} else {
			$getStudent = $this->m_leaderboard->data_get_student_by_id($idLevel, $idCabang)->result_array();
			$get_nama_cabang = $this->db->get_where('cabang_clc', ['id_cabang' => $idCabang])->row_array()['nama_cabang'];
		}

		$limitToShow = count($getStudent);
		
		$crownList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$goalData 		= $this->m_leaderboard->data_crown_list_comprehension($id_siswa, $idLevel, $from_date)->result_array();

			$totalCrown = 0;
			$lattest = 0;
			if(count($goalData) > 0) {
				$totalGoal = 1;
				$lastComprehensionNumber = "";
				foreach ($goalData as $gd) {
					if ($gd['comprehension_number'] == $lastComprehensionNumber) {
						$totalGoal++;
					} else {
						$totalGoal = 1;
					}
					if ($totalGoal > 1) {
						$totalCrown++;
					}

					$lastComprehensionNumber = $gd['comprehension_number'];
					$lattest = $gd['lattest'];
				}
			}

			$crownList[$i]['id_siswa'] = $id_siswa;
			$crownList[$i]['nama_siswa'] = $nama_siswa;
			$crownList[$i]['nama_cabang'] = $nama_cabang;
			$crownList[$i]['total'] = $totalCrown; 
			$crownList[$i]['lattest'] = $lattest;
		}

		for ($i=0; $i < count($crownList); $i++) { 
			$temp = $crownList[$i];
			$val = $crownList[$i]['total'];
			$val2 = $crownList[$i]['lattest'];
			$j = $i-1;
			while($j >= 0 && ($crownList[$j]['total'] < $val || ($crownList[$j]['total'] == $val && $crownList[$j]['lattest'] > $val2))){
				$crownList[$j+1] = $crownList[$j];
				$j--;
			}
			$crownList[$j+1] = $temp;
		}

        $total = $limitToShow;
        $results = [];

        if (count ($crownList) < $total) $total = count ($crownList);
        for($i = 0; $i < $total; $i++){
            if ($crownList[$i]['total'] != '0') {
                $results['data_crown_list_comprehension'][$i]['id_siswa'] = $crownList[$i]['id_siswa'];
                $results['data_crown_list_comprehension'][$i]['nama_siswa'] = $crownList[$i]['nama_siswa'];
                $results['data_crown_list_comprehension'][$i]['nama_cabang'] = $crownList[$i]['nama_cabang'];
                $results['data_crown_list_comprehension'][$i]['total'] = $crownList[$i]['total'];
            }
		}
		
        //fluent
		$speedList = [];
		for ($i=0; $i < count ($getStudent) ; $i++) { 
			$id_siswa 		= $getStudent[$i]['id_siswa'];
			$nama_siswa		= $getStudent[$i]['nama_siswa'];
			$nama_cabang 	= $getStudent[$i]['nama_cabang'];
			$speedList[$i]  = $this->m_leaderboard->data_fluent_list_comprehension($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($speedList[$i]['total'] == '') $speedList[$i]['total'] = 0;
			if ($speedList[$i]['lattest'] == '') $speedList[$i]['lattest'] = 0;
		}

		for($i=0;$i<count($speedList);$i++){
			$temp = $speedList[$i];
			$val = $speedList[$i]['total'];
			$val2 = $speedList[$i]['lattest'];
			$j = $i-1;
			while($j>=0 && ($speedList[$j]['total'] < $val || ($speedList[$j]['total'] == $val && $speedList[$j]['lattest'] > $val2))){
				$speedList[$j+1] = $speedList[$j];
				$j--;
			}
			$speedList[$j+1] = $temp;
        }
        
        if (count ($speedList) < $total) $total = count ($speedList);
        for($i=0;$i<$total;$i++){
            if ($speedList[$i]['total'] != '0') {
                $results['data_fluent_list_comprehension'][$i]['id_siswa'] = $speedList[$i]['id_siswa'];
                $results['data_fluent_list_comprehension'][$i]['nama_siswa'] = $speedList[$i]['nama_siswa'];
                $results['data_fluent_list_comprehension'][$i]['nama_cabang'] = $speedList[$i]['nama_cabang'];
                $results['data_fluent_list_comprehension'][$i]['total'] = $speedList[$i]['total'];
            }
        }
        
        //Tone List
        $toneList = [];
        for ($i=0; $i < count ($getStudent); $i++) { 
            $id_siswa = $getStudent[$i]['id_siswa'];
            $nama_siswa = $getStudent[$i]['nama_siswa'];
            $nama_cabang = $getStudent[$i]['nama_cabang'];
            $toneList[$i] = $this->m_leaderboard->data_tone_list_comprehension($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
            if ($toneList[$i]['total'] == '') $toneList[$i]['total'] = 0;
            if ($toneList[$i]['lattest'] == '') $toneList[$i]['lattest'] = 0;
        }

        for ($i=0; $i < count($toneList); $i++) { 
            $temp = $toneList[$i];
            $val = $toneList[$i]['total'];
            $val2 = $toneList[$i]['lattest'];
            $j = $i-1;
            while ($j >= 0 && ($toneList[$j]['total'] < $val || ($toneList[$j]['total'] == $val && $toneList[$j]['lattest'] > $val2))) {
                $toneList[$j+1] = $toneList[$j];
                $j--;
            }
            $toneList[$j+1] = $temp;
        }

        if (count ($toneList) < $total) $total = count ($toneList);
        for($i=0; $i < $total; $i++){
            if ($toneList[$i]['total'] != '0') {
                $results['data_tone_list_comprehension'][$i]['id_siswa'] = $toneList[$i]['id_siswa'];
                $results['data_tone_list_comprehension'][$i]['nama_siswa'] = $toneList[$i]['nama_siswa'];
                $results['data_tone_list_comprehension'][$i]['nama_cabang'] = $toneList[$i]['nama_cabang'];
                $results['data_tone_list_comprehension'][$i]['total'] = $toneList[$i]['total'];
            }
		}

		//Daily List
		$dailyList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa     = $getStudent[$i]['id_siswa'];
			$nama_siswa   = $getStudent[$i]['nama_siswa'];
			$nama_cabang  = $getStudent[$i]['nama_cabang'];
			$data_tanggal = [];

			//Get tanggal upload Daily Reading
			$data_daily_reading = $this->m_leaderboard->data_daily_reading($id_siswa, $idLevel, $from_date)->result_array();		

			//Get tanggal upload Dialog
			$data_dialog 		= $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

			//Get tanggal upload Comprehension
			$data_comprehension = $this->m_leaderboard->data_dialog($id_siswa, $idLevel, $from_date)->result_array();

			//Daftarkan tanggal dan jam
			foreach ($data_daily_reading as $data) {
				if (count($data) > 0)							
					array_push($data_tanggal, $data);
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_dialog as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Daftarkan / update tanggal dan jam
			foreach ($data_comprehension as $data) {
				$idx = GetArrayIndexBasedOnKeyAndValue($data_tanggal, "tgl_sebenarnya", $data['tgl_sebenarnya']);
				if ($idx == -1) {
					if (count($data) > 0)	
						array_push($data_tanggal, $data);
				} else {
					if ($data_tanggal[$idx]['earliest'] > $data['earliest']) {
						$data_tanggal[$idx]['earliest'] = $data['earliest'];
					}
				}
			}

			//Sorting data_tanggal
			for($k=0;$k<count($data_tanggal);$k++){
				$temp = $data_tanggal[$k];
				$val = $data_tanggal[$k]['tgl_sebenarnya'];							
				$j = $k-1;
				while($j>=0 && $data_tanggal[$j]['tgl_sebenarnya'] < $val){
					$data_tanggal[$j+1] = $data_tanggal[$j];
					$j--;
				}
				$data_tanggal[$j+1] = $temp;
			}

			$totalPoint = 0;
			$totalCombo = 0;
			$lastDate = "";
			$earliest = "";

			foreach ($data_tanggal as $d) {
				if ($d['tgl_sebenarnya'] != $lastDate)
					$totalPoint++;

				$earliest = $d['earliest'];
				
				if ($lastDate != "") {
					$datediff = strtotime($d['tgl_sebenarnya']) - strtotime($lastDate);
					$dayDiff = round($datediff / (60 * 60 * 24));

					if ($dayDiff == 1) {
						$totalCombo++;
					} else if ($dayDiff > 1) {
						$totalCombo = 0;
					}

					if ($totalCombo >= 2) {
						$totalPoint += 5;
						$totalCombo = 0;
						$lastDate = "";
					}
				} 

				$lastDate = $d['tgl_sebenarnya'];						
			}
				$dailyList[$i]['id_siswa'] = $id_siswa;
				$dailyList[$i]['nama_siswa'] = $nama_siswa;
				$dailyList[$i]['nama_cabang'] = $nama_cabang;
				$dailyList[$i]['total'] = $totalPoint;
				$dailyList[$i]['earliest'] = $earliest;

				if ($dailyList[$i]['total'] == '') $dailyList[$i]['total'] = 0;
				if ($dailyList[$i]['earliest'] == '') $dailyList[$i]['earliest'] = "99:99";

		}
		
		//Sort based on total and lattest entry
		for($i=0; $i < count($dailyList); $i++){
			$temp = $dailyList[$i];
			$val = $dailyList[$i]['total'];
			$val2 = $dailyList[$i]['earliest'];
			$j = $i-1;
			while($j>=0 && ($dailyList[$j]['total'] < $val || ($dailyList[$j]['total'] == $val && $dailyList[$j]['earliest'] < $val2))){
				$dailyList[$j+1] = $dailyList[$j];
				$j--;
			}
			$dailyList[$j+1] = $temp;
		}

		if (count ($dailyList) < $total) $total = count ($dailyList);
		for($i=0; $i < $total; $i++){
			if ($dailyList[$i]['total'] != '0') {
				$results['data_daily_submit_list'][$i]['id_siswa'] = $dailyList[$i]['id_siswa'];
				$results['data_daily_submit_list'][$i]['nama_siswa'] = $dailyList[$i]['nama_siswa'];
				$results['data_daily_submit_list'][$i]['nama_cabang'] = $dailyList[$i]['nama_cabang'];
				$results['data_daily_submit_list'][$i]['total'] = $dailyList[$i]['total'];
			}
		}
		
		//noMistake List
		$noMistakeList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$noMistakeList[$i] = $this->m_leaderboard->data_no_mistake_list_comprehension($id_siswa, $nama_siswa, $idLevel, $from_date, $nama_cabang)->row_array();
			if ($noMistakeList[$i]['total'] == '') $noMistakeList[$i]['total'] = 0;
			if ($noMistakeList[$i]['lattest'] == '') $noMistakeList[$i]['lattest'] = 0;
		}

		for ($i=0; $i < count($noMistakeList); $i++) { 
			$temp = $noMistakeList[$i];
			$val = $noMistakeList[$i]['total'];
			$val2 = $noMistakeList[$i]['lattest'];
			$j = $i-1;
			while ($j >= 0 && ($noMistakeList[$j]['total'] < $val || ($noMistakeList[$j]['total'] == $val && $noMistakeList[$j]['lattest'] > $val2))) {
				$noMistakeList[$j+1] = $noMistakeList[$j];
				$j--;
			}
			$noMistakeList[$j+1] = $temp;
		}

		if (count ($noMistakeList) < $total) $total = count ($noMistakeList);
		for($i=0; $i < $total; $i++){
			if ($noMistakeList[$i]['total'] != '0') {
				$results['data_no_mistake_list_comprehension'][$i]['id_siswa'] = $noMistakeList[$i]['id_siswa'];
				$results['data_no_mistake_list_comprehension'][$i]['nama_siswa'] = $noMistakeList[$i]['nama_siswa'];
				$results['data_no_mistake_list_comprehension'][$i]['nama_cabang'] = $noMistakeList[$i]['nama_cabang'];
				$results['data_no_mistake_list_comprehension'][$i]['total'] = $noMistakeList[$i]['total'];
			}
		}
		
		//QUIZ PASS
		$quizPassList = [];
		for ($i=0; $i < count($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];

			$dialogQuizData = $this->db->select('*')->from('comprehension_quiz')->where(['id_siswa' => $id_siswa, 'level' => $idLevel])->order_by('tgl_sebenarnya', 'asc')->get()->result_array();
			$totalPass = 0;
			$lattest = 0;
			$currentCheckDate = [];				
			foreach ($dialogQuizData as $dq) {
				if (!isset($currentCheckDate[$dq['id_comprehension']])) $currentCheckDate[$dq['id_comprehension']] = "";
				if ($currentCheckDate[$dq['id_comprehension']] != $dq['tgl_sebenarnya']) {
					$currentCheckDate[$dq['id_comprehension']] = $dq['tgl_sebenarnya'];
					
					if ($dq['completion'] == 100) {
						$totalPass++;
						$lattest = $dq['id_quiz'];
					}
				}					
			}

			$quizPassList[$i]['id_siswa'] = $id_siswa;
			$quizPassList[$i]['nama_siswa'] = $nama_siswa;
			$quizPassList[$i]['nama_cabang'] = $nama_cabang;
			$quizPassList[$i]['total'] = $totalPass;
			$quizPassList[$i]['lattest'] = $lattest;
		}

		//Sort based on total and lattest entry
		for($i=0;$i<count($quizPassList);$i++){
			$temp = $quizPassList[$i];
			$val = $quizPassList[$i]['total'];
			$val2 = $quizPassList[$i]['lattest'];
			$j = $i-1;
			while($j>=0 && ($quizPassList[$j]['total'] < $val || ($quizPassList[$j]['total'] == $val && $quizPassList[$j]['lattest'] > $val2))){
				$quizPassList[$j+1] = $quizPassList[$j];
				$j--;
			}
			$quizPassList[$j+1] = $temp;
		}

		if (count ($quizPassList) < $total) $total = count ($quizPassList);
		for($i=0; $i < $total; $i++){
			if ($quizPassList[$i]['total'] != '0') {
				$results['data_quiz_pass_list_comprehension'][$i]['id_siswa'] = $quizPassList[$i]['id_siswa'];
				$results['data_quiz_pass_list_comprehension'][$i]['nama_siswa'] = $quizPassList[$i]['nama_siswa'];
				$results['data_quiz_pass_list_comprehension'][$i]['nama_cabang'] = $quizPassList[$i]['nama_cabang'];
				$results['data_quiz_pass_list_comprehension'][$i]['total'] = $quizPassList[$i]['total'];
			}
		}

		//Daily Active
		$dailyActiveList = [];
		for ($i=0; $i < count ($getStudent); $i++) { 
			$id_siswa = $getStudent[$i]['id_siswa'];
			$nama_siswa = $getStudent[$i]['nama_siswa'];
			$nama_cabang = $getStudent[$i]['nama_cabang'];
			$getTotalDayUpload = $this->m_leaderboard->data_dailyActive_list($id_siswa, $idLevel, $from_date)->result_array();

			if (count($getTotalDayUpload) > 0) {
				$totalDayUpload = $getTotalDayUpload[0]['total'];
				$ld = $getTotalDayUpload[0]['last_date'];
				$lt = $getTotalDayUpload[0]['time'];

				$totalDayInATerm = abs(strtotime($from_date) - strtotime($to_date));
				$totalDayInATerm = $totalDayInATerm/86400;				
				$totalDayInATerm = intval($totalDayInATerm);
				
				
				$totalDayPassed = abs(strtotime($from_date) - strtotime(date('Y-m-d')));
				$totalDayPassed = $totalDayPassed/86400;				
				$totalDayPassed = intval($totalDayPassed + 1);
				
				$totalDayMaintenance = 0;
				$maintenanceTracker = $this->m_leaderboard->getDataMaintenance()->result_array();

				if(count($maintenanceTracker) > 0) $totalDayMaintenance = $maintenanceTracker[0]['maintenance_days'];

				$totalDayPassed -= $totalDayMaintenance;
				if ($totalDayUpload > $totalDayPassed) $totalDayUpload = $totalDayPassed;
				
				$totalPoint = round(($totalDayUpload * 100/$totalDayPassed), 1);
				$earliest = $ld." ".$lt;

			}
			
			$dailyActiveList[$i]['id_siswa'] = $id_siswa;
			$dailyActiveList[$i]['nama_siswa'] = $nama_siswa;
			$dailyActiveList[$i]['nama_cabang'] = $nama_cabang;
			$dailyActiveList[$i]['total'] = $totalPoint."%";
			$dailyActiveList[$i]['earliest'] = $earliest;

			if ($dailyActiveList[$i]['total'] == '') $dailyActiveList[$i]['total'] = 0;
			if ($dailyActiveList[$i]['earliest'] == '') $dailyActiveList[$i]['earliest'] = "99:99";
		}

		
		for ($i=0; $i < count($dailyActiveList); $i++) { 
			$temp = $dailyActiveList[$i];
			$val = $dailyActiveList[$i]['total'];
			$val2 = $dailyActiveList[$i]['earliest'];
			$j = $i-1;
			while ($j >= 0 && ((float)$dailyActiveList[$j]['total'] < (float)$val || ((float)$dailyActiveList[$j]['total'] == (float)$val && $dailyActiveList[$j]['earliest'] > $val2))) {
				$dailyActiveList[$j+1] = $dailyActiveList[$j];
				$j--;
			}
			$dailyActiveList[$j+1] = $temp;
		}

		if (count ($dailyActiveList) < $total) $total = count ($dailyActiveList);
        for($i=0; $i < $total; $i++){
            if ($dailyActiveList[$i]['total'] != '0%') {
                $results['data_daily_active_list'][$i]['id_siswa'] = $dailyActiveList[$i]['id_siswa'];
                $results['data_daily_active_list'][$i]['nama_siswa'] = $dailyActiveList[$i]['nama_siswa'];
                $results['data_daily_active_list'][$i]['nama_cabang'] = $dailyActiveList[$i]['nama_cabang'];
                $results['data_daily_active_list'][$i]['total'] = $dailyActiveList[$i]['total'];
            }
		}

		$data = [
            'crown'	        => (isset($results['data_crown_list_comprehension'])) ? $results['data_crown_list_comprehension'] : array(),
            'fluent'	    => (isset($results['data_fluent_list_comprehension'])) ? $results['data_fluent_list_comprehension'] : array(),
            'tone'	        => (isset($results['data_tone_list_comprehension'])) ? $results['data_tone_list_comprehension'] : array(),
            'daily_submit'	=> (isset($results['data_daily_submit_list'])) ? $results['data_daily_submit_list'] : array(),
            'no_mistake'	=> (isset($results['data_no_mistake_list_comprehension'])) ? $results['data_no_mistake_list_comprehension'] : array(),
            'quiz_pass'		=> (isset($results['data_quiz_pass_list_comprehension'])) ? $results['data_quiz_pass_list_comprehension'] : array(),
            'daily_active'	=> (isset($results['data_daily_active_list'])) ? $results['data_daily_active_list'] : array(),
            'nama_cabang' 	=> $get_nama_cabang,
            'id_level' 		=> $idLevel,
        ];

		echo json_encode($data);
	}
}