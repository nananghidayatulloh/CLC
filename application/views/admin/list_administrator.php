<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Administrator &nbsp;&nbsp;
                            <a href="<?=base_url()?>admin/administrator_tambah" type="button" class="btn bg-teal btn-xs waves-effect">
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
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($adm as $a):
                                    $role = $this->db->get_where('tb_role', ['id' => $a['role_user']])->row();
                                ?>
                                <tr>
                                    <td class="text-center"><?=$no?></td>
                                    <td class="text-center"><?=$a['username']?></td>
                                    <td class="text-center"><?=$role->role; ?></td>
                                    <td class="text-center">
                                        <a href="<?=base_URL()?>admin/administrator_edit/<?=encrypt_url($a['username'])?>" class="btn btn-xs bg-orange waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                        <a href="<?=base_URL()?>admin/administrator_hapus/<?=encrypt_url($a['username'])?>" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Hapus"><i class="material-icons">delete</i><span>Hapus</span></a>
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
</section>
