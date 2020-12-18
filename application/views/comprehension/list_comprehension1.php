<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content
                            <ol class="breadcrumb pull-right">
                                <li> <a href="<?=base_url()?>comprehension"><i class="material-icons">file_upload</i> Upload Content </a></li>
                                <li class="active">Comprehension</li>
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
                                </div>
                                <div class="col-md-4" id="story" hidden>
                                    <b>Story</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                            <select class="form-control show-tick" name="story" id="selectstory" require>
                                                <option value=""> - Pilih Story - </option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="display_unit_name" hidden>
                                    <b>Unit Title</b>
                                     <div class="input-group">
                                         <span class="input-group-addon">
                                             <i class="material-icons">devices</i>
                                         </span>
                                             <div class="form-line">
                                                 <input type="text" id="unitname" value="" class="form-control" required autofocus>
                                             </div>
                                             <button id="submit_unit_name" class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN</span>
                                             </button>
                                     </div>
                                </div>

                                <div class="col-md-6" id="display_story_name" hidden>
                                    <b>Story Title</b>
                                     <div class="input-group">
                                         <span class="input-group-addon">
                                             <i class="material-icons">devices</i>
                                         </span>
                                             <div class="form-line">
                                                 <input type="text" id="storyname" value="" class="form-control" required autofocus>
                                             </div>
                                             <button id="submit_story_name" class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN</span>
                                             </button>
                                     </div>
                                </div>

                                <div id="upload" hidden>
                                    <div class="col-md-12">
                                        <button type="submit" id="submit_clear_data" class="btn-block btn-xs bg-red waves-effect">
                                            <span>CLEAR DATA</span>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="containerr" id="containerr0">
                                        <b>File Story</b>
                                        <div class="status0"></div>
                                        <?php 
                                        // echo form_open_multipart('admin/upload', 'id="formStory"')
                                        ?>
                                        <?=form_open_multipart('comprehension/comprehension_upload_story', "id='formStory'"); ?>
                                            <div class="input-group">
                                                <input type="text" name="level" id="level_form_story" hidden>
                                                <input type="text" name="unit" id="unit_form_story" hidden>
                                                <input type="text" name="story" id="story_form_story" hidden>
                                                <div class="form-line">
                                                    <input type="file" name="files" id="files_story" accept=".txt" class="form-control" autofocus required>
                                                </div>
                                                <button type="submit" id="submit_form_story" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                    <span>UPLOAD</span>
                                                </button>
                                        <?=form_close()?>
                                                <div class="progress" id="progressStory">
                                                    <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_story" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <table class="table table-condensed">
                                                    <thead>
                                                        <tr id="dir0">
                                                        </tr>
                                                    </thead>
                                                </table>
                                        </div>
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>File Audio Level 1</b>
                                        <?=form_open_multipart('comprehension/comprehension_upload_audio', 'id="formAudio1"')?>
                                        <div class="input-group">
                                            <input type="text" name="speed" value="Level1" hidden>
                                            <input type="text" name="level" id="level_form_audio1" hidden>
                                            <input type="text" name="unit" id="unit_form_audio1" hidden>
                                            <input type="text" name="story" id="story_form_audio1" hidden>
                                            <div class="form-line">
                                                <input type="file" name="files_audio[]" multiple="multiple" accept=".ogg" id="files_audio1" class="form-control" required autofocus>
                                            </div>
                                            <button type="submit" id="submit_file_audio1" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                <span>UPLOAD</span>
                                            </button>
                                        <?=form_close()?>
                                            <div class="progress" id="progressAudio1">
                                                <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_audio1" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                    <thead>
                                                        <tr id="dir1">
                                                        </tr>
                                                    </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>File Audio Level 2</b>
                                        <?=form_open_multipart('admin/upload_audio', 'id="formAudio2"')?>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="speed" value="Level2" hidden>
                                                <input type="text" name="level" id="level_form_audio2" hidden>
                                                <input type="text" name="unit" id="unit_form_audio2" hidden>
                                                <input type="text" name="story" id="story_form_audio2" hidden>
                                                <div class="form-line">
                                                <input type="file" name="files_audio[]" multiple="multiple" accept=".ogg" id="files_audio2" class="form-control" required autofocus>
                                            </div>
                                            </div>
                                            <button type="submit" name="submit" value="upload" id="submit_file_audio2" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                <span>UPLOAD</span>
                                            </button>
                                        <?=form_close()?>
                                            <div class="progress" id="progressAudio2">
                                                <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_audio2" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr id="dir2">
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>File Audio Level 3</b>
                                        <?=form_open_multipart('admin/upload_audio', 'id="formAudio3"')?>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="speed" value="Level3" hidden>
                                                <input type="text" name="level" id="level_form_audio3" hidden>
                                                <input type="text" name="unit" id="unit_form_audio3" hidden>
                                                <input type="text" name="story" id="story_form_audio3" hidden>
                                                <input type="file" name="files_audio[]" multiple="multiple" accept=".ogg" id="files_audio3" class="form-control" required autofocus>
                                            </div>
                                            <button type="submit" name="submit" value="upload" id="submit_file_audio3" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                <span>UPLOAD</span>
                                            </button>
                                        <?=form_close()?>
                                            <div class="progress" id="progressAudio3">
                                                <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_audio3" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr id="dir3">
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
        if(document.getElementById("files_story").files.length !=0 ){
            document.getElementById("submit_form_story").disabled = false;
        }
        if(document.getElementById("files_audio1").files.length !=0 ){
            document.getElementById("submit_file_audio1").disabled = false;
        }				
        if(document.getElementById("files_audio2").files.length !=0 ){
            document.getElementById("submit_file_audio2").disabled = false;
        }				
        if(document.getElementById("files_audio3").files.length !=0 ){
            document.getElementById("submit_file_audio3").disabled = false;
        }
    }
    window.setInterval(function(){
        checkFile();
    }, 2000);

    function show_unit_name() {
        var level = $('#selectlevel').val();
            unit = $('#selectunit').val();
            
        $.ajax({
            url: '<?=base_url()?>comprehension/comprehension_unit_name',
            method: "POST",
            data: {level : level, unit : unit},
            async: true,
            dataType: 'JSON',
            success: function(hasil) {
                $('#unitname').val(hasil.name);
            }
        });
    }

    function show_story_name() {
        var level = $('#selectlevel').val();
            unit = $('#selectunit').val();
            story = $('#selectstory').val();
            
        $.ajax({
            url: '<?=base_url()?>comprehension/comprehension_story_name',
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
        $("#dir0 th").remove();
        $("#dir1 div").remove();
        $("#dir2 div").remove();
        $("#dir3 div").remove();
        var level       = $('#selectlevel').val();
            unit        = $('#selectunit').val();
            story       = $('#selectstory').val();
            
        $.ajax({
            url     : '<?=base_url()?>comprehension/comprehension_story_file',
            method  : 'POST',
            data    : {level : level, unit : unit, story : story},
            async   : true,
            dataType: 'JSON',
            success : function(hasil){
                show_audio_file1();
                show_audio_file2();
                show_audio_file3();
                // console.log(hasil.name);
                if (hasil.name.length != 0) {
                    $.each(hasil.name, function( index, value ) {
                        var file_name   = value;
                            var url = '<?=base_url()?>comprehension/comprehension_download_story_file?level='+level+'&unit='+unit+'&story='+story;
                                txt1    = $(`<th>`+file_name+`</th>
                                            <th>
                                                <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                                            </th>
                                            <th>
                                                <button type='button' class='btn btn-xs bg-red waves-effect' onclick=$.delete_story('`+file_name+`')> Delete </button>
                                            </th>`);
                            $('#dir0').append(txt1)
                    });
                }
            }
        });
    }

    function show_audio_file1() {
        var level       = $('#selectlevel').val();
            unit        = $('#selectunit').val();
            story       = $('#selectstory').val();
            
        $.ajax({
            url     : '<?=base_url()?>comprehension/comprehension_audio_file',
            method  : 'POST',
            data    : {level : level, unit : unit, story : story, speed : "Level1"},
            async   : true,
            dataType: 'JSON',
            success : function(hasil){
                $.each(hasil, function( index, value ) {
                        var file_name = value;
                        var txt1 = $(`  <div class='col-sm-4' align='center'>
                                            <tr>
                                                <th>`+file_name+`</th>
                                                <th>
                                                    <button type='button' class='btn btn-xs bg-red waves-effect' onclick = $.deleteDataaudio1('`+file_name+`')> Delete </button>
                                                </th>
                                            <tr>
                                        </div>`);
                        $('#dir1').append(txt1)
                    });
            }
        });
    }

    function show_audio_file2() {
        var level       = $('#selectlevel').val();
            unit        = $('#selectunit').val();
            story       = $('#selectstory').val();
            
        $.ajax({
            url     : '<?=base_url()?>comprehension/comprehension_audio_file',
            method  : 'POST',
            data    : {level : level, unit : unit, story : story, speed : "Level2"},
            async   : true,
            dataType: 'JSON',
            success : function(hasil){
                $.each(hasil, function( index, value ) {
                        var file_name = value;
                        var txt1 = $(`  <div class='col-sm-4' align='center'>
                                            <tr>
                                                <th>`+file_name+`</th>
                                                <th>
                                                    <button type='button' class='btn btn-xs bg-red waves-effect' onclick = $.deleteDataaudio2('`+file_name+`')> Delete </button>
                                                </th>
                                            <tr>
                                        </div>`);
                        $('#dir2').append(txt1)
                    });
            }
        });
    }
    function show_audio_file3() {
        var level       = $('#selectlevel').val();
            unit        = $('#selectunit').val();
            story       = $('#selectstory').val();
            
        $.ajax({
            url     : '<?=base_url()?>comprehension/comprehension_audio_file',
            method  : 'POST',
            data    : {level : level, unit : unit, story : story, speed : "Level3"},
            async   : true,
            dataType: 'JSON',
            success : function(hasil){
                $.each(hasil, function( index, value ) {
                        var file_name = value;
                        var txt1 = $(`  <div class='col-sm-4' align='center'>
                                            <tr>
                                                <th>`+file_name+`</th>
                                                <th>
                                                    <button type='button' class='btn btn-xs bg-red waves-effect' onclick = $.deleteDataaudio3('`+file_name+`')> Delete </button>
                                                </th>
                                            <tr>
                                        </div>`);
                        $('#dir3').append(txt1)
                    });
            }
        });
    }

    $.delete_story = function(file_name) {
        var file_name   = file_name;
                level       = $('#selectlevel').val();
        $.ajax({
        url     : '<?=base_url()?>comprehension/comprehension_delete_story',
        method  : "POST",
        data    : {file_name : file_name, level : level},
        async   : true,
        dataType: 'JSON',
        success: function (hasil) {
            // console.log(hasil)
            show_story_file();
            Swal('Berhasil', hasil.ADD_INFO, 'success');
        }
        });
    }

        $('#submit_form_story').on('click', function(e){
            e.preventDefault();

            var formData = new FormData($('#formStory')[0]);
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            if(e.lengthComputable){
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#bar_story').css('width', percent + '%');
                                $('#bar_story').html('<div id="percent_story">' + percent +'%</div>');
                            }
                        });
                        return xhr;
                },

                type : 'POST',
                url : '<?=base_url()?>comprehension/comprehension_upload_story',
                data : formData,
                processData : false,
                contentType : false,
                success : function(feedback){
                    Swal('Selamat', 'Berhasil Upload File', 'success');
                    $("#files_story").replaceWith($("#files_story").val('').clone(true));
                    $("#submit_form_story").prop('disabled', true);
                    $('#bar_story').width('0%');
                    $('#percent_story').delay(1000).html('0%');
                    show_story_file();
                }
            })
        });

        $('#submit_file_audio1').on('click', function(e){
            e.preventDefault();

            var formData = new FormData($('#formAudio1')[0]);
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            if(e.lengthComputable){
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#bar_audio1').css('width', percent + '%');
                                $('#bar_audio1').html('<div id="percent_audio1">' + percent +'%</div>');
                            }
                        });
                        return xhr;
                },

                type : 'POST',
                url : '<?=base_url()?>comprehension/comprehension_upload_audio',
                data : formData,
                processData : false,
                contentType : false,
                success : function(feedback){
                    Swal('Selamat', 'Berhasil Upload File', 'success');
                    $("#files_audio1").replaceWith($("#files_audio1").val('').clone(true));
                    $("#submit_file_audio1").prop('disabled', true);
                    $('#bar_audio1').width('0%');
                    $('#percent_audio1').delay(1000).html('0%');
                    show_audio_file1();
                }
            })
        });

        $('#submit_file_audio2').on('click', function(e){
            e.preventDefault();

            var formData = new FormData($('#formAudio2')[0]);
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            if(e.lengthComputable){
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#bar_audio2').css('width', percent + '%');
                                $('#bar_audio2').html('<div id="percent_audio2">' + percent +'%</div>');
                            }
                        });
                        return xhr;
                },

                type : 'POST',
                url : '<?=base_url()?>comprehension/comprehension_upload_audio',
                data : formData,
                processData : false,
                contentType : false,
                success : function(feedback){
                    Swal('Selamat', feedback, 'success');
                    $("#files_audio").replaceWith($("#files_audio").val('').clone(true));
                    $("#submit_file_audio2").prop('disabled', true);
                    $('#bar_audio2').width('0%');
                    $('#percent_audio2').delay(1000).html('0%');
                    show_audio_file2();
                }
            })
        });

        $('#submit_file_audio3').on('click', function(e){
            e.preventDefault();

            var formData = new FormData($('#formAudio3')[0]);
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                            if(e.lengthComputable){
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#bar_audio3').css('width', percent + '%');
                                $('#bar_audio3').html('<div id="percent_audio3">' + percent +'%</div>');
                            }
                        });
                        return xhr;
                },

                type : 'POST',
                url : '<?=base_url()?>comprehension/comprehension_upload_audio',
                data : formData,
                processData : false,
                contentType : false,
                success : function(feedback){
                    Swal('Selamat', feedback, 'success');
                    $("#files_audio").replaceWith($("#files_audio").val('').clone(true));
                    $("#submit_file_audio3").prop('disabled', true);
                    $('#bar_audio3').width('0%');
                    $('#percent_audio3').delay(1000).html('0%');
                    show_audio_file3();
                }
            })
        });

        $('#selectlevel').on('change', function(){
            var level = $(this).val();
            $('#level_form_story').val(level);
            $('#level_form_audio1').val(level);
            $('#level_form_audio2').val(level);
            $('#level_form_audio3').val(level);
            $.ajax({
                url: '<?=base_url()?>comprehension/comprehension_unit',
                method: 'POST',
                data : {level : level},
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
            var unit = $(this).val();
            $('#unit_form_story').val(unit);
            $('#unit_form_audio1').val(unit);
            $('#unit_form_audio2').val(unit);
            $('#unit_form_audio3').val(unit);
            $('#story').show();
            $('#display_unit_name').show();
            if (unit != "-") show_unit_name();
            $('#selectstory').prop('selectedIndex',0);
        });

        $('#selectstory').on('change', function(){
            var story = $(this).val();
            $('#story_form_story').val(story);
            $('#story_form_audio1').val(story);
            $('#story_form_audio2').val(story);
            $('#story_form_audio3').val(story);
            $('#display_story_name').show();
            $('#upload').show();
            if(story != "") show_story_name(); show_story_file();
        });

        $('#submit_unit_name').on('click', function() {
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                unit_name_baru = $('#unitname').val();

            $.ajax({
                url: '<?=base_url()?>comprehension/comprehension_update_unit',
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
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();
                story_name_baru = $('#storyname').val();

            $.ajax({
                url: '<?=base_url()?>comprehension/comprehension_update_story',
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
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();
                
            $.ajax ({
                url     : '<?=base_url()?>comprehension/comprehension_clear_data_content',
                method  : "POST",
                data    : {level : level, unit : unit, story : story},
                async   : true,
                dataType: 'JSON',
                success: function (data) {
                    show_story_file();
                    Swal('Berhasil', data, 'success');							
                }
                ,
                error : function (hasil) {
                    console.log(hasil);
                }
            });
        });
    }); 
</script>