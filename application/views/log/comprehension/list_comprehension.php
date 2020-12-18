<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN COMPREHENSION</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?=form_open('admin/log_comprehension')?>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <b>Dari</b><input type="hidden" id="dari_tanggal" value="<?=$dari?>">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="datepicker form-control" name="dari_tanggal" value="<?=$dari?>" placeholder="Mohon Pilih Tanggal Disini...">
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
                                                <input type="text" class="datepicker form-control" name="sampai_tanggal" value="<?=$sampai?>" placeholder="Mohon Pilih Tanggal Disini...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <br>
                                        <div class="input-group">
                                            <button type="submit" name="submit" class="btn bg-grey btn-xs btn-block waves-effect">
                                                <i class="material-icons">date_range</i>
                                                <span>SELECT TANGGAL</span>
                                            </button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?=form_close()?>
                        <ul class="nav nav-tabs tab-col-amber" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#quiz" data-toggle="tab">QUIZ</a>
                            </li>
                            <li role="presentation">
                                <a href="#recording" data-toggle="tab">RECORDING</a>
                            </li>
                            <div class="row pull-right pt-3">
                                <div class="col-sm-6">
                                    <?=form_open('export/export_log_comprehension_quiz')?>
                                        <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                        <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
                                        <input type="text" name="mode" value="dialog_quiz" hidden>
                                        <button type="submit" class="btn bg-red btn-xs waves-effect">
                                            <i class="material-icons">file_download</i>
                                                <span>Export Quiz(.xls)</span>
                                        </button>
                                    <?=form_close()?>
                                </div>
                                <div class="col-sm-6">
                                    <?=form_open('export/export_log_comprehension_recording')?>
                                        <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                        <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
                                        <input type="text" name="mode" value="dialog_recording" hidden>
                                    <button type="submit" class="btn bg-red btn-xs waves-effect">
                                        <i class="material-icons">file_download</i>
                                            <span>Export Recording(.xls)</span>
                                    </button>
                                    <?=form_close()?>
                                </div>
                            </div>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="quiz">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $idAndDate = array();
                                                foreach($log_quiz as $lh):
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$lh['id_siswa']?></td>
                                                <td class="text-center"><?=$lh['nama_siswa']?></td>
                                                <td class="text-center"><?=$lh['level']?></td>
                                                <td class="text-center"><?=$lh['nama_cabang']?></td>
                                                <td class="text-center"><?=$lh['id_dialog']?></td>
                                                <td class="text-center">                                                
                                                <?php 
                                                    if (!isset($idAndDate[$lh['id_siswa']][$lh['level']][$lh['id_dialog']])) $idAndDate[$lh['id_siswa']][$lh['level']][$lh['id_dialog']] = "";
                                                                                        
                                                    if ($idAndDate[$lh['id_siswa']][$lh['level']][$lh['id_dialog']] != $lh['tgl_sebenarnya']) {
                                                        $idAndDate[$lh['id_siswa']][$lh['level']][$lh['id_dialog']] = $lh['tgl_sebenarnya'];
                                                        if ($lh['completion'] == '100') {
                                                            echo "Passed";
                                                        } else {
                                                            echo $lh['completion'].'%';
                                                        }
                                                    } else {
                                                        echo $lh['completion'].'%';
                                                    }
                                                ?>
                                                </td>
                                                <td class="text-center"><?=$lh['try']?></td>
                                                <td class="text-center"><?=$lh['tgl_upload']?></td>
                                                <td class="text-center"><?=$lh['tgl_sebenarnya']?></td>
                                                <td class="text-center"><?=$lh['jam']?></td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="recording">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover data_recording">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID Siswa</th>
                                                <th class="text-center">Nama Siswa</th>
                                                <th class="text-center">Level</th>
                                                <th class="text-center">Cabang</th>
                                                <th class="text-center">Dialog</th>
                                                <th class="text-center">Time</th>
                                                <th class="text-center">Speed</th>
                                                <th class="text-center">Nada</th>
                                                <th class="text-center">Try</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Jumlah Salah</th>
                                                <th class="text-center">Tanggal Upload</th>
                                                <th class="text-center">Tanggal Masehi</th>
                                                <th class="text-center">Jam Upload</th>
                                                <th class="text-center">Note</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Checker</th>
                                                <th class="text-center">Tanggal Periksa</th>
                                                <th class="text-center">Jam Periksa</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($log_recording as $lr):
                                            ?>
                                            <tr>
                                                <td class="text-center"><?=$lr['id_siswa']?></td>
                                                <td class="text-center"><?=$lr['nama_siswa']?></td>
                                                <td class="text-center"><?=$lr['level']?></td>
                                                <td class="text-center"><?=$lr['nama_cabang']?></td>
                                                <td class="text-center"><?=$lr['id_dialog']?></td>
                                                <td class="text-center"><?=$lr['time']?></td>
                                                <td class="text-center"><?=$lr['speed']?></td>
                                                <td class="text-center"><?=$lr['nada']?></td>
                                                <td class="text-center"><?=$lr['try']?></td>
                                                <td class="text-center">
                                                    <?php if ($lr['status'] == 0) {
                                                        echo "Pending";
                                                    } else {
                                                        echo "Reviewed";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=$lr['jumlah_salah']?></td>
                                                <td class="text-center"><?=$lr['tgl_upload']?></td>
                                                <td class="text-center"><?=$lr['tgl_sebenarnya']?></td>
                                                <td class="text-center"><?=$lr['jam']?></td>
                                                <td class="text-center"><?=$lr['note']?></td>
                                                <td class="text-center">
                                                    <?php if ($lr['status'] == 2) {
                                                        echo "Warning";
                                                    } elseif ($lr['status'] == 3) {
                                                        echo "Goal";
                                                    } else {
                                                        echo "-";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=$lr['nama_guru']?></td>
                                                <td class="text-center">
                                                    <?php if($lr['waktu_periksa'] != '') 
                                                        echo explode(' ', $lr['waktu_periksa'])[0];
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($lr['waktu_periksa'] != '') 
                                                        echo explode(' ', $lr['waktu_periksa'])[1];
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn bg-orange btn-xs waves-effect edit_note <?php if($lr['status'] == 0) {echo "hidden";}?>" title="Edit Note" data="<?=encrypt_url($lr['id_dialog'])?>" data-mode="1"><i class="material-icons">edit</i><span>Edit Note</span></button>
                                                    <button class="btn bg-red btn-xs waves-effect delete_data" title="Delete" data="<?=encrypt_url($lr['id_dialog'])?>" data-mode="1"><i class="material-icons">delete</i><span>Delete</span></button>
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
        </div>
    </div>
</section>
        <!-- <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div align="center">
                            <h4 class="modal-title" id="smallModalLabel">Edit Node</h4>
                        </div>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" name="id_dialog" id="id">
                                    <input class="form-control" type="text" name="note" id="note" placeholder="Silahkan Masukan Note...">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p id="demo"></p>
                            <button type="submit" name="submit" id="btn_submit" data-mode="1" class="btn btn-link waves-effect">SAVE</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                </div>
            </div>
        </div> -->
<script>
$(document).ready(function() {
    $('.data_comprehension_quiz').DataTable( {
        "order": [[8, 'desc'], [9, 'desc']],
        "info" :false,
        "searching" :true,
        "lengthChange" :false,
        "paging":false
    } );

    $('.data_comprehension').DataTable( {
        "order": [],
        "info" :false,
        "searching" :true,
        "lengthChange" :false,
        "paging":false
    } );
});
</script>