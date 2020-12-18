<section class="content">
        <div class="container-fluid">
            <!-- Notifikasi -->
        <?php 
        
        ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Kantor Cabang &nbsp;&nbsp;
                                <a href="<?=base_url()?>admin/kantor_cabang_tambah" type="button" class="btn bg-teal btn-xs waves-effect">
                                    <i class="material-icons">add</i>
                                    <span>Tambah</span>
                                </a>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Kantor Cabang</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($kantor_cabang as $kc):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?></td>
                                        <td class="text-center"><?=$kc['nama_cabang']?></td>
                                        <td class="text-center">
                                            <a href="<?=base_URL()?>admin/kantor_cabang_edit/<?=encrypt_url($kc['id_cabang'])?>" class="btn btn-xs bg-orange waves-effect" title="Detail"><i class="material-icons">create</i><span>Edit</span></a>
                                            <a href="<?=base_URL()?>admin/kantor_cabang_hapus/<?=encrypt_url($kc['id_cabang'])?>" class="btn btn-xs bg-red waves-effect tombol_hapus" title="Hapus"><i class="material-icons">delete</i><span>Hapus</span></a>
                                        </td>
                                    </tr>

                                    <?php $no++; endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
        </div>
    </section>