<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Level &nbsp;&nbsp;
                            <ol class="breadcrumb pull-right">
                              <li><a href="<?=base_url()?>admin/level_siswa"><i class="material-icons">filter_list</i> Daftar Level</a></li>
                              <li class="active">Tambah</li>
                            </ol>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <?=form_open('admin/level_siswa_tambah', 'role="form"')?>
                                    <div class="col-md-6">
                                        <b>Nama Level</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="id_level" class="form-control" placeholder="Masukan Nama Level" required autofocus maxlength="5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Time Limit</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">access_time</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="time_limit" min="1" max="24" required> : 00
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn bg-indigo waves-effect"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                    <a href="<?=base_url()?>admin/level_siswa" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
                                    </a>
                                    <?=form_close()?>
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