<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_plan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('m_bank_soal');
        session();
    }


    function reading_main()
    {
      $category = "lesson_plan_reading";

      $query = "SELECT r.id, r.lesson_plan_code, r.unit, r.create_at, r.id_admin, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_reading r
                LEFT JOIN lesson_plan_unit_name un ON un.category = '$category' AND un.unit = r.unit AND un.lesson_plan_code = r.lesson_plan_code AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'main'
               ";
               // $this->db->get_where('lesson_plan_reading', ['mode' => 'main'])->result()
      $data = [
        'page_title' => 'Lesson Plan | Reading Main',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'main',
        'table' => 'lesson_plan_reading',
        'config' => 'daily_reading_config'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }
    

    function reading_extended_main()
    {
      $category = "lesson_plan_reading_extended";

      $query = "SELECT r.id, r.lesson_plan_code, r.unit, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_reading_extended r
                LEFT JOIN lesson_plan_unit_name un ON un.category = '$category' AND un.unit = r.unit AND un.lesson_plan_code = r.lesson_plan_code AND un.lesson_plan_code = r.lesson_plan_code AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'main'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Reading Extended Main',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'main',
        'table' => 'lesson_plan_reading_extended',
        'config' => 'daily_reading_config'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }

    function reading_extended_extra()
    {
      $category = "lesson_plan_reading_extended";

      $query = "SELECT r.id, r.lesson_plan_code, r.unit, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_reading_extended r
                LEFT JOIN lesson_plan_unit_name un ON un.category = '$category' AND un.unit = r.unit AND un.lesson_plan_code = r.lesson_plan_code AND un.lesson_plan_code = r.lesson_plan_code AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'extra'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Reading Extended Extra',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'extra',
        'table' => 'lesson_plan_reading_extended',
        'config' => 'daily_reading_config'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }

    function reading_extra()
    {
      $category = "lesson_plan_reading";

      $query = "SELECT r.id, r.lesson_plan_code, r.unit, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_reading r
                LEFT JOIN lesson_plan_unit_name un ON un.category = '$category' AND un.unit = r.unit AND un.lesson_plan_code = r.lesson_plan_code AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'extra'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Reading Extra',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'extra',
        'table' => 'lesson_plan_reading',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }

    function reading_extended()
    {
      $query = "SELECT r.id, r.level, r.unit, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_reading r
                LEFT JOIN unit_name un ON un.unit = r.unit AND un.level = r.level AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'extended'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Reading Extended',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'extended',
        'table' => 'lesson_plan_reading',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }

    function add_reading_main()
    {
      $query = "SELECT code
                FROM lesson_plan_code
                INNER JOIN lesson_plan_unit_name ON lesson_plan_unit_name.lesson_plan_code = lesson_plan_code.code AND unit_name.mode = 'main'
                ";
      $data = [
        'page_title' => 'Lesson Plan | Add Reading Main',
        'level' => $this->db->get('level')->result(),
        'lesson_code' => $this->db->get_where('lesson_plan_code', array('label' => 'Reading'))->result(),
        'mode' => 'main',
        'table' => 'lesson_plan_reading',
        'config' => 'daily_reading_config'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }

    function add_reading_extended_main()
    {
      $data = [
        'page_title' => 'Lesson Plan | Add Reading Extended Main',
        'level' => $this->db->get('level')->result(),
        'lesson_code' => $this->db->get_where('lesson_plan_code', array('label' => 'Reading'))->result(),
        'mode' => 'main',
        'table' => 'lesson_plan_reading_extended',
        'config' => 'daily_reading_config'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }

    function add_reading_extended_extra()
    {
      $data = [
        'page_title' => 'Lesson Plan | Add Reading Extended Extra',
        'level' => $this->db->get('level')->result(),
        'lesson_code' => $this->db->get_where('lesson_plan_code', array('label' => 'Reading'))->result(),
        'mode' => 'extra',
        'table' => 'lesson_plan_reading_extended',
        'config' => 'daily_reading_config'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }

    function add_reading_extra()
    {
      $query = "SELECT id_level
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extra'
                ";
      $data = [
        'page_title' => 'Lesson Plan | Add Reading Extra',
        'level' => $this->db->get('level')->result(),
        'lesson_code' => $this->db->get_where('lesson_plan_code', array('label' => 'Reading'))->result(),
        'mode' => 'extra',
        'table' => 'lesson_plan_reading',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }

    function add_reading_extended()
    {
      $query = "SELECT id_level
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extended'
                ";
      $data = [
        'page_title' => 'Lesson Plan | Add Reading Extended',
        'level' => $this->db->get('level')->result(),
        'mode' => 'extended',
        'table' => 'lesson_plan_reading',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }



    // -------------------------------------------------------------- END READING SECTION --------------------------------------------------------------------------

    // -------------------------------------------------------------- START MEANING SECTION --------------------------------------------------------------------------

    function meaning_main()
    {
      $query = "SELECT r.id, r.level, r.unit, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_meaning r
                LEFT JOIN unit_name un ON un.unit = r.unit AND un.level = r.level AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'main'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Meaning Main',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'main',
        'table' => 'lesson_plan_meaning'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }

    function meaning_extra()
    {
      $query = "SELECT r.id, r.level, r.unit, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_meaning r
                LEFT JOIN unit_name un ON un.unit = r.unit AND un.level = r.level AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'extra'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Meaning Extra',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'extra',
        'table' => 'lesson_plan_meaning'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }

    function meaning_extended()
    {
      $query = "SELECT r.id, r.level, r.unit, r.story, r.mode, r.product_code, un.name unit_name, b.title
                FROM lesson_plan_meaning r
                LEFT JOIN unit_name un ON un.unit = r.unit AND un.level = r.level AND un.mode = r.mode
                LEFT JOIN bank_content b ON b.code = r.product_code
                WHERE r.mode = 'extended'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Meaning Extended',
        'reading' => $this->db->query($query)->result(),
        'mode' => 'extended',
        'table' => 'lesson_plan_meaning'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/index', $data);
      $this->load->view('layout/footer');
    }

    function add_meaning_main()
    {
      $query = "SELECT id_level
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'main'
                ";
      $data = [
        'page_title' => 'Lesson Plan | Add Meaning Main',
        'level' => $this->db->get('level')->result(),
        'mode' => 'main',
        'table' => 'lesson_plan_meaning',
        'config' => 'daily_reading_config'

      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }

    function add_meaning_extra()
    {
      $query = "SELECT id_level
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extra'
                ";
      $data = [
        'page_title' => 'Lesson Plan | Add Meaning Extra',
        'level' => $this->db->get('level')->result(),
        'mode' => 'extra',
        'table' => 'lesson_plan_meaning',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }

    function add_meaning_extended()
    {
      $query = "SELECT id_level
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extended'
                ";
      $data = [
        'page_title' => 'Lesson Plan | Add Meaning Extended',
        'level' => $this->db->get('level')->result(),
        'mode' => 'extended',
        'table' => 'lesson_plan_meaning',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/add', $data);
      $this->load->view('layout/footer');
    }

    // -------------------------------------------------------------- END MEANING SECTION --------------------------------------------------------------------------


    function get_product_code()
    {
      if (isset($_GET['term'])) {
           $this->db->like('code', strtoupper($_GET['term']));
           $this->db->select('code');
           $this->db->order_by('code', 'ASC');
           $this->db->limit(10);
           $result = $this->db->get('bank_content')->result();

           if (count($result) > 0) {
           foreach ($result as $row)
               $arr_result[] = $row->code;
               echo json_encode($arr_result);
           }
       }

    }

    function get_unit($level, $mode, $config)
    {
      $conf = $this->db->get_where($config, ['id_level' => $level])->row();
      $this->db->order_by('mode', 'ASC');
      $data = $this->db->get_where('unit_name', ['level' => $level, 'mode' => $mode])->result();
      $option = "<option value=''>-- Select Unit --</option>";

      if($data){
        // foreach ($conf as $key => $data) {
        //   $option .= "<option data-unit_name='".$data->name."' value='".$data->unit."'>".$data->unit." ".$data->name."</option>";
        // }
        for ($i=1; $i <= $conf->main_total_unit; $i++) {
            $get_unit_name = $this->db->get_where('unit_name', ['unit' => $i, 'level' => $level, 'mode' => $mode])->row();
            $option .= "<option data-unit_name='".$get_unit_name->name."' value='".$i."'>".$i." ".$get_unit_name->name."</option>";
        }
      }else {
        $option = "<option value=''>Sorry, unit not found !</option>";
      }
      // echo json_encode(['option' => $option, 's1' => 'axxxx']);
      echo $option;

    }



    function save_lesson($table)
    {
      $story = $this->input->post('story[]');
      $id_story = $this->input->post('id_story[]');
      $goal = $this->input->post('goal_target[]');
      $limit = $this->input->post('submit_limit[]');
      $unlock_date = $this->input->post('unlock_date[]');
      $batch = $this->input->post('batch[]');


      // var_dump($unlock_date); exit();

      $data_total = [
        'category' => $table,
        'mode' =>  $this->input->post('mode'),
        'lesson_plan_code' => $this->input->post('lesson_plan_code'),
        'unit' => $this->input->post('unit')
      ];
      $cek_total = $this->db->get_where('lesson_total_story', $data_total)->num_rows();
        if($cek_total){
          $this->db->update('lesson_total_story', [
            'category' => $table,
            'mode' =>  $this->input->post('mode'),
            'lesson_plan_code' => $this->input->post('lesson_plan_code'),
            'unit' => $this->input->post('unit'),
            'total_story' => $this->input->post('total_story'),
            'batch'       => implode(', ', $batch)
          ], $data_total);
        }else {
          $this->db->insert('lesson_total_story', [
            'id' => rand(),
            'category' => $table,
            'mode' =>  $this->input->post('mode'),
            'lesson_plan_code' => $this->input->post('lesson_plan_code'),
            'unit' => $this->input->post('unit'),
            'total_story' => $this->input->post('total_story'),
            'batch'       => implode(', ', $batch)
          ]);
        }

      $cek = $this->db->get_where('lesson_plan_unit_name',
        ['category' => $table,
         'mode' => $this->input->post('mode'),
         'lesson_plan_code' =>  $this->input->post('lesson_plan_code'),
         'unit' =>  $this->input->post('unit')
        ])->num_rows();


      if($cek == 0)
      {
         $lpun = $this->db->insert('lesson_plan_unit_name', [
          'category' => $table,
          'mode' => $this->input->post('mode'),
          'lesson_plan_code' =>  $this->input->post('lesson_plan_code'),
          'unit' =>  $this->input->post('unit'),
          'name' =>  $this->input->post('title')
        ]);
      }else {
        $this->db->update('lesson_plan_unit_name', [
          'category' => $table,
          'mode' => $this->input->post('mode'),
          'lesson_plan_code' =>  $this->input->post('lesson_plan_code'),
          'unit' =>  $this->input->post('unit'),
          'name' =>  $this->input->post('title')
        ],
        [
          'category' => $table,
          'mode' => $this->input->post('mode'),
          'lesson_plan_code' =>  $this->input->post('lesson_plan_code'),
          'unit' =>  $this->input->post('unit')
        ]);
      }
      $this->db->delete($table, [
        'lesson_plan_code' =>  $this->input->post('lesson_plan_code'),
        'unit' =>  $this->input->post('unit'),
        'mode' =>  $this->input->post('mode')
      ]);

      for ($i=0; $i < count($story); $i++) {
        $data = [
          'unit' => $this->input->post('unit'),
          'story' => $id_story[$i],
          'mode' => $this->input->post('mode'),
          'product_code' => $story[$i],
          'lesson_plan_code' => $this->input->post('lesson_plan_code'),
          'unlock_date' => $unlock_date[$i],
          'create_at' => time(),
          'id_admin' => $this->session->userdata('username')
        ];

        $gl = [
          'mode' => $this->input->post('mode'),
          'lesson_plan_code' => $this->input->post('lesson_plan_code'),
          'unit' => $this->input->post('unit'),
          'story' => $id_story[$i],
          'goal_target' => $goal[$i],
          'submit_limit' => $limit[$i]
        ];
        if($story[$i] != "")
        {
          $save1 = $this->db->insert('reading_goal_rule', $gl);
          $save2 = $this->db->insert($table, $data);
        }
      }

        echo json_encode(['type' => 'success', 'msg' => 'Data berhasil disimpan']);

    }

    function del($table,$mode, $id)
    {
      $type = explode('_',$table);
      $hapus = $this->db->delete($table, ['id' => $id]);
      if($hapus)
      {
        redirect(base_url('lesson_plan/'.end($type).'_'.$mode));
      }
    }

    function get_id_bank_soal($code)
    {
      $this->db->select('id');
      $res = $this->db->get_where('bank_content', ['code' => strtoupper($code)])->row();
      if($res){
        echo json_encode($res->id);
      }
    }

// ---------------------------
    function lesson_dialog_main()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_dialog d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'main'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Dialog Main',
        'dialog' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_dialog',
        'mode' => 'main'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/dialog/index', $data);
      $this->load->view('layout/footer');
    }

    function lesson_dialog_extra()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_dialog d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'extra'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Dialog Extra',
        'dialog' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_dialog',
        'mode' => 'extra'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/dialog/index', $data);
      $this->load->view('layout/footer');
    }

    function lesson_dialog_extended()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_dialog d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'extended'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Dialog Extended',
        'dialog' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_dialog',
        'mode' => 'extended'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/dialog/index', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_dialog_main()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'main'";
      $data = [
        'page_title' => 'Lesson Plan | Add Dialog Main',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_dialog',
        'mode'  => 'main',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/dialog/add', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_dialog_extra()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extra'";
      $data = [
        'page_title' => 'Lesson Plan | Add Dialog Extra',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_dialog',
        'mode'  => 'extra',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/dialog/add', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_dialog_extended()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extended'";
      $data = [
        'page_title' => 'Lesson Plan | Add Dialog Extended',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_dialog',
        'mode'  => 'extended',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/dialog/add', $data);
      $this->load->view('layout/footer');
    }


    function lesson_comprehension_main()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_comprehension d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'main'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Comprehension Main',
        'comprehension' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_comprehension',
        'mode' => 'main'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/comprehension/index', $data);
      $this->load->view('layout/footer');
    }

    function lesson_comprehension_extra()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_comprehension d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'extra'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Comprehension Extra',
        'comprehension' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_comprehension',
        'mode' => 'extra'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/comprehension/index', $data);
      $this->load->view('layout/footer');
    }

    function lesson_comprehension_extended()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_comprehension d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'extended'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Comprehension Extended',
        'comprehension' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_comprehension',
        'mode' => 'extended'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/comprehension/index', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_comprehension_main()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'main'";
      $data = [
        'page_title' => 'Lesson Plan | Add Comprehension Main',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_comprehension',
        'mode'  => 'main',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/comprehension/add', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_comprehension_extra()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extra'";
      $data = [
        'page_title' => 'Lesson Plan | Add Comprehension Extra',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_comprehension',
        'mode'  => 'extra',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/comprehension/add', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_comprehension_extended()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extended'";
      $data = [
        'page_title' => 'Lesson Plan | Add Comprehension Extended',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_comprehension',
        'mode'  => 'extended',
        'config' => 'daily_reading_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/comprehension/add', $data);
      $this->load->view('layout/footer');
    }

    function lesson_speaking_main()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_speaking d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'main'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Speaking Main',
        'comprehension' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_speaking',
        'mode' => 'main'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/speaking/index', $data);
      $this->load->view('layout/footer');
    }

    function lesson_speaking_extra()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_comprehension d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'extra'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Speaking Extra',
        'comprehension' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_speaking',
        'mode' => 'extra'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/speaking/index', $data);
      $this->load->view('layout/footer');
    }

    function lesson_speaking_extended()
    {
      $query = "SELECT d.id, d.level, d.unit, d.mode, d.product_code, b.title
                FROM lesson_plan_comprehension d
                LEFT JOIN bank_content b ON b.code = d.product_code
                WHERE d.mode = 'extended'
               ";
      $data = [
        'page_title' => 'Lesson Plan | Speaking Extended',
        'comprehension' => $this->db->query($query)->result(),
        'table' => 'lesson_plan_speaking',
        'mode' => 'extended'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/speaking/index', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_speaking_main()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'main'";
      $data = [
        'page_title' => 'Lesson Plan | Add Speaking Main',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_speaking',
        'mode'  => 'main',
        'config' => 'daily_speaking_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/speaking/add', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_speaking_extra()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extra'";
      $data = [
        'page_title' => 'Lesson Plan | Add Speaking Extra',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_speaking',
        'mode'  => 'extra',
        'config' => 'daily_speaking_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/speaking/add', $data);
      $this->load->view('layout/footer');
    }

    function add_lesson_speaking_extended()
    {
      $query = "SELECT id_level, total_unit
                FROM level
                INNER JOIN unit_name ON unit_name.level = level.id_level AND unit_name.mode = 'extended'";
      $data = [
        'page_title' => 'Lesson Plan | Add Speaking Extended',
        'level' => $this->db->get('level')->result(),
        'table' => 'lesson_plan_speaking',
        'mode'  => 'extended',
        'config' => 'daily_speaking_config'
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/speaking/add', $data);
      $this->load->view('layout/footer');
    }

    function save_lesson_dcs($table)
    {
      $unit = $this->input->post('unit[]');
      $product_code = $this->input->post('product_code[]');

      $this->db->delete($table, [
        'level' =>  $this->input->post('level'),
        'mode' =>  $this->input->post('mode')
      ]);

      for ($i=0; $i < count($unit); $i++) {
      $data = [
        'level' => $this->input->post('level'),
        'unit' => $i+1,
        'mode' => $this->input->post('mode'),
        'product_code' => $product_code[$i],
        'batch' => $this->input->post('batch')
      ];
      if($product_code[$i] != '')
      {
        $save = $this->db->insert($table, $data);
      }
      }

        echo json_encode(['type' => 'success', 'msg' => 'Data berhasil disimpan']);

    }

    function hapus_lesson_speaking($id, $mode)
    {
      $hapus = $this->db->delete('lesson_plan_speaking', ['id' => $id, 'mode' => $mode]);
      if($hapus)
      {
        redirect(base_url('lesson_plan/lesson_speaking_'.$mode));
      }
    }

    function hapus_lesson_comprehension($id, $mode)
    {
      $hapus = $this->db->delete('lesson_plan_comprehension', ['id' => $id, 'mode' => $mode]);
      if($hapus)
      {
        redirect(base_url('lesson_plan/lesson_comprehension_'.$mode));
      }
    }

    function hapus_lesson_dialog($id, $mode)
    {
      $hapus = $this->db->delete('lesson_plan_dialog', ['id' => $id, 'mode' => $mode]);
      if($hapus)
      {
        redirect(base_url('lesson_plan/lesson_dialog_'.$mode));
      }
    }


    function get_story($lesson_plan_code, $unit, $mode, $table)
    {
      $query = "SELECT *
                FROM '".$table."' tb
                LEFT JOIN lesson_total_story lts ON lts.mode = tb.mode AND lts.unit = tb.unit AND lts.level = tb.level AND lts.category = '".$table."'
                WHERE lesson_plan_code = '".$lesson_plan_code."' AND unit = '".$unit."' AND mode = '".$mode."'
                ";

      $res1 = $this->db->get_where($table, ['lesson_plan_code' => $lesson_plan_code, 'unit' => $unit, 'mode' => $mode])->result();
      $res2 = $this->db->get_where('lesson_total_story', ['lesson_plan_code' => $lesson_plan_code, 'unit' => $unit, 'mode' => $mode, 'category' => $table])->row();
      echo json_encode($res2);
    }

    function get_batch($table, $total, $mode, $lesson_plan_code)
    {
      $this->db->order_by('unit', 'ASC');
      $get = $this->db->get_where($table, ['lesson_plan_code' => $lesson_plan_code, 'mode' => $mode,]);

      $data = array_fill(0, $total, '');
      for ($i=0; $i < count($get->result()); $i++) {
        // array_push($data, $get->product_code);
        $data[$get->result()[$i]->unit] = $get->result()[$i]->product_code;
      }
      // var_dump($data); die();
      // print_r($data); die();
      $content = '';
      for ($i=1; $i <= $total; $i++) {
        $content .= '<div class="col-md-4">
              <b>Unit '.$i.'</b>
              <div class="input-group">
                  <div class="form-line">
                    <input data-unitt="'.$i.'" type="text" name="unit" class="form-control auto-complete suggest unit unit'.$i.'" value="'.$data[$i].'" maxlength="20">
                  </div>
              </div>
          </div>';
      }
      $res = [
        'content' => $content,
        'batch' => $get->row()
      ];
      echo json_encode($res);
    }


    function l_exam()
    {
      $query = "SELECT r.id, r.level, r.unit, r.story, r.product_code, un.name unit_name
                FROM lesson_plan_exam r
                LEFT JOIN exam_name un ON un.unit = r.unit AND un.level = r.level
               ";
      $data = [
        'page_title' => 'Lesson Plan | Exam',
        'exam' => $this->db->query($query)->result()
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/exam/index', $data);
      $this->load->view('layout/footer');
    }

    function add_l_exam()
    {
      $data = [
        'page_title' => 'Lesson Plan | Add Exam',
        'level' => $this->db->get('level')->result(),
      ];

      $this->load->view('layout/header', $data);
      $this->load->view('layout/sidebar');
      $this->load->view('lesson_plan/exam/add', $data);
      $this->load->view('layout/footer');
    }

    function get_unitt($level)
    {
      $this->db->order_by('total_unit', 'ASC');
      $conf = $this->db->get_where('exam_list', ['id_level' => $level])->row();
      $data = $this->db->get_where('exam_name', ['level' => $level])->result();
      $option = "<option value=''>-- Select Unit --</option>";

      if($data){
        // foreach ($conf as $key => $data) {
        //   $option .= "<option data-unit_name='".$data->name."' value='".$data->unit."'>".$data->unit." ".$data->name."</option>";
        // }
        for ($i=1; $i <= $conf->total_unit; $i++) {
            $get_unit_name = $this->db->get_where('exam_name', ['unit' => $i, 'level' => $level])->row();
            $option .= "<option data-unit_name='".$get_unit_name->name."' value='".$i."'>".$i." ".$get_unit_name->name."</option>";
        }
      }else {
        $option = "<option value=''>Sorry, unit not found !</option>";
      }
      // echo json_encode(['option' => $option, 's1' => 'axxxx']);
      echo $option;

    }

    function save_exam($table = 'lesson_plan_exam')
    {
      $story = $this->input->post('story[]');
      $id_story = $this->input->post('id_story[]');
      $cek = $this->db->get_where('exam_name', [
        'level' => $this->input->post('level'),
        'unit' => $this->input->post('unit')
        ])->num_rows();
      if($cek == 0)
      {
        $this->db->insert('exam_name', [
          'level' => $this->input->post('level'),
          'unit' => $this->input->post('unit'),
          'name' => $this->input->post('title')
        ]);
      }else {
        $this->db->update('exam_name', [
          'level' => $this->input->post('level'),
          'unit' => $this->input->post('unit'),
          'name' => $this->input->post('title')
        ],
        [
          'level' => $this->input->post('level'),
          'unit' => $this->input->post('unit')
        ]);
      }
      $this->db->delete($table, [
        'level' =>  $this->input->post('level'),
        'unit' =>  $this->input->post('unit')
        ]);

      for ($i=0; $i < count($story); $i++) {
      $data = [
        'level' => $this->input->post('level'),
        'unit' => $this->input->post('unit'),
        'story' => $i+1,
        'product_code' => $story[$i]
      ];
      if($story[$i] != "")
      {
        $save = $this->db->insert($table, $data);
      }
      }

        echo json_encode(['type' => 'success', 'msg' => 'Data berhasil disimpan']);

    }

    function get_exam_story($level, $unit, $table='lesson_plan_exam')
    {
      $res = $this->db->get_where($table, ['level' => $level, 'unit' => $unit])->result();
      echo json_encode($res);
    }

    function check_code($code)
    {
      $cek = $this->db->get_where('bank_content', ['code' => $code])->row();
      if($cek){
        echo json_encode('(title: '.$cek->title.') <span class="existing" data-status="1" style="color:green;">✔ exist</span>');
        exit();
      }else {
        echo json_encode("<span class='existing' data-status='0' style='color:red;'>this code doesn't exist!</span>");
        exit();
      }

    }

    function check_calendar($code)
    {
      $term = $this->db->get('current_term')->row();
      $this->db->where("indo_format >='$term->from_date'");
      $this->db->where("indo_format <='$term->to_date'");
      $this->db->where('clc_format', $code);
      $cek = $this->db->get('calendar')->row();
      if($cek){
        echo json_encode('<span class="" data-status="1" style="color:green;">✔ exist</span>');
        exit();
      }else {
        echo json_encode("<span class='' data-status='0' style='color:red;'>this code doesn't exist!</span>");
        exit();
      }

    }

    function get_lesson_plan_code($id, $code, $mode = 'main')
    {
      $lesson_plan_config = $this->db->get_where('lesson_plan_config', ['code' => $code])->row();
      // var_dump($lvl);
      // exit();
      // if($lesson_plan_config)
      // {
        $option = '<option>- Pilih Unit -</option>';
        for ($i=1; $i <= $lesson_plan_config->total_main_unit; $i++) {
          $unit_name = $this->db->get_where('lesson_plan_unit_name',
          ['mode' => $mode,
           'lesson_plan_code' => strval($code),
           'unit' => strval($i)])->row();
           if($unit_name){
             $option .= "<option data-title='".$unit_name->name."' value=".$i.">".$i."</option>";
           }else {
             $option .= "<option data-title='' value=".$i.">".$i."</option>";
           }
        }
        echo json_encode(['option' => $option]);
      // }
    }

}
