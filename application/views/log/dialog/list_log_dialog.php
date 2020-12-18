<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN DIALOG</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?=form_open('admin/log_dialog')?>
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
                                    <?=form_open('export/export_log')?>
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
                                    <?=form_open('export/export_log')?>
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
                                                <th class="text-center">Dialog</th>
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
                                                <td class="text-center"><?=ucwords($lh['mode'])?></td>
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
                                                <th class="text-center">Mode</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($log_recording as $lr): ?>
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
                                                    <td class="text-center">
                                                        <?php 
                                                            if ($lr['status'] != 0 ) {
                                                                echo getGuru($lr['id_checker_dialog']);
                                                            }
                                                        ?>
                                                    </td>
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
                                                    <td class="text-center"><?=ucwords($lr['mode'])?></td>
                                                    <td class="text-center">
                                                        <button class="btn bg-orange btn-xs waves-effect edit_dialog <?php if($lr['status'] == 0) {echo "hidden";}?>" title="Edit" data="<?=encrypt_url($lr['id_dialog'])?>" data-mode="1"><i class="material-icons">edit</i><span>Edit</span></button>
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
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div align="center">
                        <h4 class="modal-title" id="smallModalLabel">Edit</h4>
                    </div>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <?=form_open('admin/log_dialog', 'id="form_edit"');?>
                                <input type="hidden" name="id_dialog" id="id">
                                <div class="col-sm-4">
                                    <b>Speed</b>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="speed" class="form-control" id="speed">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <b>Nada</b>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" name="nada" class="form-control" id="nada">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <b>Keterangan</b>
                                    <div class="input-group">
                                        <div class="form-line" id="status">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Note</b>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input class="form-control" type="text" name="note" id="note" placeholder="Silahkan Masukan Note...">
                                        </div>
                                    </div>
                                </div>
                            <?=form_close();?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p id="demo"></p>
                        <button type="submit" name="submit" id="btn_submit_dialog" data-mode="1" class="btn btn-link waves-effect">SAVE</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {

    $('.data_quiz').DataTable( {
        "order": [[ 8, 'desc' ], [ 9, 'desc' ]],
        "info" :false,
        "searching" :true,
        "lengthChange" :false,
        "paging":false
    });

    $('.data_recording').DataTable( {
        "order": [],
        "info" :false,
        "searching" :true,
        "lengthChange" :false,
        "paging":false
    });

    $('.edit_dialog').on('click', function () {
        var id    = $(this).attr('data');
            mode  = $(this).attr('data-mode');

        $.ajax({
            url: '<?=base_url()?>admin/get_id',
            type: 'POST',
            data: {id : id, mode : mode},
            async: true,
            dataType: 'JSON',
            success: function(response) {
                $('#smallModal').modal('show');
                $('[name="note"]').val(response.note);
                $('[name="id_dialog"]').val(response.id_dialog);
                $('[name="speed"]').val(response.speed);
                $('[name="nada"]').val(response.nada);

                var status = response.status;
                    text = "";
                    selected = "";
                
                if (status == 2) {
                    var text = `<input type="text" name="status" class="form-control" value="Warning" readonly>`;
                } else {
                    var text = `<select class="form-control show-tick" name="status" id="keterangan" required>
                                    <option value="1" id="goal_stripes"> - </option>
                                    <option value="3" id="goal"> Goal </option>
                                </select>`;

                    $('#status').html(text);

                    if (status == 1) {
                        $('#goal_stripes').attr("selected", "selected");
                    } else if(status == 3) {
                        $('#goal').attr("selected", "selected");
                    }
                }

            }
        });
    });
    
    $('#btn_submit_dialog').on('click', function (e) {
        e.preventDefault();
        var form_edit = new FormData($('#form_edit')[0]);

        $.ajax({
            type : 'POST',
            url : '<?=base_url()?>admin/log_dialog_edit',
            data : form_edit,
            processData : false,
            contentType : false,
            success: function (response) {
                Swal.fire('Berhasil', response, 'success');
                window.setInterval(function(){
                    location.reload();
                }, 2000);
            }
        });
    });
});
</script>