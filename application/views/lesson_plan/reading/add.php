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
                                <?php //form_open_multipart('news/tambah_news', 'role="form"')?>

                                <div class="col-md-6">
                                    <b>Level</b>
                                    <div class="input-group">
                                      <div class="form-line">
                                          <select class="form-control chosen-select choosen-level" id="level" name="jenis" style="margin-top:10px;">
                                            <option value="">-- Choose Level --</option>
                                            <?php foreach ($level as $key => $lvl) : ?>
                                              <option value="<?= $lvl->id_level ?>"><?= $lvl->id_level ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <b>Unit</b>
                                    <div class="input-group">
                                      <div class="form-line">
                                          <select disabled class="form-control choosen-unit chosen-select" name="jenis" id="unit" style="margin-top:10px;">
                                            <option value="">-- Choose Level First --</option>
                                            <?php //foreach ($level as $key => $lvl) : ?>
                                            <?php //endforeach; ?>
                                          </select>
                                        </div>
                                    </div>
                                </div>




                                    <div class="col-md-12">
                                        <b>Unit Title</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input id="unit_title" style="text-transform:uppercase;" type="text" name="unit_title" class="form-control product_code bg-success" value="" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                              <input type="hidden" name="judul" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Story 1</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input type="text" name="story1" class="form-control auto-complete story" value="" maxlength="20">
                                              <input type="hidden" name="id_story1" class="form-control auto-complete id_story" value="" maxlength="20">

                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Story 2</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input type="text" name="story2" class="form-control auto-complete story" value="" maxlength="20">
                                              <input type="hidden" name="id_story2" class="form-control auto-complete id_story" value="" maxlength="20">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <b>Story 3</b>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input type="text" name="story3" class="form-control auto-complete story" value="" maxlength="20">
                                              <input type="hidden" name="id_story3" class="form-control auto-complete id_story" value="" maxlength="20">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn bg-indigo waves-effect btn_simpan"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                        <a href="<?=base_url()?>lesson_plan/reading_<?= $mode?>" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
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
$(document).ready(function(){
  $(".chosen-select").chosen({no_results_text: "Oops, data not found!"});

  $(".choosen-level").on('change', function(){
    $.ajax({
    url:'<?php echo base_url("lesson_plan/get_unit/") ?>'+$(this).val()+'/'+'<?= $mode ?>',
    type:'POST',
    success: function(data){
      if(data == "<option value=''>Sorry, unit not found !</option>")
      {
        $('.choosen-unit').find("option").remove();
        $('.choosen-unit').append(data);
        $('.choosen-unit').trigger("chosen:updated");
        return false;
      }
      $('.choosen-unit').removeAttr('disabled');
      $('.choosen-unit').find("option").remove();
      $('.choosen-unit').append(data);
      $('.choosen-unit').trigger("chosen:updated");
    },
    beforeSend:function(){
    }
   });
  });

  $(".choosen-unit").on('change', function(){
    var name =  $(this).find(':selected').data('unit_name');
    $('input[name="unit_title"]').val(name);
    $('input[name="judul"]').val(name);
  })

  $('.btn_simpan').on('click', function(){
    var story = [];
    var id_story = [];

    $('.story').each(function(){
      story.push($(this).val());
    });

    $('.id_story').each(function(){
      id_story.push($(this).val());
    });


        $.ajax({
        url:'<?php echo base_url("lesson_plan/save_lesson/") ?>'+'<?= $table ?>',
        type:'POST',
        data : {
          'story[]' : story,
          'id_story[]' : id_story,
          unit : $('#unit').val(),
          level : $('#level').val(),
          judul : 'unit asdf',
          mode : '<?= $mode ?>'
        },
        dataType: 'JSON',
        success : function(data){
            alert(data.msg);
        }
    });
  });

})


$(function(){

		$(".auto-complete").autocomplete({
		  source: "<?= base_url("lesson_plan/get_product_code/") ?>",
      change: function() {
         var name = $(this).attr('name');

         $.ajax({
         url:'<?php echo base_url("lesson_plan/get_id_bank_soal/") ?>'+$(this).val(),
         type:'POST',
         dataType: 'JSON',
         success : function(data){
             $('input[name="id_'+name+'"]').val(data);
         }
     });
     }
		});
	});



</script>
