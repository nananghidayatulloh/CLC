<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text-center"> <?= $page_title ?> &nbsp;&nbsp;
                        </h2>
                        <a href="<?=base_url()?>lesson_plan_config/add" type="button" class="btn bg-teal btn-xs waves-effect">
                          &nbsp; &nbsp;<i class="material-icons">add</i>
                          <span>&nbsp;Add &nbsp; &nbsp; </span>
                        </a>



                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                  <th class=""></th>
                                    <th class="" style="width:5%;">No</th>
                                    <th class="">Category</th>
                                    <th class="">Lesson Plan Code</th>
                                    <th class="">Target Level</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $no =1;
                              foreach ($data as $key => $value) :
                                $get = $this->db->get('lesson_plan_code', ['code' => $value->code, 'label' => $value->label])->row();
                                 ?>
                                <tr>
                                  <td>
                                    <a onclick="return confirm('Yakin ingin menghapus ?')" href="<?= base_url('lesson_plan_config/delete/'.$value->id) ?>" class="btn-sm btn-danger">Delete</a>
                                  </td>
                                  <td><?= $no++ ?></td>
                                  <td><?= $value->label ?></td>
                                  <!-- reading -->
                                  <td><?= $value->code ?></td>
                                  <td><?= $value->level ?></td>
                                  <!--  -->
                                  <!-- target ??? -->
                                  <td> <input type="number" name="" data-id="time<?= $key?>" class="time time<?= $key?>" value="<?= $value->recording_time_limit; ?>" style="width:50px;"> : 00 </td>
                                  <td>
                                    <a href="<?= base_url('lesson_plan_config/edit/'.$value->id) ?>" class="btn-sm btn-info"> Edit </a> 
                                    <!-- <a data-time="<?= $key ?>" data-id="<?= $value->id ?>" id="time<?= $key?>" href="#" onclick="edit(this)" class="btn-sm btn-primary">Edit</a>  -->
                                  </td>
                                </tr>
                                <?php //base_url('lesson_plan_config/edit/'.$value->id) ?>
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
  function edit(el){
    var target = $(el).data('time');
    var data = $('.time'+target).val();
    var id = $(el).data('id');
    $.ajax({
      url:'<?= base_url('lesson_plan_config/save_config/') ?>'+id,
      type:'POST',
      dataType:'json',
      data:{
        recording_time_limit:data
      },
      success:function(data){
        alert(data)
      }
    });
  }

</script>
