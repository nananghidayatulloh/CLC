<?php
    $CI =& get_instance();
    $CI->load->model(['m_current', 'm_app_version']);

    $current        = $CI->m_current->getCurrentTerm()->result_array()[0];
    $app_version	= $CI->m_app_version->getAppVersion()->result_array();
    $session        = $this->session->userdata('role_user');
    $total_guru 	= $this->db->get('guru')->num_rows() - 1;
    $total_siswa 	= $this->db->get('siswa')->num_rows();
?>

<body class="theme-orange">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-amber">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Mohon Tunggu Sebentar...</p>
        </div>
    </div>
    <div class="overlay"></div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?=base_url()?>admin">CHILDREN LEARNING CHINESE</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-center navbar-header">
                    <li class="navbar-brand">CURRENT TERM : <?=$current['from_date']?> - <?=$current['to_date']?> <span><button class="btn btn-xs btn-primary waves-effect" data-toggle="modal" data-target="#modal_current_term">EDIT</button></span></li>
                </ul>
                <!-- <?php if ($session == "superadmin") :?> -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                    </ul>
                <!-- <?php endif;?> -->
            </div>
        </div>
    </nav>
    
    <section>
        <aside id="leftsidebar" class="sidebar">
            <div class="menu">
                <ul class="list">
                    <li <?php if($this->uri->segment(1)=="dashboard") { echo 'class="active"'; } ?>>
                        <a href="<?=base_url()?>dashboard">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <?php if ($session == "superadmin") :?>
                        <li <?php if($this->uri->segment(2)=="administrator" || $this->uri->segment(2)=="administrator_tambah" || $this->uri->segment(2)=="administrator_edit") { echo 'class="active"'; } ?>>
                            <a href="<?=base_url()?>admin/administrator">
                                <i class="material-icons">people</i>
                                <span>Daftar Administrator</span>
                            </a>
                        </li>
                    <?php endif;?>

                    <li <?php if($this->uri->segment(2)=="kantor_cabang" || $this->uri->segment(2)=="kantor_cabang_tambah" || $this->uri->segment(2)=="kantor_cabang_edit") { echo 'class="active"'; } ?>>
                        <a href="<?=base_url()?>admin/kantor_cabang">
                            <i class="material-icons">place</i>
                            <span>Kantor Cabang</span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2)=="template_comment") { echo 'class="active"'; } ?>>
                        <a href="<?=base_url()?>admin/template_comment">
                            <i class="material-icons">forum</i>
                            <span>Template Comment</span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2)=="level_siswa" || $this->uri->segment(2)=="level_siswa_tambah" || $this->uri->segment(2)=="level_siswa_edit") { echo 'class="active"'; }?>>
                        <a href="<?=base_url()?>admin/level_siswa">
                            <i class="material-icons">filter_list</i>
                            <span>Daftar Level</span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2)=="guru" || $this->uri->segment(2)=="guru_tambah" || $this->uri->segment(2)=="guru_edit") { echo 'class="active"'; }?>>
                        <a href="<?=base_url()?>admin/guru">
                            <i class="material-icons">tag_faces</i>
                            <span>Daftar Guru</span> <span class="label bg-orange"> <font color="white"><?=$total_guru?></font> </span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2)=="siswa" || $this->uri->segment(2)=="siswa_tambah" || $this->uri->segment(2)=="siswa_edit") { echo 'class="active"'; }?>>
                        <a href="<?=base_url()?>admin/siswa">
                            <i class="material-icons">face</i>
                            <span>Daftar Siswa </span> <span class="label bg-orange"> <font color="white"><?=$total_siswa?> </font></span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2) == "log_daily_reading" || $this->uri->segment(2) == "log_dialog" || $this->uri->segment(2) == "log_exam" || $this->uri->segment(2) == "log_comprehension" || $this->uri->segment(2) == "log_recording" || $this->uri->segment(2)=="log_quiz_dialog" || $this->uri->segment(2)=="log_quiz_comprehension") { echo 'class="active"'; } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">schedule</i>
                            <span>Log Harian</span>
                        </a>
                        <ul class="ml-menu">
                            <!-- <li <?php if($this->uri->segment(2)=="log_daily_reading") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>admin/log_daily_reading">Daily Reading</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="log_dialog") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>admin/log_dialog">Dialog</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="log_exam") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>admin/log_exam">Exam</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="log_comprehension") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>admin/log_comprehension">Comprehension</a>
                            </li> -->
                            <li <?php if($this->uri->segment(2)=="log_quiz_dialog" || $this->uri->segment(2)=="log_quiz_comprehension") { echo 'class="active"'; } ?>>
                                <a href="javascript:void(0);" class="menu-toggle"> Quiz </span></a>
                                <ul class="ml-menu">
                                    <li <?php if($this->uri->segment(2)=="log_quiz_dialog") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>admin/log_quiz_dialog">
                                            <span>Dialog</span>
                                        </a>
                                    </li>
                                    <li <?php if($this->uri->segment(2)=="log_quiz_comprehension") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>admin/log_quiz_comprehension">
                                            <span>Comprehension</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($this->uri->segment(2)=="log_recording") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>admin/log_recording"> Recording </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li <?php if($this->uri->segment(2)=="leaderboard") { echo 'class="active"'; } ?>>
                        <a href="<?=base_url()?>admin/leaderboard">
                            <i class="material-icons">equalizer</i>
                            <span>Leaderboard</span>
                        </a>
                    </li> -->

                    <li <?php if($this->uri->segment(2) == "leaderboard_dailyreading" || $this->uri->segment(2) == "leaderboard_dailyreading_extended" || $this->uri->segment(2) == "leaderboard_dialog" || $this->uri->segment(2) == "leaderboard_comprehension") { echo 'class="active"'; } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">equalizer</i>
                            <span> Leaderboard </span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if($this->uri->segment(2)=="leaderboard_dailyreading") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>leaderboard/leaderboard_dailyreading">Daily Reading</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="leaderboard_dailyreading_extended") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>leaderboard/leaderboard_extended">Daily Reading Extended</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="leaderboard_dialog") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>leaderboard/leaderboard_dialog">Dialog</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="leaderboard_comprehension") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>leaderboard/leaderboard_comprehension">Exam</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- <li <?php if($this->uri->segment(2) == "daily_reading" || $this->uri->segment(2) == "dialog" || $this->uri->segment(2) == "exam" || $this->uri->segment(2) == "comprehension") { echo 'class="active"'; } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">file_upload</i>
                            <span>Upload Content</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if($this->uri->segment(2)=="daily_reading") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>admin/daily_reading">Daily Reading</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="dialog") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>dialog/dialog">Dialog</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="exam") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>exam">Exam</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="comprehension") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>comprehension">Comprehension</a>
                            </li>
                        </ul>
                    </li> -->

                    <li <?php if($this->uri->segment(2) == "daily_reading_main" || $this->uri->segment(2) == "daily_reading_extra" || $this->uri->segment(2) == "daily_reading_extended" || $this->uri->segment(2)=="dialog_main" || $this->uri->segment(2)=="dialog_extra" || $this->uri->segment(2) == "comprehension_main" || $this->uri->segment(2)=="comprehension_extra") { echo 'class="active"'; } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">file_upload</i>
                            <span> Upload Content </span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if($this->uri->segment(2)=="daily_reading_main" || $this->uri->segment(2)=="daily_reading_extra" || $this->uri->segment(2)=="daily_reading_extended") { echo 'class="active"'; } ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Daily Reading</code></span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php if($this->uri->segment(2)=="daily_reading_main") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>daily_reading/daily_reading_main">
                                            <span>Main</span>
                                        </a>
                                    </li>
                                    <li <?php if($this->uri->segment(2)=="daily_reading_extra") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>daily_reading/daily_reading_extra">
                                            <span>Extra</span>
                                        </a>
                                    </li>
                                    <li <?php if($this->uri->segment(2)=="daily_reading_extended") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>daily_reading/daily_reading_extended">
                                            <span>Extended</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($this->uri->segment(2)=="dialog_main" || $this->uri->segment(2)=="dialog_extra") { echo 'class="active"'; } ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Dialog</code></span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php if($this->uri->segment(2)=="dialog_main") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>dialog/dialog_main">
                                            <span>Main</span>
                                        </a>
                                    </li>
                                    <li <?php if($this->uri->segment(2)=="dialog_extra") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>dialog/dialog_extra">
                                            <span>Extra</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($this->uri->segment(2)=="exam") { echo 'class="active"'; } ?>>
                                <a href="<?=base_url()?>exam">Exam</a>
                            </li>
                            <li <?php if($this->uri->segment(2)=="comprehension_main" || $this->uri->segment(2)=="comprehension_extra") { echo 'class="active"'; } ?>>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Comprehension</code></span>
                                </a>
                                <ul class="ml-menu">
                                    <li <?php if($this->uri->segment(2)=="comprehension_main") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>comprehension/comprehension_main">
                                            <span>Main</span>
                                        </a>
                                    </li>
                                    <li <?php if($this->uri->segment(2)=="comprehension_extra") { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url()?>comprehension/comprehension_extra">
                                            <span>Extra</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li <?php if($this->uri->segment(2)=="clear_warning") { echo 'class="active"'; } ?>>
                        <a href="<?=base_url()?>admin/clear_warning">
                            <i class="material-icons">warning</i>
                            <span>Warning Siswa</span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2)=="reminder") { echo 'class="active"'; }?>>
                        <a href="<?=base_url()?>admin/reminder">
                            <i class="material-icons">access_alarms</i>
                            <span>Reminder</span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2)=="talk_mandarin") { echo 'class="active"'; }?>>
                        <a href="<?=base_url()?>talk_mandarin">
                            <i class="material-icons">access_alarms</i>
                            <span>Talk Mandarin</span>
                        </a>
                    </li>

                    <li <?php if($this->uri->segment(2) == "news" || $this->uri->segment(2) == "tambah_news" || $this->uri->segment(2) == "edit_news") { echo 'class="active"'; }?>>
                        <a href="<?=base_url()?>news">
                            <i class="material-icons">info</i>
                            <span>News</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?=base_url()?>login/signout">
                            <i class="material-icons">text_fields</i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">CLC - Children Learning Chinese</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <?php if ($session == "superadmin") :?>
            <aside id="rightsidebar" class="right-sidebar">
                <div role="tabpanel" class="tab-pane fade in active in active" id="settings">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header text-center">
                                    <h2>
                                        APP VERSION
                                    </h2>
                                </div>
                                <div class="body">
                                    <?=form_open('dashboard/app_version_edit', 'id="form_app_version"')?>
                                        <?php
                                            foreach ($app_version as $av):
                                        ?>
                                        <ul class="list-group">
                                            <label><?=strtoupper(str_replace("_"," ",$av['app_version_for']))?></label>
                                            <input type="text" class="form-control" name="<?=$av['app_version_for']?>" value="<?=$av['current_version']?>" onKeyPress="return onlyNumbersWithDot(event);" >
                                        </ul>
                                        <?php endforeach?>
                                        <ul class="list-group">
                                            <button class="btn btn-primary btn-block waves-effect" id="submit_app_version">SUBMIT</button>
                                        </ul>
                                    <?=form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        <?php endif;?>
    </section>
    <div class="modal fade" id="modal_current_term" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="largeModalLabel">Edit Current Term</h4>
                </div>
                <div class="modal-body">
                    <?=form_open('dashboard/current_term_edit')?>
                        <input type="hidden" name="no" value="<?=$current['no']?>">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <b>Dari</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker1" name="from_date" value="<?=$current['from_date']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>Sampai</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker2" name="to_date" value="<?=$current['to_date']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <b>Notice</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">announcement</i>
                                        </span>
                                        <div class="form-line">
                                            <textarea class="form-control" rows="8" name="end_term_notice"><?=$current['end_term_notice']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="input-group">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block waves-effect">
                                            <i class="material-icons">input</i>
                                            <span>SUBMIT</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>