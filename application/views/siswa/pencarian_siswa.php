<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Siswa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?= base_url() ?>admin/siswa_tambah" type="button" class="btn bg-teal btn-xs waves-effect">
                                <i class="material-icons">add</i>
                                <span>Tambah</span>
                            </a>
                            <button type="button" class="btn bg-orange btn-xs waves-effect" data-toggle="modal" data-target="#smallModal"><i class="material-icons">file_upload</i><span>Tambah by CSV file</span></button>
                            <button type="button" class="btn bg-red btn-xs waves-effect pull-right" id="clear_all_permission"><i class="material-icons">delete</i><span>Clear All Permission</span></button>
                            <button type="button" class="btn bg-red btn-xs waves-effect pull-right" id="clear_all_device" style="margin-right:3px;"><i class="material-icons">delete</i><span>Clear All Device</span></button>
                        </h2>
                    </div>
                    <div class="page-loader-wrapper"  style="display: none; margin-left: auto; margin-right: auto; background-color:#00000059" id="loading">
                        <div class="loader">
                            <div class="preloader pl-size-xs">
                                <div class="spinner-layer pl-amber">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <p style="color:black">Mohon Tunggu Sebentar...</p>
                        </div>
                    </div>
                    <div class="body">
                        <?=form_open('admin/pencarian_siswa')?>
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="keyword" placeholder="Pencarian">
                                </div>
                                <span class="input-group-addon">
                                    <button class="btn btn-circle btn-sm material-icons">search</button>
                                </span>
                            </div>
                        <?=form_close()?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="table_pencarian_siswa">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">
                                            <input type="checkbox" id="checkbox_all">
                                            <label for="checkbox_all">Select All</label>
                                        </th>
                                        <th class="text-center">No</th>
                                        <th class="text-center">ID Siswa</th>
                                        <th class="text-center">Nama Siswa</th>
                                        <th class="text-center">Level</th>
                                        <th class="text-center">Cabang</th>
                                        <th class="text-center">Guru</th>
                                        <th class="text-center">Checker</th>
                                        <th class="text-center">Examiner</th>
                                        <th class="text-center">Spontan</th>
                                        <th class="text-center">Practice</th>
                                        <th class="text-center">Test</th>
                                        <th class="text-center">Review</th>
                                        <th class="text-center">Daily Active</th>
                                        <th class="text-center">Produk Name</th>
                                        <th class="text-center">Class Name</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; foreach ($siswa as $sis) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?=form_open('export')?>
                                                <input type="hidden" name="id_siswa" value="<?= encrypt_url($sis['id_siswa']) ?>">
                                                <input type="hidden" name="nama_siswa" value="<?= $sis['nama_siswa'] ?>">
                                                <button type="submit" class="btn bg-blue btn-xs waves-effect" title="Report" style="font-size:smaller;  margin-bottom:5px;"><i class="material-icons" style="font-size:initial;">create</i><span>Report</span></button>
                                            <?=form_close()?>
                                            
                                            <a href="<?= base_URL() ?>admin/siswa_hapus/<?= encrypt_url($sis['id_siswa']) ?>" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Hapus" style="font-size:smaller"><i class="material-icons" style="font-size:initial">delete</i><span>Hapus</span></a>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" id="checkbox_<?=$no?>" class="select" name="checkbox" data-id_siswa="<?=$sis['id_siswa']?>">
                                            <label for="checkbox_<?=$no?>">Select</label>
                                        </td>
                                        <td class="text-center"><?= $no ?>.</td>
                                        <td class="text-center"><?= $sis['id_siswa'] ?></td>
                                        <td class="text-center"><?= $sis['nama_siswa'] ?></td>
                                        <td class="text-center"><?= $sis['level'] ?></td>
                                        <td class="text-center"><?= $sis['nama_cabang'] ?></td>
                                        <td class="text-center">
                                            <?php if($sis['nama_guru'] == "") { 
                                                echo 'Tidak Terdaftar';
                                            } else {
                                                echo $sis['nama_guru'];
                                            }?>
                                        </td>
                                        <td class="text-center"><?= $sis['nama_checker'] ?></td>
                                        <td class="text-center"><?= $sis['nama_examiner'] ?></td>
                                        <td class="text-center"><?php echo $spontan = ($sis['spontan'] == null) ? 0 : $sis['spontan'] ;?></td>
                                        <td class="text-center"><?php echo $practice = ($sis['practice'] == null) ? 0 : $sis['practice'] ;?></td>
                                        <td class="text-center"><?php echo $test = ($sis['test'] == null) ? 0 : $sis['test'] ;?></td>
                                        <td class="text-center"><?php echo $review = ($sis['review'] == null) ? 0 : $sis['review'] ;?></td>
                                        <td class="text-center"><?= $sis['daily_active']."%"?></td>
                                        <td class="text-center"><?= $sis['produk_name']?></td>
                                        <td class="text-center"><?= $sis['class_name']?></td>
                                        <td class="text-center">
                                            <a href="<?= base_URL() ?>admin/siswa_edit/<?= encrypt_url($sis['id_siswa']) ?>" class="btn bg-orange btn-block btn-xs waves-effect" title="Edit" style="font-size:smaller; margin-bottom:5px;"><i class="material-icons" style="font-size:initial">create</i><span>Edit</span></a>

                                            <a href="javascript:void(0)" class="btn btn-xs bg-teal waves-effect" data-admin="<?=$this->session->userdata('username')?>" data-nama_siswa="<?=$sis['nama_siswa']?>" onclick="$.permission_selftest('<?=$this->session->userdata('username')?>', '<?=$sis['nama_siswa']?>', '<?=$sis['id_siswa']?>')" style="font-size:smaller;"><i class="material-icons" style="font-size:initial">lock</i><span>Unlock Selftest</a>
                                        </td>
                                    </tr>
                                <?php $no++; endforeach; ?>
                                </tbody>
                            </table>
                            <?=form_open('admin/clear_al_permission', 'id="form_clear_permission"');?>
                            <?=form_close()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Small Size -->
        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="smallModalLabel">Import Excel/CSV file </h4>
                    </div>
                    <?=form_open_multipart('admin/upload_siswa', 'id="import_csv"')?>
                        <div class="modal-body">
                            <span>File : <input type="file" name="csv_file" required accept=".csv" class="form-control bg-blue-grey"></label>
                            <br>
                            <a href="<?=base_url()?>admin/download_template_siswa" type="button" style="color:white" class="btn bg-light-blue btn-block waves-effect">Download Template</a>
                            <br><br>
                            <div align="center">
                                <button type="submit" id="import_csv_btn" class="btn bg-blue waves-effect">Upload</button>
                                <button type="button" class="btn bg-blue waves-effect" data-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <ul class="list-group">
                                <li class="list-group-item" style="text-align:center;">Untuk set aktifasi dialog, isikan kolom "dialog activated" dengan 0 untuk menonaktifkan, dan 1 untuk mengaktifakan.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set aktifasi custom school term, isikan kolom "custom term activated" dengan 0 untuk menonaktifkan, dan 1 untuk mengaktifakan.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set tanggal custom school term, isi kolom "custom term from" dan "custom term to" dengan tanggal yang menggunakan format UK, ex: 2018-07-30.</li>
                                <li class="list-group-item" style="text-align:center;">Server akan membaca tanggal US 30-07-18 menjadi 2030-07-18 dan akan mengakibatkan error pada term siswa.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set "custom active story", isikan (tanpa tanda petik) "1-2-3" jika ingin mengaktifkan ketiga story, "1-3" jika ingin mengaktifkan story 1 dan 3 saja, "2" jika ingin mengaktifkan story 2 saja. 
                                Kosongkan jika ingin me-nonaktifkan.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set aktifasi comprehension activated, isikan kolom "comprehension activated" dengan 0 untuk menonaktifkan, dan 1 untuk mengaktifakan.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set aktifasi extended class, isikan kolom "extended class" dengan 0 untuk menonaktifkan, dan 1 untuk mengaktifakan.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set aktifasi speaking activated, isikan kolom "speaking activated" dengan 0 untuk menonaktifkan, dan 1 untuk mengaktifakan.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set aktifasi meaning activated, isikan kolom "meaning activated" dengan 0 untuk menonaktifkan, dan 1 untuk mengaktifakan.</li>
                                <li class="list-group-item" style="text-align:center;">Kosongkan kolom warning (jangan diisi 0 atau 1 atau 2 dst..) jika ingin total warning tidak ikut ter-update.</li>
                                <li class="list-group-item" style="text-align:center;">Untuk set custom active subject : 1:2%1-2-3-4_2:3%1-2-3-4-5</li>
                            </ul>
                        </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_permission_selftest" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center" id="smallModalLabel">Unlock Selftest</h4>
                    </div>
                    <?=form_open_multipart('admin/permission_selftest')?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" class="form-control" id="nama_siswa" readonly  style="background-color:#c7c7c7">
                                </div>
                                <div class="col-sm-6">
                                    <label for="spontan">Spontan</label>
                                    <input type="number" min="0" max="999" name="spontan" class="form-control" id="spontan">
                                </div>
                                <div class="col-sm-6">
                                    <label for="practice">Practice</label>
                                    <input type="number" min="0" max="999" name="practice" class="form-control" id="practice">
                                </div>
                                <div class="col-sm-6">
                                    <label for="test">Test</label>
                                    <input type="number" min="0" max="999" name="test" class="form-control" id="test">
                                </div>
                                <div class="col-sm-6">
                                    <label for="review">Review</label>
                                    <input type="number" min="0" max="999" name="review" class="form-control" id="review">
                                </div>
                                <div class="col-sm-12">
                                    <label for="admin">Nama Admin</label>
                                    <input type="text" name="admin" class="form-control" id="admin" readonly  style="background-color:#c7c7c7">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info btn-block waves-effect">Simpan</button>
                        </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
	$('#import_csv_btn').on('click', function(e){
        e.preventDefault();
        var formData = new FormData($('#import_csv')[0]);
		$.ajax({
			url         :   "<?php echo base_url(); ?>admin/upload_siswa",
			method      :   "POST",
			data        :   formData,
			processData :   false,
			contentType :   false,
			beforeSend:function(){
				$('#import_csv_btn').html('Mohon Menunggu...');
			},
			success:function(data)
			{   
                Swal.fire('Berhasil', data, 'success');
				$('#import_csv')[0].reset();
				$('#import_csv_btn').attr('disabled', false);
				$('#import_csv_btn').delay(1000).html('Upload');
                setTimeout("location.reload(true);", 1500);
			},
            failed : function(data)
            {
                Swal.fire('Gagal', 'File Tidak Ditemukan', 'error');
                setTimeout("location.reload(true);", 1500);
            }
		});
	});
	
    $('#clear_all_device').on('click', function(e) {
        e.preventDefault();
        var mode = "siswa";
        Swal.fire({
            title: 'Yakin akan menghapus?',
            text: "Data Ini.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya'
        }).then(function(isConfirm) {
            if (isConfirm.value) {
                $.ajax({
                    url     : '<?=base_url()?>clear/clear_all_device',
                    type    : "POST",
                    data    : {mode : mode},
                    success: function(feedback){
                        Swal.fire('Selamat', feedback, 'success');
                    }
                });
            }
        })
    });

    $.permission_selftest = function(admin, nama_siswa, id_siswa) 
    {
        $('input[name="nama_siswa"]').val(nama_siswa);
        $('input[name="admin"]').val(admin);

        $.ajax({
            url     : '<?=base_url()?>admin/get_permission_selftest',
            type    : "POST",
            data    : { id_siswa : id_siswa},
            async   : true,
            dataType: 'JSON',
            success : function(callback) {
                var spontan = practice = test = review = "0";
                if (callback != null) {
                    spontan     = callback.spontan;
                    practice    = callback.practice;
                    test        = callback.test;
                    review      = callback.review;
                } 
                    $('input[name="spontan"]').val(spontan);
                    $('input[name="practice"]').val(practice);
                    $('input[name="test"]').val(test);
                    $('input[name="review"]').val(review);
            }
        });
        $('#modal_permission_selftest').modal('show');
    };

    let table           = $('#table_pencarian_siswa').DataTable({"searching" :false,});
    let array_selected  = [];

    table.on("click", "#checkbox_all", function() {
        $("#loading").css("display", "block");
        var rows        = table.rows({ 'search': 'applied' }).nodes();
        var rows_length = rows.length;
        var form        = $('#form_clear_permission');
        
        setTimeout(() => {
            if (this.checked) {
                $('input[name="checkbox"]', rows).prop('checked', this.checked);
                $('input[name="checkbox"]', rows).addClass('selected');
                    for (let index = 1; index <= rows_length; index++) {
                        var id_siswa    = $('#checkbox_'+index, rows).data('id_siswa');
                        if (array_selected.includes(id_siswa) === false) array_selected.push(id_siswa);
                        if (index == rows_length) $("#loading").css("display", "none");
                    }
            } else {
                $('input[name="checkbox"]', rows).prop("checked", false);
                $('input[name="checkbox"]', rows).removeClass('selected');
                    for (let index = 1; index <= rows_length; index++) {
                        var id_siswa = $('#checkbox_'+index, rows).data('id_siswa');
                        array_selected.splice( array_selected.indexOf(id_siswa), 1 );
                        if (index == rows_length) $("#loading").css("display", "none");
                    }
            }
        }, 500);
    });

    table.on('change', '.select', function() {
        var id_siswa    = $(this).data('id_siswa');
        var count_siswa = '<?=count($siswa)?>';

        if(this.checked) {
            $(this).prop('checked', this.checked);
            $(this).addClass('selected');
            array_selected[array_selected.length]  = id_siswa;
            
        } else {
            $(this).prop('checked', false);
            $(this).removeClass('selected');
            array_selected.splice( array_selected.indexOf(id_siswa), 1 );
        }

        if (count_siswa == array_selected.length) {
            $('#checkbox_all').prop('checked', true);
        } else {
            $('#checkbox_all').prop('checked', false);
        }
    })

    $('#clear_all_permission').on('click', function() {
        $.ajax({
            url     : '<?=base_url()?>admin/clear_all_permission',
            type    : "POST",
            data    : {array_selected : array_selected},
            success: function(callback){
                if (callback != 0) {
                    Swal.fire('Selamat', 'Anda Berhasil Clear Permission', 'success');
                    setTimeout("location.reload(true);", 1000);
                }
            }
        });
    });
});
</script>