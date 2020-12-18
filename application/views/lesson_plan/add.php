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
                                    <b>Lesson Plan Code</b>
                                    <div class="input-group">
                                      <div class="form-line">
                                        <select class="form-control chosen-select choosen-lesson_code" id="lesson_code" name="lesson_code" style="margin-top:10px;">
                                          <option value="">-- Choose Lesson Plan Code --</option>
                                          <?php foreach ($lesson_code as $key => $lvl) : ?>
                                            <option data-level="<?= $lvl->code ?>" data-level2="<?= $lvl->level ?>" value="<?= $lvl->id ?>"><?= $lvl->code ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <b>Target Level</b>
                                    <div class="input-group">
                                      <div class="form-line">
                                          <input disabled type="text" name="" id="v_level" class="form-control" value="">
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




                                    <div class="col-md-6">
                                        <b>Unit Title</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input id="unit_title" type="text" name="unit_title" class="form-control product_code bg-success" value="" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-11">
                                        <b>Total Story</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input id="total_story" type="text" name="total_story" class="form-control total_story bg-success" value="" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <br>
                                        <div class="input-group">
                                              <button type="button" class="btn btn-primary apply" name="button"> <i class="material-icons" style="font-size:11pt;">filter_list</i>&nbsp; Apply</button>
                                        </div>
                                    </div>

                                    <div class="batch_section" hidden>
                                    <div class="col-md-11">
                                        <b>Batch Input</b> &nbsp; <small class="pc"></small> <small style="font-weight:bold;">StoryNumber-ProductCode-CLCDate-GoalTarget-SubmitLimit (example: 1-019NDK-W02D1-3-7, 2-020NDK-W03D1-5-8)</small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input id="batch" style="text-transform:uppercase;" type="text" name="batch" class="form-control batch bg-success batch_input" value="">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <br>
                                        <div class="input-group">
                                              <button type="button" class="btn btn-primary btn_apply" name="button"> <i class="material-icons" style="font-size:11pt;">filter_list</i>&nbsp; Apply</button>
                                        </div>
                                    </div>
                                  </div>

                                    <div class="story_section">

                                    </div>



                                    <div class="col-md-12 save_section" hidden>
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

function storyEdit(){
  var data = [];
    var story = [];
    var id_story = [];
    var unlock_date = [];
    var goal_target = [];
    var submit_limit = [];
    var batch = [];
    var no=1;

    $('.goal_target').each(function(){
      goal_target.push($(this).val());
    });
    $('.submit_limit').each(function(){
      submit_limit.push($(this).val());
    });

    $('.id_story').each(function(){
      id_story.push($(this).val());
    });

    $('.unlock_date').each(function(){
      unlock_date.push($(this).val());
    });

    $('.story').each(function(){

      if($(this).val() != ""){
        batch.push((no++)+'-'+$(this).val()+'-'+unlock_date[no-2]+'-'+goal_target[no-2]+'-'+submit_limit[no-2]);
      }
      story.push($(this).val());
    });
    $('.batch').val(batch.toString());
    $('.btn_apply').click();
  }

$(document).ready(function(){
  $(".chosen-select").chosen({no_results_text: "Oops, data not found!"});

  $(".choosen-level").on('change', function(){
    $.ajax({
    url:'<?php echo base_url("lesson_plan/get_unit/") ?>'+$(this).val()+'/<?= $mode ?>/'+'<?= $config ?>',
    type:'POST',
    success: function(data){
      if(data == "<option value=''>Sorry, unit not found !</option>")
      {
        $('.choosen-unit').find("option").remove();
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

  $("#lesson_code").on('change', function(){
    let level = $(this).find('option:selected').data('level');
    let level2 = $(this).find('option:selected').data('level2');
    $.ajax({
    url:'<?php echo base_url("lesson_plan/get_lesson_plan_code/") ?>'+$(this).val()+'/'+level,
    dataType:'json',
    type:'POST',
    success: function(data){
      // $('.choosen-level').removeAttr('disabled');
      $('.choosen-unit').removeAttr('disabled');
      $('.choosen-unit').find("option").remove();
      $('.choosen-unit').append(data.option);
      $('.choosen-unit').trigger("chosen:updated");
      $('#v_level').val(level2);
    },
    beforeSend:function(){
    }
   });
  });

  $(".choosen-unit").on('change', function(){
    var name =  $(this).find(':selected').data('title');
    $('#unit_title').val(name);

    $.ajax({
    url:'<?php echo base_url("lesson_plan/get_story/") ?>'+$('#lesson_code').find('option:selected').data('level')+'/'+$(this).val()+'/'+'<?= $mode ?>'+'/'+'<?= $table ?>',
    type:'POST',
    success: function(data){
      var dataa = jQuery.parseJSON(data);
      // alert(dataa[0].product_code);
      // return false;
      // for (var i = 0; i < dataa.length; i++) {
      //   console.log('Hasil '+ dataa[i].product_code);
      //   $('#story'+dataa[i].story).val(dataa[i].product_code);
      //   $('#total_story').val(dataa[i].total_story);
      //   $('.apply').click();
      // }
        $('#total_story').val(dataa.total_story);
        $('.apply').click();
        $('#batch').val(dataa.batch);
        $('.btn_apply').click();
    },
    beforeSend:function(){
    }
   });

  })

  $(document).on('click', '.btn_simpan', function(){



    // setTimeout(function(){
    var data = [];
    var story = [];
    var id_story = [];
    var unlock_date = [];
    var goal_target = [];
    var submit_limit = [];
    var batch = [];
    var no=1;

    $('.goal_target').each(function(){
      goal_target.push($(this).val());
    });
    $('.submit_limit').each(function(){
      submit_limit.push($(this).val());
    });

    $('.id_story').each(function(){
      id_story.push($(this).val());
    });

    $('.unlock_date').each(function(){
      unlock_date.push($(this).val());
    });

    $('.story').each(function(){

      if($(this).val() != ""){
        batch.push((no++)+'-'+$(this).val()+'-'+unlock_date[no-2]+'-'+goal_target[no-2]+'-'+submit_limit[no-2]);
      }
      story.push($(this).val());
    });
    $('.batch').val(batch.toString());
    $('.btn_apply').click();


    $('.existing').each(function(){
      data.push($(this).data('status'));
    })


    if ($.inArray(0, data) != -1)
    {
      alert('Process Failed. \nMake sure story code is exist!')
      return false;
    }




        $.ajax({
        url:'<?php echo base_url("lesson_plan/save_lesson/") ?>'+'<?= $table ?>',
        type:'POST',
        data : {
          'story[]' : story,
          'id_story[]' : id_story,
          'unlock_date[]' : unlock_date,
          'goal_target[]' : goal_target,
          'submit_limit[]' : submit_limit,
          title : $('#unit_title').val(),
          unit : $('#unit').val(),
          level : $('#v_level').val(),
          'batch[]' : batch,
          lesson_plan_code : $('#lesson_code').find('option:selected').data('level'),
          total_story : $('#total_story').val(),
          mode : '<?= $mode ?>'
        },
        dataType: 'JSON',
        success : function(data){
            alert(data.msg);
            location.reload();
        }
    });
  // }, 500);
  });

})




  $('.apply').on('click', function(){
    var total_story = $('.total_story').val();
    $('.story_section').html('');
    for (var i = 0; i < total_story; i++) {
      var str = `<div class="col-md-4 parent">
          <b>Story `+ (i+1) +` <small class="notif exist`+(i+1)+`"></small></b>
          <div class="input-group">
              <div class="form-line">
                <input id="story`+(i+1)+`" type="text" name="story1" class="form-control auto-complete story unit`+(i+1)+`" value="" maxlength="20" onfocusout="storyEdit()">
                <input type="hidden" name="id_story" class="form-control auto-complete id_story" value="`+(i+1)+`" maxlength="20">

              </div>
          </div>
      </div>
      <div class="col-md-4">
          <b>Available at <small class="notif_ava exist_ava`+(i+1)+`"></small></b>
          <div class="input-group">
              <div class="form-line">
                <input id="available`+(i+1)+`" type="text" name="available" class="form-control auto-complete unlock_date available`+(i+1)+`" value="" maxlength="20" onfocusout="storyEdit()">
              </div>
          </div>
          </div>

          <div class="col-md-2">
              <b>Goal Target <small class=" gt`+(i+1)+`"></small></b>
              <div class="input-group">
                  <div class="form-line">
                    <input id="gt`+(i+1)+`" type="text" name="goal_target" class="form-control auto-complete goal_target gt`+(i+1)+`" value="3" maxlength="20">
                  </div>
              </div>
              </div>

              <div class="col-md-2">
                  <b>Submit Limit <small class=" sl`+(i+1)+`"></small></b>
                  <div class="input-group">
                      <div class="form-line">
                        <input id="sl`+(i+1)+`" type="text" name="submit_limit" class="form-control auto-complete submit_limit sl`+(i+1)+`" value="7" maxlength="20">
                      </div>
                  </div>
                  </div>
      `;
      $('.story_section').append(str);
    }

    $('.save_section').removeAttr('hidden');
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
      .bind( "keyup", function( event ) {
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
        $('.story').val('');
        $('.notif').html('');
        $('.story').css('background-color', 'white');
        var pecah = $('.batch').val().split(',');

        var batch = $('.unit').val("");
        var batch = $('.unit').css('background-color', 'white');
        for (var x = 0; x < pecah.length; x++) {
            var txt = pecah[x].split('-');
            if(txt[0] != ""){

            var target = 'unit'+txt[0];
            var available = 'available'+txt[0];
            var status = 'exist'+txt[0];
            var status_ava = 'exist_ava'+txt[0];
            var gt = 'gt'+txt[0];
            var sl = 'sl'+txt[0];

            var tt = target.split(' ').join('');
            var ava = available.split(' ').join('');
            var st = status.split(' ').join('');
            var st2 = status_ava.split(' ').join('');


            $('.'+tt).css('background-color','#A8FBA4');
            $('.'+tt).val(txt[1].toUpperCase());
            // $('.'+st).val(txt[1].toUpperCase());
            $('.'+st).text(check_code(txt[1].toUpperCase(), '.'+st));
            if(txt.length > 2){
              $('.'+ava).val(txt[2].toUpperCase());
              $('.'+st2).text(check_calendar(txt[2].toUpperCase(), '.'+st2));
            }
            if(txt.length > 3)
            {
              if(txt[3].toUpperCase() == '')
              {
                $('.'+gt).val(3);
              }else {
                $('.'+gt).val(txt[3].toUpperCase());
              }
            }
            if(txt.length > 4)
            {
              if(txt[4].toUpperCase() == '')
              {
                $('.'+sl).val(7);
              }else {
                $('.'+sl).val(txt[4].toUpperCase());
              }
            }
            }
        }

        // alert(batch);
      });

      function check_code(code, target)
      {
        $.ajax({
        url:'<?php echo base_url("lesson_plan/check_code/") ?>'+code,
        type:'POST',
        dataType: 'JSON',
        success : function(data){
          $(target).html(data);
        }
        });
      }

      function check_calendar(code, target)
      {
        $.ajax({
        url:'<?php echo base_url("lesson_plan/check_calendar/") ?>'+code,
        type:'POST',
        dataType: 'JSON',
        success : function(data){
          $(target).html(data);
        }
        });
      }

      $(document).ready(function() {
        $( ".story" )
          // don't navigate away from the field on tab when selecting an item
          .bind( "keyup", function( event ) {
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

      })



      jQuery(document).on('keyup', '.storyxx', function() {
        $.ajax({
        url:'<?php echo base_url("lesson_plan/get_product_code/") ?>'+$(this).val(),
        type:'POST',
        dataType: 'JSON',
        success : function(data){
          $(target).html(data);
        }
        });
      });




</script>
