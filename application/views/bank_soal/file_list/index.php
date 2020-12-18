<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center"> <?= $page_title ?> &nbsp;&nbsp;
                        </h2>
                        <a href="<?=base_url()?>bank_soal/add_file" type="button" class="btn bg-teal btn-xs waves-effect">
                          &nbsp; &nbsp;<i class="material-icons">add</i>
                          <span>&nbsp;Add &nbsp; &nbsp; </span>
                        </a>

                        <select id="filter" class="form-control" name="" style="margin-top:10px;">
                          <option value="">- Show All -</option>
                          <option <?= $this->uri->segment(3)=='Reading'?'selected':'' ?> value="Reading">Reading</option>
                          <option <?= $this->uri->segment(3)=='Dialogue'?'selected':'' ?> value="Dialogue">Dialogue</option>
                          <option <?= $this->uri->segment(3)=='Comprehension'?'selected':'' ?> value="Comprehension">Comprehension</option>
                          <option <?= $this->uri->segment(3)=='Speaking'?'selected':'' ?> value="Speaking">Speaking</option>
                          <option <?= $this->uri->segment(3)=='Meaning'?'selected':'' ?> value="Meaning">Meaning</option>
                        </select>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th class="" style="width:5%;">No</th>
                                    <th class="">Category</th>
                                    <th class="">Product Code</th>
                                    <th class="">Title</th>
                                    <th class="">Upload Date</th>
                                    <th class="">Last Updated</th>
                                    <th class="">Admin</th>
                                    <th class="">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $no =1;
                              foreach ($bank_content as $key => $value) : ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $value->label ?></td>
                                  <td><?= $value->code ?></td>
                                  <td><?= $value->title ?></td>
                                  <td><?= $value->tgl_create ?></td>
                                  <td><?= ($value->tgl_update == ""?"-":$value->tgl_update) ?></td>
                                  <td><?= $value->id_admin ?></td>
                                  <td>
                                    <a href="<?= base_url('bank_soal/edit_file/'.$value->id) ?>" class="btn-sm btn-primary">&nbsp; Edit &nbsp;</a>
                                    <a onclick="return confirm('Yakin ingin menghapus ?')" href="<?= base_url('bank_soal/hapus/'.$value->id) ?>" class="btn-sm btn-danger">Hapus</a>
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


<script type="text/javascript">
  $('#filter').on('change', function(){
    window.location.replace('<?= base_url("bank_soal/file_list/") ?>'+$(this).val());
  })
</script>
