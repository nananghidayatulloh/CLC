<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content Daily Speaking Extra
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>daily_speaking/daily_speaking_extra"><i class="material-icons">file_upload</i> Upload Content</a></li>
                            <li>Daily Speaking</li>
                            <li class="active">Extra</li>
                        </ol>
                        </h2>
                    </div>
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
                                            <option value="<?=$l['id_level']?>"><?=$l['id_level']?></option>
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
                                    <button class="btn btn-xs btn-primary btn-block" id="freeze" data-value="" style="display: none;"><i class="material-icons" id="icons_freeze">done</i> <span class="icon-name">Freeze</span></button>
                                </div>
                                <div class="col-md-4" id="display_unit_name" hidden>
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
                                <div id="upload" style="display:none">
                                    <div class="col-sm-12">
                                        <button type="submit" id="clear_data_content" class="btn-block btn-xs bg-red waves-effect">
                                            <span>CLEAR DATA</span>
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <b>File Story</b>
                                        <?=form_open('daily_speaking/upload_daily_speaking', "id='form_daily_speaking'"); ?>
                                            <div class="input-group">
                                                <input type="text" name="level" id="level_form_story" hidden>
                                                <input type="text" name="unit" id="unit_form_story" hidden>
                                                <input name="mode" value="daily_speaking_extra" hidden>
                                                <div class="form-line">
                                                    <input type="file" name="files" id="files" accept=".txt" class="form-control" autofocus required>
                                                </div>
                                                <button type="submit" name="submit" value="upload" id="submit_daily_speaking" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                    <span>UPLOAD</span>
                                                </button>
                                        <?= form_close() ?>
                                                <div class="progress" id="progress_daily_speaking">
                                                    <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_daily_speaking" aria-valuemin="0" aria-valuemax="100">
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
                                    <div class="col-md-6">
                                        <b>File Audio Level</b>
                                        <?=form_open_multipart('daily_speaking/daily_speaking_upload_audio', 'id="formAudio"')?>
                                        <div class="input-group">
                                            <input type="text" name="level" id="level_form_audio" hidden>
                                            <input type="text" name="unit" id="unit_form_audio" hidden>
                                            <input type="text" name="mode" value="daily_speaking_audio_extra" hidden>
                                            <div class="form-line">
                                                <input type="file" name="files_audio[]" multiple="multiple" accept=".ogg" id="files_audio" class="form-control" required autofocus>
                                            </div>
                                            <button type="submit" id="submit_file_audio" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                <span>UPLOAD</span>
                                            </button>
                                        <?=form_close()?>
                                            <div class="progress" id="progressAudio">
                                                <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_audio" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                    <thead>
                                                        <tr id="dir_audio">
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
    var levelsel = "";
    function checkFile(){
				
        if( document.getElementById("files").files.length !=0 ){
            document.getElementById("submit_daily_speaking").disabled = false;
        }

        if(document.getElementById("files_audio").files.length !=0 ){
            document.getElementById("submit_file_audio").disabled = false;
        }
    }
    
    window.setInterval(function(){
        checkFile();
    }, 2000);

    $(document).ready(function(){
        function show_unit_name() {
            var level   = $('#selectlevel').val();
                unit    = $('#selectunit').val();
                mode    = "extra";
                
            $.ajax({
                url: '<?=base_url()?>daily_speaking/daily_speaking_unit_name',
                method: "POST",
                data: {level : level, unit : unit, mode : mode},
                async: true,
                dataType: 'JSON',
                success: function(hasil) {
                    $('#unitname').val(hasil.name);
                }
            });
        }

        $.show_story_file = function() {
            $("#dir div").remove();
            var level = $('#selectlevel').val();
                unit  = $('#selectunit').val();
                mode  = "daily_speaking_extra";
            $.ajax({
                url     : '<?=base_url()?>daily_speaking/daily_speaking_list_file_story',
                method  : 'POST',
                data    : { level : level, unit : unit, mode : mode},
                async   : true,
                dataType: 'JSON',
                success : function(hasil){
                    parsedata   = $.parseJSON(hasil.data);
                    $.each(parsedata, function( index, value ) {
                        var file_name = value;
                            url = '<?=base_url()?>daily_speaking/download_daily_speaking_file?level='+level+'&unit='+unit+'&file_name='+file_name+'&mode=daily_speaking_extra';
                            txt1 = $(`<div class="col-sm-6">
                                        <th>`+value+`</th> 
                                            <th>
                                                <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                                            </th>
                        				<th>
                        					<button type='button' class='btn btn-xs bg-red waves-effect' onclick = $.delete_data('`+file_name+`')> Delete </button>
                        				</th>
                                    </div>`);
						$('#dir').append(txt1)
					});
                },
                error: function(hasil){
                    console.log(hasil)
                }
            });
        }

        $.show_audio_file = function() {
            $("#dir_audio div").remove();
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                mode        = "daily_speaking_audio_extra"
                
            $.ajax({
                url     : '<?=base_url()?>daily_speaking/daily_speaking_audio_file',
                method  : 'POST',
                data    : {level : level, unit : unit, mode : mode},
                async   : true,
                dataType: 'JSON',
                success : function(hasil){
                    $.each(hasil, function( index, value ) {
                        var file_name = value;
                        var txt1 = $(`  <div class='col-sm-4' align='center'>
                                            <tr>
                                                <th>`+file_name+`</th>
                                                <th>
                                                    <button type='button' class='btn btn-xs bg-red waves-effect' onclick="$.delete_data_audio('`+file_name+`')"> Delete </button>
                                                </th>
                                            <tr>
                                        </div>`);
                        $('#dir_audio').append(txt1)
                    });
                }
            });
        }

        $('#selectlevel').on('change', function(){
            var level        = $(this).val();
                mode         = 'daily_speaking_extra';
                $('#level_form_story').val(level);
                $('#level_form_audio').val(level);

            $.ajax({
                url: '<?=base_url()?>daily_speaking/daily_speaking_unit',
                method: 'POST',
                data : {level : level, mode : mode},
                async: true,
                dataType: 'JSON',
                success: function(data) {
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
            var level = $('#selectlevel').val();
            var unit = $(this).val();
            var mode  = "extra";

            $.ajax({
                url: '<?=base_url()?>daily_speaking/daily_speaking_content_freeze',
                method: 'POST',
                data : {level : level, unit : unit, mode : mode},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    $('#freeze').data('value', data['freeze']);
                    if(data['freeze'] == 0) {
                        $('#icons_freeze').html('clear');
                        $('#freeze').addClass('btn-danger');
                        $('#freeze').removeClass('btn-primary');
                    } else {
                        $('#icons_freeze').html('done');
                        $('#freeze').addClass('btn-primary');
                        $('#freeze').removeClass('btn-danger');
                        $('#freeze').prop('disabled', false);
                    }
                    $('#unit_form_story').val(unit);
                    $('#unit_form_audio').val(unit);
                    $('#display_unit_name').show();
                    $('#upload').show();
                    $('#freeze').show();
                    if (unit != "-") show_unit_name(); $.show_story_file(); $.show_audio_file();
                }
            });
            return false;
        });

        $('#freeze').on('click', function(){
            var value = $('#freeze').data('value');
            var level = $('#selectlevel').val();
            var unit  = $('#selectunit').val();
            var mode  = "extra";

            if (value == 0) {
                Swal.fire({
                    title: 'Do you really want to freeze this unit?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes'
                }).then(function(isConfirm) {
                    if (isConfirm.value) {
                        $.ajax({
                            url     : '<?=base_url()?>daily_speaking/daily_speaking_submit_freeze',
                            type    : "POST",
                            data    : {level : level, unit : unit, mode : mode},
                            success: function(feedback){
                                Swal.fire('Kamu', feedback, 'success');
                                $('#icons_freeze').html('done');
                                $('#freeze').addClass('btn-primary');
                                $('#freeze').removeClass('btn-danger');
                                $('#freeze').prop('disabled', false);
                            }
                        });
                    }
                })
            }
        });

        $('#submit_unit_name').on('click', function() {
            var level           = $('#selectlevel').val();
                unit            = $('#selectunit').val();
                unit_name_baru  = $('#unitname').val();
                mode            = "extra";
            $.ajax({
                url: '<?=base_url()?>daily_speaking/daily_speaking_update_unit',
                method: 'POST',
                data : {level : level, unit : unit, unit_name_baru : unit_name_baru, mode : mode},
                async: true,
                dataType : 'JSON',
                success : function(data) {
                    Swal('Berhasil', data.name, 'success');
                }
            })
        });

        $.delete_data = function(file_name) {
            var level = $('#selectlevel').val();
                unit  = $('#selectunit').val();
                mode  = "daily_speaking_extra";

            $.ajax({
            url     : "<?=base_url()?>daily_speaking/delete_daily_speaking_file",
            method  : "POST",
            data    : {file_name : file_name, level : level, mode : mode},
            async   : true,
            dataType: 'JSON',
            cache   : false,
            success : function (hasil) {
                $.show_story_file();
                Swal('Berhasil', hasil.data, 'success');
            },
            error   : function(){
                alert('error');
            }
            });
        };

        $.delete_data_audio = function(file_name) {
            var level = $('#selectlevel').val();
                unit  = $('#selectunit').val();
                mode  = "daily_speaking_extra";

            $.ajax({
                url     : "<?=base_url()?>daily_speaking/delete_daily_speaking_file_audio",
                method  : "POST",
                data    : {file_name : file_name, level : level, unit : unit, mode : mode},
                async   : true,
                dataType: 'JSON',
                cache   : false,
                success : function (hasil) {
                    $.show_audio_file();
                    Swal('Berhasil', hasil.data, 'success');
                },
                error   : function(){
                    alert('error');
                }
            });
        };
    });

    $('#submit_daily_speaking').on("click", function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?=base_url()?>daily_speaking/upload_daily_speaking",
            method: "POST",
            data: new FormData($('#form_daily_speaking')[0]),
            contentType : false,
            processData : false,
            cache : false,
            xhr: function() {
                var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                    if(e.lengthComputable){
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#bar_daily_speaking').css('width', percent + '%');
                        $('#bar_daily_speaking').html('<div id="percent_daily_speaking">' + percent +'%</div>');
                    }
                    });
                return xhr;
            },
            success: function(feedback){
                Swal('Berhasil Upload', feedback, 'success');
                $("#files").replaceWith($("#files").val('').clone(true));
                $("#submit_daily_speaking").prop('disabled', true);
                $('#bar_daily_speaking').width('0%');
                $('#percent_daily_speaking').delay(1000).html('0%');
                $.show_story_file();
            }
        })
    });

    $('#submit_file_audio').on('click', function(e){
        e.preventDefault();

        var formData = new FormData($('#formAudio')[0]);
        $.ajax({
            xhr : function() {
                var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            var percent = Math.round((e.loaded / e.total) * 100);
                            $('#bar_audio').css('width', percent + '%');
                            $('#bar_audio').html('<div id="percent_audio">' + percent +'%</div>');
                        }
                    });
                    return xhr;
            },

            type : 'POST',
            url : '<?=base_url()?>daily_speaking/daily_speaking_upload_audio',
            data : formData,
            processData : false,
            contentType : false,
            success : function(feedback){
                Swal('Selamat Berhasil Upload File', feedback, 'success');
                $("#files_audio").replaceWith($("#files_audio").val('').clone(true));
                $("#submit_file_audio").prop('disabled', true);
                $('#bar_audio').width('0%');
                $('#percent_audio').delay(1000).html('0%');
                $.show_audio_file();
            }
        })
    });

    $('#clear_data_content').on("click", function(e) {
        var level = $('#selectlevel').val();
            unit  = $('#selectunit').val();
            mode  = "daily_speaking_extra";

        $.ajax ({
            url         : '<?=base_url()?>daily_speaking/daily_speaking_clear_data_content',
            method      : "POST",
            data        : {level : level, unit : unit, mode : mode},
            async       : true,
            dataType    : 'JSON',
            cache       : false,
            success: function (hasil) {
                $.show_story_file();
                $.show_audio_file();
                Swal('Berhasil', hasil, 'success');
            },

            error : function (data) {
                alert (data.responseText);
            }
        });
    });
</script>