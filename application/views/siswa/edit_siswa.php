<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Siswa &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?= base_url() ?>admin/siswa"><i class="material-icons">face</i> Daftar Siswa</a></li>
                            <li class="active">Edit</li>
                        </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <?= form_open('admin/siswa_edit', 'role="form"') ?>
                                    <div class="col-md-12">
                                        <b>ID Siswa</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">view_quilt</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="id_siswa" value="<?= $siswa['id_siswa'] ?>" class="form-control" placeholder="Masukan ID Siswa" autofocus readonly maxlength="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Level Siswa</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">account_circle</i>
                                            </span>
                                            <select class="form-control show-tick" name="id_level">
                                                <option value="">-- Pilih Level Siswa --</option>
                                                <?php 
                                                    foreach($id_level as $lvl): 
                                                ?>
                                                    <option value="<?=$lvl['id_level']?>" <?php if($siswa['level'] == $lvl['id_level']) { echo "selected=selected" ; } ?>> <?=$lvl['id_level']?> </option>
                                                    <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Nama Siswa</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="nama_siswa" value="<?= $siswa['nama_siswa'] ?>" class="form-control" placeholder="Masukan Nama Siswa" required autofocus maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Password</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" name="password" value="<?= $siswa['password'] ?>" class="form-control" placeholder="Masukan Password" required autofocus maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Cabang</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">share</i>
                                            </span>
                                            <select class="form-control show-tick" name="nama_cabang">
                                                <option value="">-- Pilih Cabang --</option>
                                                <?php 
                                                    foreach($id_cabang as $cbng): 
                                                ?>
                                                    <option value="<?=$cbng['id_cabang']?>" <?php if($siswa['id_cabang'] == $cbng['id_cabang']) { echo "selected=selected" ; } ?>> <?=$cbng['nama_cabang']?> </option>
                                                    <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <b>Checker</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">tag_faces</i>
                                            </span>
                                            <select class="form-control show-tick" name="nama_checker">
                                                <option value="">-- Pilih Checker --</option>
                                                <?php 
                                                    foreach($id_guru as $gr): 
                                                ?>
                                                    <option value="<?=$gr['id_guru']?>" <?php if($siswa['id_checker'] == $gr['id_guru']) { echo "selected=selected" ; } ?>> <?=$gr['nama_guru']?> </option>
                                                    <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Guru</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">tag_faces</i>
                                            </span>
                                            <select class="form-control show-tick" name="nama_guru">
                                                <option value="">-- Pilih Guru --</option>
                                                <?php 
                                                    foreach($id_guru as $gr): 
                                                ?>
                                                    <option value="<?=$gr['id_guru']?>" <?php if($siswa['id_guru'] == $gr['id_guru']) { echo "selected=selected" ; } ?>> <?=$gr['nama_guru']?> </option>
                                                    <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Custom Current School</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                                <input type="date" name="custom_term_from" class="datepicker" value="<?=$siswa['custom_term_from']?>" autofocus> &nbsp; &nbsp; - 
                                                &nbsp; &nbsp; <input type="date" class="datepicker" name="custom_term_to" value="<?=$siswa['custom_term_to']?>" autofocus> 
                                                &nbsp; &nbsp; <input type="checkbox" name="custom_term_activated" value="1" id="basic_checkbox_1" <?php if ($siswa['custom_term_activated'] > 0) {
                                                    echo "checked";
                                                }?> />
                                                    <label for="basic_checkbox_1">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Max Dialog Quiz</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="dialog_limit" value="<?= $siswa['dialog_limit'] ?>" class="form-control" required autofocus min="0" max="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Max Comprehension Quiz</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="comprehension_limit" value="<?= $siswa['comprehension_limit'] ?>" class="form-control" required autofocus min="0" max="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Max Device</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="device_limit" value="<?= $siswa['device_limit'] ?>" class="form-control" required autofocus min="0" max="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Max Recording</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="max_recording" value="<?= $siswa['send_limit'] ?>" class="form-control" required autofocus min="0" max="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group" style="border: 2px #1f91f3 solid;">
                                            <span class="input-group-addon"><i class="material-icons">lock</i></span>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: 3.5rem;">
                                                    <input type="checkbox" name="dialog_activated" value="1" id="basic_checkbox_2" <?php if ($siswa['dialog_activated'] > 0) {
                                                        echo "checked";
                                                    }?> />
                                                    <label for="basic_checkbox_2"><b>Unlock Dialog</b></label>
                                                </div>
                                                <div class="col-md-4" style="margin-top: 3.5rem;">
                                                    <input type="checkbox" name="comprehension_activated" value="1" id="check_comprehension" <?php if ($siswa['comprehension_activated'] > 0) {
                                                        echo "checked";
                                                    }?> />
                                                    <label for="check_comprehension"><b>Unlock Comprehension</b></label>
                                                </div>
                                                
                                                <div class="col-md-4" style="margin-top: 3.5rem;">
                                                    <input type="checkbox" name="extended_class" value="1" id="check_extended" <?php if ($siswa['extended_class'] > 0) {
                                                        echo "checked";
                                                    }?>/>
                                                    <label for="check_extended"><b>Extended Class</b></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="speaking_activated" value="1" id="speaking_activated" <?php if ($siswa['speaking_activated'] > 0) {
                                                        echo "checked";
                                                    }?>/>
                                                    <label for="speaking_activated"><b>Unlock Speaking Apps</b></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="meaning_activated" value="1" id="meaning_activated" <?php if ($siswa['meaning_activated'] > 0) {
                                                        echo "checked";
                                                    }?>/>
                                                    <label for="meaning_activated"><b>Unlock Meaning Apps</b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Produk Name</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">book</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="produk_name" value="<?= $siswa['produk_name'] ?>" class="form-control" autofocus maxlength="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Class Name</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">book</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="class_name" value="<?= $siswa['class_name'] ?>" class="form-control" autofocus maxlength="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Custom Active Subject Selftest</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">book</i>
                                            </span>
                                            <div class="form-line">
                                                <textarea name="custom_active_subject" id="" class="form-control" cols="2" rows="5"><?= $siswa['custom_active_subject'] ?></textarea>
                                            </div>
                                            <small style="color:red; font-size:15px;">Contoh : 1:2%1-2-3-4_2:3%1-2-3-4-5</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Custom Active Story</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <?php 
                                                $custom_active_story = explode('-', $siswa['custom_active_story']);
                                                for ($i=1; $i <=3 ; $i++) { 
                                                    echo $i;
                                                    $active = "";
                                                    for ($j=0; $j < count($custom_active_story) ; $j++) { 
                                                        if ($i == $custom_active_story[$j]) {
                                                        $active = "checked";
                                                        break;
                                                    }
                                                }
                                            ?>
                                                <input type="checkbox" name="custom_story<?=$i?>" id="<?=$i?>" value="<?=$i?>" <?=$active?>>
                                                <label for="<?=$i?>"></label>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <input type="checkbox" name="clear_device" value="1" id="check_device" />
                                            <label for="check_device"><b>Clear Device</b></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Current Devices</b>
                                            <div class="box" style="overflow: auto; width:auto; height:150px;">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">devices</i>
                                                    </span>
                                                    <div class="row">
                                                        <div class="col-md-4">    
                                                            <label>Meaning</label>
                                                            <?php foreach($device_siswa as $ds) {
                                                                    if(strpos($ds['device_unique_id'], 'MEANING') !== false) {
                                                                        echo "<li style='margin-left: 2.5rem'> ". $ds['device_type'] ."</li>";
                                                                    } 
                                                                }
                                                            ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Speaking</label>
                                                            <?php foreach($device_siswa as $ds) {
                                                                    if(strpos($ds['device_unique_id'], 'SPEAKING') !== false) {
                                                                        echo "<li style='margin-left: 2.5rem'> ". $ds['device_type'] ."</li>";
                                                                    } 
                                                                }
                                                            ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Reading</label>
                                                            <?php foreach($device_siswa as $ds) {
                                                                    if(strpos($ds['device_unique_id'], 'READING') !== false) {
                                                                        echo "<li style='margin-left: 2.5rem'> ". $ds['device_type'] ."</li>";
                                                                    } 
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn bg-indigo waves-effect">
                                            <i class="material-icons">save</i>
                                            <span>SIMPAN</span>
                                        </button>
                                        <a href="<?= base_url() ?>admin/pencarian_siswa" type="button" class="btn bg-indigo waves-effect">
                                            <i class="material-icons">arrow_back</i>
                                            <span>KEMBALI</span>
                                        </a>
                                    </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Masked Input -->
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->
    </div>
</section>