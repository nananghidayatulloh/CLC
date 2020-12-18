<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?= $page_title ?> &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>news"><i class="material-icons">people</i> &nbsp;Sub Sub Menu</a></li>
                            <li class="active">Add</li>
                        </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                            <?php echo validation_errors(); ?>

                                    <div class="col-md-12">
                                        <b>Sub Sub Name</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input type="text" name="menu" class="form-control menu bg-success" id="menu" value="" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Url</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input type="text" name="url" class="form-control url bg-success" id="url" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Order</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input type="text" name="urutan" class="form-control urutan bg-success" id="urutan" value="" maxlength="20">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <b>Role</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <select id="role_id" name="role_id" class="form-control show-tick">
                                                <option value="">- Select Role -</option>
                                                <?php foreach ($role as $key => $data) : ?>
                                                  <option value="<?= $data->id ?>"><?= $data->role ?></option>
                                                <?php endforeach; ?>
                                              </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-indigo waves-effect btn_simpan"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                        <a href="<?=base_url()?>menus/sub_menu/<?= $this->uri->segment(3) ?>" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
                                        </a>
                                    </div>
                                <?php //form_close()?>
                            </div>
                        </div>
                    </div>
        <!-- #END# Masked Input -->
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->
    </div>
</section>


<script type="text/javascript">
  xhr = null;


   $('.btn_simpan').on('click', function(){

         $.ajax({
         url:'<?php echo base_url("menus/save_childmenu/") ?>',
         type:'POST',
         data:{
           sub_id:'<?= $this->uri->segment(3); ?>',
           title:$('#menu').val(),
           url:$('#url').val(),
           order:$('#urutan').val(),
           role_id:$('#role_id').val()
         },
         success: function(data){
           $('.btn_simpan').html('<i class="material-icons">save</i> SIMPAN');
           Swal('Berhasil', 'Menyimpan data...', 'success');
           // alert(data);
           location.reload();

         },
         beforeSend:function(){
           $('.btn_simpan').html(loader('Processing...'));
         }
        });

    });

   function loader(pesan)
   {
     return `<img style="width:17px;" src="<?= base_url('assets/images/loader.gif') ?>" alt=""> `+pesan;
   }


</script>
