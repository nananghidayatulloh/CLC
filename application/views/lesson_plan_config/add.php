

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
                                            <option value="Reading">Reading</option>
                                            <option value="Meaning">Meaning</option>
                                            <option value="Dialog">Dialog</option>
                                            <option value="Comprehension">Comprehension</option>
                                            <option value="Speaking">Speaking</option>
                                            <option value="Exam">Exam</option>
                                          </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <b>Code</b> &nbsp; <small class="pc"></small>
                                    <div class="input-group">
                                        <div class="form-line">
                                          <input style="margin-top:10px;" id="code" type="text" name="code" class="form-control product_code bg-success" value="" maxlength="20">
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
                                              <option value="<?= $lvl->id_level ?>"><?= $lvl->id_level ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                    </div>
                                </div>

                                    <div class="col-md-6">
                                        <b>Recording Time Limit </b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">

                                            <div class="form-line">
                                              <input id="recording_time_limit" type="number" name="recording_time_limit" class="form-control total_story bg-success" value="" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Main Unit Total</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input style="margin-top:10px;" id="main_unit_total" type="text" name="main_unit_total" class="form-control product_code bg-success" value="" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Extra Unit Total</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input style="margin-top:10px;" id="extra_unit_total" type="text" name="extra_unit_total" class="form-control product_code bg-success" value="" maxlength="20">
                                              <input type="hidden" name="" class="code_status" value="">
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <b>Extended Unit Total</b> &nbsp; <small class="pc"></small>
                                        <div class="input-group">
                                            <div class="form-line">
                                              <input style="margin-top:10px;" id="extended_unit_total" type="text" name="extended_unit_total" class="form-control product_code bg-success" value="" maxlength="20">
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



  $(document).on('click', '.btn_simpan', function(){
    setTimeout(function(){
      var formData = new FormData(document.getElementById("form_submit"));
      $.ajax({
      url:'<?php echo base_url("lesson_plan_config/save/") ?>',
      type:'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        alert(data);
        location.reload();
      }
      });

  }, 500);
  });




</script>
