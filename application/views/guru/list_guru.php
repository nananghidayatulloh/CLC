<section class="content">
    <div class="container-fluid">
    <!-- Notifikasi -->
    <?php 
    if ($this->session->flashdata('simpan')){
        echo '<div class="flash-data" data-flashdata="'.$this->session->flashdata('simpan').'"></div>';
    } else if ($this->session->flashdata('salah')){
        echo '<div class="flash-error" data-flasherror="'.$this->session->flashdata('salah').'"></div>';
    }
    ?>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Guru &nbsp;&nbsp;
                            <a href="<?= base_url() ?>admin/guru_tambah" type="button" class="btn bg-teal btn-xs waves-effect">
                                <i class="material-icons">add</i>
                                <span>Tambah</span>
                            </a>
                            <button type="button" class="btn bg-red btn-xs waves-effect pull-right" id="clear_all_device"><i class="material-icons">delete</i><span>Clear All Device</span></button>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">ID Guru</th>
                                        <th class="text-center">Nama Guru</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($guru as $gr) :
                                        if ($gr['id_guru'] != "") :
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?>.</td>
                                        <td class="text-center"><?= $gr['id_guru'] ?></td>
                                        <td class="text-center"><?= $gr['nama_guru'] ?></td>
                                        <td class="text-center">
                                        <div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
                                            <a href="<?= base_url() ?>admin/guru_edit/<?= encrypt_url($gr['id_guru']) ?>" class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                            <a href="<?= base_url() ?>admin/guru_hapus/<?= encrypt_url($gr['id_guru']) ?>" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Hapus"><i class="material-icons">delete</i><span>Hapus</span></a>
                                        </div>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                    endif;
                                    endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->

            <!-- Small Size -->
            <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Import Excel/CSV file </h4>
                        </div>
                        <div class="modal-body">
                            <span>File : <input type="file" name=""></label>
                            <br>
                            <a href="" type="button" style="color:white" class="btn bg-light-blue btn-block waves-effect">Download Template</a>
                        </div>
                        <div class="modal-footer">
                            <a type="button" name="submit" class="btn btn-link waves-effect">SIMPAN</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
</div>
</section>
<script>
$(document).ready(function(){
    $('#clear_all_device').on('click', function(e) {
        e.preventDefault();
        var mode = "guru";
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
});
</script>