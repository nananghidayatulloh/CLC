<section class="content">
    <div class="container-fluid">
        <?php 
            if ($this->session->flashdata('simpan')){
            echo '<div class="flash-akun" data-flashakun="'.$this->session->flashdata('simpan').'"></div>';
            } else if ($this->session->flashdata('salah')){
            echo '<div class="flash-error" data-flasherror="'.$this->session->flashdata('salah').'"></div>';
            }
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Level Siswa &nbsp;&nbsp;&nbsp;</h2>
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#level_edit" data-toggle="tab">Level Edit</a></li>
                                <li role="presentation"><a href="#daily_reading_main" data-toggle="tab">Daily Reading Main</a></li>
                                <li role="presentation"><a href="#daily_reading_extra" data-toggle="tab">Daily Reading Extra</a></li>
                                <li role="presentation"><a href="#daily_reading_extended" data-toggle="tab">Daily Reading Extended</a></li>
                                <li role="presentation"><a href="#dialog" data-toggle="tab">Dialog</a></li>
                                <li role="presentation"><a href="#comprehension" data-toggle="tab">Comprehension</a></li>
                                <li role="presentation"><a href="#speaking" data-toggle="tab">Speaking</a></li>
                                <li role="presentation"><a href="#exam_edit" data-toggle="tab">Exam Edit</a></li>
                                <li role="presentation"><a href="#selftest" data-toggle="tab">Selftest</a></li>
                            </ul>
                        </div>
                    <div class="body">
                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane fade in active" id="level_edit">
                                <a href="<?=base_url()?>admin/level_siswa_tambah" type="button" class="btn bg-teal btn-xs waves-effect">
                                    <i class="material-icons">add</i>
                                    <span>Tambah Level</span>
                                </a>
                                <br><br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="table-responsive pt-5">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"></th>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Level</th>
                                                        <th class="text-center">Time Limit</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 1;
                                                        foreach($level as $lvl): 
                                                    ?>
                                                    <tr id="tr<?=$no;?>">
                                                        <td class="text-center">
                                                            <a href="<?=base_URL()?>admin/level_siswa_hapus/<?=encrypt_url($lvl['id_level'])?>" class="btn btn-xs bg-red waves-effect tombol_hapus" title="Hapus"><i class="material-icons">delete</i><span>Hapus</span></a>
                                                        </td>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$lvl['id_level']?>
                                                            <input type="hidden" name="id_level" id="id_level<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                        </td>
                                                        <td class="text-center">
                                                            <input id="time_limit<?=$no?>" type="number" onchange="$.editBg(<?=$no;?>)" name="time_limit" min="1" max="24" value="<?=$lvl['time_limit'];?>" style="width: 40px" required> : 00
                                                        </td>
                                                        <td class="text-center">
                                                            <a type="button" id="button" onclick="$.submit(<?=$no?>)"  class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="exam_edit">
                                <div class="table-responsive pt-5">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:5%;">No</th>
                                                <th class="text-center" style="width:15%;">Level</th>
                                                <th class="text-center">Jumlah Unit</th>
                                                <th class="text-center" style="width:55%;">Unit</th>
                                                <th class="text-center" style="width:5%;">Story</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($level as $lvl):
                                                $ci =& get_instance();
                                                $dataExam = $ci->m_level->data_level_exam($lvl['id_level'])->row_array();
                                                $count_file_exam    = $ci->m_level->getCountFile('Exam', '', $lvl['id_level']);
                                            ?>
                                            <tr id="tr_exam<?=$no;?>">
                                                <td class="text-center"><?=$no?>.</td>
                                                <td class="text-center"><?=$lvl['id_level']?>
                                                    <input type="hidden" name="id_level_exam" id="id_level_exam<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                    <br>
                                                    <label>File : <?=$count_file_exam?></label>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="text-center" style="width:80px" data-id_level="<?=$lvl['id_level']?>" id="total_unit_exam<?=$no?>" name="total_unit_exam<?=$no?>" value="<?=$dataExam['total_unit']?>" onchange="$.totalUnitChangeExam(<?=$no?>)" oninput="this.onchange()" min="0" max="100">
                                                    
                                                </td>
                                                <td id="unit_exam<?=$no?>"></td>
                                                <td id="story_exam<?=$no?>"></td>
                                                    <input type="hidden" id="isi_unit_exam<?=$no?>" value="<?=$dataExam['unit_aktif']?>">
                                                    <input type="hidden" id="isi_story_exam<?=$no?>" value="<?=$dataExam['story_aktif']?>">
                                                <td class="text-center">
                                                    <a type="button" id="button_exam" onclick="$.submitExam(<?=$no?>)"  class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade in" id="daily_reading_main">
                                <div class="table-responsive pt-5">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center" style="width:5%;">No</th>
                                                <th class="text-center" style="width:8%;">Level</th>
                                                <th class="text-center">Jumlah Unit</th>
                                                <th class="text-center" style="width:55%;">Unit</th>
                                                <th class="text-center" style="width:15%;">Story</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($level as $lvl):
                                                $ci =& get_instance();
                                                $data_daily_reading = $ci->m_level->data_daily_reading_main($lvl['id_level'])->row_array();
                                                $count_file_main    = $ci->m_level->getCountFile('DailyReading', 'Main', $lvl['id_level']);
                                            ?>
                                            <tr id="tr_daily_reading_main<?=$no;?>">
                                                <td class="text-center">
                                                    <button type="button" class="btn bg-red btn-xs waves-effect clear_log" title="Clear Log" data-level="<?=$lvl['id_level']?>" data-mode="main"> <i class="material-icons">delete</i> Clear Log </button>
                                                </td>
                                                <td class="text-center"><?=$no?>.</td>
                                                <td class="text-center"><?=$lvl['id_level']?>
                                                    <br>
                                                    <input type="hidden" name="id_level_daily_reading_main" id="id_level_daily_reading_main<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                    <label> File : <?=$count_file_main?></label>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="text-center" style="width:80px" data-id_level="<?=$lvl['id_level']?>" id="main_total_unit<?=$no?>" name="main_total_unit<?=$no?>" value="<?=$data_daily_reading['main_total_unit']?>" onchange="$.main_total_unit_change(<?=$no?>)" oninput="this.onchange()" min="0" max="100">
                                                    
                                                </td>
                                                <td id="main_unit_active<?=$no?>"></td>
                                                <td id="main_story_active<?=$no?>"></td>
                                                    <input type="hidden" id="isi_main_unit_active<?=$no?>" value="<?=$data_daily_reading['main_unit_active']?>">
                                                    <input type="hidden" id="isi_main_story_active<?=$no?>" value="<?=$data_daily_reading['main_story_active']?>">
                                                <td class="text-center">
                                                    <a type="button" id="button_daily_reading_main" onclick="$.submit_daily_reading_main(<?=$no?>)"  class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade in" id="daily_reading_extra">
                                <div class="table-responsive pt-5">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center" style="width:5%;">No</th>
                                                <th class="text-center" style="width:8%;">Level</th>
                                                <th class="text-center">Jumlah Unit</th>
                                                <th class="text-center" style="width:55%;">Unit</th>
                                                <th class="text-center" style="width:15%;">Story</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($level as $lvl):
                                                $ci =& get_instance();
                                                $data_daily_reading = $ci->m_level->data_daily_reading_main($lvl['id_level'])->row_array();
                                                $count_file_extra   = $ci->m_level->getCountFile('DailyReading', 'Extra', $lvl['id_level']);
                                            ?>
                                            <tr id="tr_daily_reading_extra<?=$no;?>">
                                                <td class="text-center">
                                                    <button type="button" class="btn bg-red btn-xs waves-effect clear_log" title="Clear Log" data-level="<?=$lvl['id_level']?>" data-mode="extra"> <i class="material-icons">delete</i> Clear Log </button>
                                                </td>
                                                <td class="text-center"><?=$no?>.</td>
                                                <td class="text-center"><?=$lvl['id_level']?>
                                                    <br>
                                                    <input type="hidden" name="id_level_daily_reading_extra" id="id_level_daily_reading_extra<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                    <label>File : <?=$count_file_extra?></label>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="text-center" style="width:80px" data-id_level="<?=$lvl['id_level']?>" id="extra_total_unit<?=$no?>" name="extra_total_unit<?=$no?>" value="<?=$data_daily_reading['extra_total_unit']?>" onchange="$.extra_total_unit_change(<?=$no?>)" oninput="this.onchange()" min="0" max="100">
                                                    
                                                </td>
                                                <td id="extra_unit_active<?=$no?>"></td>
                                                <td id="extra_story_active<?=$no?>"></td>
                                                    <input type="hidden" id="isi_extra_unit_active<?=$no?>" value="<?=$data_daily_reading['extra_unit_active']?>">
                                                    <input type="hidden" id="isi_extra_story_active<?=$no?>" value="<?=$data_daily_reading['extra_story_active']?>">
                                                <td class="text-center">
                                                    <a type="button" id="button_daily_reading_extra" onclick="$.submit_daily_reading_extra(<?=$no?>)"  class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade in" id="daily_reading_extended">
                                <div class="table-responsive pt-5">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center" style="width:5%;">No</th>
                                                <th class="text-center" style="width:8%;">Level</th>
                                                <th class="text-center">Jumlah Unit</th>
                                                <th class="text-center" style="width:55%;">Unit</th>
                                                <th class="text-center" style="width:15%;">Story</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($level as $lvl):
                                                $ci =& get_instance();
                                                $data_daily_reading = $ci->m_level->data_daily_reading_main($lvl['id_level'])->row_array();
                                                $count_file_extended= $ci->m_level->getCountFile('DailyReading', 'Extended', $lvl['id_level']);
                                            ?>
                                            <tr id="tr_daily_reading_extended<?=$no;?>">
                                                <td class="text-center">
                                                    <button type="button" class="btn bg-red btn-xs waves-effect clear_log" title="Clear Log" data-level="<?=$lvl['id_level']?>" data-mode="extended"> <i class="material-icons">delete</i> Clear Log </button>
                                                </td>
                                                <td class="text-center"><?=$no?>.</td>
                                                <td class="text-center"><?=$lvl['id_level']?>
                                                    <br>
                                                    <input type="hidden" name="id_level_daily_reading_extended" id="id_level_daily_reading_extended<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                    <label> File : <?=$count_file_extended?></label>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="text-center" style="width:80px" data-id_level="<?=$lvl['id_level']?>" id="extended_total_unit<?=$no?>" name="extended_total_unit<?=$no?>" value="<?=$data_daily_reading['extended_total_unit']?>" onchange="$.extended_total_unit_change(<?=$no?>)" oninput="this.onchange()" min="0" max="100">
                                                    
                                                </td>
                                                <td id="extended_unit_active<?=$no?>"></td>
                                                <td id="extended_story_active<?=$no?>"></td>
                                                    <input type="hidden" id="isi_extended_unit_active<?=$no?>" value="<?=$data_daily_reading['extended_unit_active']?>">
                                                    <input type="hidden" id="isi_extended_story_active<?=$no?>" value="<?=$data_daily_reading['extended_story_active']?>">
                                                <td class="text-center">
                                                    <a type="button" id="button_daily_reading_extended" onclick="$.submit_daily_reading_extended(<?=$no?>)"  class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade in" id="dialog">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="table-responsive pt-5">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th class="text-center" style="width:5%;">No</th>
                                                        <th class="text-center" style="width:15%;">Level</th>
                                                        <th class="text-center">Jumlah Unit Main</th>
                                                        <th class="text-center">Jumlah Unit Extra</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 1;
                                                        foreach($level as $lvl):
                                                        $ci =& get_instance();
                                                        $data_dialog = $ci->m_level->data_level_dialog($lvl['id_level'])->row_array();
                                                        $count_file_dialog_main   = $ci->m_level->getCountFile('Dialog', 'Main', $lvl['id_level']);
                                                        $count_file_dialog_extra   = $ci->m_level->getCountFile('Dialog', 'Extra', $lvl['id_level']);
                                                    ?>
                                                    <tr id="tr_dialog<?=$no;?>">
                                                        <td class="text-center">
                                                            <button type="button" class="btn bg-red btn-xs waves-effect clear_log" title="Clear Log" data-level="<?=$lvl['id_level']?>" data-mode="dialog"> <i class="material-icons">delete</i> Clear Log </button>
                                                        </td>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$lvl['id_level']?>
                                                            <input type="hidden" name="id_level_dialog" id="id_level_dialog<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                            <label>File Main : <?=$count_file_dialog_main?></label>
                                                            <label>File Extra : <?=$count_file_dialog_extra?></label>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" class="text-center form-control" data-id_level="<?=$lvl['id_level']?>" id="dialog_main_total_unit<?=$no?>" name="dialog_main_total_unit<?=$no?>" value="<?=$data_dialog['main_total_unit']?>" min="0" max="100">
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" class="text-center form-control" id="dialog_extra_total_unit<?=$no?>" name="dialog_extra_total_unit<?=$no?>" value="<?=$data_dialog['extra_total_unit']?>" min="0" max="100">
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                            <a type="button" id="button_dialog" class="btn bg-orange btn-xs waves-effect" title="Edit" onclick="$.submit_dialog(<?=$no?>)"><i class="material-icons">create</i><span>Edit</span></a>


                                                            <a type="button" id="button_lock_dialog" class="btn bg-cyan btn-xs waves-effect" title="Lock" onclick="$.lock_dialog(<?=$no?>)"><i class="material-icons">lock_outline</i><span>Lock</span></a>

                                                            <a type="button" id="button_unlock_dialog" class="btn bg-green btn-xs waves-effect" title="Unlock" onclick="$.unlock_dialog(<?=$no?>)"><i class="material-icons">lock_open</i><span>Unlock</span></a>
                                                        </td>

                                                    </tr>
                                                    <?php $no++; endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade in" id="comprehension">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="table-responsive pt-5">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th class="text-center" style="width:5%;">No</th>
                                                        <th class="text-center" style="width:15%;">Level</th>
                                                        <th class="text-center">Jumlah Unit Main</th>
                                                        <th class="text-center">Jumlah Unit Extra</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 1;
                                                        foreach($level as $lvl):
                                                        $ci =& get_instance();
                                                        $data_comprehension = $ci->m_level->data_level_comprehension($lvl['id_level'])->row_array();
                                                        $count_file_comprehension_main    = $ci->m_level->getCountFile('Comprehension', 'Main', $lvl['id_level']);
                                                        $count_file_comprehension_extra   = $ci->m_level->getCountFile('Comprehension', 'Extra', $lvl['id_level']);
                                                    ?>
                                                    <tr id="tr_comprehension<?=$no;?>">
                                                        <td class="text-center">
                                                            <button type="button" class="btn bg-red btn-xs waves-effect clear_log" title="Clear Log" data-level="<?=$lvl['id_level']?>" data-mode="comprehension"> <i class="material-icons">delete</i> Clear Log </button>
                                                        </td>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$lvl['id_level']?>
                                                            <input type="hidden" name="id_level_comprehension" data-id_level="<?=$lvl['id_level']?>" id="id_level_comprehension<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                            <br>
                                                            <label>File Main : <?=$count_file_comprehension_main?></label>
                                                            <label>File Extra : <?=$count_file_comprehension_extra?></label>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" class="text-center form-control" id="comprehension_main_total_unit<?=$no?>" name="comprehension_main_total_unit<?=$no?>" value="<?=$data_comprehension['main_total_unit']?>" min="0" max="100">
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" class="text-center form-control" id="comprehension_extra_total_unit<?=$no?>" name="comprehension_extra_total_unit<?=$no?>" value="<?=$data_comprehension['extra_total_unit']?>" min="0" max="100">
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                            <a type="button" id="button_comprehension" class="btn bg-orange btn-xs waves-effect" title="Edit" onclick="$.submit_comprehension(<?=$no?>)"><i class="material-icons">create</i><span>Edit</span></a>

                                                            <a type="button" id="button_lock_comprehension" class="btn bg-cyan btn-xs waves-effect" title="Lock" onclick="$.lock_comprehension(<?=$no?>)"><i class="material-icons">lock_outline</i><span>Lock</span></a>

                                                            <a type="button" id="button_unlock_comprehension" class="btn bg-green btn-xs waves-effect" title="Unlock" onclick="$.unlock_comprehension(<?=$no?>)"><i class="material-icons">lock_open</i><span>Unlock</span></a>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade in" id="speaking">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="table-responsive pt-5">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th class="text-center" style="width:5%;">No</th>
                                                        <th class="text-center" style="width:15%;">Level</th>
                                                        <th class="text-center">Jumlah Unit Main</th>
                                                        <th class="text-center">Jumlah Unit Extra</th>
                                                        <th class="text-center">Main Unit Free Pass</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 1;
                                                        foreach($level as $lvl):
                                                        $ci =& get_instance();
                                                        $data_speaking = $ci->m_level->data_level_speaking($lvl['id_level'])->row_array();
                                                        $count_file_speaking_main   = $ci->m_level->getCountFile('DailySpeaking', 'Main', $lvl['id_level']);
                                                        $count_file_speaking_extra   = $ci->m_level->getCountFile('DailySpeaking', 'Extra', $lvl['id_level']);
                                                    ?>
                                                    <tr id="tr_speaking<?=$no;?>">
                                                        <td class="text-center">
                                                            <button type="button" class="btn bg-red btn-xs waves-effect clear_log" title="Clear Log" data-level="<?=$lvl['id_level']?>" data-mode="speaking"> <i class="material-icons">delete</i> Clear Log </button>
                                                        </td>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$lvl['id_level']?>
                                                            <input type="hidden" name="id_level_speaking" id="id_level_speaking<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                            <label>File Main : <?=$count_file_speaking_main?></label>
                                                            <label>File Extra : <?=$count_file_speaking_extra?></label>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" class="text-center form-control" data-id_level="<?=$lvl['id_level']?>" id="speaking_main_total_unit<?=$no?>" name="speaking_main_total_unit<?=$no?>" value="<?=$data_speaking['main_total_unit']?>" min="0" max="100">
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" class="text-center form-control" id="speaking_extra_total_unit<?=$no?>" name="speaking_extra_total_unit<?=$no?>" value="<?=$data_speaking['extra_total_unit']?>" min="0" max="100">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="number" class="text-center form-control" id="main_submitcount_freepass<?=$no?>" name="main_submitcount_freepass<?=$no?>" value="<?=$data_speaking['main_submitcount_freepass']?>" min="0" max="100">
                                                        </td>
                                                        <td class="text-center">
                                                            <a type="button" id="button_speaking" class="btn bg-orange btn-xs waves-effect" title="Edit" onclick="$.submit_speaking(<?=$no?>)"><i class="material-icons">create</i><span>Edit</span></a>


                                                            <a type="button" id="button_lock_speaking" class="btn bg-cyan btn-xs waves-effect" title="Lock" onclick="$.lock_speaking(<?=$no?>)"><i class="material-icons">lock_outline</i><span>Lock</span></a>

                                                            <a type="button" id="button_unlock_speaking" class="btn bg-green btn-xs waves-effect" title="Unlock" onclick="$.unlock_speaking(<?=$no?>)"><i class="material-icons">lock_open</i><span>Unlock</span></a>
                                                        </td>

                                                    </tr>
                                                    <?php $no++; endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade in" id="selftest">
                                <div class="table-responsive pt-5">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center" style="width:5%;">No</th>
                                                <th class="text-center" style="width:15%;">Level</th>
                                                <th class="text-center">Jumlah Subject</th>
                                                <th class="text-center" style="width:55%;">Subject</th>
                                                <th class="text-center">Jumlah Unit</th>
                                                <th class="text-center" style="width:55%;">Unit</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($level as $lvl):
                                                $ci =& get_instance();
                                                $data_selftest_quiz     = $ci->m_level->data_selftest_quiz($lvl['id_level'])->row_array();
                                                $count_file_selftest    = $ci->m_level->getCountFileSelftest($data_selftest_quiz['total_subject'], $lvl['id_level']);
                                            ?>
                                            <tr id="tr_selftest<?=$no;?>">
                                                <td class="text-center">
                                                    <button type="button" class="btn bg-red btn-xs waves-effect clear_log" title="Clear Log" data-level="<?=$lvl['id_level']?>" data-mode="selftest"> <i class="material-icons">delete</i> Clear Log </button>
                                                </td>

                                                <td class="text-center"><?=$no?>.</td>

                                                <td class="text-center"><?=$lvl['id_level']?>
                                                    <input type="hidden" name="id_level_selftest" id="id_level_selftest<?=$no?>" class="text-center" value="<?=$lvl['id_level']?>" style="width:80px">
                                                    <br>
                                                    <?php if($count_file_selftest != NULL) :?>
                                                        <?php foreach ($count_file_selftest as $file) : ?>
                                                            <?php if (isset($file['subject'])) : ?>
                                                                <label><?=$file['subject'].", ".$file['content_type']." File : ".$file[$file['content_type']];?></label>
                                                            <?php endif;?>
                                                        <?php endforeach;?>
                                                    <?php else : ?>
                                                        <Label>File : 0</Label>
                                                    <?php endif;?>
                                                </td>

                                                <td class="text-center">
                                                    <input type="number" class="text-center" style="width:80px" data-id_level="<?=$lvl['id_level']?>" id="selftest_total_subject<?=$no?>" name="total_subject<?=$no?>" value="<?=$data_selftest_quiz['total_subject']?>" onchange="$.total_subject_change(<?=$no?>)" oninput="this.onchange()" min="0" max="100">
                                                </td>

                                                <td id="selftest_subject_active<?=$no?>"></td>
                                                    <input type="hidden" id="isi_selftest_subject_active<?=$no?>" value="<?=$data_selftest_quiz['subject_active']?>">

                                                <td class="text-center">
                                                    <input type="number" class="text-center" style="width:80px" data-id_level="<?=$lvl['id_level']?>" id="selftest_total_unit<?=$no?>" name="total_unit<?=$no?>" value="<?=$data_selftest_quiz['total_unit']?>" onchange="$.total_unit_change(<?=$no?>)" oninput="this.onchange()" min="0" max="100">
                                                </td>

                                                <td id="selftest_unit_active<?=$no?>"></td>
                                                    <input type="hidden" id="isi_selftest_unit_active<?=$no?>" value="<?=$data_selftest_quiz['unit_active']?>">

                                                <td class="text-center">
                                                    <a type="button" id="button_selftest" onclick="$.submit_selftest(<?=$no?>)"  class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $( document ).ready(function() {

        var rules_story = {};

        $.validate = function(evt) {
            var theEvent = evt || window.event;

            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        
        $.editBg = function(i){
            $("tr[id='tr"+i+"']").css("background-color", "#FFDAA3");
            $("tr[id='tr_exam"+i+"']").css("background-color", "#FFDAA3");
            $("tr[id='tr_daily_reading_main"+i+"']").css("background-color", "#FFDAA3");
            $("tr[id='tr_daily_reading_extra"+i+"']").css("background-color", "#FFDAA3");
            $("tr[id='tr_daily_reading_extended"+i+"']").css("background-color", "#FFDAA3");
        }

        $.RemoveEditBg = function(i){
            $("tr[id='tr"+i+"']").css("background-color", "");
            $("tr[id='tr_exam"+i+"']").css("background-color", "");
            $("tr[id='tr_daily_reading_main"+i+"']").css("background-color", "");
            $("tr[id='tr_daily_reading_extra"+i+"']").css("background-color", "");
            $("tr[id='tr_daily_reading_extended"+i+"']").css("background-color", "");
        }

        $.submit = function(button){
            var unit         = $("input[data-unit='"+button+"']:checked").serialize();
                story        = $("input[data-story='"+button+"']:checked").serialize();
                id_level     = $("#id_level"+button).val();
                total_unit   = $("#total_unit"+button).val();
                time_limit   = $("#time_limit"+button).val();
                total_dialog = $("#total_dialog"+button).val();
                total_comprehension = $("#total_comprehension"+button).val();
            
            $.ajax({
                url: "<?=base_url()?>admin/level_siswa_edit?"+unit+"&"+story+"&id_level="+id_level+"&total_unit="+total_unit+"&time_limit="+time_limit+"&total_dialog="+total_dialog+"&total_comprehension="+total_comprehension+"&mode=level_edit",
                type: 'GET',
                
                success: function(output){
                    Swal('Berhasil', 'Merubah data ini...', 'success');
                    // $("tr[id='tr"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                }
            });
        }

        $.deleteLevel = function(button){
            var id_level = $("#id_level"+button).val();
            
            $.ajax({
                url : "<?=base_url()?>admin/level_siswa_hapus?id_level="+id_level,
                type: 'GET',
                
                success: function(output){
                    Swal('Berhasil', 'Menghapus data ini...', 'success');
                    // $("tr[id='tr"+button+"']").remove();
                    $.RemoveEditBg(button);
                }
            });
        }

        $.totalUnitChangeExam = function(t){
            var id = t;
            var total_unit_exam = $("#total_unit_exam"+t).val();
            var id_level = $('#total_unit_exam'+t).data('id_level');
            var unit_aktif_exam = $("#isi_unit_exam"+t).val();
            var story_aktif_exam = $("#isi_story_exam"+t).val();
            
            if(unit_aktif_exam != null){
                var unit_aktif_split = unit_aktif_exam.split("-");
            }
            if(story_aktif_exam !=null){
                var story_aktif_split = story_aktif_exam.split("-");
            }

            var array_unit_aktif_exam = {};
            for (let j = 0; j < unit_aktif_split.length; j++) {
                array_unit_aktif_exam[unit_aktif_split[j]] = 1;
            }

            var array_story_aktif_exam = {};
            for (let j = 0; j < story_aktif_split.length; j++) {
                array_story_aktif_exam[story_aktif_split[j]] = 1;
            }

            $("td[id='unit_exam"+id+"']").html("");
            var indexunit = 0;
            for(var i = 1; i <= total_unit_exam; i++){
                
                if(array_unit_aktif_exam[i] === 1){
                    var txt1 = `<input type="checkbox" id="indexunit_exam`+id+id_level+indexunit+`" data-unit-exam="`+id+`" name="unit[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                <label for="indexunit_exam`+id+id_level+indexunit+`">`+i+`</label>`;
                }else{
                    var txt1 = `<input type="checkbox" id="indexunit_exam`+id+id_level+indexunit+`" name="unit[]" data-unit-exam="`+id+`" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                                <label for="indexunit_exam`+id+id_level+indexunit+`">`+i+`</label>`;                         
                }
                    indexunit++;
                $("td[id='unit_exam"+id+"']").append(txt1);
            }
            
            $("td[id='story_exam"+id+"']").html("");
            var indexstory = 0;
            if(total_unit_exam > 0 && !isNaN(total_unit_exam)){
                for(var i = 1; i <= 3; i++){
                    if(array_story_aktif_exam[i] === 1){
                        var txt1 = `<input type="checkbox" id="indexstory_exam`+id+id_level+indexstory+`" data-story-exam="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                <label for="indexstory_exam`+id+id_level+indexstory+`">`+i+`</label>`;
                        
                    }else{
                        var txt1 = `<input type="checkbox" id="indexstory_exam`+id+id_level+indexstory+`" data-story-exam="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                                <label for="indexstory_exam`+id+id_level+indexstory+`">`+i+`</label>`;
                    }
                    indexstory++;
                    $("td[id='story_exam"+id+"']").append(txt1);
                }
            }
        }

        $.submitExam = function(button){
            var unit        = $("input[data-unit-exam='"+button+"']:checked").serialize();
                story       = $("input[data-story-exam='"+button+"']:checked").serialize();
                id_level    = $("#id_level_exam"+button).val();
                total_unit  = $("#total_unit_exam"+button).val();
                // url = "<?=base_url()?>admin/level_siswa_edit?"+unit+"&"+story+"&id_level="+id_level+"&total_unit="+total_unit+"&mode=exam_edit";

            $.ajax({
                url: "<?=base_url()?>admin/level_siswa_edit?"+unit+"&"+story+"&id_level="+id_level+"&total_unit="+total_unit+"&mode=exam_edit",
                type: 'GET',
                
                success: function(output){
                    Swal('Berhasil', 'Merubah data ini...', 'success');
                    // $("tr[id='tr_exam"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                }
            });
        }

        $.main_total_unit_change = function(t){
            var id = t;
            var main_total_unit = $("#main_total_unit"+t).val();
            var id_level = $("#main_total_unit"+t).data('id_level');
            var main_unit_active = $("#isi_main_unit_active"+t).val();
            var main_story_active = $("#isi_main_story_active"+t).val();
            
            if(main_unit_active != null){
                var main_unit_active_split = main_unit_active.split("-");
            }

            if(main_story_active !=null){
                var main_story_active_split = main_story_active.split("-");
            }

            var array_main_unit_active = {};
            for (let j = 0; j < main_unit_active_split.length; j++) {
                array_main_unit_active[main_unit_active_split[j]] = 1;
            }

            var array_main_story_active = {};
            for (let j = 0; j < main_story_active_split.length; j++) {
                array_main_story_active[main_story_active_split[j]] = 1;
            }

            $("td[id='main_unit_active"+id+"']").html("");
            var indexunit = 0;
            for(var i = 1; i <= main_total_unit; i++){
                
                if(array_main_unit_active[i] === 1){
                    var txt1 = `<input type="checkbox" id="indexunit_main`+id+id_level+indexunit+`" data-unit-main="`+id+`" name="unit[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                <label for="indexunit_main`+id+id_level+indexunit+`">`+i+`</label>`;
                }else{
                    var txt1 = `<input type="checkbox" id="indexunit_main`+id+id_level+indexunit+`" name="unit[]" data-unit-main="`+id+`" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                                <label for="indexunit_main`+id+id_level+indexunit+`">`+i+`</label>`;
                }
                indexunit++;
                $("td[id='main_unit_active"+id+"']").append(txt1);
            }
            
            $("td[id='main_story_active"+id+"']").html("");
            var indexstory = 0;
            if(main_total_unit > 0 && !isNaN(main_total_unit)){
                for(var i = 1; i <= 3; i++){
                    if(array_main_story_active[i] === 1){
                        var txt1 = `
                                <tr>
                                <td style="padding:2px; border:0px;">
                                    <input type="checkbox" id="indexstory_main`+id+id_level+indexstory+`" data-story-main="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                    <label for="indexstory_main`+id+id_level+indexstory+`">`+i+`</label>
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="no_mistake" class="text-center" style="width:22px;" title="No Mistake" id="main_rules_no_mistake_`+id_level+i+`" onchange="$.main_rules_change('`+id_level+`', 'no_mistake', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="min_record" class="text-center" style="width:22px;" title="Min Record" id="main_rules_min_record_`+id_level+i+`" onchange="$.main_rules_change('`+id_level+`', 'min_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td style="padding:2px; border:0px;">
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="max_record" class="text-center" style="width:22px;" title="Max Record" id="main_rules_max_record_`+id_level+i+`" onchange="$.main_rules_change('`+id_level+`', 'max_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <tr>
                                `;
                        
                    }else{
                        var txt1 = `
                                    <tr>
                                    <td style="padding:2px; border:0px;">
                                        <input type="checkbox" id="indexstory_main`+id+id_level+indexstory+`" data-story-main="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                                        <label for="indexstory_main`+id+id_level+indexstory+`">`+i+`</label>
                                    </td>
                                    <td style="padding:2px; border:0px;">
                                        <input type="text" name="no_mistake" class="text-center" style="width:22px;" title="No Mistake" id="main_rules_no_mistake_`+id_level+i+`" onchange="$.main_rules_change('`+id_level+`', 'no_mistake', `+i+`, `+id+`)" oninput="this.onchange()">
                                    </td>
                                    <td style="padding:2px; border:0px;">
                                        <input type="text" name="min_record" class="text-center" style="width:22px;" title="Min Record" id="main_rules_min_record_`+id_level+i+`" onchange="$.main_rules_change('`+id_level+`', 'min_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                    </td>
                                    <td style="padding:2px; border:0px;">
                                        <input type="text" name="max_record" class="text-center" style="width:22px;" title="Max Record" id="main_rules_max_record_`+id_level+i+`" onchange="$.main_rules_change('`+id_level+`', 'max_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                    </td>
                                    </tr>
                                    `;
                    }
                    indexstory++;
                    $("td[id='main_story_active"+id+"']").append(txt1);
                }
            }
            $.get_rules_story('main',id);
        }

        $.get_rules_story = function (mode,level) {
            var id_level    = $("#id_level_daily_reading_"+mode+level).val();
            var text_rules_story      = "";
                rules_story[mode] = {};

                $.ajax({
                    url     : "<?=base_url()?>level/daily_reading_rules_story",
                    method  : 'POST',
                    data    : { id_level : id_level, mode : mode},
                    dataType: 'JSON',
                    success : function(callback) {
                        rules_story[mode][id_level] = {};
                        var parse = JSON.stringify(callback);

                            $.each($.parseJSON(parse), function (i,v)
                            {
                                var index = i + 1;
                                rules_story[mode][id_level][i] = {};
                                $('#'+mode+'_rules_no_mistake_'+id_level+index).val(v.no_mistake);
                                $('#'+mode+'_rules_min_record_'+id_level+index).val(v.min_record);
                                $('#'+mode+'_rules_max_record_'+id_level+index).val(v.max_record);

                                rules_story[mode][id_level][i]['no_mistake'] = v.no_mistake;
                                rules_story[mode][id_level][i]['min_record'] = v.min_record;
                                rules_story[mode][id_level][i]['max_record'] = v.max_record;
                            });
                    }
                });
        }

        $.main_rules_change = function (id_level, mode, t, button) {
            var value = $('#main_rules_'+mode+'_'+id_level+t).val();
            if (value != '') {
                var index = t - 1;
                rules_story['main'][id_level][index][mode] = value;
                $.editBg(button);
            }
        }

        $.submit_daily_reading_main = function(button){
            var unit        = $("input[data-unit-main='"+button+"']:checked").serialize();
            var story       = $("input[data-story-main='"+button+"']:checked").serialize();
            var id_level    = $("#id_level_daily_reading_main"+button).val();
            var total_unit  = $("#main_total_unit"+button).val();
            var rules       = "";

            for (let index = 0; index < Object.keys(rules_story['main'][id_level]).length; index++) {
                let i = index + 1;
                let no_mistake = rules_story['main'][id_level][index]['no_mistake'];
                let min_record = rules_story['main'][id_level][index]['min_record'];
                let max_record = rules_story['main'][id_level][index]['max_record'];
                rules += i+":"+no_mistake+"-"+min_record+"-"+max_record+"_";
            }

            var slice_rules  = rules.slice(0, -1);

            $.ajax({
                url: "<?=base_url()?>level/daily_reading_update?"+unit+"&"+story+"&id_level="+id_level+"&total_unit="+total_unit+"&mode=main_edit&rules_story="+slice_rules,
                type: 'GET',
                dataType: 'JSON',
                success: function(output){
                    Swal('Berhasil', output.STATUS, 'success');
                    // $("tr[id='tr_daily_reading_main"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                }
            });
        }

        $('.clear_log').on('click', function() {
            var id_level    = $(this).attr('data-level');
                mode        = $(this).attr('data-mode');

                Swal.fire({
                    title: 'Yakin akan clear log?',
                    text: "Data Ini.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya'
                }).then(function(isConfirm) {
                    if (isConfirm.value == true) {
                        if (mode == 'main') {
                            $.ajax({
                                url     : "<?=base_url()?>level/clear_log_daily_reading_main",
                                method  : 'POST',
                                data    : { id_level : id_level, mode : mode},
                                dataType: 'JSON',
                                success : function(callback) {
                                    Swal('Berhasil', callback.STATUS, 'success');
                                }
                            });
                        } else if(mode == 'extra') {
                            $.ajax({
                                url     : "<?=base_url()?>level/clear_log_daily_reading_extra",
                                method  : 'POST',
                                data    : { id_level : id_level, mode : mode},
                                dataType: 'JSON',
                                success : function(callback) {
                                    Swal('Berhasil', callback.STATUS, 'success');
                                }
                            })
                        } else if(mode == 'extended') {
                            $.ajax({
                                url     : "<?=base_url()?>level/clear_log_daily_reading_extended",
                                method  : 'POST',
                                data    : { id_level : id_level, mode : mode},
                                dataType: 'JSON',
                                success : function(callback) {
                                    Swal('Berhasil', callback.STATUS, 'success');
                                }
                            })
                        } else if(mode == 'dialog') {
                            $.ajax({
                                url     : "<?=base_url()?>level/clear_log_dialog",
                                method  : 'POST',
                                data    : { id_level : id_level},
                                dataType: 'JSON',
                                success : function(callback) {
                                    Swal('Berhasil', callback.STATUS, 'success');
                                }
                            })
                        } else if(mode == 'comprehension') {
                            $.ajax({
                                url     : "<?=base_url()?>level/clear_log_comprehension",
                                method  : 'POST',
                                data    : { id_level : id_level},
                                dataType: 'JSON',
                                success : function(callback) {
                                    Swal('Berhasil', callback.STATUS, 'success');
                                }
                            })
                        } else if(mode == 'selftest') {
                            $.ajax({
                                url     : "<?=base_url()?>level/clear_log_selftest",
                                method  : 'POST',
                                data    : { id_level : id_level, mode : mode},
                                dataType: 'JSON',
                                success : function(callback) {
                                    Swal('Berhasil', callback.STATUS, 'success');
                                }
                            })
                        }
                    }
                });
        });

        $.extra_total_unit_change = function(t){
            var id = t;
            var extra_total_unit = $("#extra_total_unit"+t).val();
            var id_level = $("#extra_total_unit"+t).data('id_level');
            var extra_unit_active = $("#isi_extra_unit_active"+t).val();
            var extra_story_active = $("#isi_extra_story_active"+t).val();
            
            if(extra_unit_active != null){
                var extra_unit_active_split = extra_unit_active.split("-");
            }
            if(extra_story_active !=null){
                var extra_story_active_split = extra_story_active.split("-");
            }

            var array_extra_unit_active = {};
            for (let j = 0; j < extra_unit_active_split.length; j++) {
                array_extra_unit_active[extra_unit_active_split[j]] = 1;
            }

            var array_extra_story_active = {};
            for (let j = 0; j < extra_story_active_split.length; j++) {
                array_extra_story_active[extra_story_active_split[j]] = 1;
            }

            $("td[id='extra_unit_active"+id+"']").html("");
            var indexunit = 0;
            for(var i = 1; i <= extra_total_unit; i++){
                
                if(array_extra_unit_active[i] === 1){
                    var txt1 = `<input type="checkbox" id="indexunit_extra`+id+id_level+indexunit+`" data-unit-extra="`+id+`" name="unit[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                <label for="indexunit_extra`+id+id_level+indexunit+`">`+i+`</label>`;
                }else{
                    var txt1 = `<input type="checkbox" id="indexunit_extra`+id+id_level+indexunit+`" name="unit[]" data-unit-extra="`+id+`" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                                    <label for="indexunit_extra`+id+id_level+indexunit+`">`+i+`</label>`;
                }
                indexunit++;
                $("td[id='extra_unit_active"+id+"']").append(txt1);
            }
            
            $("td[id='extra_story_active"+id+"']").html("");
            var indexstory = 0;
            if(extra_total_unit > 0 && !isNaN(extra_total_unit)){
                for(var i = 1; i <= 3; i++){
                    if(array_extra_story_active[i] === 1){
                        var txt1 = `
                                <tr>
                                <td style="padding:2px; border:0px;">
                                    <input type="checkbox" id="indexstory_extra`+id+id_level+indexstory+`" data-story-extra="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                    <label for="indexstory_extra`+id+id_level+indexstory+`">`+i+`</label>
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="no_mistake" class="text-center" style="width:22px;" title="No Mistake" id="extra_rules_no_mistake_`+id_level+i+`" onchange="$.extra_rules_change('`+id_level+`', 'no_mistake', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="min_record" class="text-center" style="width:22px;" title="Min Record" id="extra_rules_min_record_`+id_level+i+`" onchange="$.extra_rules_change('`+id_level+`', 'min_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="max_record" class="text-center" style="width:22px;" title="Max Record" id="extra_rules_max_record_`+id_level+i+`" onchange="$.extra_rules_change('`+id_level+`', 'max_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                </tr>
                                `;
                        
                    }else{
                        var txt1 = `
                                <tr>
                                <td style="padding:2px; border:0px;">
                                    <input type="checkbox" id="indexstory_extra`+id+id_level+indexstory+`" data-story-extra="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                                    <label for="indexstory_extra`+id+id_level+indexstory+`">`+i+`</label>
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="no_mistake" class="text-center" style="width:22px;" title="No Mistake" id="extra_rules_no_mistake_`+id_level+i+`" onchange="$.extra_rules_change('`+id_level+`', 'no_mistake', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="min_record" class="text-center" style="width:22px;" title="Min Record" id="extra_rules_min_record_`+id_level+i+`" onchange="$.extra_rules_change('`+id_level+`', 'min_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="max_record" class="text-center" style="width:22px;" title="Max Record" id="extra_rules_max_record_`+id_level+i+`" onchange="$.extra_rules_change('`+id_level+`', 'max_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                </tr>
                                `;
                    }
                    indexstory++;
                    $("td[id='extra_story_active"+id+"']").append(txt1);
                }

                $.get_rules_story('extra',id);
            }
        }

        $.extra_rules_change = function (id_level, mode, t, button) {
            var value = $('#extra_rules_'+mode+'_'+id_level+t).val();
            if (value == '') { value = 0 }
            var index = t - 1;
                rules_story['extra'][id_level][index][mode] = value;
                $.editBg(button);
        }

        $.submit_daily_reading_extra = function(button){
            var unit        = $("input[data-unit-extra='"+button+"']:checked").serialize();
                story       = $("input[data-story-extra='"+button+"']:checked").serialize();
                id_level    = $("#id_level_daily_reading_extra"+button).val();
                total_unit  = $("#extra_total_unit"+button).val();
                var rules       = "";

            for (let index = 0; index < Object.keys(rules_story['extra'][id_level]).length; index++) {
                let i = index + 1;
                let no_mistake = rules_story['extra'][id_level][index]['no_mistake'];
                let min_record = rules_story['extra'][id_level][index]['min_record'];
                let max_record = rules_story['extra'][id_level][index]['max_record'];
                rules += i+":"+no_mistake+"-"+min_record+"-"+max_record+"_";
            }

            var slice_rules  = rules.slice(0, -1);

            $.ajax({
                url: "<?=base_url()?>level/daily_reading_update?"+unit+"&"+story+"&id_level="+id_level+"&total_unit="+total_unit+"&mode=extra_edit&rules_story="+slice_rules,
                type: 'GET',
                dataType: 'JSON',
                success: function(output){
                    // console.log("success "+output.STATUS)
                    Swal('Berhasil', output.STATUS, 'success');
                    // $("tr[id='tr_daily_reading_extra"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                }
            });
        }

        $.extended_total_unit_change = function(t){
            var id = t;
            var extended_total_unit = $("#extended_total_unit"+t).val();
            var id_level = $("#extended_total_unit"+t).data('id_level');
            var extended_unit_active = $("#isi_extended_unit_active"+t).val();
            var extended_story_active = $("#isi_extended_story_active"+t).val();
            
            if(extended_unit_active != null){
                var extended_unit_active_split = extended_unit_active.split("-");
            }
            if(extended_story_active !=null){
                var extended_story_active_split = extended_story_active.split("-");
            }

            var array_extended_unit_active = {};
            for (let j = 0; j < extended_unit_active_split.length; j++) {
                array_extended_unit_active[extended_unit_active_split[j]] = 1;
            }

            var array_extended_story_active = {};
            for (let j = 0; j < extended_story_active_split.length; j++) {
                array_extended_story_active[extended_story_active_split[j]] = 1;
            }

            $("td[id='extended_unit_active"+id+"']").html("");
            var indexunit = 0;
            for(var i = 1; i <= extended_total_unit; i++){
                
                if(array_extended_unit_active[i] === 1){
                    var txt1 = `<input type="checkbox" id="indexunit_extended`+id+id_level+indexunit+`" data-unit-extended="`+id+`" name="unit[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                <label for="indexunit_extended`+id+id_level+indexunit+`">`+i+`</label>`;
                }else{
                    var txt1 = `<input type="checkbox" id="indexunit_extended`+id+id_level+indexunit+`" name="unit[]" data-unit-extended="`+id+`" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                    <label for="indexunit_extended`+id+id_level+indexunit+`">`+i+`</label>`;                         
                }
                indexunit++;
                $("td[id='extended_unit_active"+id+"']").append(txt1);
            }
            
            $("td[id='extended_story_active"+id+"']").html("");
            var indexstory = 0;
            if(extended_total_unit > 0 && !isNaN(extended_total_unit)){
                for(var i = 1; i <= 3; i++){
                    if(array_extended_story_active[i] === 1){
                        var txt1 = `
                                <tr>
                                <td style="padding:2px; border:0px;">
                                    <input type="checkbox" id="indexstory_extended`+id+id_level+indexstory+`" data-story-extended="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                    <label for="indexstory_extended`+id+id_level+indexstory+`">`+i+`</label>
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="no_mistake" class="text-center" style="width:22px;" title="No Mistake" id="extended_rules_no_mistake_`+id_level+i+`" onchange="$.extended_rules_change('`+id_level+`', 'no_mistake', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="min_record" class="text-center" style="width:22px;" title="Min Record" id="extended_rules_min_record_`+id_level+i+`" onchange="$.extended_rules_change('`+id_level+`', 'min_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="max_record" class="text-center" style="width:22px;" title="Max Record" id="extended_rules_max_record_`+id_level+i+`" onchange="$.extended_rules_change('`+id_level+`', 'max_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                </tr>
                                `;
                        
                    }else{
                        var txt1 = `
                                <tr>
                                <td style="padding:2px; border:0px;">
                                    <input type="checkbox" id="indexstory_extended`+id+id_level+indexstory+`" data-story-extended="`+id+`" name="story[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                                    <label for="indexstory_extended`+id+id_level+indexstory+`">`+i+`</label>
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="no_mistake" class="text-center" style="width:22px;" title="No Mistake" id="extended_rules_no_mistake_`+id_level+i+`" onchange="$.extended_rules_change('`+id_level+`', 'no_mistake', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="min_record" class="text-center" style="width:22px;" title="Min Record" id="extended_rules_min_record_`+id_level+i+`" onchange="$.extended_rules_change('`+id_level+`', 'min_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                <td style="padding:2px; border:0px;">
                                    <input type="text" name="max_record" class="text-center" style="width:22px;" title="Max Record" id="extended_rules_max_record_`+id_level+i+`" onchange="$.extended_rules_change('`+id_level+`', 'max_record', `+i+`, `+id+`)" oninput="this.onchange()">
                                </td>
                                </tr>
                                `;
                    }
                    indexstory++;
                    $("td[id='extended_story_active"+id+"']").append(txt1);
                }

                $.get_rules_story('extended',id);
            }
        }

        $.extended_rules_change = function (id_level, mode, t, button) {
            var value = $('#extended_rules_'+mode+'_'+id_level+t).val();
            if (value == '') { value = 0 }
            var index = t - 1;
                rules_story['extended'][id_level][index][mode] = value;
                $.editBg(button);
        }

        $.submit_daily_reading_extended = function(button){
            var unit        = $("input[data-unit-extended='"+button+"']:checked").serialize();
                story       = $("input[data-story-extended='"+button+"']:checked").serialize();
                id_level    = $("#id_level_daily_reading_extended"+button).val();
                total_unit  = $("#extended_total_unit"+button).val();
                var rules       = "";

            for (let index = 0; index < Object.keys(rules_story['extended'][id_level]).length; index++) {
                let i = index + 1;
                let no_mistake = rules_story['extended'][id_level][index]['no_mistake'];
                let min_record = rules_story['extended'][id_level][index]['min_record'];
                let max_record = rules_story['extended'][id_level][index]['max_record'];
                rules += i+":"+no_mistake+"-"+min_record+"-"+max_record+"_";
            }

            var slice_rules  = rules.slice(0, -1);

            $.ajax({
                url: "<?=base_url()?>level/daily_reading_update?"+unit+"&"+story+"&id_level="+id_level+"&total_unit="+total_unit+"&mode=extended_edit&rules_story="+slice_rules,
                type: 'GET',
                dataType: 'JSON',
                success: function(output){
                    // console.log("success "+output.STATUS)
                    Swal('Berhasil', output.STATUS, 'success');
                    // $("tr[id='tr_daily_reading_extended"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                }
            });
        }

        $.submit_dialog = function(button){
            var id_level         = $("#id_level_dialog"+button).val();
                main_total_unit  = $("#dialog_main_total_unit"+button).val();
                extra_total_unit  = $("#dialog_extra_total_unit"+button).val();

            $.ajax({
                url: '<?=base_url()?>level/level_dialog_update',
                method: "POST",
                data: {id_level : id_level, main_total_unit : main_total_unit, extra_total_unit : extra_total_unit},
                async: true,
                dataType: 'JSON',
                success: function(output){
                    // console.log("success "+output.STATUS)
                    Swal('Berhasil', output.STATUS, 'success');
                    // $("tr[id='tr_dialog"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                },
                error: function(params) {
                    console.log(params);
                }
            });
        }

        $.lock_dialog = function (button) {
            var id_level    = $('#id_level_dialog'+button).val();
                value       = 0;

                $.ajax({
                    url: '<?=base_url()?>level/lock_dialog_activated',
                    method: "POST",
                    data: {id_level : id_level, value : value},
                    async: true,
                    dataType: 'JSON',
                    success : function(output) {
                        Swal('Berhasil', output.STATUS, 'success');
                    }
                })
        }

        $.unlock_dialog = function (button) {
            var id_level    = $('#id_level_dialog'+button).val();
                value       = 1;

                $.ajax({
                    url: '<?=base_url()?>level/unlock_dialog_activated',
                    method: "POST",
                    data: {id_level : id_level, value : value},
                    async: true,
                    dataType: 'JSON',
                    success : function(output) {
                        Swal('Berhasil', output.STATUS, 'success');
                    }
                })
        }

        $.submit_comprehension = function(button){
            var id_level         = $("#id_level_comprehension"+button).val();
                main_total_unit  = $("#comprehension_main_total_unit"+button).val();
                extra_total_unit  = $("#comprehension_extra_total_unit"+button).val();

            $.ajax({
                url: '<?=base_url()?>level/level_comprehension_update',
                method: "POST",
                data: {id_level : id_level, main_total_unit : main_total_unit, extra_total_unit : extra_total_unit},
                async: true,
                dataType: 'JSON',
                success: function(output){
                    // console.log("success "+output.STATUS)
                    Swal('Berhasil', output.STATUS, 'success');
                    // $("tr[id='tr_comprehension"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                },
                error: function(params) {
                    console.log(params);
                }
            });
        }

        $.lock_comprehension = function (button) {
            var id_level    = $('#id_level_comprehension'+button).val();
                value       = 0;

                $.ajax({
                    url: '<?=base_url()?>level/lock_comprehension_activated',
                    method: "POST",
                    data: {id_level : id_level, value : value},
                    async: true,
                    dataType: 'JSON',
                    success : function(output) {
                        Swal('Berhasil', output.STATUS, 'success');
                    }
                })
        }

        $.unlock_comprehension = function (button) {
            var id_level    = $('#id_level_comprehension'+button).val();
                value       = 1;

                $.ajax({
                    url: '<?=base_url()?>level/unlock_comprehension_activated',
                    method: "POST",
                    data: {id_level : id_level, value : value},
                    async: true,
                    dataType: 'JSON',
                    success : function(output) {
                        Swal('Berhasil', output.STATUS, 'success');
                    }
                })
        }

        $.submit_speaking = function(button){
            var id_level         = $("#id_level_speaking"+button).val();
                main_total_unit  = $("#speaking_main_total_unit"+button).val();
                extra_total_unit = $("#speaking_extra_total_unit"+button).val();
                main_submitcount_freepass = $("#main_submitcount_freepass"+button).val();

            $.ajax({
                url: '<?=base_url()?>level/level_speaking_update',
                method: "POST",
                data: {id_level : id_level, main_total_unit : main_total_unit, extra_total_unit : extra_total_unit, main_submitcount_freepass : main_submitcount_freepass},
                async: true,
                dataType: 'JSON',
                success: function(output){
                    Swal('Berhasil', output.STATUS, 'success');
                    $.RemoveEditBg(button);
                },
                error: function(params) {
                    console.log(params);
                }
            });
        }

        $.lock_speaking = function (button) {
            var id_level    = $('#id_level_speaking'+button).val();
                value       = 0;

                $.ajax({
                    url: '<?=base_url()?>level/lock_speaking_activated',
                    method: "POST",
                    data: {id_level : id_level, value : value},
                    async: true,
                    dataType: 'JSON',
                    success : function(output) {
                        Swal('Berhasil', output.STATUS, 'success');
                    }
                })
        }

        $.unlock_speaking = function (button) {
            var id_level    = $('#id_level_speaking'+button).val();
                value       = 1;

                $.ajax({
                    url: '<?=base_url()?>level/unlock_speaking_activated',
                    method: "POST",
                    data: {id_level : id_level, value : value},
                    async: true,
                    dataType: 'JSON',
                    success : function(output) {
                        Swal('Berhasil', output.STATUS, 'success');
                    }
                })
        }

        $.total_subject_change = function(t){
            var id = t;
            var total_subject = $("#selftest_total_subject"+t).val();
            var id_level = $("#selftest_total_subject"+t).data('id_level');
            var subject_active = $("#isi_selftest_subject_active"+t).val();

            if(subject_active != null){
                var subject_active_split = subject_active.split("-");
            }

            var array_subject_active = {};
            for (let j = 0; j < subject_active_split.length; j++) {
                array_subject_active[subject_active_split[j]] = 1;
            }

            $("td[id='selftest_subject_active"+id+"']").html("");
            var indexsubject = 0;
            for(var i = 1; i <= total_subject; i++){
                
                if(array_subject_active[i] === 1){
                    var txt1 = `<input type="checkbox" id="indexsubject_selftest`+id+id_level+indexsubject+`" data-subject_selftest="`+id+`" name="subject[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                <label for="indexsubject_selftest`+id+id_level+indexsubject+`">`+i+`</label>`;
                }else{
                    var txt1 = `<input type="checkbox" id="indexsubject_selftest`+id+id_level+indexsubject+`" name="subject[]" data-subject_selftest="`+id+`" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                    <label for="indexsubject_selftest`+id+id_level+indexsubject+`">`+i+`</label>`;                         
                }
                indexsubject++;
                $("td[id='selftest_subject_active"+id+"']").append(txt1);
            }
        }

        $.total_unit_change = function(t){
            var id = t;
            var total_unit = $("#selftest_total_unit"+t).val();
            var id_level = $("#selftest_total_unit"+t).data('id_level');
            var unit_active = $("#isi_selftest_unit_active"+t).val();

            if(unit_active != null){
                var unit_active_split = unit_active.split("-");
            }

            var array_unit_active = {};
            for (let j = 0; j < unit_active_split.length; j++) {
                array_unit_active[unit_active_split[j]] = 1;
            }

            $("td[id='selftest_unit_active"+id+"']").html("");
            var indexunit = 0;
            for(var i = 1; i <= total_unit; i++){
                
                if(array_unit_active[i] === 1){
                    var txt1 = `<input type="checkbox" id="indexunit_selftest`+id+id_level+indexunit+`" data-unit_selftest="`+id+`" name="unit[]" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`" checked />
                                <label for="indexunit_selftest`+id+id_level+indexunit+`">`+i+`</label>`;
                }else{
                    var txt1 = `<input type="checkbox" id="indexunit_selftest`+id+id_level+indexunit+`" name="unit[]" data-unit_selftest="`+id+`" value="`+i+`" onchange="$.editBg(`+id+`)" class="chk-col-teal check`+id+`"/>
                    <label for="indexunit_selftest`+id+id_level+indexunit+`">`+i+`</label>`;                         
                }
                indexunit++;
                $("td[id='selftest_unit_active"+id+"']").append(txt1);
            }
        }

        $.submit_selftest = function(button){
            var unit            = $("input[data-unit_selftest='"+button+"']:checked").serialize();
                subject         = $("input[data-subject_selftest='"+button+"']:checked").serialize();
                id_level        = $("#id_level_selftest"+button).val();
                total_unit      = $("#selftest_total_unit"+button).val();
                total_subject   = $("#selftest_total_subject"+button).val();

            $.ajax({
                url: "<?=base_url()?>level/selftest_update?"+unit+"&"+subject+"&id_level="+id_level+"&total_unit="+total_unit+"&total_subject="+total_subject,
                type: 'GET',
                dataType: 'JSON',
                success: function(output){
                    Swal('Berhasil', output.STATUS, 'success');
                    // $("tr[id='tr_selftest"+button+"']").css("background-color", "");
                    $.RemoveEditBg(button);
                }
            });
        }

        var index = <?=$no-1;?>;
        for(var i = 1; i <= index; i++){
            $.totalUnitChangeExam(i);
            $.main_total_unit_change(i);
            $.extra_total_unit_change(i);
            $.extended_total_unit_change(i);
            $.total_subject_change(i);
            $.total_unit_change(i);
        }
        
    });
</script>