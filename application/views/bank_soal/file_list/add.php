<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?= $page_title ?> &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>news"><i class="material-icons">people</i> &nbsp;File List</a></li>
                            <li class="active">Tambah</li>
                        </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                            <?php echo validation_errors(); ?>

                            <form method="post" id="form_submit" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <b>Category</b>
                                    <div class="input-group">
                                      <div class="form-line">
                                          <select class="form-control select" name="jenis" style="margin-top:10px;">
                                            <option value="">- Pilih Jenis -</option>
                                            <option value="Reading">Reading</option>
                                            <option value="Dialogue">Dialogue</option>
                                            <option value="Comprehension">Comprehension</option>
                                            <option value="Speaking">Speaking</option>
                                            <option value="Meaning">Meaning</option>
                                          </select>
                                            <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                        </div>
                                    </div>
                                </div>




                                    <div class="col-md-12">
                                        <b>Product Code</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input style="text-transform:uppercase;" type="text" name="code" class="form-control product_code bg-success" value="" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Title</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input type="text" name="title" class="form-control" value="" maxlength="20">
                                              <input type="text" name="version" value="1" hidden>
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <b>Choose File (.txt)</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input type="file" name="file_txt" accept=".txt" class="form-control file_txt" value="" maxlength="20">
                                              <input type="hidden" name="text_path" value="" id="file_txt">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                            <div class="loader_txt">
                                            </div>
                                            <div class="preview_txt">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Choose File (.ogg audio)</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input type="file" name="file_audio[]" accept="audio/ogg" class="form-control file_audio" multiple value="" >
                                              <input type="hidden" name="audio_path" value="" id="file_audio">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                            <div class="loader_audio">

                                            </div>
                                            <div class="preview_audio">

                                            </div>
                                        </div>
                                    </div>
                                  </form>





                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-indigo waves-effect btn_simpan"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                        <a href="<?=base_url()?>bank_soal/file_list" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
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


  $('.product_code').on('keyup', function(){
    if($(this).val().length >= 3){

    if(xhr && xhr.readyState != 4){  xhr.abort();  }

      xhr = $.ajax({
        type:'POST',
        url :'<?= base_url($this->uri->segment(1)."/cek_product_code/") ?>'+($(this).val()).toUpperCase(),
        dataType:'json',
        success:function(data)
        {
          $('.code_status').val(data.type);
          if(data.type == 'false')
          {
            $('.pc').html(data.msg);
          }else {
            $('.pc').html(data.msg);
          }
        },
        beforeSend:function(){
          $('.pc').html(loader('checking...'));
        }
        });
      }

  });


  $('.file_audio').on('change', function(){
    var product_code = $('.product_code').val();
    var jenis = $('.select').val();
    if(product_code == "" || jenis == "")
    {
      $('.file_audio').val("");
      alert('Isi terlebih dahulu Product Code/Jenis');
      return false;
    }
    var name = $(this).attr('name');
     upload_ajax('loader_audio','preview_audio', null, product_code, jenis);
   });

   $('.file_txt').on('change', function(){
     var product_code = $('.product_code').val();
     var jenis = $('.select').val();
     if(product_code == "" || jenis == "")
     {
       $(this).val("");
       alert('Isi terlebih dahulu Product Code/Jenis');
       return false;
     }

     var name = $(this).attr('name');
      upload_ajax_txt('loader_txt','preview_txt', null, product_code, jenis);
    });

  function upload_ajax(preview, target, name, code, jenis)
   {
     if($('.code_status').val() == 'false')
     {
       alert('Product Code sudah dipakai.');
       return false;
     }

     var formData = new FormData(document.getElementById("form_submit"));
     $.ajax({
     url:'<?php echo base_url("bank_soal/upload_file/") ?>'+name+'/'+code+'/'+jenis,
     type:'POST',
     data: formData,
     processData: false,
     contentType: false,
     success: function(data){
       // var preview = '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i id="foto" onclick="delete_dokumen($(this))" class="fa fa-trash trash"></i> </span></div><input name="dokumen[]"  type="text" disabled class="form-control" value="' + data + '" disabled></div>';
            var res = data.split('/');
            var end = res.pop();
            var path = res.join('/');
            $('#'+name).val(path);
            $('.'+preview+'').html('');
            var div  = `<a onclick="remove_el(this, '`+end+`')" data-preview="`+preview+`" data-file="`+path+`/`+end+`" href="#" style="margin-top:2px; margin-left:4px;" type="button" class="btn btn-xs bg-indigo waves-effect"><i style="font-size:13pt;" class="material-icons">delete</i><span> `+end+`</span></a>`;
            $('.'+target).append(data);

     },
     beforeSend:function(){
       $('.'+preview+'').html(loader('Processing...'));
     }
   });
   }

   function upload_ajax_txt(preview, target, name, code, jenis)
    {
      if($('.code_status').val() == 'false')
      {
        alert('Product Code sudah dipakai.');
        return false;
      }

      var formData = new FormData(document.getElementById("form_submit"));
      $.ajax({
      url:'<?php echo base_url("bank_soal/upload_txt/") ?>'+name+'/'+code+'/'+jenis,
      type:'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        // var preview = '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i id="foto" onclick="delete_dokumen($(this))" class="fa fa-trash trash"></i> </span></div><input name="dokumen[]"  type="text" disabled class="form-control" value="' + data + '" disabled></div>';
             var res = data.split('/');
             var end = res.pop();
             var path = res.join('/');
             $('#'+name).val(path);
             $('.'+preview+'').html('');
             var div  = `<a onclick="remove_el(this, '`+end+`')" data-preview="`+preview+`" data-file="`+path+`/`+end+`" href="#" style="margin-top:2px; margin-left:4px;" type="button" class="btn btn-xs bg-indigo waves-effect"><i style="font-size:13pt;" class="material-icons">delete</i><span> `+end+`</span></a>`;
             $('.'+target).html(data);

      },
      beforeSend:function(){
        $('.'+preview+'').html(loader('Processing...'));
      }
    });
    }

   $('.btn_simpan').on('click', function(){
     // var dd = $('.path_audio').data('path_audio');
     // alert(dd); return false;
     var product_code = $('.product_code').val();
     var jenis = $('.select').val();
     var label = $('select[name="jenis"]').val();
     var code = $('input[name="code"]').val();
     var title = $('input[name="title"]').val();
     var text_path = $('.path_txt').data('path_txt');
     var audio_path = $('.path_audio').data('path_audio');

     if(product_code == "" || jenis == "")
     {
       $('.file_audio').val("");
       alert('Isi terlebih dahulu Product Code/Jenis');
       return false;
     }

     if($('.code_status').val() == 'false')
     {
       alert('Product Code sudah dipakai.');
       return false;
     }



     if(text_path == '')
     {
       alert('Anda belum mengupload file txt.');
       return false;
     }
         $.ajax({
         url:'<?php echo base_url("bank_soal/save_file/") ?>',
         type:'POST',
         data:{
           label:label,
           code:code,
           title:title,
           text_path:text_path,
           audio_path:audio_path
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

   function remove_el(el, file)
    {
      var r = confirm("Apakah Anda yakin ingin menghapus dokumen "+file+" ?");
      if(r == true)
      {
          $.ajax({
            url: '<?= base_url('bank_soal') ?>/delete_file/',
            data:{
              file: $(el).data("file")
            },
            type:'POST',
            success: function (response) {
              // $('.'+$(el).data("preview")+'').html('');
              $(el).remove();

            },
            beforeSend: function () {
              // $('.'+$(el).data("preview")+'').html(loader('Processing...'));
            }
          });
      }
    }
</script>
