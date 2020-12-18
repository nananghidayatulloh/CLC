<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center"> <?= $page_title ?> &nbsp;&nbsp;
                        </h2>
                        <a href="<?=base_url('menus/')?>add" type="button" class="btn bg-teal btn-xs waves-effect">
                          &nbsp; &nbsp;<i class="material-icons">add</i>
                          <span>&nbsp;Add &nbsp; &nbsp; </span>
                        </a>



                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th class="" style="width:5%;">No</th>
                                    <th class="">Menu Name</th>
                                    <th class="">Url</th>
                                    <th class="">Urutan</th>
                                    <th class="">Icon</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $no =1;
                              foreach ($menu as $key => $m) : ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $m->menu ?></td>
                                  <td><?= $m->url ?></td>
                                  <td><?= $m->urutan ?></td>
                                  <td><?= $m->icon ?></td>
                                  <td>
                                    <a href="<?= base_url('menus/sub_menu/'.$m->id) ?>" class="btn-sm btn-info">Sub Menu</a>
                                    <a href="<?= base_url('menus/edit/'.$m->id) ?>" class="btn-sm btn-primary">Edit</a>
                                    <a onclick="return confirm('Yakin ingin menghapus ?')" href="<?= base_url('menus/delete/'.$m->id) ?>" class="btn-sm btn-danger">Hapus</a>
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
