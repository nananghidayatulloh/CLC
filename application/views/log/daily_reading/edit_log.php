<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Edit Log Daily Reading &nbsp;&nbsp;
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?=base_url()?>admin/log_daily_reading_edit"><i class="material-icons">people</i> Edit Log Daily Reading </a></li>
                                <li class="active">Edit</li>
                            </ol>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <?=form_open('admin/log_daily_reading_edit')?>
                                    <!-- <input type="text" value="<?=$adm['id_admn']?>"> -->
                                    <div class="col-md-4">
                                        <b>Id Siswa</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="id_siswa" value="<?=$log_daily_reading['id_siswa']?>" class="form-control" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Nama</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_siswa" value="<?=$log_daily_reading['nama_siswa']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Cabang</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="cabang" value="<?=$log_daily_reading['nama_cabang']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>level</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="id_level" value="<?=$log_daily_reading['level_t']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Unit</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="unit" value="<?=$log_daily_reading['unit']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Story</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="story" value="<?=$log_daily_reading['story']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Time</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="time" value="<?=$log_daily_reading['time']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Speed</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="speed" value="<?=$log_daily_reading['speed']?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Nada</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="nada" value="<?=$log_daily_reading['nada']?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Try</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="try" value="<?=$log_daily_reading['try']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Status</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="status" value="<?=$log_daily_reading['status']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Jumlah Salah</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="jumlah_salah" value="<?=$log_daily_reading['jumlah_salah']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Tanggal Upload</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_upload" value="<?=$log_daily_reading['tgl_upload']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Tanggal Masehi</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_sebenarnya" value="<?=$log_daily_reading['tgl_sebenarnya']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Jam Upload</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="jam" value="<?=$log_daily_reading['jam']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Jam Upload</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="jam" value="<?=$log_daily_reading['jam']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Note</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="note" value="<?=$log_daily_reading['note']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Keterangan</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="keterangan">
                                                    <option value="">-- Pilih Keterangan --</option>
                                                    <option value="-"> - </option>
                                                    <option value="goal"> Goal </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" name="submit" class="btn bg-indigo waves-effect"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                    <a href="<?=base_url()?>admin/log_daily_reading" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
                                    </a>
                                    <?=form_close()?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>