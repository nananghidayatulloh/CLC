<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center"> <?= $page_title ?> &nbsp;&nbsp;
                        </h2>
                        <a href="<?=base_url('previlege/')?>add" type="button" class="btn bg-teal btn-xs waves-effect">
                          &nbsp; &nbsp;<i class="material-icons">add</i>
                          <span>&nbsp;Add &nbsp; &nbsp; </span>
                        </a>



                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th class="" style="width:5%;">No</th>
                                    <th class="">Role Name</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $no =1;
                              foreach ($role as $key => $r) : ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $r->role ?></td>
                                  <td>
                                    <a href="<?= base_url('previlege/access/'.$r->id) ?>" class="btn-sm btn-info">Access Menu</a>
                                    <a href="<?= base_url('previlege/edit/'.$r->id) ?>" class="btn-sm btn-primary">Edit</a>
                                    <a onclick="return confirm('Yakin ingin menghapus ?')" href="<?= base_url('previlege/delete/'.$r->id) ?>" class="btn-sm btn-danger">Hapus</a>
                                  </td>
                                </tr>
                              <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
