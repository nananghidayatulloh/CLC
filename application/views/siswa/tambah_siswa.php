<section class="content">
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Siswa &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?= base_url() ?>admin/siswa"><i class="material-icons">face</i> Daftar Siswa</a></li>
                            <li class="active">Tambah</li>
                        </ol>
                        </h2>
                    </div>
                    <!-- Masked Input -->
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <?= form_open('admin/siswa_tambah', 'role="form"') ?>
                                <div class="col-sm-12">
                                    <b>ID Siswa</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">view_quilt</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="id_siswa" class="form-control" placeholder="Masukan ID Siswa" required autofocus maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Level Siswa</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <select class="form-control show-tick" name="id_level" required>
                                            <option value="">-- Pilih Level Siswa --</option>
                                            <?php 
                                            foreach ($level as $l) :
                                            ?>
                                                <option value="<?= $l['id_level'] ?>"><?= $l['id_level'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Nama Siswa</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">face</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="nama_siswa" class="form-control" placeholder="Masukan Nama Siswa" required autofocus maxlength="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Password</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required autofocus maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Cabang</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">share</i>
                                        </span>
                                        <select class="form-control show-tick" name="nama_cabang">
                                            <option value="">-- Pilih Cabang --</option>
                                            <?php 
                                            foreach ($cabang as $cbng) :
                                            ?>
                                                <option value="<?= $cbng['id_cabang'] ?>"><?= $cbng['nama_cabang'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Checker</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">tag_faces</i>
                                        </span>
                                        <select class="form-control show-tick" name="nama_checker">
                                            <option value="">-- Pilih Checker --</option>
                                            <?php 
                                            foreach ($guru as $gr) :
                                            ?>
                                                <option value="<?= $gr['id_guru'] ?>"><?= $gr['nama_guru'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Guru</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">tag_faces</i>
                                        </span>
                                        <select class="form-control show-tick" name="nama_guru">
                                            <option value="">-- Pilih Guru --</option>
                                            <?php 
                                            foreach ($guru as $gr) :
                                            ?>
                                                <option value="<?= $gr['id_guru'] ?>"><?= $gr['nama_guru'] ?></option>
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
                                            <input type="date" name="custom_term_from" class="datepicker" utofocus> &nbsp; &nbsp; - 
                                            &nbsp; &nbsp; <input type="date" class="datepicker" name="custom_term_to" utofocus> 
                                            &nbsp; &nbsp; <input type="checkbox" name="custom_term_activated" value="1" id="basic_checkbox_1"/>
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
                                            <input type="number" name="dialog_limit" class="form-control" value="0" autofocus min="0" max="100">
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
                                            <input type="number" name="comprehension_limit" class="form-control" value="0" autofocus min="0" max="100">
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
                                            <input type="number" name="device_limit" class="form-control" value="0" autofocus min="0" max="100">
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
                                            <input type="number" name="max_recording" class="form-control" value="0" autofocus min="0" max="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="input-group" style="border: 2px #1f91f3 solid;">
                                            <span class="input-group-addon"><i class="material-icons">lock</i></span>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: 3.5rem;">
                                                    <input type="checkbox" name="dialog_activated" value="1" id="basic_checkbox_2"/>
                                                    <label for="basic_checkbox_2"><b>Unlock Dialog</b></label>
                                                </div>
                                                <div class="col-md-4" style="margin-top: 3.5rem;">
                                                    <input type="checkbox" name="comprehension_activated" value="1" id="basic_checkbox_3"/>
                                                    <label for="basic_checkbox_3"><b>Unlock Comprehension</b></label>
                                                </div>
                                                <div class="col-md-4" style="margin-top: 3.5rem;">
                                                    <input type="checkbox" name="extended_class" value="1" id="check_extended"/>
                                                    <label for="check_extended"><b>Extended Class</b></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="speaking_activated" value="1" id="speaking_activated" />
                                                    <label for="speaking_activated"><b>Unlock Speaking Apps</b></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="meaning_activated" value="1" id="meaning_activated" />
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
                                            <input type="text" name="produk_name" class="form-control" autofocus maxlength="20">
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
                                            <input type="text" name="class_name" class="form-control" autofocus maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <b>Custom Active Story</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <?php 
                                                for ($i=1; $i <=3 ; $i++) :
                                            ?>
                                                <?=$i?><input type="checkbox" name="custom_story<?=$i?>" id="<?=$i?>" value="<?=$i?>">
                                                <label for="<?=$i?>"></label>
                                            <?php endfor;?>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    <b>Custom Active Subject Selftest</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">book</i>
                                        </span>
                                        <div class="form-line">
                                            <textarea name="custom_active_subject" id="" class="form-control" cols="2" rows="5"></textarea>
                                        </div>
                                        <small style="color:red; font-size:15px;">Contoh : 1:2%1-2-3-4_2:3%1-2-3-4-5</small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
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