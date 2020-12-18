<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN QUIZ COMPEHENSION</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?=form_open('admin/log_quiz_comprehension')?>
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
                                                <?=form_open('export/export_log_quiz')?>
                                                    <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                                    <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
                                                    <input type="text" name="mode" value="comprehension_quiz" hidden>
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
                                            <th class="text-center">Comprehension</th>
                                            <th class="text-center">Completion</th>
                                            <th class="text-center">Try</th>
                                            <th class="text-center">Tanggal Upload</th>
                                            <th class="text-center">Tanggal Masehi</th>
                                            <th class="text-center">Jam</th>
                                            <th class="text-center">Mode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $idAndDate = array();
                                            foreach($log_comprehension_quiz as $lc):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$lc['id_siswa']?></td>
                                            <td class="text-center"><?=$lc['nama_siswa']?></td>
                                            <td class="text-center"><?=$lc['level']?></td>
                                            <td class="text-center"><?=$lc['nama_cabang']?></td>
                                            <td class="text-center"><?=$lc['id_comprehension']?></td>
                                            <td class="text-center">                                                
                                            <?php 
                                                if (!isset($idAndDate[$lc['id_siswa']][$lc['level']][$lc['id_comprehension']])) $idAndDate[$lc['id_siswa']][$lc['level']][$lc['id_comprehension']] = "";
                                                                                    
                                                if ($idAndDate[$lc['id_siswa']][$lc['level']][$lc['id_comprehension']] != $lc['tgl_sebenarnya']) {
                                                    $idAndDate[$lc['id_siswa']][$lc['level']][$lc['id_comprehension']] = $lc['tgl_sebenarnya'];
                                                    if ($lc['completion'] == '100') {
                                                        echo "Passed";
                                                    } else {
                                                        echo $lc['completion'].'%';
                                                    }
                                                } else {
                                                    echo $lc['completion'].'%';
                                                }
                                            ?>
                                            </td>
                                            <td class="text-center"><?=$lc['try']?></td>
                                            <td class="text-center"><?=$lc['tgl_upload']?></td>
                                            <td class="text-center"><?=$lc['tgl_sebenarnya']?></td>
                                            <td class="text-center"><?=$lc['jam']?></td>
                                            <td class="text-center"><?=ucwords($lc['mode'])?></td>
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