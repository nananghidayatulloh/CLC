<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?= $page_title ?> &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>news"><i class="material-icons">people</i> &nbsp;Lesson Plan Config</a></li>
                            <li class="active">Tambah</li>
                        </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                            <?php echo validation_errors(); ?>
                                <?php //form_open_multipart('news/tambah_news', 'role="form"')?>
                                <form method="post" id="form_submit" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <b>Category</b>
                                    <div class="input-group">
                                      <div class="form-line">
                                          <select class="form-control chosen-select choosen-level" id="label" name="label" style="margin-top:10px;">
                                            <option value="">-- Choose Category --</option>
                                            <option <?= $data->label == 'Reading'?'selected':'' ?> value="Reading">Reading</option>
                                            <option <?= $data->label == 'Meaning'?'selected':'' ?> value="Meaning">Meaning</option>
                                            <option <?= $data->label == 'Dialog'?'selected':'' ?> value="Dialog">Dialog</option>
                                            <option <?= $data->label == 'Comprehension'?'selected':'' ?> value="Comprehension">Comprehension</option>
                                            <option <?= $data->label == 'Speaking'?'selected':'' ?> value="Speaking">Speaking</option>
                                            <option <?= $data->label == 'Exam'?'selected':'' ?> value="Exam">Exam</option>
                                          </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <b>Code</b> &nbsp; <small class="pc"></small>
                                    <div class="input-group">
                                        <div class="form-line">
                                          <input style="margin-top:10px;" id="code" type="text" name="code" class="form-control product_code bg-success" value="<?= $data->code ?>" maxlength="20">
                                          <input type="hidden" name="" class="code_status" value="">
                                            <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <b>Target Level</b>
                                    <div class="input-group">
                                      <div class="form-line">
                                          <select class="form-control chosen-select choosen-level" id="level" name="level">
                                            <option value="">-- Choose Level --</option>
                                            <?php foreach ($level as $key => $lvl) : ?>
                                              <option <?= $data->level == $lvl->id_level?'selected':'' ?> value="<?= $lvl->id_level ?>"><?= $lvl->id_level ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                    </div>
                                </div>

                                    <div class="col-md-6">
                                        <b>Recording Time Limit </b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input id="recording_time_limit" type="number" name="recording_time_limit" class="form-control total_story bg-success" value="<?= $data->recording_time_limit ?>" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Main Unit Total</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input style="margin-top:10px;" id="main_unit_total" type="text" name="main_unit_total" class="form-control product_code bg-success" value="<?= $data->total_main_unit ?>" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Extra Unit Total</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input style="margin-top:10px;" id="extra_unit_total" type="text" name="extra_unit_total" class="form-control product_code bg-success" value="<?= $data->total_extra_unit ?>" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Extended Unit Total</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input style="margin-top:10px;" id="extended_unit_total" type="text" name="extended_unit_total" class="form-control product_code bg-success" value="<?= $data->total_extended_unit ?>" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    </form>

                                    <div class="col-md-12 save_section">
                                        <button class="btn bg-indigo waves-effect btn_simpan"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                        <a href="<?=base_url()?>lesson_plan_config" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
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





  $(document).on('click', '.btn_simpan', function(){

        $.ajax({
        url:'<?php echo base_url("lesson_plan_config/save/").$data->id ?>',
        type:'POST',
        data : {
          code : $('#code').val(),
          label : $('#label').val(),
          recording_time_limit : $('#recording_time_limit').val(),
          main_unit_total : $('#main_unit_total').val(),
          extra_unit_total : $('#extra_unit_total').val(),
          extended_unit_total : $('#extended_unit_total').val(),
          level : $('#level').find('option:selected').text()
        },
        dataType: 'JSON',
        success : function(data){
            alert(data);
            location.replace('<?= base_url("lesson_plan_config") ?>');
        }
    });
  });

})




  $('.apply').on('click', function(){
    var total_story = $('.total_story').val();
    $('.story_section').html('');
    for (var i = 0; i < total_story; i++) {
      var str = `<div class="col-md-4">
          <b>Story `+ (i+1) +`</b>
          <div class="input-group">
              <div class="form-line">
                <input id="story`+(i+1)+`" type="text" name="story1" class="form-control auto-complete story unit`+(i+1)+`" value="" maxlength="20">
                <input type="hidden" name="id_story1" class="form-control auto-complete id_story" value="" maxlength="20">
              </div>
          </div>
      </div>`;
      $('.story_section').append(str);
    }

    $('.batch_section').removeAttr('hidden');

  });

  $(function(){
  // $(document).ready(function(){
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


    $(function() {

    function split( val ) {
      return val.split( /,\s*/ );
    }

    function extractLast( term ) {
      return split( term ).pop();
    }

    $( ".batch_input" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).data( "ui-autocomplete" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( '<?= base_url("lesson_plan/get_product_code/") ?>', {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 1 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
    });


      $('.btn_apply').on('click', function(){
        var pecah = $('.batch').val().split(',');

        var batch = $('.unit').val("");
        var batch = $('.unit').css('background-color', 'white');
        for (var x = 0; x < pecah.length; x++) {
            var txt = pecah[x].split('-');
            if(txt[0] != ""){

            var target = 'unit'+txt[0];
            var tt = target.split(' ').join('');

            $('.'+tt).css('background-color','#A8FBA4');
            $('.'+tt).val(txt[1].toUpperCase());
            }
        }
        // alert(batch);
      });


</script>
