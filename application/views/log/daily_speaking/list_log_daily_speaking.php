<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN DAILY SPEAKING</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?=form_open('admin/log_daily_speaking')?>
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
                                                <?=form_open('export/export_log_daily_speaking')?>
                                                    <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                                    <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
                                                    <input type="text" name="mode" value="daily_speaking" hidden>
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
                                            <th class="text-center">Section</th>
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
                                        <?php 
                                            $idAndDate = array();
                                            foreach($log_daily_speaking as $lds):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$lds['id_siswa']?></td>
                                            <td class="text-center"><?=$lds['nama_siswa']?></td>
                                            <td class="text-center"><?=$lds['level']?></td>
                                            <td class="text-center"><?=$lds['nama_cabang']?></td>
                                            <td class="text-center"><?=$lds['unit']?></td>
                                            <td class="text-center"><?=$lds['section']?></td>
                                            <td class="text-center"><?=$lds['time']?></td>
                                            <td class="text-center"><?php echo ($lds['section'] == 1) ? 0 : $lds['speed']?></td>
                                            <td class="text-center"><?php echo ($lds['section'] == 1) ? 0 : $lds['nada']?></td>
                                            <td class="text-center"><?=$lds['try']?></td>
                                            <td class="text-center">
                                                <?php 
                                                    echo $lds['status'] == 0 ? 'Pending' : 'Reviewed';
                                                ?>
                                            </td>
                                            <td class="text-center"><?=$lds['jumlah_salah']?></td>
                                            <td class="text-center"><?=$lds['tgl_upload']?></td>
                                            <td class="text-center"><?=$lds['tgl_sebenarnya']?></td>
                                            <td class="text-center"><?=$lds['jam']?></td>
                                            <td class="text-center"><?=$lds['note']?></td>
                                            <td class="text-center">
                                                <?php 
                                                    echo $lds['status'] == 2 ? "Warning" : ($lds['status'] == 3 ? "Goal" : "-");
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($lds['status'] != 0 ) {
                                                        echo getGuru($lds['id_checker_daily_speaking']);
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($lds['waktu_periksa'] != '') 
                                                    echo explode(' ', $lds['waktu_periksa'])[0];
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($lds['waktu_periksa'] != '') 
                                                    echo explode(' ', $lds['waktu_periksa'])[1];
                                                ?>
                                            </td>
                                            <td class="text-center"><?=ucwords(str_replace('_', ' ', $lds['mode']))?></td>
                                            <td class="text-center">
                                                <button class="btn bg-orange btn-xs waves-effect edit_daily_speaking <?php if($lds['status'] == 0) {echo "hidden";}?>" title="Edit" data="<?=encrypt_url($lds['id_tugas'])?>" data-mode="3"><i class="material-icons">edit</i><span>Edit</span></button>
                                                <button class="btn bg-red btn-xs waves-effect delete_data" title="Delete" data="<?=encrypt_url($lds['id_tugas'])?>" data-mode="4"><i class="material-icons">delete</i><span>Delete</span></button>
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
                        <?=form_open('admin/log_daily_speaking', 'id="form_edit"');?>
                        <input type="hidden" name="id_tugas" id="id">
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
                    <button type="button" class="pull-left btn btn-link waves-effect" id="reset_tugas">RESET REVIEW</button>
                    <button type="submit" name="submit" id="btn_submit_daily_speaking" data-mode="3" class="btn btn-link waves-effect">SAVE</button>
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

    $('.edit_daily_speaking').on('click', function () {
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
                $('[name="id_tugas"]').val(response.id_tugas);
                $('[name="speed"]').val(response.speed);
                $('[name="nada"]').val(response.nada);

                var status = response.status;
                    text = "";
                    selected = "";
                
                if (status == 2) {
                    var text = `<select class="form-control show-tick" name="status" id="keterangan" required>
                                    <option value="1" id="goal_stripes"> - </option>
                                    <option value="2" id="warning" selected> Warning </option>
                                    <option value="3" id="goal"> Goal </option>
                                </select>`;

                    $('#status').html(text);
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

    $('#btn_submit_daily_speaking').on('click', function (e) {
        e.preventDefault();
        var form_edit = new FormData($('#form_edit')[0]);

        $.ajax({
            type : 'POST',
            url : '<?=base_url()?>admin/log_dialy_speaking_edit',
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

    $('#reset_tugas').on('click', function(e) {
        e.preventDefault();

        var id_tugas = $('#id').val();
        var kategori = "speaking";

        $.ajax({
            url: '<?=base_url()?>admin/log_reset_tugas',
            type: 'POST',
            data: {id_tugas : id_tugas, kategori : kategori},
            async: true,
            dataType: 'JSON',
            success : function(data) {
                Swal.fire('Berhasil', data, 'success');
                window.setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        });
    });
});
</script>