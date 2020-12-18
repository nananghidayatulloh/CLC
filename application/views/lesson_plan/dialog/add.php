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
                                          <select class="form-control chosen-select choosen-level" id="level" name="level" style="margin-top:10px;">
                                            <option value="">-- Choose Level --</option>
                                            <?php foreach ($level as $key => $lvl) :
                                                $total_unit = $this->db->get_where('dialog_config', ['id_level' => $lvl->id_level])->row();
                                               ?>
                                              <option data-total_unit="<?= ($total_unit?$total_unit->main_total_unit:0) ?>" value="<?= $lvl->id_level ?>"><?= $lvl->id_level ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                    </div>
                                </div>






                                    <div class="col-md-10">
                                        <b>Batch Input</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input id="batch" style="text-transform:uppercase;" type="text" name="batch" class="form-control batch bg-success auto-complete" value="">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                      <b></b> &nbsp; <small class="pc"></small>
                                      <div class="input-group">
                                        <button class="btn bg-indigo waves-effect btn_apply btn-xs"> <i class="material-icons">filter_list</i> <span>Apply</span></button>
                                      </div>
                                    </div>
                                    <div class="story_content">

                                    </div>


                                    <div class="col-md-12">
                                        <button class="btn bg-indigo waves-effect btn_simpan"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                        <a href="<?=base_url()?>lesson_plan/<?= str_replace('add_', '', $this->uri->segment(2)) ?>" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
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


  $('.btn_simpan').on('click', function(){
    var unit = [];
    var product_code = [];

    $('.unit').each(function(){
      product_code.push($(this).val());
      unit.push($(this).data('unitt'));
    });

        $.ajax({
        url:'<?php echo base_url("lesson_plan/save_lesson_dcs/") ?>'+'<?= $table ?>',
        type:'POST',
        data : {
          level : $('#level').val(),
          batch : $('#batch').val(),
          'unit[]' : unit,
          'product_code[]' : product_code,
          mode : '<?= $mode ?>'
        },
        dataType: 'JSON',
        success : function(data){
            alert(data.msg);
            location.reload();
        }
    });
  });

})


$(function(){


    $('#level').on('change', function(){
      var total_unit = $(this).find(':selected').data('total_unit');

      $.ajax({
      url:'<?php echo base_url("lesson_plan/get_batch/") ?>'+'<?= $table ?>/'+total_unit+'/<?= $mode ?>'+'/'+$(this).val(),
      type:'POST',
      dataType: 'JSON',
      success : function(data){
        var myArr = [];
        for (var i = 0; i < data.length; i++) {
          myArr.push(data[i].product_code);
        }
        $('.story_content').html(data.content);
        $('.batch').val(data.batch.batch);


      }
  });


    });

    // $(".auto-complete").autocomplete({
    //   source: "<?php //base_url("lesson_plan/get_product_code/") ?>",
    //
    // });

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

$(function() {

function split( val ) {
  return val.split( /,\s*/ );
}

function extractLast( term ) {
  return split( term ).pop();
}

$( ".auto-complete" )
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


$(document).ready(function(){


		$(".suggest").autocomplete({
		  source: "<?= base_url("lesson_plan/get_product_code/") ?>"
		});
	});


</script>
