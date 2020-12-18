<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center"> <?= $page_title ?> &nbsp;&nbsp;
                        </h2>
                        <a href="<?=base_url()?>lesson_plan/add_<?= $this->uri->segment(2) ?>" type="button" class="btn bg-teal btn-xs waves-effect">
                          &nbsp; &nbsp;<i class="material-icons">add</i>
                          <span>&nbsp;Add &nbsp; &nbsp; </span>
                        </a>



                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th class="" style="width:5%;">No</th>
                                    <th class="">Lesson Plan</th>
                                    <th class="">Unit</th>
                                    <th class="">Story</th>
                                    <th class="">Mode</th>
                                    <th class="">Product Code</th>
                                    <th class="">Create At</th>
                                    <th class="">Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $no =1;
                              foreach ($reading as $key => $value) : ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $value->lesson_plan_code ?></td>
                                  <td><?= $value->unit.' '.$value->unit_name ?></td>
                                  <td><?= $value->story.' '.$value->title ?></td>
                                  <td><?= $value->mode ?></td>
                                  <td><?= $value->product_code ?></td>
                                  <td><?= date('Y/m/d H:i', $value->create_at); ?></td>
                                  <td><?= $value->id_admin ?></td>
                                  <td>
                                    <a onclick="return confirm('Yakin ingin menghapus ?')" href="<?= base_url('lesson_plan/del/'.$table.'/'.$mode.'/'.$value->id) ?>" class="btn-sm btn-danger">Hapus</a>
                                    <a href="<?= base_url('lesson_plan/edit/'.$table.'/'.$mode.'/'.$value->id) ?>" class="btn-sm btn-info">&nbsp; Edit &nbsp;</a>
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
