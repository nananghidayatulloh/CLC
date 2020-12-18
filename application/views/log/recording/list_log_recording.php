<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN RECORDING</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?=form_open('admin/log_recording')?>
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
                                                <?=form_open('export/export_log_recording')?>
                                                    <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                                    <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
                                                    <input type="text" name="mode" value="recording" hidden>
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
                                <table class="table table-bordered table-striped table-hover data_recording">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID Siswa</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Story</th>
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
                                            <th class="text-center">Checker/Examiner</th>
                                            <th class="text-center">Tanggal Periksa</th>
                                            <th class="text-center">Jam Periksa</th>
                                            <th class="text-center">Mode</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Persen Aktif</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($log_daily_reading_recording as $daily_reading): ?>
                                            <tr>
                                                <td class="text-center"><?=$daily_reading['id_siswa']?></td>
                                                <td class="text-center"><?=$daily_reading['nama_siswa']?></td>
                                                <td class="text-center"><?=$daily_reading['level']?></td>
                                                <td class="text-center"><?=$daily_reading['nama_cabang']?></td>
                                                <td class="text-center"><?=$daily_reading['unit']?></td>
                                                <td class="text-center"><?=$daily_reading['story']?></td>
                                                <td class="text-center"><?=$daily_reading['time']?></td>
                                                <td class="text-center"><?=$daily_reading['speed']?></td>    
                                                <td class="text-center"><?=$daily_reading['nada']?></td>
                                                <td class="text-center"><?=$daily_reading['try']?></td>
                                                <td class="text-center">
                                                    <?php 
                                                        echo $daily_reading['status'] == 0 ? 'Pending' : 'Reviewed';
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=$daily_reading['jumlah_salah']?></td>
                                                <td class="text-center"><?=$daily_reading['tgl_upload']?></td>
                                                <td class="text-center"><?=$daily_reading['tgl_sebenarnya']?></td>
                                                <td class="text-center"><?=$daily_reading['jam']?></td>
                                                <td class="text-center"><?=$daily_reading['note']?></td>
                                                <td class="text-center">
                                                    <?php 
                                                        if ($daily_reading['status'] == 2) {
                                                            if ($daily_reading['warning'] < 3) {
                                                                echo "Warning";
                                                            } else {
                                                                echo "Suspended";
                                                            }
                                                        } else if ($daily_reading['status'] == 3){
                                                            //echo "Goal";
                                                            if ($daily_reading['goal_rating'] == 3) {
                                                                echo "G Goal";
                                                            } else if ($daily_reading['goal_rating'] == 2) {
                                                                echo "S Goal";
                                                            } else if ($daily_reading['goal_rating'] == 1) {
                                                                echo "B Goal";
                                                            }
                                                        } else {
                                                            echo "-";
                                                        }
                                                        //echo $daily_reading['status'] == 2 ? "Warning" : ($daily_reading['status'] == 3 ? "Goal" : "-");
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                        if ($daily_reading['status'] != 0 ) {
                                                            echo getGuru($daily_reading['id_checker_t']);
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($daily_reading['waktu_periksa'] != '') 
                                                        echo explode(' ', $daily_reading['waktu_periksa'])[0];
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($daily_reading['waktu_periksa'] != '') 
                                                        echo explode(' ', $daily_reading['waktu_periksa'])[1];
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=ucwords($daily_reading['mode'])?></td>
                                                <td class="text-center">Daily Reading</td>
                                                <td class="text-center"><?=$daily_reading['percent_active']."%"?></td>
                                                <td class="text-center">
                                                    <button class="btn bg-orange btn-xs waves-effect edit_recording <?php if($daily_reading['status'] == 0) {echo "hidden";}?>" title="Edit" data="<?=encrypt_url($daily_reading['id_tugas'])?>" data-mode="0"><i class="material-icons">edit</i><span>Edit</span></button>
                                                    <button class="btn bg-red btn-xs waves-effect delete_data" title="Delete" data="<?=encrypt_url($daily_reading['id_tugas'])?>" data-mode="0"><i class="material-icons">delete</i><span>Delete</span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        <?php foreach($log_dialog_recording as $dialog): ?>
                                            <tr>
                                                <td class="text-center"><?=$dialog['id_siswa']?></td>
                                                <td class="text-center"><?=$dialog['nama_siswa']?></td>
                                                <td class="text-center"><?=$dialog['level']?></td>
                                                <td class="text-center"><?=$dialog['nama_cabang']?></td>
                                                <td class="text-center"><?=$dialog['dialog_number']?></td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center"><?=$dialog['time']?></td>
                                                <td class="text-center"><?=$dialog['speed']?></td>
                                                <td class="text-center"><?=$dialog['nada']?></td>
                                                <td class="text-center"><?=$dialog['try']?></td>
                                                <td class="text-center">
                                                    <?php if ($dialog['status'] == 0) {
                                                        echo "Pending";
                                                    } else {
                                                        echo "Reviewed";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=$dialog['jumlah_salah']?></td>
                                                <td class="text-center"><?=$dialog['tgl_upload']?></td>
                                                <td class="text-center"><?=$dialog['tgl_sebenarnya']?></td>
                                                <td class="text-center"><?=$dialog['jam']?></td>
                                                <td class="text-center"><?=$dialog['note']?></td>
                                                <td class="text-center">
                                                    <?php if ($dialog['status'] == 2) {
                                                            if ($dialog['warning'] < 3) {
                                                                echo "Warning";
                                                            } else {
                                                                echo "Suspended";
                                                            }
                                                        } else if ($dialog['status'] == 3){
                                                            echo "Goal";
                                                        } else {
                                                            echo "-";
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                        if ($dialog['status'] != 0 ) {
                                                            echo getGuru($dialog['id_checker_dialog']);
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($dialog['waktu_periksa'] != '') 
                                                        echo explode(' ', $dialog['waktu_periksa'])[0];
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($dialog['waktu_periksa'] != '') 
                                                        echo explode(' ', $dialog['waktu_periksa'])[1];
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=ucwords($dialog['mode'])?></td>
                                                <td class="text-center"> Dialog </td>
                                                <td class="text-center"><?=$dialog['percent_active']."%"?></td>
                                                <td class="text-center">
                                                    <button class="btn bg-orange btn-xs waves-effect edit_recording <?php if($dialog['status'] == 0) {echo "hidden";}?>" title="Edit" data="<?=encrypt_url($dialog['id_dialog'])?>" data-mode="1"><i class="material-icons">edit</i><span>Edit</span></button>
                                                    <button class="btn bg-red btn-xs waves-effect delete_data" title="Delete" data="<?=encrypt_url($dialog['id_dialog'])?>" data-mode="1"><i class="material-icons">delete</i><span>Delete</span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        <?php foreach($log_exam_recording as $exam): ?>
                                            <tr>
                                                <td class="text-center"><?=$exam['id_siswa']?></td>
                                                <td class="text-center"><?=$exam['nama_siswa']?></td>
                                                <td class="text-center"><?=$exam['level']?></td>
                                                <td class="text-center"><?=$exam['nama_cabang']?></td>
                                                <td class="text-center"><?=$exam['unit']?></td>
                                                <td class="text-center"><?=$exam['story']?></td>
                                                <td class="text-center"><?=$exam['time']?></td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center"><?=$exam['try']?></td>
                                                <td class="text-center"><?php echo $exam['status'] == 0 ? "Pending" : "Reviewed"?></td>    
                                                <td class="text-center"><?=$exam['jumlah_salah']?></td>
                                                <td class="text-center"><?=$exam['tgl_upload']?></td>
                                                <td class="text-center"><?=$exam['tgl_sebenarnya']?></td>
                                                <td class="text-center"><?=$exam['jam']?></td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center">
                                                    <?php echo $exam['status'] == 3 ? "Goal" : ($exam['status'] == 2 ? "Warning" : "")?>
                                                    </td>
                                                <td class="text-center">
                                                    <?php 
                                                        if ($exam['status'] != 0 ) {
                                                            echo getGuru($exam['id_guru_final_test']);
                                                        }
                                                    ?>
                                                
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($exam['waktu_periksa'] != '') echo explode(' ', $exam['waktu_periksa'])[0]?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($exam['waktu_periksa'] != '') echo explode(' ', $exam['waktu_periksa'])[1]?>
                                                </td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center"> Exam </td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center">
                                                    <button class="btn bg-red btn-xs waves-effect delete_data" data="<?=encrypt_url($exam['id_test'])?>" title="Delete" data-mode="2"><i class="material-icons">delete</i><span>Delete</span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        <?php foreach($log_comprehension_recording as $comprehension): ?>
                                            <tr>
                                                <td class="text-center"><?=$comprehension['id_siswa']?></td>
                                                <td class="text-center"><?=$comprehension['nama_siswa']?></td>
                                                <td class="text-center"><?=$comprehension['level']?></td>
                                                <td class="text-center"><?=$comprehension['nama_cabang']?></td>
                                                <td class="text-center"><?=$comprehension['comprehension_number']?></td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center"><?=$comprehension['time']?></td>
                                                <td class="text-center"><?=$comprehension['speed']?></td>
                                                <td class="text-center"><?=$comprehension['nada']?></td>
                                                <td class="text-center"><?=$comprehension['try']?></td>
                                                <td class="text-center">
                                                    <?php if ($comprehension['status'] == 0) {
                                                        echo "Pending";
                                                    } else {
                                                        echo "Reviewed";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=$comprehension['jumlah_salah']?></td>
                                                <td class="text-center"><?=$comprehension['tgl_upload']?></td>
                                                <td class="text-center"><?=$comprehension['tgl_sebenarnya']?></td>
                                                <td class="text-center"><?=$comprehension['jam']?></td>
                                                <td class="text-center"><?=$comprehension['note']?></td>
                                                <td class="text-center">
                                                    <?php if ($comprehension['status'] == 2) {
                                                            if ($comprehension['warning'] < 3) {
                                                                echo "Warning";
                                                            } else {
                                                                echo "Suspended";
                                                            }
                                                        } else if ($comprehension['status'] == 3){
                                                            echo "Goal";
                                                        } else {
                                                            echo "-";
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                        if ($comprehension['status'] != 0 ) {
                                                            echo getGuru($comprehension['id_checker_comprehension']);
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($comprehension['waktu_periksa'] != '') 
                                                        echo explode(' ', $comprehension['waktu_periksa'])[0];
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($comprehension['waktu_periksa'] != '') 
                                                        echo explode(' ', $comprehension['waktu_periksa'])[1];
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=ucwords($comprehension['mode'])?></td>
                                                <td class="text-center"> Comprehension </td>
                                                <td class="text-center"><?=$comprehension['percent_active']."%"?></td>
                                                <td class="text-center">
                                                    <button class="btn bg-orange btn-xs waves-effect edit_recording <?php if($comprehension['status'] == 0) {echo "hidden";}?>" title="Edit" data="<?=encrypt_url($comprehension['id_comprehension'])?>" data-mode="2"><i class="material-icons">edit</i><span>Edit</span></button>
                                                    <button class="btn bg-red btn-xs waves-effect delete_data" title="Delete" data="<?=encrypt_url($comprehension['id_comprehension'])?>" data-mode="3"><i class="material-icons">delete</i><span>Delete</span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        <!-- <?php foreach($log_daily_speaking_recording as $daily_speaking): ?>
                                            <tr>
                                                <td class="text-center"><?=$daily_speaking['id_siswa']?></td>
                                                <td class="text-center"><?=$daily_speaking['nama_siswa']?></td>
                                                <td class="text-center"><?=$daily_speaking['level']?></td>
                                                <td class="text-center"><?=$daily_speaking['nama_cabang']?></td>
                                                <td class="text-center"><?=$daily_speaking['unit']?></td>
                                                <td class="text-center"> - </td>
                                                <td class="text-center"><?=$daily_speaking['time']?></td>
                                                <td class="text-center"><?=$daily_speaking['speed']?></td>
                                                <td class="text-center"><?=$daily_speaking['nada']?></td>
                                                <td class="text-center"><?=$daily_speaking['try']?></td>
                                                <td class="text-center">
                                                    <?php if ($daily_speaking['status'] == 0) {
                                                        echo "Pending";
                                                    } else {
                                                        echo "Reviewed";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=$daily_speaking['jumlah_salah']?></td>
                                                <td class="text-center"><?=$daily_speaking['tgl_upload']?></td>
                                                <td class="text-center"><?=$daily_speaking['tgl_sebenarnya']?></td>
                                                <td class="text-center"><?=$daily_speaking['jam']?></td>
                                                <td class="text-center"><?=$daily_speaking['note']?></td>
                                                <td class="text-center">
                                                    <?php if ($daily_speaking['status'] == 2) {
                                                        echo "Warning";
                                                    } elseif ($daily_speaking['status'] == 3) {
                                                        echo "Goal";
                                                    } else {
                                                        echo "-";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                        if ($daily_speaking['status'] != 0 ) {
                                                            echo getGuru($daily_speaking['id_checker_daily_speaking']);
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($daily_speaking['waktu_periksa'] != '') 
                                                        echo explode(' ', $daily_speaking['waktu_periksa'])[0];
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($daily_speaking['waktu_periksa'] != '') 
                                                        echo explode(' ', $daily_speaking['waktu_periksa'])[1];
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=ucwords($daily_speaking['mode'])?></td>
                                                <td class="text-center"> Daily Speaking </td>
                                                <td class="text-center">
                                                    <button class="btn bg-orange btn-xs waves-effect edit_recording <?php if($daily_speaking['status'] == 0) {echo "hidden";}?>" title="Edit" data="<?=encrypt_url($daily_speaking['id_daily_speaking'])?>" data-mode="2"><i class="material-icons">edit</i><span>Edit</span></button>
                                                    <button class="btn bg-red btn-xs waves-effect delete_data" title="Delete" data="<?=encrypt_url($daily_speaking['id_tugas'])?>" data-mode="4"><i class="material-icons">delete</i><span>Delete</span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;?> -->
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
                            <?=form_open('admin/log_recording', 'id="form_edit"');?>
                                <input type="hidden" name="id_recording" id="id">
                                <input type="hidden" name="kategori" id="kategori">
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
                        <button type="button" class="pull-left btn btn-link waves-effect" id="reset_tugas">RESET REVIEW</button>
                        <button type="submit" name="submit" id="btn_submit_recording" data-mode="2" class="btn btn-link waves-effect">SAVE</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('.data_recording').DataTable( {
        "order": [[13, 'desc'], [14, 'desc']],
        "info" :false,
        "searching" :true,
        "lengthChange" :false,
        "paging":false
    } );

    $('.edit_recording').on('click', function () {
        var id    = $(this).attr('data');
            mode  = $(this).attr('data-mode');

        $.ajax({
            url: '<?=base_url()?>admin/get_id_recording',
            type: 'POST',
            data: {id : id, mode : mode},
            async: true,
            dataType: 'JSON',
            success: function(response) {
                $('#smallModal').modal('show');
                $('[name="kategori"]').val(response.kategori);
                $('[name="note"]').val(response.note);
                $('[name="id_recording"]').val(response.id_recording);
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

    $('#btn_submit_recording').on('click', function (e) {
        e.preventDefault();
        var form_edit = new FormData($('#form_edit')[0]);

        $.ajax({
            type : 'POST',
            url : '<?=base_url()?>admin/log_recording_edit',
            data : form_edit,
            processData : false,
            contentType : false,
            success: function (response) {
                Swal.fire('Berhasil', response, 'success');
                window.setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        });
    });

    $('#reset_tugas').on('click', function(e) {
        e.preventDefault();

        var id_tugas = $('#id').val();
        var kategori = $('#kategori').val();

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