<section class="content">
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>exam/exam"><i class="material-icons">file_upload</i> Upload Content</a></li>
                            <li class="active">Exam</li>
                        </ol>
                        </h2>
                    </div>
                    <!-- Masked Input -->
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <div class="col-md-4">
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
                                            <option value="<?=$l['id_level']?>" id="level"><?=$l['id_level']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display:none" id="display_unit">
                                    <b>Unit</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                        <select class="form-control show-tick" name="level" id="selectunit" required>
                                            <option value=""> - Pilih Unit - </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="display_story" hidden>
                                    <b>Story</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                            <select class="form-control show-tick" name="story" id="selectstory" required>
                                                <option value=""> - Pilih Story - </option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="story" hidden>
                                    <b>Story</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                            <select class="form-control show-tick" name="story" id="selectstory" require onchange="changeStory()">
                                                <option value=""> - Pilih Story - </option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="display_unit_name" hidden>
                                    <b>Unit Title</b>
                                     <div class="input-group">
                                         <span class="input-group-addon">
                                             <i class="material-icons">devices</i>
                                         </span>
                                             <div class="form-line">
                                                 <input type="text" id="unitname" value="" class="form-control" maxlength="20" required autofocus>
                                             </div>
                                             <button id="submit_unit_name" class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN</span>
                                             </button>
                                     </div>
                                </div>
                                <div class="col-md-3" id="display_story_name" hidden>
                                    <b>Story Title</b>
                                     <div class="input-group">
                                         <span class="input-group-addon">
                                             <i class="material-icons">devices</i>
                                         </span>
                                             <div class="form-line">
                                                 <input type="text" id="storyname" value="" class="form-control" maxlength="20" required autofocus>
                                             </div>
                                             <button id="submit_story_name" class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN</span>
                                             </button>
                                     </div>
                                </div>
                                    <div id="upload" hidden>
                                        <div class="col-md-6">
                                            <button type="submit" name="submit" id="submit_clear_data" class="btn-block btn-xs bg-red waves-effect">
                                                <span>CLEAR DATA</span>
                                            </button>
                                            <b>File Story</b>
                                            <div class="status0"></div>
                                            <?=form_open_multipart('admin/upload_exam', "id='formExam'"); ?>
                                                <div class="input-group">
                                                    <input type="text" name="level" id="level_exam" hidden>
                                                    <input type="text" name="unit" id="unit_exam" hidden>
                                                    <input type="text" name="story" id="story_exam" hidden>
                                                    <div class="form-line">
                                                        <input type="file" name="files" id="files" accept=".txt" class="form-control" autofocus required>
                                                    </div>
                                                    <button type="submit" value="upload" id="submit_upload_exam" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                        <span>UPLOAD</span>
                                                    </button>
                                            <?= form_close() ?>
                                                    <div class="progress" id="progress_exam" hidden>
                                                        <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="progressbar_exam" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        <div id="percent_exam">0%</div>
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
                $('#submit_upload_exam').removeAttr("disabled");
            }
        }

        window.setInterval(function(){
            checkFile();
        }, 2000);

        $('#submit_upload_exam').on("click", function (e) {
            $("#progress_exam").show();
            if ($('#files').val()) {
                e.preventDefault();
            }

            $.ajax({
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            var progressbar = Math.round((e.loaded/e.total)*100);
                            $('#progressbar_exam').css('width', progressbar + '%');
                            $('#progressbar_exam').html('<div id="percent_exam">' + progressbar +'%</div>');
                        }
                    });
                    return xhr;
                },
                method      : "POST",
                url         : "<?=base_url()?>exam/upload_file_exam",
                data        : new FormData($('#formExam')[0]),
                processData : false,
                contentType : false,
                cache : false,
                success: function(feedback){
                    Swal('Berhasil Upload', feedback, 'success');
                    $("#files").replaceWith($("#files").val('').clone(true));
                    $("#submit_upload_exam").prop('disabled', true);
                    $('#progressbar_exam').width('0%');
                    $('#percent_exam').delay(1000).html('0%');
                    show_story_file();
                    $("#progress_exam").hide();
                }
            })
        });

        $('#selectlevel').on('change', function(){
            var level = $(this).val();
            $('#level_exam').val(level);
            // $('#level_form_story').val(level);
            $.ajax({
                url: '<?=base_url()?>exam/exam_unit2',
                method: 'POST',
                data : {level : level},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#display_unit').show();
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i]['unit_number']+'>'+data[i]['unit_number']+'  '+data[i]['unit_title'] + ' ' + data[i]['story_uploaded']+'</option>';
                        }
                        $('#selectunit').html(html);
                }
            });
            return false;
        });

        $('#selectunit').on('change', function(){
            var unit = $(this).val();
            var level = $('#selectlevel').val();
            $('#unit_exam').val(unit);
            $('#display_story').show();
            $('#display_unit_name').show();
            if (unit != "-") show_unit_name();
            $.ajax({
                // url: '<?=base_url()?>daily_reading/daily_reading_unit',
                url: '<?=base_url()?>exam/exam_story',
                method: 'POST',
                data : {level : level, unit : unit},
                // data : {level : level},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    $('#display_unit').show();
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i]['story_number']+'>'+data[i]['story_number']+'  '+data[i]['story_title'] + ' ' + data[i]['story_uploaded']+'</option>';
                        }
                        $('#selectstory').html(html);
                }
            });
            $('#selectstory').prop('selectedIndex',0);
        });

        function show_unit_name() {
            var level = $('#selectlevel').val();
                unit = $('#selectunit').val();
                
            $.ajax({
                url: '<?=base_url()?>exam/exam_unit_name',
                method: "POST",
                data: {level : level, unit : unit},
                async: true,
                dataType: 'JSON',
                success: function(hasil) {
                    $('#unitname').val(hasil.name);
                }
            });
        }

        $('#selectstory').on('change', function(){
            var story = $(this).val();
            $('#story_exam').val(story);
            $('#display_story_name').show();
            $('#upload').show();
            if(story != "") show_story_name(); show_story_file();
        });

        function show_story_name() {
            var level = $('#selectlevel').val();
                unit = $('#selectunit').val();
                story = $('#selectstory').val();
                
            $.ajax({
                url: '<?=base_url()?>exam/exam_story_name',
                method: "POST",
                data: {level : level, unit : unit, story : story},
                async: true,
                dataType: 'JSON',
                success: function(hasil) {
                    $('#storyname').val(hasil.name);
                }
            });
        }

        function show_story_file() {
            $("#dir th").remove();
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();

            $.ajax({
                url     : '<?=base_url()?>exam/exam_list_file',
                method  : 'POST',
                data    : {level : level, unit : unit, story : story},
                async   : true,
                dataType: 'JSON',
                success : function(hasil){
                    parsedata   = $.parseJSON(hasil.data);
                    $.each(parsedata, function( index, value ) {
                        var file_name = value;
                            url = '<?=base_url()?>exam/exam_download_file?level='+level+'&unit='+unit+'&story='+story;
                            txt1 = $(`<th>`+value+`</th> 
                                        <th>
                                            <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                                        </th>
                                        <th>
                                            <button type='button' class='btn btn-xs bg-red waves-effect' onclick = $.delete_data('`+file_name+`')> Delete </button>
                                        </th>
                                    `);
                        $('#dir').append(txt1)
                    });
                }
            });
        }

        $.delete_data = function(file_name) {
            var file_name   = file_name;
                level       = $('#selectlevel').val();
            $.ajax({
            url     : '<?=base_url()?>exam/exam_delete_file',
            method  : "POST",
            data    : {file_name : file_name, level : level},
            async   : true,
            dataType: 'JSON',
            success: function (hasil) {
                show_story_file();
                Swal('Berhasil', hasil.data, 'success');
            }
            });
        };

        $('#submit_unit_name').on('click', function() {
            var level           = $('#selectlevel').val();
                unit            = $('#selectunit').val();
                unit_name_baru  = $('#unitname').val();
            $.ajax({
                url: '<?=base_url()?>exam/exam_update_unit',
                method: 'POST',
                data : {level : level, unit : unit, unit_name_baru : unit_name_baru},
                async: true,
                dataType : 'JSON',
                success : function(data) {
                    Swal('Berhasil', data.name, 'success');
                }
            })
        });

        $('#submit_story_name').on('click', function() {
            var level           = $('#selectlevel').val();
                unit            = $('#selectunit').val();
                story           = $('#selectstory').val();
                story_name_baru = $('#storyname').val();

            $.ajax({
                url: '<?=base_url()?>exam/exam_update_story',
                method: 'POST',
                data : {level : level, unit : unit, story : story, story_name_baru : story_name_baru},
                async: true,
                dataType : 'JSON',
                success : function(data) {
                    Swal('Berhasil', data.name, 'success');
                }
            })
        });

        $('#submit_clear_data').on('click', function() {
            var level   = $('#selectlevel').val();
                unit    = $('#selectunit').val();
                story   = $('#selectstory').val();

            $.ajax ({
                url     : '<?=base_url()?>exam/exam_clear_content',
                method  : "POST",
                data    : {level : level, unit : unit, story : story},
                async   : true,
                dataType: 'JSON',
                success: function (data) {
                    show_story_file();
                    Swal('Berhasil', data, 'success');							
                }
            });
        });

    });
</script>