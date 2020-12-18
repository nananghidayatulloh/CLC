<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content Self Test
                            <ol class="breadcrumb pull-right">
                                <li> <a href="<?=base_url()?>selftest"><i class="material-icons">file_upload</i> Upload Content </a></li>
                                <li>Self Test</li>
                                <li class="active">Arrange Quiz</li>
                            </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <b>Level</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                        <select class="form-control show-tick" name="level" id="selectlevel" required>
                                            <option value=""> - Pilih Level - </option>
                                            <?php
                                                foreach($level as $l):
                                            ?>
                                            <option value="<?=$l['id_level']?>"><?=$l['id_level']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div id="display_subject" style="display:none">
                                    <div class="col-md-3">
                                        <b>Subject</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <select class="form-control show-tick" name="subject" id="selectsubject" required>
                                                <option value=""> - Pilih Subject - </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="display_unit" style="display:none">
                                    <div class="col-md-2">
                                        <b>Unit</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <select class="form-control show-tick" name="unit" id="selectunit" required>
                                                <option value=""> - Pilih Unit - </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="display_other" style="display:none">
                                    <div class="col-md-4">
                                        <div class="row clearfix">
                                            <div class="col-md-6">
                                                <b>Time Limit</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">filter_list</i>
                                                    </span>
                                                    <input type="number" id="time_limit" style="width: 40px" min="1" max="99" value="1" required> : 00
        
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <br>
                                                <div class="input-group">
                                                    <input type="checkbox" id="set_spontan" class="chk-col-teal"/>
                                                    <label for="set_spontan">Set Spontan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="display_subject_name" style="display:none">
                                    <div class="col-md-6">
                                        <b>Subjects</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">book</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="subjects" maxlength="20" required id="subject_name">
                                            </div>
                                            <button id="submit_subject" class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="arrange_quiz" style="display:none">
                                    <div class="col-md-6">
                                        <!-- <button type="submit" id="clear_data_content" class="btn-block btn-xs bg-red waves-effect">
                                            <span>CLEAR DATA</span>
                                        </button> -->
                                        <b>File Matching Quiz</b>
                                        <?=form_open_multipart('selftest/upload_arrange_quiz', "id='form_arrange_quiz'"); ?>
                                            <div class="input-group">
                                                <input name="level" id="level_arrange_quiz" hidden>
                                                <input name="subject" id="subject_arrange_quiz" hidden>
                                                <input name="unit" id="unit_arrange_quiz" hidden>
                                                <input name="time_limit" id="submit_time_limit" hidden>
                                                <input name="set_spontan" id="submit_set_spontan" hidden>
                                                <input name="mode" value="arrange_quiz" hidden>
                                                <div class="form-line">
                                                    <input type="file" name="files"  id="files" accept=".txt" class="form-control" autofocus required>
                                                </div>
                                                <button type="submit" name="submit" value="upload" id="submit_arrange_quiz" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                    <span>UPLOAD</span>
                                                </button>
                                        <?= form_close() ?>
                                                <div class="progress" id="progress_arrange_quiz">
                                                    <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_arrange_quiz" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <table class="table table-condensed">
                                                    <thead>
                                                        <tr id="dir">
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        function checkFile(){
            if(document.getElementById("files").files.length !=0 ){
                document.getElementById("submit_arrange_quiz").disabled = false;
            }
        }

        function show_subject_name() {
            var level   = $('#selectlevel').val();
                subject = $('#selectsubject').val();
                unit    = $('#selectunit').val();
                mode    = "arrange_quiz";
                
            $.ajax({
                url: '<?=base_url()?>selftest/selftest_subject_name',
                method: "POST",
                data: {level : level, subject : subject, unit : unit, mode : mode},
                async: true,
                dataType: 'JSON',
                success: function(hasil) {
                    $('#subject_name').val(hasil.name);
                }
            });
        }

        window.setInterval(function(){
            checkFile();
        }, 2000);

        $.show_file = function() {
            $("#dir th").remove();
            var level    = $('#selectlevel').val();
                subject  = $('#selectsubject').val();
                unit     = $('#selectunit').val();
                mode     = "arrange_quiz";
            
            $.ajax({
                url     : '<?=base_url()?>selftest/selftest_file_content',
                method  : 'POST',
                data    : {level : level, subject : subject, unit : unit, mode : mode},
                async   : true,
                dataType: 'JSON',
                success : function(hasil){
                    if (hasil.name.length != 0) {
                        $.each(hasil.name, function( index, value ) {
                            var file_name  = value;
                            var url        = '<?=base_url()?>selftest/selftest_download_file?level='+level+'&file_name='+file_name+'&mode='+mode;

                            txt1    = $(`<th>`+file_name+`</th>
                                            <th>
                                                <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                                            </th>
                                            <th>
                                                <button type='button' class='btn btn-xs bg-red waves-effect' onclick=$.delete_content('`+file_name+`')> Delete </button>
                                            </th>
                                        `);
                            $('#dir').append(txt1)
                        });
                    }
                }
            });
        }

        $('#selectlevel').on('change', function(){
            var level = $(this).val();
            $('#level_arrange_quiz').val(level);
            var mode = "arrange_quiz";
            $.ajax({
                url: '<?=base_url()?>selftest/selftest_subject',
                method: 'POST',
                data : {level : level, mode : mode},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    $('#display_subject').show();
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i]+'>'+data[i]+'</option>';
                        }
                        $('#selectsubject').html(html);
                }
            });
            return false;
        });

        $('#selectsubject').on('change', function(){
            var level = $('#level_arrange_quiz').val();
                        $('#subject_arrange_quiz').val($(this).val());
                mode  = "arrange_quiz";
            $.ajax({
                url: '<?=base_url()?>selftest/selftest_unit',
                method: 'POST',
                data : {level : level, mode : mode},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    $('#display_unit').show();
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i]+'>'+data[i]+'</option>';
                        }
                        $('#selectunit').html(html);
                }
            });
            return false;
        });

        $('#selectunit').on('change', function(){
            var unit    = $(this).val();
                          $('#unit_arrange_quiz').val(unit);
                level   = $('#selectlevel').val();
                subject = $('#selectsubject').val();
                mode    = "arrange_quiz";

            $.ajax({
                url: '<?=base_url()?>selftest/selftest_content_spontan',
                method: 'POST',
                data : {level : level, unit : unit, subject : subject, mode : mode},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    $('#time_limit').val(data.time_limit);
                    $('#submit_time_limit').val(data.time_limit);
                    if (data.set_spontan == "1") {
                        $('#set_spontan').prop("checked", true);
                        $('#submit_set_spontan').val(data.set_spontan);
                    } else {
                        $('#set_spontan').prop("checked", false);
                        $('#submit_set_spontan').val(data.set_spontan);
                    }
                    $('#display_other').show();
                    $('#display_subject_name').show();
                    $('#arrange_quiz').show();
                    show_subject_name();
                    $.show_file();
                }
            });
        });

        $('#time_limit').on('change', function() {
            value = $(this).val();
            $('#submit_time_limit').val(value);
        });

        $('#set_spontan').on('click', function() {
            var checkBoxes = $(this);
            if(checkBoxes.prop("checked") == true)
                $('#submit_set_spontan').val(1);
            else
                $('#submit_set_spontan').val(0);
        });

        $('#submit_arrange_quiz').on("click", function (e) {
            $("#progress_arrange_quiz").show();
            e.preventDefault();

            $.ajax({
                url: "<?=base_url()?>selftest/upload_file_selftest",
                method: "POST",
                data: new FormData($('#form_arrange_quiz')[0]),
                contentType : false,
                processData : false,
                cache : false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            var percent = Math.round((e.loaded / e.total) * 100);
                            $('#bar_arrange_quiz').css('width', percent + '%');
                            $('#bar_arrange_quiz').html('<div id="percent_arrange_quiz">' + percent +'%</div>');
                        }
                        });
                    return xhr;
                },
                success: function(feedback){
                    Swal('Berhasil Upload', feedback, 'success');
                    $("#files").replaceWith($("#files").val('').clone(true));
                    $("#submit_arrange_quiz").prop('disabled', true);
                    $('#bar_arrange_quiz').width('0%');
                    $('#percent_arrange_quiz').delay(1000).html('0%');
                    $.show_file();
                }
            })
        });

        $('#submit_subject').on('click', function(e){
            var level           = $('#selectlevel').val();
                subject         = $('#selectsubject').val();
                unit            = $('#selectunit').val();
                subject_name    = $('#subject_name').val();
                mode            = "arrange_quiz";

                $.ajax({
                    url: '<?=base_url()?>selftest/selftest_submit_subject',
                    method: 'POST',
                    data : {level : level, subject : subject, unit : unit, subject_name : subject_name, mode : mode},
                    async: true,
                    dataType : 'JSON',
                    success : function(data) {
                        Swal('Berhasil', data.name, 'success');
                    }
                })
        });

        $('#clear_data_content').on("click", function(e) {
            var level = $('#selectlevel').val();
                unit = $('#selectunit').val();
                mode  = "arrange_quiz";

            $.ajax ({
                url         : '<?=base_url()?>selftest/selftest_clear_data_content',
                method      : "POST",
                data        : {level : level, mode : mode, unit : unit},
                async       : true,
                dataType    : 'JSON',
                cache       : false,
                success: function (hasil) {
                    $.show_file();
                    Swal('Berhasil', hasil, 'success');
                },

                error : function (data) {
                    alert (data.responseText);
                }
            });
        });

        $.delete_content = function(file_name) {
            var file_name   = file_name;
                level       = $('#selectlevel').val();
                mode        = "arrange_quiz";
            
                $.ajax({
                url     : '<?=base_url()?>selftest/selftest_delete_file',
                method  : "POST",
                data    : {file_name : file_name, level : level, mode : mode},
                async   : true,
                dataType: 'JSON',
                    success: function (hasil) {
                        $.show_file();
                        Swal('Berhasil', hasil.ADD_INFO, 'success');
                    }
                });
        }
    }); 
</script>