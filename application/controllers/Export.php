<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//load Spout Library
require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';
//lets Use the Spout Namespaces
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\StyleBuilder;

class Export extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_log');
    }

    public function index()
    {
        $eid = $this->input->post('id_siswa');
        $id = decrypt_url($eid);
        
        $nama_siswa = $this->input->post('nama_siswa');

        $profil_header = ['ID', 'Name', 'Level', 'Teacher'];
        $history_header_daily_reading = ['No', 'Unit', 'Story', 'Time', 'Speed', 'Nada', 'Try', 'Status', 'Jumlah Salah', 'Tanggal Upload', 'Tanggal Masehi', 'Jam Upload', 'Note', 'Keterangan', 'Tanggal Periksa', 'Jam Periksa', 'Audio'];

        $history_header_dialog = ['No', 'Time', 'Speed', 'Nada', 'Try', 'Status', 'Jumlah Salah', 'Tanggal Upload', 'Tanggal Masehi', 'Jam Upload', 'Note', 'Keterangan', 'Tanggal Periksa', 'Jam Periksa', 'Audio'];

        $history_header_comprehension = ['No', 'Time', 'Speed', 'Nada', 'Try', 'Status', 'Jumlah Salah', 'Tanggal Upload', 'Tanggal Masehi', 'Jam Upload', 'Note', 'Keterangan', 'Tanggal Periksa', 'Jam Periksa', 'Audio'];

        $history_header_exam = ['No', 'Unit', 'Story', 'Time', 'Try', 'Status',  'Jumlah Salah', 'Tanggal Upload', 'Tanggal Masehi', 'Jam Upload', 'Note', 'Keterangan', 'Tanggal Periksa', 'Jam Periksa', 'Audio'];

        $history_quiz_dialog = ['No', 'Dialog', 'Try', 'Completion', 'Tanggal Upload', 'Tanggal Masehi', 'Jam', 'Mode'];
        $history_quiz_comprehension = ['No', 'Comprehension', 'Try', 'Completion', 'Tanggal Upload', 'Tanggal Masehi', 'Jam', 'Mode'];

        $goal_header = ['No', 'Unit', 'Story'];


        $profil_rows = $this->m_siswa->profil_siswa($id)->result_array();
        $data_profil = [];
        for ($i=0; $i < count($profil_rows) ; $i++) { 
            $data_profil[$i]['id_siswa'] = $id;
            $data_profil[$i]['nama_siswa'] = $profil_rows[$i]['nama_siswa'];
            $data_profil[$i]['level'] = $profil_rows[$i]['level'];
            $data_profil[$i]['id_guru'] = getGuru($profil_rows[$i]['id_guru']);
        }

        $level = $profil_rows[0]['level'];

        //===================== HISTORY DAILY READING ======================//
        $history_rows_daily_reading = $this->m_siswa->history_daily_reading($id, $level)->result_array();

        $data_history_daily_reading = [];
        for ($i=0; $i < count($history_rows_daily_reading) ; $i++) {
            $status = $history_rows_daily_reading[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $history_rows_daily_reading[$i]['status'] == 2 ? "Warning" : ($history_rows_daily_reading[$i]['status'] == 3 ? "Goal" : "-");
            if($history_rows_daily_reading[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $history_rows_daily_reading[$i]['waktu_periksa'])[0];
            if($history_rows_daily_reading[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $history_rows_daily_reading[$i]['waktu_periksa'])[1];
            $audio = $history_rows_daily_reading[$i]['tgl_upload']."_".$level."_".$history_rows_daily_reading[$i]['unit']."(".$history_rows_daily_reading[$i]['story'].")_".strtoupper($history_rows_daily_reading[$i]['mode'])."_".$history_rows_daily_reading[$i]['time']."_x".$history_rows_daily_reading[$i]['try'].".m4a";

            $data_history_daily_reading[$i]['row_number'] = $history_rows_daily_reading[$i]['row_number'];
            $data_history_daily_reading[$i]['unit'] = $history_rows_daily_reading[$i]['unit'];
            $data_history_daily_reading[$i]['story'] = $history_rows_daily_reading[$i]['story'];
            $data_history_daily_reading[$i]['time'] = $history_rows_daily_reading[$i]['time'];
            $data_history_daily_reading[$i]['speed'] = $history_rows_daily_reading[$i]['speed'];
            $data_history_daily_reading[$i]['nada'] = $history_rows_daily_reading[$i]['nada'];
            $data_history_daily_reading[$i]['try'] = $history_rows_daily_reading[$i]['try'];
            $data_history_daily_reading[$i]['status'] = $status;
            $data_history_daily_reading[$i]['jumlah_salah'] = $history_rows_daily_reading[$i]['jumlah_salah'];
            $data_history_daily_reading[$i]['tgl_upload'] = $history_rows_daily_reading[$i]['tgl_upload'];
            $data_history_daily_reading[$i]['tgl_sebenarnya'] = $history_rows_daily_reading[$i]['tgl_sebenarnya'];
            $data_history_daily_reading[$i]['jam'] = $history_rows_daily_reading[$i]['jam'];
            $data_history_daily_reading[$i]['note'] = $history_rows_daily_reading[$i]['note'];
            $data_history_daily_reading[$i]['keterangan'] = $keterangan;
            $data_history_daily_reading[$i]['tanggal_periksa'] = $tanggal_periksa;
            $data_history_daily_reading[$i]['jam_periksa'] = $jam_periksa;

            $dir_audio = assignment_dir()."DailyReading/".$id."/".$audio;
            $url_audio = "";
            if (file_exists($dir_audio)) {
                $url_audio = assignment_url()."DailyReading/".$id."/".urlencode($audio);
            } else {
                $url_audio = "NO FILE";
            }
            $data_history_daily_reading[$i]['audio'] = $url_audio;
        }

        //===================== HISTORY DIALOG ======================//
        $history_rows_dialog = $this->m_siswa->history_dialog($id, $level)->result_array();

        $data_history_dialog = [];
        for ($i=0; $i < count($history_rows_dialog) ; $i++) {
            $status = $history_rows_dialog[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $history_rows_dialog[$i]['status'] == 2 ? "Warning" : ($history_rows_dialog[$i]['status'] == 3 ? "Goal" : "-");
            if($history_rows_dialog[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $history_rows_dialog[$i]['waktu_periksa'])[0];
            if($history_rows_dialog[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $history_rows_dialog[$i]['waktu_periksa'])[1];
            $audio = $history_rows_dialog[$i]['tgl_upload']."_".$level."_DIALOG_".$history_rows_dialog[$i]['dialog_number']."_".strtoupper($history_rows_dialog[$i]['mode'])."_".$history_rows_dialog[$i]['time']."_x".$history_rows_dialog[$i]['try'].".m4a";

            $data_history_dialog[$i]['row_number'] = $history_rows_dialog[$i]['row_number'];
            $data_history_dialog[$i]['time'] = $history_rows_dialog[$i]['time'];
            $data_history_dialog[$i]['speed'] = $history_rows_dialog[$i]['speed'];
            $data_history_dialog[$i]['nada'] = $history_rows_dialog[$i]['nada'];
            $data_history_dialog[$i]['try'] = $history_rows_dialog[$i]['try'];
            $data_history_dialog[$i]['status'] = $status;
            $data_history_dialog[$i]['jumlah_salah'] = $history_rows_dialog[$i]['jumlah_salah'];
            $data_history_dialog[$i]['tgl_upload'] = $history_rows_dialog[$i]['tgl_upload'];
            $data_history_dialog[$i]['tgl_sebenarnya'] = $history_rows_dialog[$i]['tgl_sebenarnya'];
            $data_history_dialog[$i]['jam'] = $history_rows_dialog[$i]['jam'];
            $data_history_dialog[$i]['note'] = $history_rows_dialog[$i]['note'];
            $data_history_dialog[$i]['keterangan'] = $keterangan;
            $data_history_dialog[$i]['tanggal_periksa'] = $tanggal_periksa;
            $data_history_dialog[$i]['jam_periksa'] = $jam_periksa;

            $dir_audio = assignment_dir()."Dialog/".$id."/".$audio;
            $url_audio = "";
            if (file_exists($dir_audio)) {
                $url_audio = assignment_url()."Dialog/".$id."/".urlencode($audio);
            } else {
                $url_audio = "NO FILE";
            }
            $data_history_dialog[$i]['audio'] = $url_audio;
        }

        //===================== HISTORY COMPREHENSION ======================//
        $history_rows_comprehension = $this->m_siswa->history_comprehension($id, $level)->result_array();

        $data_history_comprehension = [];
        for ($i=0; $i < count($history_rows_comprehension) ; $i++) {
            $status = $history_rows_comprehension[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $history_rows_comprehension[$i]['status'] == 2 ? "Warning" : ($history_rows_comprehension[$i]['status'] == 3 ? "Goal" : "-");
            if($history_rows_comprehension[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $history_rows_comprehension[$i]['waktu_periksa'])[0];
            if($history_rows_comprehension[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $history_rows_comprehension[$i]['waktu_periksa'])[1];
            $audio = $history_rows_comprehension[$i]['tgl_upload']."_".$level."_COMP_".$history_rows_comprehension[$i]['try']."_".$history_rows_comprehension[$i]['time']."_x".$history_rows_comprehension[$i]['try'].".m4a";
            // W01D2_TEST_COMP_1_00:00_x1.m4a

            $data_history_comprehension[$i]['row_number'] = $history_rows_comprehension[$i]['row_number'];
            $data_history_comprehension[$i]['time'] = $history_rows_comprehension[$i]['time'];
            $data_history_comprehension[$i]['speed'] = $history_rows_comprehension[$i]['speed'];
            $data_history_comprehension[$i]['nada'] = $history_rows_comprehension[$i]['nada'];
            $data_history_comprehension[$i]['try'] = $history_rows_comprehension[$i]['try'];
            $data_history_comprehension[$i]['status'] = $status;
            $data_history_comprehension[$i]['jumlah_salah'] = $history_rows_comprehension[$i]['jumlah_salah'];
            $data_history_comprehension[$i]['tgl_upload'] = $history_rows_comprehension[$i]['tgl_upload'];
            $data_history_comprehension[$i]['tgl_sebenarnya'] = $history_rows_comprehension[$i]['tgl_sebenarnya'];
            $data_history_comprehension[$i]['jam'] = $history_rows_comprehension[$i]['jam'];
            $data_history_comprehension[$i]['note'] = $history_rows_comprehension[$i]['note'];
            $data_history_comprehension[$i]['keterangan'] = $keterangan;
            $data_history_comprehension[$i]['tanggal_periksa'] = $tanggal_periksa;
            $data_history_comprehension[$i]['jam_periksa'] = $jam_periksa;

            $dir_audio = assignment_dir()."Comprehension/".$id."/".$audio;
            $url_audio = "";
            if (file_exists($dir_audio)) {
                $url_audio = assignment_url()."Comprehension/".$id."/".urlencode($audio);
            } else {
                $url_audio = "NO FILE";
            }
            $data_history_comprehension[$i]['audio'] = $url_audio;
        }

        //===================== HISTORY EXAM ======================//
        $history_rows_exam = $this->m_siswa->history_exam($id, $level)->result_array();

        $data_history_exam = [];
        for ($i=0; $i < count($history_rows_exam) ; $i++) {
            $status = $history_rows_exam[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $history_rows_exam[$i]['status'] == 2 ? "Warning" : ($history_rows_exam[$i]['status'] == 3 ? "Goal" : "-");
            if($history_rows_exam[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $history_rows_exam[$i]['waktu_periksa'])[0];
            if($history_rows_exam[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $history_rows_exam[$i]['waktu_periksa'])[1];
            $audio = $history_rows_exam[$i]['tgl_upload']."_".$level."_".$history_rows_exam[$i]['unit']."(".$history_rows_exam[$i]['story'].")_".$history_rows_exam[$i]['time']."_x".$history_rows_exam[$i]['try']."_EXAM.m4a";

            $data_history_exam[$i]['row_number'] = $history_rows_exam[$i]['row_number'];
            $data_history_exam[$i]['unit'] = $history_rows_exam[$i]['unit'];
            $data_history_exam[$i]['story'] = $history_rows_exam[$i]['story'];
            $data_history_exam[$i]['time'] = $history_rows_exam[$i]['time'];
            $data_history_exam[$i]['try'] = $history_rows_exam[$i]['try'];
            $data_history_exam[$i]['status'] = $status;
            $data_history_exam[$i]['jumlah_salah'] = $history_rows_exam[$i]['jumlah_salah'];
            $data_history_exam[$i]['tgl_upload'] = $history_rows_exam[$i]['tgl_upload'];
            $data_history_exam[$i]['tgl_sebenarnya'] = $history_rows_exam[$i]['tgl_sebenarnya'];
            $data_history_exam[$i]['jam'] = $history_rows_exam[$i]['jam'];
            $data_history_exam[$i]['keterangan'] = $keterangan;
            $data_history_exam[$i]['tanggal_periksa'] = $tanggal_periksa;
            $data_history_exam[$i]['jam_periksa'] = $jam_periksa;

            $dir_audio = assignment_dir()."Exam/".$id."/".$audio;
            $url_audio = "";
            if (file_exists($dir_audio)) {
                $url_audio = assignment_url()."Exam/".$id."/".urlencode($audio);
            } else {
                $url_audio = "NO FILE";
            }
            $data_history_exam[$i]['audio'] = $url_audio;
        }

        //==================== QUIZ DIALOG =======================//
        $history_rows_dialog = $this->m_siswa->history_quiz_dialog($id, $level)->result_array();

        $data_history_quiz_dialog = [];
        $index = 0;
        foreach ($history_rows_dialog as $quiz_dialog) {
            if ($quiz_dialog['completion'] == "100") {
                $completion = "Passed";
            } else {
                $completion = $quiz_dialog['completion']."%";
            }
            $data_history_quiz_dialog[$index]['row_number'] = $quiz_dialog['row_number'];
            $data_history_quiz_dialog[$index]['id_dialog']  = $quiz_dialog['id_dialog'];
            $data_history_quiz_dialog[$index]['try']        = $quiz_dialog['try'];
            $data_history_quiz_dialog[$index]['completion'] = $completion;
            $data_history_quiz_dialog[$index]['tgl_upload'] = $quiz_dialog['tgl_upload'];
            $data_history_quiz_dialog[$index]['tgl_sebenarnya'] = $quiz_dialog['tgl_sebenarnya'];
            $data_history_quiz_dialog[$index]['jam']        = $quiz_dialog['jam'];
            $data_history_quiz_dialog[$index]['mode']       = $quiz_dialog['mode'];
            $index++;
        }

        //==================== QUIZ COMPREHENSION =======================//
        $history_rows_comprehension = $this->m_siswa->history_quiz_comprehension($id, $level)->result_array();

        $data_history_quiz_comprehension = [];
        $index = 0;
        foreach ($history_rows_comprehension as $quiz_comprehension) {
            if ($quiz_comprehension['completion'] == "100") {
                $completion = "Passed";
            } else {
                $completion = $quiz_comprehension['completion']."%";
            }
            $data_history_quiz_comprehension[$index]['row_number'] = $quiz_comprehension['row_number'];
            $data_history_quiz_comprehension[$index]['id_comprehension']  = $quiz_comprehension['id_comprehension'];
            $data_history_quiz_comprehension[$index]['try']        = $quiz_comprehension['try'];
            $data_history_quiz_comprehension[$index]['completion'] = $completion;
            $data_history_quiz_comprehension[$index]['tgl_upload'] = $quiz_comprehension['tgl_upload'];
            $data_history_quiz_comprehension[$index]['tgl_sebenarnya'] = $quiz_comprehension['tgl_sebenarnya'];
            $data_history_quiz_comprehension[$index]['jam']        = $quiz_comprehension['jam'];
            $data_history_quiz_comprehension[$index]['mode']       = $quiz_comprehension['mode'];
            $index++;
        }

        $goal_rows = $this->m_siswa->goal($id, $level)->result_array();

        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser($id.'-'.$nama_siswa.'.xlsx');
        $headerStyle = (new StyleBuilder())
                ->setFontBold()
                ->build();

        $writer->getCurrentSheet()->setName('PROFIL');
        $writer->addRowWithStyle($profil_header, $headerStyle);
        $writer->addRows($data_profil);

        $writer->addNewSheetAndMakeItCurrent()->setName('HISTORY DAILY READING');
        $writer->addRowWithStyle($history_header_daily_reading, $headerStyle);
        $writer->addRows($data_history_daily_reading);

        $writer->addNewSheetAndMakeItCurrent()->setName('HISTORY DIALOG');
        $writer->addRowWithStyle($history_header_dialog, $headerStyle);
        $writer->addRows($data_history_dialog);

        $writer->addNewSheetAndMakeItCurrent()->setName('HISTORY COMPREHENSION');
        $writer->addRowWithStyle($history_header_comprehension, $headerStyle);
        $writer->addRows($data_history_comprehension);

        $writer->addNewSheetAndMakeItCurrent()->setName('HISTORY EXAM');
        $writer->addRowWithStyle($history_header_exam, $headerStyle);
        $writer->addRows($data_history_exam);
        
        $writer->addNewSheetAndMakeItCurrent()->setName('HISTORY QUIZ DIALOG');
        $writer->addRowWithStyle($history_quiz_dialog, $headerStyle);
        $writer->addRows($data_history_quiz_dialog);
        
        $writer->addNewSheetAndMakeItCurrent()->setName('HISTORY QUIZ COMPREHENSION');
        $writer->addRowWithStyle($history_quiz_comprehension, $headerStyle);
        $writer->addRows($data_history_quiz_comprehension);

        $writer->addNewSheetAndMakeItCurrent()->setName('GOAL');
        $writer->addRowWithStyle($goal_header, $headerStyle);
        $writer->addRows($goal_rows);

        $writer->close();

    }

    public function log()
    {
        $dari   = $this->input->get('dari_tanggal');
        $sampai = $this->input->get('sampai_tanggal');
        
        $header_quiz = ['No', 'ID Siswa', 'Nama Siswa', 'Level', 'Cabang', 'Dialog', 'Completion', 'Try', 'Tanggal Pengerjaan', 'Tanggal Masehi', 'Jam'];
        $rows_quiz = $this->m_log->data_log_dialog($dari, $sampai)->result_array();

        // setup Spout Excel Writer, set tipenya xlsx
        $writer = WriterFactory::create(Type::XLSX);
        // download to browser
        $writer->openToBrowser($id.'-'.$nama_siswa.'.xlsx');
        // set style untuk header
        $headerStyle = (new StyleBuilder())
                ->setFontBold()
                ->build();

        // write ke Sheet pertama
        $writer->getCurrentSheet()->setName('QUIZ');
        // header Sheet pertama
        $writer->addRowWithStyle($header_quiz, $headerStyle);
        // data Sheet pertama
        $writer->addRows($rows_quiz);

        // close writter
        $writer->close();

        echo "Berhasil";
    }

    public function export_log()
    {
        $data = $this->input->post();
        $status = '';
        $keterangan = '';
        
        if ($data['mode'] == 'daily_reading') {
            $result_daily_reading = $this->m_log->data_log_daily($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
            $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'UNIT', 'STORY', 'TIME', 'SPEED', 'NADA', 'TRY', 'STATUS', 'JUMLAH SALAH', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM UPLOAD', ' NOTE', 'KETERANGAN', 'CHECKER', 'TANGGAL PERIKSA', 'JAM PERIKSA', 'MODE'];

            $data_rows = [];
            for ($i=0; $i < count($result_daily_reading) ; $i++) { 
                $status     = $result_daily_reading[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
                $keterangan = $result_daily_reading[$i]['status'] == 2 ? "Hasil" : ($result_daily_reading[$i]['status'] == 3 ? "Goal" : "-");
                $checker    = $result_daily_reading[$i]['status'] == 1 ? getGuru($result_daily_reading[$i]['id_checker_t']) : "-";
                if($result_daily_reading[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_daily_reading[$i]['waktu_periksa'])[0];
                if($result_daily_reading[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_daily_reading[$i]['waktu_periksa'])[1];

                $data_rows[$i]['id_siswa']       = $result_daily_reading[$i]['id_siswa'];
                $data_rows[$i]['nama_siswa']     = $result_daily_reading[$i]['nama_siswa'];
                $data_rows[$i]['level']          = $result_daily_reading[$i]['level'];
                $data_rows[$i]['nama_cabang']    = $result_daily_reading[$i]['nama_cabang'];
                $data_rows[$i]['unit']           = $result_daily_reading[$i]['unit'];
                $data_rows[$i]['story']          = $result_daily_reading[$i]['story'];
                $data_rows[$i]['time']           = $result_daily_reading[$i]['time'];
                $data_rows[$i]['speed']          = $result_daily_reading[$i]['speed'];
                $data_rows[$i]['nada']           = $result_daily_reading[$i]['nada'];
                $data_rows[$i]['try']            = $result_daily_reading[$i]['try'];
                $data_rows[$i]['status']         = $status;
                $data_rows[$i]['jumlah_salah']   = $result_daily_reading[$i]['jumlah_salah'];
                $data_rows[$i]['tgl_upload']     = $result_daily_reading[$i]['tgl_upload'];
                $data_rows[$i]['tgl_sebenarnya'] = $result_daily_reading[$i]['tgl_sebenarnya'];
                $data_rows[$i]['jam']            = $result_daily_reading[$i]['jam'];
                $data_rows[$i]['note']           = $result_daily_reading[$i]['note'];
                $data_rows[$i]['keterangan']     = $keterangan;
                $data_rows[$i]['checker']        = $checker;
                $data_rows[$i]['tanggal periksa']= $tanggal_periksa;
                $data_rows[$i]['jam periksa']    = $jam_periksa;
                $data_rows[$i]['mode']           = ucwords($result_daily_reading[$i]['mode']);
            }

            $nama_sheet = ucwords(str_replace("_", " ",$data['mode']));
        } else if ($data['mode'] == 'dialog_quiz') {
            $result_dialog_quiz = $this->m_log->data_log_dialog_quiz($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
            $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'DIALOG', 'COMPLETION', 'TRY', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM', 'MODE'];

                $data_rows  = [];
                $idAndDate  = [];
                $completion = "";

                for ($i=0; $i < count($result_dialog_quiz) ; $i++) {
                    if (!isset($idAndDate[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']])) $idAndDate[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']] = "";
                                                                                            
                        if ($idAndDate[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']] != $result_dialog_quiz[$i]['tgl_sebenarnya']) {
                            $idAndDate[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']] = $result_dialog_quiz[$i]['tgl_sebenarnya'];
                            if ($result_dialog_quiz[$i]['completion'] == '100') {
                                $completion = "Passed";
                            } else {
                                $completion = $result_dialog_quiz[$i]['completion'].'%';
                            }
                        } else {
                            $completion = $result_dialog_quiz[$i]['completion'].'%';
                        }

                    $data_rows[$i]['id_siswa']       = $result_dialog_quiz[$i]['id_siswa'];
                    $data_rows[$i]['nama_siswa']     = $result_dialog_quiz[$i]['nama_siswa'];
                    $data_rows[$i]['level']          = $result_dialog_quiz[$i]['level'];
                    $data_rows[$i]['nama_cabang']    = $result_dialog_quiz[$i]['nama_cabang'];
                    $data_rows[$i]['id_dialog']      = $result_dialog_quiz[$i]['id_dialog'];
                    $data_rows[$i]['completion']     = $completion;
                    $data_rows[$i]['try']            = $result_dialog_quiz[$i]['try'];
                    $data_rows[$i]['tgl_upload']     = $result_dialog_quiz[$i]['tgl_upload'];
                    $data_rows[$i]['tgl_sebenarnya'] = $result_dialog_quiz[$i]['tgl_sebenarnya'];
                    $data_rows[$i]['jam']            = $result_dialog_quiz[$i]['jam'];
                    $data_rows[$i]['mode']           = ucwords($result_dialog_quiz[$i]['mode']);
                }

                $nama_sheet = ucwords(str_replace("_", " ",$data['mode']));

        } else if ($data['mode'] == 'dialog_recording') {
            $result_dialog_recording = $this->m_log->data_log_dialog_recording($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
            $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'DIALOG', 'TIME', 'SPEED', 'NADA', 'TRY', 'STATUS', 'JUMLAH SALAH', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM UPLOAD', 'NOTE', 'KETERANGAN', 'CHECKER', 'TANGGAL PERIKSA', 'JAM PERIKSA', 'MODE'];

                $data_rows  = [];
                $status = '';
                $keterangan = '';
                $tanggal_periksa = '';
                $jam_periksa = '';

                for ($i=0; $i < count($result_dialog_recording) ; $i++) { 
                    $status = $result_dialog_recording[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
                    $keterangan = $result_dialog_recording[$i]['status'] == 2 ? "Hasil" : ($result_dialog_recording[$i]['status'] == 3 ? "Goal" : "-");
                    $checker    = $result_dialog_recording[$i]['status'] == 1 ? getGuru($result_dialog_recording[$i]['id_checker_dialog']) : "-";

                    if($result_dialog_recording[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_dialog_recording[$i]['waktu_periksa'])[0];
                    if($result_dialog_recording[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_dialog_recording[$i]['waktu_periksa'])[1];

                    $data_rows[$i]['id_siswa']       = $result_dialog_recording[$i]['id_siswa'];
                    $data_rows[$i]['nama_siswa']     = $result_dialog_recording[$i]['nama_siswa'];
                    $data_rows[$i]['level']          = $result_dialog_recording[$i]['level'];
                    $data_rows[$i]['nama_cabang']    = $result_dialog_recording[$i]['nama_cabang'];
                    $data_rows[$i]['id_dialog']      = $result_dialog_recording[$i]['id_dialog'];
                    $data_rows[$i]['time']           = $result_dialog_recording[$i]['time'];
                    $data_rows[$i]['speed']          = $result_dialog_recording[$i]['speed'];
                    $data_rows[$i]['nada']           = $result_dialog_recording[$i]['nada'];
                    $data_rows[$i]['try']            = $result_dialog_recording[$i]['try'];
                    $data_rows[$i]['status']         = $status;
                    $data_rows[$i]['jumlah_salah']   = $result_dialog_recording[$i]['jumlah_salah'];
                    $data_rows[$i]['tgl_upload']     = $result_dialog_recording[$i]['tgl_upload'];
                    $data_rows[$i]['tgl_sebenarnya'] = $result_dialog_recording[$i]['tgl_sebenarnya'];
                    $data_rows[$i]['jam']            = $result_dialog_recording[$i]['jam'];
                    $data_rows[$i]['note']           = $result_dialog_recording[$i]['note'];
                    $data_rows[$i]['keterangan']     = $keterangan;
                    $data_rows[$i]['checker']        = $checker;
                    $data_rows[$i]['tanggal_periksa']= $tanggal_periksa;
                    $data_rows[$i]['jam_periksa']    = $jam_periksa;
                    $data_rows[$i]['mode']           = ucwords($result_dialog_recording[$i]['mode']);
                }

                $nama_sheet = ucwords(str_replace("_", " ",$data['mode']));

        } else if ($data['mode'] == 'exam') {
            $result_exam = $this->m_log->data_log_exam($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
            $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'UNIT', 'STORY', 'TIME', 'TRY', 'STATUS', 'JUMLAH SALAH', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM UPLOAD', 'EXAMINER', 'KETERANGAN', 'TANGGAL PERIKSA', 'JAM PERIKSA'];

            $data_rows  = [];
            $status = '';
            $tanggal_periksa = '';
            $jam_periksa = '';

            for ($i=0; $i < count($result_exam) ; $i++) { 
                $status = $result_exam[$i]['status'] == 0 ? "Pending" : "Reviewed";
                $keterangan = $result_exam[$i]['status'] == 2 ? "Warning" : ($result_exam[$i]['status'] == 3 ? "Goal" : "-");
                $examiner   = $result_exam[$i]['status'] == 1 ? getGuru($result_exam[$i]['id_guru_final_test']) : "-";

                if($result_exam[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_exam[$i]['waktu_periksa'])[0];
                if($result_exam[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_exam[$i]['waktu_periksa'])[1];

                $data_rows[$i]['id_siswa']       = $result_exam[$i]['id_siswa'];
                $data_rows[$i]['nama_siswa']     = $result_exam[$i]['nama_siswa'];
                $data_rows[$i]['level']          = $result_exam[$i]['level'];
                $data_rows[$i]['nama_cabang']    = $result_exam[$i]['nama_cabang'];
                $data_rows[$i]['unit']           = $result_exam[$i]['unit'];
                $data_rows[$i]['story']          = $result_exam[$i]['story'];
                $data_rows[$i]['time']           = $result_exam[$i]['time'];
                $data_rows[$i]['try']            = $result_exam[$i]['try'];
                $data_rows[$i]['status']         = $status;
                $data_rows[$i]['jumlah_salah']   = $result_exam[$i]['jumlah_salah'];
                $data_rows[$i]['tgl_upload']     = $result_exam[$i]['tgl_upload'];
                $data_rows[$i]['tgl_sebenarnya'] = $result_exam[$i]['tgl_sebenarnya'];
                $data_rows[$i]['jam']            = $result_exam[$i]['jam'];
                $data_rows[$i]['examiner']       = $examiner;
                $data_rows[$i]['keterangan']     = $keterangan;
                $data_rows[$i]['tanggal_periksa']= $tanggal_periksa;
                $data_rows[$i]['jam_periksa']    = $jam_periksa;
            }

            $nama_sheet = ucwords(str_replace("_", " ",$data['mode']));

        } else if ($data['mode'] == 'comprehension_quiz') {
            $result_comprehension_quiz = $this->m_log->data_log_comprehension_quiz($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
            $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'COMPREHENSION', 'COMPLETION', 'TRY', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM', 'MODE'];

                $data_rows  = [];
                $idAndDate  = [];
                $completion = "";

                for ($i=0; $i < count($result_comprehension_quiz) ; $i++) {
                    if (!isset($idAndDate[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']])) $idAndDate[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']] = "";
                                                                                            
                        if ($idAndDate[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']] != $result_comprehension_quiz[$i]['tgl_sebenarnya']) {
                            $idAndDate[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']] = $result_comprehension_quiz[$i]['tgl_sebenarnya'];
                            if ($result_comprehension_quiz[$i]['completion'] == '100') {
                                $completion = "Passed";
                            } else {
                                $completion = $result_comprehension_quiz[$i]['completion'].'%';
                            }
                        } else {
                            $completion = $result_comprehension_quiz[$i]['completion'].'%';
                        }

                    $data_rows[$i]['id_siswa']         = $result_comprehension_quiz[$i]['id_siswa'];
                    $data_rows[$i]['nama_siswa']       = $result_comprehension_quiz[$i]['nama_siswa'];
                    $data_rows[$i]['level']            = $result_comprehension_quiz[$i]['level'];
                    $data_rows[$i]['nama_cabang']      = $result_comprehension_quiz[$i]['nama_cabang'];
                    $data_rows[$i]['id_comprehension'] = $result_comprehension_quiz[$i]['id_comprehension'];
                    $data_rows[$i]['completion']       = $completion;
                    $data_rows[$i]['try']              = $result_comprehension_quiz[$i]['try'];
                    $data_rows[$i]['tgl_upload']       = $result_comprehension_quiz[$i]['tgl_upload'];
                    $data_rows[$i]['tgl_sebenarnya']   = $result_comprehension_quiz[$i]['tgl_sebenarnya'];
                    $data_rows[$i]['jam']              = $result_comprehension_quiz[$i]['jam'];
                    $data_rows[$i]['mode']             = ucwords($result_comprehension_quiz[$i]['mode']);
                }
                $nama_sheet = ucwords(str_replace("_", " ",$data['mode']));
        } else if ($data['mode'] == 'comprehension_recording') {
            $result_comprehension_recording = $this->m_log->data_log_comprehension_recording($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();

            $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'COMPREHENSION', 'TIME', 'SPEED', 'NADA', 'TRY', 'STATUS', 'JUMLAH SALAH', 'TANGGAL UPLOAD', 'TANGGAL MASEHI','JAM UPLOAD', 'NOTE', 'KETERANGAN', 'CHECKER', 'TANGGAL PERIKSA', 'JAM PERIKSA', 'MODE'];

                $data_rows  = [];
                $status = '';
                $keterangan = '';
                $tanggal_periksa = '';
                $jam_periksa = '';

                for ($i=0; $i < count($result_comprehension_recording) ; $i++) {
                    $status = $result_comprehension_recording[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
                    $keterangan = $result_comprehension_recording[$i]['status'] == 2 ? "Hasil" : ($result_comprehension_recording[$i]['status'] == 3 ? "Goal" : "-");
                    $checker    = $result_comprehension_recording[$i]['status'] == 1 ? getGuru($result_comprehension_recording[$i]['id_checker_comprehension']) : "-";

                    if($result_comprehension_recording[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_comprehension_recording[$i]['waktu_periksa'])[0];
                    if($result_comprehension_recording[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_comprehension_recording[$i]['waktu_periksa'])[1];
                                                                                            
                    $data_rows[$i]['id_siswa']         = $result_comprehension_recording[$i]['id_siswa'];
                    $data_rows[$i]['nama_siswa']       = $result_comprehension_recording[$i]['nama_siswa'];
                    $data_rows[$i]['level']            = $result_comprehension_recording[$i]['level'];
                    $data_rows[$i]['nama_cabang']      = $result_comprehension_recording[$i]['nama_cabang'];
                    $data_rows[$i]['id_comprehension'] = $result_comprehension_recording[$i]['id_comprehension'];
                    $data_rows[$i]['time']             = $result_comprehension_recording[$i]['time'];
                    $data_rows[$i]['speed']            = $result_comprehension_recording[$i]['speed'];
                    $data_rows[$i]['nada']             = $result_comprehension_recording[$i]['nada'];
                    $data_rows[$i]['try']              = $result_comprehension_recording[$i]['try'];
                    $data_rows[$i]['status']           = $status;
                    $data_rows[$i]['jumlah_salah']     = $result_comprehension_recording[$i]['jumlah_salah'];
                    $data_rows[$i]['tgl_upload']       = $result_comprehension_recording[$i]['tgl_upload'];
                    $data_rows[$i]['tgl_sebenarnya']   = $result_comprehension_recording[$i]['tgl_sebenarnya'];
                    $data_rows[$i]['jam']              = $result_comprehension_recording[$i]['jam'];
                    $data_rows[$i]['note']             = $result_comprehension_recording[$i]['note'];
                    $data_rows[$i]['keterangan']       = $keterangan;
                    $data_rows[$i]['checker']          = $checker;
                    $data_rows[$i]['tanggal_periksa']  = $tanggal_periksa;
                    $data_rows[$i]['jam_periksa']      = $jam_periksa;
                    $data_rows[$i]['mode']             = ucwords($result_comprehension_recording[$i]['mode']);
                }
                $nama_sheet = ucwords(str_replace("_", " ",$data['mode']));
        }

        // setup Spout Excel Writer, set tipenya xlsx
        $writer = WriterFactory::create(Type::XLSX);
        // download to browser
        $writer->openToBrowser('Laporan Log Harian '.$nama_sheet.'.xlsx');

        // set style untuk header
        $headerStyle = (new StyleBuilder())
                ->setFontBold()
                ->build();
        // write ke Sheet pertama
        $writer->getCurrentSheet()->setName($nama_sheet);
        // header Sheet pertama
        $writer->addRowWithStyle($data_headers, $headerStyle);
        // data Sheet pertama
        $writer->addRows($data_rows);

        // print_r($writer);
        // close writter
        $writer->close();
    }

    public function export_log_recording()
    {
        $data = $this->input->post();
        $status = '';
        $keterangan = '';
        $tanggal_periksa = '';
        $jam_periksa = '';
        
        $data_rows = [];
        $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'UNIT', 'STORY', 'TIME', 'SPEED', 'NADA', 'TRY', 'STATUS', 'JUMLAH SALAH', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM UPLOAD', ' NOTE', 'KETERANGAN', 'CHECKER/EXAMINER', 'TANGGAL PERIKSA', 'JAM PERIKSA', 'MODE', 'KATEGORI', 'PERSEN AKTIF'];
        
        $result_daily_reading = $this->m_log->data_log_daily($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
        for ($i=0; $i < count($result_daily_reading) ; $i++) { 
            $status     = $result_daily_reading[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $result_daily_reading[$i]['status'] == 2 ? "Hasil" : ($result_daily_reading[$i]['status'] == 3 ? "Goal" : "-");
            $checker    = $result_daily_reading[$i]['status'] == 1 ? getGuru($result_daily_reading[$i]['id_checker_t']) : "-";
            if($result_daily_reading[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_daily_reading[$i]['waktu_periksa'])[0];
            if($result_daily_reading[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_daily_reading[$i]['waktu_periksa'])[1];

            $data_rows[$i]['id_siswa']       = $result_daily_reading[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']     = $result_daily_reading[$i]['nama_siswa'];
            $data_rows[$i]['level']          = $result_daily_reading[$i]['level'];
            $data_rows[$i]['nama_cabang']    = $result_daily_reading[$i]['nama_cabang'];
            $data_rows[$i]['unit']           = $result_daily_reading[$i]['unit'];
            $data_rows[$i]['story']          = $result_daily_reading[$i]['story'];
            $data_rows[$i]['time']           = $result_daily_reading[$i]['time'];
            $data_rows[$i]['speed']          = $result_daily_reading[$i]['speed'];
            $data_rows[$i]['nada']           = $result_daily_reading[$i]['nada'];
            $data_rows[$i]['try']            = $result_daily_reading[$i]['try'];
            $data_rows[$i]['status']         = $status;
            $data_rows[$i]['jumlah_salah']   = $result_daily_reading[$i]['jumlah_salah'];
            $data_rows[$i]['tgl_upload']     = $result_daily_reading[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya'] = $result_daily_reading[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']            = $result_daily_reading[$i]['jam'];
            $data_rows[$i]['note']           = $result_daily_reading[$i]['note'];
            $data_rows[$i]['keterangan']     = $keterangan;
            $data_rows[$i]['checker/examiner'] = $checker;
            $data_rows[$i]['tanggal_periksa']= $tanggal_periksa;
            $data_rows[$i]['jam_periksa']    = $jam_periksa;
            $data_rows[$i]['mode']           = ucwords($result_daily_reading[$i]['mode']);
            $data_rows[$i]['kategori']       = "Daily Reading";
            $data_rows[$i]['percent_active'] = $result_daily_reading[$i]['percent_active']." %";
        }

        $result_dialog_recording = $this->m_log->data_log_dialog_recording($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
        for ($i=0; $i < count($result_dialog_recording) ; $i++) { 
            $status = $result_dialog_recording[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $result_dialog_recording[$i]['status'] == 2 ? "Hasil" : ($result_dialog_recording[$i]['status'] == 3 ? "Goal" : "-");
            $checker    = $result_dialog_recording[$i]['status'] == 1 ? getGuru($result_dialog_recording[$i]['id_checker_dialog']) : "-";

            if($result_dialog_recording[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_dialog_recording[$i]['waktu_periksa'])[0];
            if($result_dialog_recording[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_dialog_recording[$i]['waktu_periksa'])[1];

            $data_rows[$i]['id_siswa']       = $result_dialog_recording[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']     = $result_dialog_recording[$i]['nama_siswa'];
            $data_rows[$i]['level']          = $result_dialog_recording[$i]['level'];
            $data_rows[$i]['nama_cabang']    = $result_dialog_recording[$i]['nama_cabang'];
            $data_rows[$i]['unit']           = " - ";
            $data_rows[$i]['story']          = " - ";
            $data_rows[$i]['time']           = $result_dialog_recording[$i]['time'];
            $data_rows[$i]['speed']          = $result_dialog_recording[$i]['speed'];
            $data_rows[$i]['nada']           = $result_dialog_recording[$i]['nada'];
            $data_rows[$i]['try']            = $result_dialog_recording[$i]['try'];
            $data_rows[$i]['status']         = $status;
            $data_rows[$i]['jumlah_salah']   = $result_dialog_recording[$i]['jumlah_salah'];
            $data_rows[$i]['tgl_upload']     = $result_dialog_recording[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya'] = $result_dialog_recording[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']            = $result_dialog_recording[$i]['jam'];
            $data_rows[$i]['note']           = $result_dialog_recording[$i]['note'];
            $data_rows[$i]['keterangan']     = $keterangan;
            $data_rows[$i]['checker/examiner']        = $checker;
            $data_rows[$i]['tanggal_periksa']= $tanggal_periksa;
            $data_rows[$i]['jam_periksa']    = $jam_periksa;
            $data_rows[$i]['mode']           = ucwords($result_dialog_recording[$i]['mode']);
            $data_rows[$i]['kategori']       = "Dialog";
            $data_rows[$i]['percent_active'] = $result_dialog_recording[$i]['percent_active']." %";
        }

        $result_exam = $this->m_log->data_log_exam($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
        for ($i=0; $i < count($result_exam) ; $i++) { 
            $status = $result_exam[$i]['status'] == 0 ? "Pending" : "Reviewed";
            $keterangan = $result_exam[$i]['status'] == 2 ? "Warning" : ($result_exam[$i]['status'] == 3 ? "Goal" : "-");
            $examiner   = $result_exam[$i]['status'] == 1 ? getGuru($result_exam[$i]['id_guru_final_test']) : "-";

            if($result_exam[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_exam[$i]['waktu_periksa'])[0];
            if($result_exam[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_exam[$i]['waktu_periksa'])[1];

            $data_rows[$i]['id_siswa']       = $result_exam[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']     = $result_exam[$i]['nama_siswa'];
            $data_rows[$i]['level']          = $result_exam[$i]['level'];
            $data_rows[$i]['nama_cabang']    = $result_exam[$i]['nama_cabang'];
            $data_rows[$i]['unit']           = $result_exam[$i]['unit'];
            $data_rows[$i]['story']          = $result_exam[$i]['story'];
            $data_rows[$i]['time']           = $result_exam[$i]['time'];
            $data_rows[$i]['speed']          = " - ";
            $data_rows[$i]['nada']           = " - ";
            $data_rows[$i]['try']            = $result_exam[$i]['try'];
            $data_rows[$i]['status']         = $status;
            $data_rows[$i]['jumlah_salah']   = $result_exam[$i]['jumlah_salah'];
            $data_rows[$i]['tgl_upload']     = $result_exam[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya'] = $result_exam[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']            = $result_exam[$i]['jam'];
            $data_rows[$i]['note']           = "";
            $data_rows[$i]['keterangan']     = $keterangan;
            $data_rows[$i]['checker/examiner'] = $examiner;
            $data_rows[$i]['tanggal_periksa']= $tanggal_periksa;
            $data_rows[$i]['jam_periksa']    = $jam_periksa;
            $data_rows[$i]['mode']           = ' - ';
            $data_rows[$i]['kategori']       = "Exam";
            $data_rows[$i]['percent_active'] = '-';
        }

        $result_comprehension_recording = $this->m_log->data_log_comprehension_recording($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
        for ($i=0; $i < count($result_comprehension_recording) ; $i++) {
            $status = $result_comprehension_recording[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $result_comprehension_recording[$i]['status'] == 2 ? "Hasil" : ($result_comprehension_recording[$i]['status'] == 3 ? "Goal" : "-");
            $checker    = $result_comprehension_recording[$i]['status'] == 1 ? getGuru($result_comprehension_recording[$i]['id_checker_comprehension']) : "-";

            if($result_comprehension_recording[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_comprehension_recording[$i]['waktu_periksa'])[0];
            if($result_comprehension_recording[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_comprehension_recording[$i]['waktu_periksa'])[1];
                                                                                    
            $data_rows[$i]['id_siswa']         = $result_comprehension_recording[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']       = $result_comprehension_recording[$i]['nama_siswa'];
            $data_rows[$i]['level']            = $result_comprehension_recording[$i]['level'];
            $data_rows[$i]['nama_cabang']      = $result_comprehension_recording[$i]['nama_cabang'];
            $data_rows[$i]['unit']             = " - ";
            $data_rows[$i]['story']            = " - ";
            $data_rows[$i]['time']             = $result_comprehension_recording[$i]['time'];
            $data_rows[$i]['speed']            = $result_comprehension_recording[$i]['speed'];
            $data_rows[$i]['nada']             = $result_comprehension_recording[$i]['nada'];
            $data_rows[$i]['try']              = $result_comprehension_recording[$i]['try'];
            $data_rows[$i]['status']           = $status;
            $data_rows[$i]['jumlah_salah']     = $result_comprehension_recording[$i]['jumlah_salah'];
            $data_rows[$i]['tgl_upload']       = $result_comprehension_recording[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya']   = $result_comprehension_recording[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']              = $result_comprehension_recording[$i]['jam'];
            $data_rows[$i]['note']             = $result_comprehension_recording[$i]['note'];
            $data_rows[$i]['keterangan']       = $keterangan;
            $data_rows[$i]['checker/examiner'] = $checker;
            $data_rows[$i]['tanggal_periksa']  = $tanggal_periksa;
            $data_rows[$i]['jam_periksa']      = $jam_periksa;
            $data_rows[$i]['mode']             = ucwords($result_comprehension_recording[$i]['mode']);
            $data_rows[$i]['kategori']         = "Comprehension";
            $data_rows[$i]['percent_active']   = $result_comprehension_recording[$i]['percent_active']." %";
        }

        $nama_file = "Recording (".$data['dari_tanggal']." to ".$data['sampai_tanggal'].")";
        $nama_sheet = "Laporan Log Harian Recording";

        $this->_sistem_export($nama_file, $nama_sheet, $data_headers, $data_rows);
    }

    public function export_log_quiz()
    {
        $data = $this->input->post();
        $status = '';
        $keterangan = '';
        $nama_file = '';
        $nama_sheet = '';
        $data_rows  = [];
        $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'UNIT', 'COMPLETION', 'TRY', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM', 'MODE', 'KATEGORI'];

        //Dialog
        $idAndDateDialog    = [];
        $completionDialog   = "";

        $result_dialog_quiz = $this->m_log->data_log_dialog_quiz($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
        for ($i=0; $i < count($result_dialog_quiz) ; $i++) {
            if (!isset($idAndDateDialog[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']])) $idAndDateDialog[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']] = "";
                                                                                    
                if ($idAndDateDialog[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']] != $result_dialog_quiz[$i]['tgl_sebenarnya']) {
                    $idAndDateDialog[$result_dialog_quiz[$i]['id_siswa']][$result_dialog_quiz[$i]['level']][$result_dialog_quiz[$i]['id_dialog']] = $result_dialog_quiz[$i]['tgl_sebenarnya'];
                    if ($result_dialog_quiz[$i]['completion'] == '100') {
                        $completionDialog = "Passed";
                    } else {
                        $completionDialog = $result_dialog_quiz[$i]['completion'].'%';
                    }
                } else {
                    $completion = $result_dialog_quiz[$i]['completion'].'%';
                }

            $data_rows[$i]['id_siswa']       = $result_dialog_quiz[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']     = $result_dialog_quiz[$i]['nama_siswa'];
            $data_rows[$i]['level']          = $result_dialog_quiz[$i]['level'];
            $data_rows[$i]['nama_cabang']    = $result_dialog_quiz[$i]['nama_cabang'];
            $data_rows[$i]['id_dialog']      = $result_dialog_quiz[$i]['id_dialog'];
            $data_rows[$i]['completion']     = $completionDialog;
            $data_rows[$i]['try']            = $result_dialog_quiz[$i]['try'];
            $data_rows[$i]['tgl_upload']     = $result_dialog_quiz[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya'] = $result_dialog_quiz[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']            = $result_dialog_quiz[$i]['jam'];
            $data_rows[$i]['mode']           = ucwords($result_dialog_quiz[$i]['mode']);
            $data_rows[$i]['kategori']       = "Dialog";
        }
        //End Dialog

        //Comprehension
        $idAndDateComprehension = [];
        $completionComprehension = "";

        $result_comprehension_quiz = $this->m_log->data_log_comprehension_quiz($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();

        for ($i=0; $i < count($result_comprehension_quiz) ; $i++) {
            if (!isset($idAndDateComprehension[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']])) $idAndDateComprehension[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']] = "";
                                                                                    
                if ($idAndDateComprehension[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']] != $result_comprehension_quiz[$i]['tgl_sebenarnya']) {
                    $idAndDateComprehension[$result_comprehension_quiz[$i]['id_siswa']][$result_comprehension_quiz[$i]['level']][$result_comprehension_quiz[$i]['id_comprehension']] = $result_comprehension_quiz[$i]['tgl_sebenarnya'];
                    if ($result_comprehension_quiz[$i]['completion'] == '100') {
                        $completionComprehension = "Passed";
                    } else {
                        $completionComprehension = $result_comprehension_quiz[$i]['completion'].'%';
                    }
                } else {
                    $completionComprehension = $result_comprehension_quiz[$i]['completion'].'%';
                }

            $data_rows[$i]['id_siswa']         = $result_comprehension_quiz[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']       = $result_comprehension_quiz[$i]['nama_siswa'];
            $data_rows[$i]['level']            = $result_comprehension_quiz[$i]['level'];
            $data_rows[$i]['nama_cabang']      = $result_comprehension_quiz[$i]['nama_cabang'];
            $data_rows[$i]['id_comprehension'] = $result_comprehension_quiz[$i]['id_comprehension'];
            $data_rows[$i]['completion']       = $completionComprehension;
            $data_rows[$i]['try']              = $result_comprehension_quiz[$i]['try'];
            $data_rows[$i]['tgl_upload']       = $result_comprehension_quiz[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya']   = $result_comprehension_quiz[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']              = $result_comprehension_quiz[$i]['jam'];
            $data_rows[$i]['mode']             = ucwords($result_comprehension_quiz[$i]['mode']);
            $data_rows[$i]['kategori']         = "Comprehension";
        }

        $nama_file = "Laporan Log Quiz (".$data['dari_tanggal']." to ".$data['sampai_tanggal'].")";
        $nama_sheet = "Laporan Log Quiz";

        $this->_sistem_export($nama_file, $nama_sheet, $data_headers, $data_rows);
    }

    public function export_log_daily_speaking() {
        $data = $this->input->post();
        $status = '';
        $keterangan = '';
        $tanggal_periksa = '';
        $jam_periksa = '';
        
        $data_rows = [];
        $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'UNIT', 'SECTION', 'TIME', 'SPEED', 'NADA', 'TRY', 'STATUS', 'JUMLAH_SALAH', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM UPLOAD', 'NOTE', 'KETERANGAN', 'CHECKER/EXAMINER', 'TANGGAL PERIKSA','JAM_PERIKSA', 'KATEGORI', 'MODE'];

        $result_daily_speaking = $this->m_log->data_log_daily_speaking($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
        
        for ($i=0; $i < count($result_daily_speaking) ; $i++) { 
            $status     = $result_daily_speaking[$i]['status'] == 0 ? 'Pending' : 'Reviewed';
            $keterangan = $result_daily_speaking[$i]['status'] == 2 ? "Hasil" : ($result_daily_speaking[$i]['status'] == 3 ? "Goal" : "-");
            $checker    = $result_daily_speaking[$i]['status'] == 1 ? getGuru($result_daily_speaking[$i]['id_checker_daily_speaking']) : "-";
            if($result_daily_speaking[$i]['waktu_periksa'] != '')    $tanggal_periksa = explode(' ', $result_daily_speaking[$i]['waktu_periksa'])[0];
            if($result_daily_speaking[$i]['waktu_periksa'] != '')    $jam_periksa     = explode(' ', $result_daily_speaking[$i]['waktu_periksa'])[1];

            $data_rows[$i]['id_siswa']       = $result_daily_speaking[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']     = $result_daily_speaking[$i]['nama_siswa'];
            $data_rows[$i]['level']          = $result_daily_speaking[$i]['level'];
            $data_rows[$i]['nama_cabang']    = $result_daily_speaking[$i]['nama_cabang'];
            $data_rows[$i]['unit']           = $result_daily_speaking[$i]['unit'];
            $data_rows[$i]['section']        = $result_daily_speaking[$i]['section'];
            $data_rows[$i]['time']           = $result_daily_speaking[$i]['time'];
            $data_rows[$i]['speed']          = $result_daily_speaking[$i]['speed'];
            $data_rows[$i]['nada']           = $result_daily_speaking[$i]['nada'];
            $data_rows[$i]['try']            = $result_daily_speaking[$i]['try'];
            $data_rows[$i]['status']         = $status;
            $data_rows[$i]['jumlah_salah']   = $result_daily_speaking[$i]['jumlah_salah'];
            $data_rows[$i]['tgl_upload']     = $result_daily_speaking[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya'] = $result_daily_speaking[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']            = $result_daily_speaking[$i]['jam'];
            $data_rows[$i]['note']           = $result_daily_speaking[$i]['note'];
            $data_rows[$i]['keterangan']     = $keterangan;
            $data_rows[$i]['checker/examiner'] = $checker;
            $data_rows[$i]['tanggal_periksa']= $tanggal_periksa;
            $data_rows[$i]['jam_periksa']    = $jam_periksa;
            $data_rows[$i]['kategori']       = "Daily Speaking";
            $data_rows[$i]['mode']           = ucwords($result_daily_speaking[$i]['mode']);
        }

        $nama_file = "Daily Speaking (".$data['dari_tanggal']." to ".$data['sampai_tanggal'].")";
        $nama_sheet = "Laporan Log Daily Speaking";

        $this->_sistem_export($nama_file, $nama_sheet, $data_headers, $data_rows);
    }

    public function export_log_daily_quiz() {
        $data = $this->input->post();
        
        $data_rows = [];
        $data_headers = ['ID SISWA', 'NAMA SISWA', 'LEVEL', 'NAMA CABANG', 'UNIT', 'STORY', 'TRY', 'TANGGAL UPLOAD', 'TANGGAL MASEHI', 'JAM UPLOAD', 'MODE', 'KATEGORI'];

        $result_daily_quiz = $this->m_log->data_log_daily_quiz($data['dari_tanggal'], $data['sampai_tanggal'])->result_array();
        
        for ($i=0; $i < count($result_daily_quiz) ; $i++) { 

            $data_rows[$i]['id_siswa']       = $result_daily_quiz[$i]['id_siswa'];
            $data_rows[$i]['nama_siswa']     = $result_daily_quiz[$i]['nama_siswa'];
            $data_rows[$i]['level']          = $result_daily_quiz[$i]['level'];
            $data_rows[$i]['nama_cabang']    = $result_daily_quiz[$i]['nama_cabang'];
            $data_rows[$i]['unit']           = $result_daily_quiz[$i]['unit'];
            $data_rows[$i]['section']        = $result_daily_quiz[$i]['story'];
            $data_rows[$i]['try']            = $result_daily_quiz[$i]['try'];
            $data_rows[$i]['tgl_upload']     = $result_daily_quiz[$i]['tgl_upload'];
            $data_rows[$i]['tgl_sebenarnya'] = $result_daily_quiz[$i]['tgl_sebenarnya'];
            $data_rows[$i]['jam']            = $result_daily_quiz[$i]['jam'];
            $data_rows[$i]['mode']           = ucwords($result_daily_quiz[$i]['mode']);
            $data_rows[$i]['kategori']       = "Matching Quiz";
        }

        $nama_file = "Daily Quiz (".$data['dari_tanggal']." to ".$data['sampai_tanggal'].")";
        $nama_sheet = "Laporan Log Daily Quiz";

        $this->_sistem_export($nama_file, $nama_sheet, $data_headers, $data_rows);
    }

    function _sistem_export($nama_file, $nama_sheet, $data_headers, $data_rows)
    {
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser($nama_sheet.'.xlsx');
        $headerStyle = (new StyleBuilder())
        ->setFontBold()
        ->build();
        $writer->getCurrentSheet()->setName($nama_sheet);
        $writer->addRowWithStyle($data_headers, $headerStyle);
        $writer->addRows($data_rows);

        $writer->close();
    }
}