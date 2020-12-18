<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN EXAM</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                    <?=form_open('admin/log_exam')?>
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <b>Dari</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="date" class="form-control dari" name="dari_tanggal" value="<?=$dari?>" placeholder="Mohon Pilih Tanggal Disini...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <b>Sampai</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="date" class="form-control sampai" name="sampai_tanggal" value="<?=$sampai?>" placeholder="Mohon Pilih Tanggal Disini...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="submit" name="submit" class="btn bg-grey btn-xs waves-effect">
                                                <i class="material-icons">date_range</i>
                                                <span>SELECT TANGGAL</span>
                                            </button>
                                        </div>
                    <?=form_close()?>
                                        <div class="col-sm-6">
                                            <?=form_open('export/export_log')?>
                                            <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                            <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
                                            <input type="text" name="mode" value="exam" hidden>
                                            <button type="submit" class="btn bg-red btn-xs waves-effect">
                                                <i class="material-icons">file_download</i>
                                                    <span>Export Excel</span>
                                            </button>
                                            <?=form_close()?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover data_exam">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Siswa</th>
                                    <th class="text-center">Nama Siswa</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center">Cabang</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Story</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Try</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Jumlah Salah</th>
                                    <th class="text-center">Tanggal Upload</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jam</th>
                                    <th class="text-center">Examiner</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Tanggal Periksa</th>
                                    <th class="text-center">Jam Periksa</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($log_exam as $le): ?>
                                    <tr>
                                        <td class="text-center"><?=$le['id_siswa']?></td>
                                        <td class="text-center"><?=$le['nama_siswa']?></td>
                                        <td class="text-center"><?=$le['level']?></td>
                                        <td class="text-center"><?=$le['nama_cabang']?></td>
                                        <td class="text-center"><?=$le['unit']?></td>
                                        <td class="text-center"><?=$le['story']?></td>
                                        <td class="text-center"><?=$le['time']?></td>
                                        <td class="text-center"><?=$le['try']?></td>
                                        <td class="text-center"><?php echo $le['status'] == 0 ? "Pending" : "Reviewed"?></td>    
                                        <td class="text-center"><?=$le['jumlah_salah']?></td>
                                        <td class="text-center"><?=$le['tgl_upload']?></td>
                                        <td class="text-center"><?=$le['tgl_sebenarnya']?></td>
                                        <td class="text-center"><?=$le['jam']?></td>
                                        <td class="text-center">
                                            <?php 
                                                if ($le['status'] == 1 ) {
                                                    echo getGuru($le['id_guru_final_test']);
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $le['status'] == 3 ? "Goal" : ($le['status'] == 2 ? "Warning" : "")?></td>
                                        <td class="text-center">
                                            <?php if ($le['waktu_periksa'] != '') echo explode('-', $le['waktu_periksa'])[0]?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($le['waktu_periksa'] != '') echo explode('-', $le['waktu_periksa'])[1]?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn bg-red btn-xs waves-effect delete_data" data="<?=encrypt_url($le['id_test'])?>" title="Delete" data-mode="2"><i class="material-icons">delete</i><span>Delete</span></button>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>