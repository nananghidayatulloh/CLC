<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN DAILY QUIZ</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?=form_open('admin/log_daily_quiz')?>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <b>Dari</b><input type="hidden" id="dari_tanggal" value="<?=$dari?>">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="dari_tanggal" value="<?=$dari?>" placeholder="Mohon Pilih Tanggal Disini...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Sampai</b><input type="hidden" id="sampai_tanggal" value="<?=$sampai?>">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="sampai_tanggal" value="<?=$sampai?>" placeholder="Mohon Pilih Tanggal Disini...">
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
                                                <?=form_open('export/export_log_daily_quiz')?>
                                                    <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                                    <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
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
                                <table class="table table-bordered table-striped table-hover data_quiz">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID Siswa</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Story</th>
                                            <th class="text-center">Score</th>
                                            <th class="text-center">Try</th>
                                            <th class="text-center">Tanggal Upload</th>
                                            <th class="text-center">Tanggal Masehi</th>
                                            <th class="text-center">Jam Upload</th>
                                            <th class="text-center">Mode</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $idAndDate = array();
                                            foreach($log_daily_quiz as $ldq):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$ldq['id_siswa']?></td>
                                            <td class="text-center"><?=$ldq['nama_siswa']?></td>
                                            <td class="text-center"><?=$ldq['level_d']?></td>
                                            <td class="text-center"><?=$ldq['nama_cabang']?></td>
                                            <td class="text-center"><?=$ldq['unit']?></td>
                                            <td class="text-center"><?=$ldq['story']?></td>
                                            <td class="text-center"><?=$ldq['completion']?></td>
                                            <td class="text-center"><?=$ldq['try']?></td>
                                            <td class="text-center"><?=$ldq['tgl_upload']?></td>
                                            <td class="text-center"><?=$ldq['tgl_sebenarnya']?></td>
                                            <td class="text-center"><?=$ldq['jam']?></td>
                                            <td class="text-center"><?=ucwords(str_replace('_', ' ', $ldq['mode']))?></td>
                                            <td class="text-center">Matching Quiz</td>
                                            <td class="text-center">
                                                <button class="btn bg-red btn-xs waves-effect delete_data" title="Delete" data="<?=encrypt_url($ldq['id_quiz'])?>" data-mode="5"><i class="material-icons">delete</i><span>Delete</span></button>
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
<script>
$(document).ready(function() {

    $('.data_quiz').DataTable( {
        "order": [[ 8, 'desc' ], [ 9, 'desc' ]],
        "info" :false,
        "searching" :true,
        "lengthChange" :false,
        "paging":false
    });

});
</script>