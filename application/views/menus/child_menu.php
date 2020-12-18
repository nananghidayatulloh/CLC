<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center"> <?= $page_title ?> &nbsp;&nbsp;
                        </h2>
                        <a href="<?=base_url('menus/sub_menu/')?><?= $this->uri->segment(4) ?>" type="button" class="btn bg-primary btn-xs waves-effect">
                          &nbsp; &nbsp;<i class="material-icons">arrow_back</i>
                          <span>&nbsp;Back &nbsp; &nbsp; </span>
                        </a>
                        <a href="<?=base_url('menus/')?>add_childmenu/<?= $this->uri->segment(3) ?>" type="button" class="btn bg-teal btn-xs waves-effect">
                          &nbsp; &nbsp;<i class="material-icons">add</i>
                          <span>&nbsp;Add &nbsp; &nbsp; </span>
                        </a>



                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th class="" style="width:5%;">No</th>
                                    <th class="">Sub Sub Menu Name</th>
                                    <th class="">Url</th>
                                    <th class="">Order</th>
                                    <th class="">Is Active ?</th>
                                    <th class="">Role</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $no =1;
                              foreach ($child_menu as $key => $m) :
                                $role = $this->db->get_where('tb_role', ['id' => $m->role_id])->row();
                                ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $m->title ?></td>
                                  <td><?= $m->url ?></td>
                                  <td><?= $m->order ?></td>
                                  <td><?= $m->is_active==1?'Yes':'No' ?></td>
                                  <td><?= $role->role ?></td>
                                  <td>
                                    <a href="<?= base_url('menus/edit_child/'.$m->id) ?>" class="btn-sm btn-primary">Edit</a>
                                    <a onclick="return confirm('Yakin ingin menghapus ?')" href="<?= base_url('menus/delete_child/'.$m->id.'/'.$this->uri->segment(3)) ?>" class="btn-sm btn-danger">Hapus</a>
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
