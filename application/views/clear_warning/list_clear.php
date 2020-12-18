<section class="content">
    <div class="container-fluid">
    <!-- Notifikasi -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Warning Siswa</h2>
                    </div>
                    <div class="body table-responsive">
                        <ul class="nav nav-tabs tab-col-amber" role="tablist">
                            <li role="presentation">
                                <a href="#daily_reading_lama" data-toggle="tab">DAILY READING (lama)</a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="#daily_reading" data-toggle="tab">DAILY READING</a>
                            </li>
                            <li role="presentation">
                                <a href="#daily_speaking" data-toggle="tab">DAILY SPEAKING</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="daily_reading_lama">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">ID Siswa</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Nama Cabang</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Warning</th>
                                            <th class="text-center">Total Cleared</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($clear_warning as $cw):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$no?></td>
                                            <td class="text-center"><?=$cw['id_siswa']?>
                                                <?=form_open('admin/clear_warning_hapus')?>
                                                    <input type="hidden" name="id_siswa" value="<?=$cw['id_siswa']?>">
                                            </td>
                                            <td class="text-center"><?=$cw['nama_siswa']?></td>
                                            <td class="text-center"><?=$cw['nama_cabang']?>
                                            <td class="text-center"><?=$cw['level']?>
                                            <td class="text-center"><?=$cw['warning']?>
                                                <input type="hidden" name="warning" value="0">
                                            </td>
                                            <td class="text-center"><?=$cw['total_cleared']?></td>
                                            <td class="text-center">
                                                <!-- <a href="<?=base_url()?>admin/clear_warning_hapus/<?=encrypt_url($cw['id_siswa'])?>" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Tambah"><i class="material-icons">delete</i><span>Clear</span></a> -->
                                                <button type="submit" name="submit" class="btn bg-red btn-xs waves-effect" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" title="Tambah"><i class="material-icons">delete</i><span>Clear</span></button>
                                            </td>
                                            <?=form_close()?>
                                        </tr>

                                        <?php $no++; endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in active" id="daily_reading">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">ID Siswa</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Nama Cabang</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Warning</th>
                                            <th class="text-center">Total Cleared</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($daily_reading as $dr):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$no?></td>
                                            <td class="text-center"><?=$dr['id_siswa']?></td>
                                            <td class="text-center"><?=$dr['nama_siswa']?></td>
                                            <td class="text-center"><?=$dr['nama_cabang']?>
                                            <td class="text-center"><?=$dr['level']?>
                                            <td class="text-center"><?=$dr['warning']?></td>
                                            <td class="text-center"><?=$dr['total']?></td>
                                            <td class="text-center">
                                                <a href="<?=base_url()?>admin/clear_warning_siswa/<?=encrypt_url($dr['id_siswa'])?>/daily_reading" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Clear"><i class="material-icons">delete</i><span>Clear</span></a>
                                            </td>
                                        </tr>

                                        <?php $no++; endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="daily_speaking">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">ID Siswa</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Nama Cabang</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Warning</th>
                                            <th class="text-center">Total Cleared</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($daily_speaking as $ds):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$no?></td>
                                            <td class="text-center"><?=$ds['id_siswa']?></td>
                                            <td class="text-center"><?=$ds['nama_siswa']?></td>
                                            <td class="text-center"><?=$ds['nama_cabang']?>
                                            <td class="text-center"><?=$ds['level']?>
                                            <td class="text-center"><?=$ds['warning']?></td>
                                            <td class="text-center"><?=$ds['total']?></td>
                                            <td class="text-center">
                                                <a href="<?=base_url()?>admin/clear_warning_siswa/<?=encrypt_url($ds['id_siswa'])?>/daily_speaking" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Clear"><i class="material-icons">delete</i><span>Clear</span></a>
                                            </td>
                                        </tr>

                                        <?php $no++; endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->
    </div>
</section>