<section class="content">
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>admin/daily_reading"><i class="material-icons">file_upload</i> Upload Content</a></li>
                            <li class="active">Daily Reading</li>
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
                                        <select class="form-control show-tick" name="level" id="selectlevel" required onchange="changeFolder()">
                                            <option value=""> - Pilih Level - </option>
                                            <?php
                                                foreach($level as $l):
                                            ?>
                                            <option value="<?=$l['id_level']?>"><?=$l['id_level']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="hid_unit" hidden>
                                    
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
                                <div class="col-md-6" id="namingunit">
                                </div>
                                <div class="col-md-6" id="namingstory">
                                </div>
                                    <div id="upload" hidden>
                                        <div class="col-md-12">
                                            <button type="submit" name="submit" onclick="clearData()" class="btn-block btn-xs bg-red waves-effect">
                                                <span>CLEAR DATA</span>
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="containerr" id="containerr0" hidden>
                                            <b>File Story</b>
                                            <div class="status0"></div>
                                            <?php 
                                            // echo form_open_multipart('admin/upload', 'id="formStory"')
                                            ?>
                                            <?=form_open_multipart('admin/upload_story', "id='formStory'"); ?>
                                                <div class="input-group">
                                                    <input type="text" name="level" id="level0" hidden>
                                                    <input type="text" name="unit" id="unit0" hidden>
                                                    <input type="text" name="story" id="story0" hidden>
                                                    <div class="form-line">
                                                        <input type="file" name="files" id="files0" accept=".txt" class="form-control" autofocus required>
                                                    </div>
                                                    <button type="submit" name="submit" value="upload" id="submit0" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                        <span>UPLOAD</span>
                                                    </button>
                                            <?=
                                            form_close()
                                            ?>
                                                    <div class="progress" id="progressStory">
                                                        <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="progressbarStory" aria-valuemin="0" aria-valuemax="100">
                                                        <div id="percentStory">0%</div>
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
                                            <?=form_open_multipart('admin/upload_audio', 'id="formAudio1"')?>
                                            <div class="input-group">
                                                <input type="text" name="speed" value="Level1" hidden>
                                                <input type="text" name="level" id="level1" hidden>
                                                <input type="text" name="unit" id="unit1" hidden>
                                                <input type="text" name="story" id="story1" hidden>
                                                <div class="form-line">
                                                    <input type="file" name="files[]" multiple="multiple" accept=".ogg" id="files1" class="form-control" required autofocus>
                                                </div>
                                                <button type="submit" name="submit" value="upload" id="submit1" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                    <span>UPLOAD</span>
                                                </button>
                                            <?=
                                            form_close()
                                            ?>
                                                <div class="progress" id="progressAudio1">
                                                    <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="progressbarAudio1" aria-valuemin="0" aria-valuemax="100">
                                                        <div id="percentAudio1">0%</div>
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
                                                    <input type="text" name="level" id="level2" hidden>
                                                    <input type="text" name="unit" id="unit2" hidden>
                                                    <input type="text" name="story" id="story2" hidden>
                                                    <div class="form-line">
                                                    <input type="file" name="files[]" multiple="multiple" accept=".ogg" id="files2" class="form-control" required autofocus>
                                                </div>
                                                </div>
                                                <button type="submit" name="submit" value="upload" id="submit2" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                    <span>UPLOAD</span>
                                                </button>
                                            <?=
                                            form_close()
                                            ?>
                                                <div class="progress" id="progressAudio2">
                                                    <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="progressbarAudio2" aria-valuemin="0" aria-valuemax="100">
                                                        <div id="percentAudio2">0%</div>
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
                                                    <input type="text" name="level" id="level3" hidden>
                                                    <input type="text" name="unit" id="unit3" hidden>
                                                    <input type="text" name="story" id="story3" hidden>
                                                    <input type="file" name="files[]" multiple="multiple" accept=".ogg" id="files3" class="form-control" required autofocus>
                                                </div>
                                                <button type="submit" name="submit" value="upload" id="submit3" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                    <span>UPLOAD</span>
                                                </button>
                                            <?=
                                            form_close()
                                            ?>
                                                <div class="progress" id="progressAudio3">
                                                    <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="progressbarAudio3" aria-valuemin="0" aria-valuemax="100">
                                                        <div id="percentAudio3">0%</div>
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
        <!-- #END# Masked Input -->
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->
    </div>
</section>
<script>
    var levelsel = "";
        unitsel  = "";
        storysel = "";
        i = 0;
        j = 0;
        k = 0;

    function display() {
        $.showFile();
    };

    function clearData () {
        $.clearData();
    }

    function changeFolder(){
        var level = document.getElementById("selectlevel");
        levelsel = level.options[level.selectedIndex].value;
        
        document.getElementById("level1").value = levelsel;
        document.getElementById("level2").value = levelsel;
        document.getElementById("level3").value = levelsel;
        document.getElementById("level0").value = levelsel;
        i = 1;
        
        document.getElementById("selectlevel").disabled = true;
        document.getElementById("hid_unit").hidden = false;
    }

    function changeUnit(){
        var unit = document.getElementById("selectunit");
        unitsel = unit.options[unit.selectedIndex].value;
        
        document.getElementById("unit1").value = unitsel;
        document.getElementById("unit2").value = unitsel;
        document.getElementById("unit3").value = unitsel;
        document.getElementById("unit0").value = unitsel;
        j =1;
        
        document.getElementById("selectunit").disabled = true;
        document.getElementById("story").hidden = false;
        showUnitName();
    }

    function changeStory(){
        var story = document.getElementById("selectstory");
        storysel = story.options[story.selectedIndex].value;

        document.getElementById("story1").value = storysel;
        document.getElementById("story2").value = storysel;
        document.getElementById("story3").value = storysel;
        document.getElementById("story0").value = storysel;
        k = 1;
        
        document.getElementById("selectstory").disabled = true;
        if(i+j+k == 3){
            document.getElementsByClassName("containerr").hidden= false;
            document.getElementById("containerr0").hidden = false;
            display();
        }
        showStoryName();
    }

    function checkFile(){
				
        if(document.getElementById("files0").files.length !=0 ){
            document.getElementById("submit0").disabled = false;
        }
        if(document.getElementById("files1").files.length !=0 ){
            document.getElementById("submit1").disabled = false;
        }				
        if(document.getElementById("files2").files.length !=0 ){
            document.getElementById("submit2").disabled = false;
        }				
        if(document.getElementById("files3").files.length !=0 ){
            document.getElementById("submit3").disabled = false;
        }
    }
    window.setInterval(function(){
        checkFile();
    }, 2000);

    
    function showUnitName() {
        var level = $('#selectlevel').val();
            unit = $('#selectunit').val();
            dataString = 'level='+level+'&unit='+unit+'&mode=0';
            
        $.ajax({
            url: '<?=base_url()?>admin/manage_unit_name',
            type: "POST",
            data: dataString,
            success: function(hasil) {
                var inpt = $('<b>Unit Title</b><div class="input-group"><span class="input-group-addon"><i class="material-icons">devices</i></span><div class="form-line"><input type="text" id="unitname" value="'+hasil+'" class="form-control" required autofocus></div><button onclick=$.changeUnitName() class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN</span></button></div>');
                $('#namingunit').append(inpt);
            }
        });
    }

    function showStoryName() {
        var level = $('#selectlevel').val();
            unit = $('#selectunit').val();
            story = $('#selectstory').val();
            dataString = 'level='+level+'&unit='+unit+'&story='+story+'&mode=0';

        $.ajax({
            url: '<?=base_url()?>admin/manage_story_name',
            type: "POST",
            data: dataString,
            success: function(hasil) {
                var inpt = $('<b>Story Title</b><div class="input-group"><span class="input-group-addon"><i class="material-icons">devices</i></span><div class="form-line"><input type="text" id="storyname" value="'+hasil+'" class="form-control" required autofocus></div><button onclick=$.changeStoryName() class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN</span></button></div>');
                $('#namingstory').append(inpt);
            }
        });
    }
            
    $(document).ready(function() {
        var q = $('#selectlevel').val();
            $('#selectlevel').on("change", function () {
                q = $(this).val();
                $.ajax({
                    type : "POST",
                    url: '<?=base_url()?>admin/daily_reading_unit',
                    dataType : "JSON",
                    data: {level:q},
                    success: function (data) {
                        var text = $(`
                            <b>Unit</b>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <select class="form-control show-tick" name="unit" id="selectunit" onchange="changeUnit()" required>
                                        <option value="" id="unit"> - Pilih  Unit - </option>
                                    </select>
                                </div>
                            `);
                            $('#hid_unit').append(text);
                        var i;
                        for (i = data.total_unit; i >= data.total_unit - data.total_unit +1 ; i--) {
                            var text1 = $('<option value="'+i+'">'+i+'</option>');
                            $("#unit").after(text1);
                        }
                    }
                });
                
            });

        $.changeUnitName = function () {
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                nama_baru   = $('#unitname').val();
                dataString  = 'level='+level+'&unit='+unit+'&mode=1&nama_baru='+nama_baru;

            $.ajax({
                url: '<?=base_url()?>admin/manage_unit_name',
                type: "POST",
                data: dataString,
                success: function(data) {
                    Swal('Berhasil', data, 'success');
                }
            });
        }
    
        $.changeStoryName = function() {
            var level = $('#selectlevel').val();
                unit = $('#selectunit').val();
                story = $('#selectstory').val();
                nama_baru = $('#storyname').val();
                dataString = 'level='+level+'&unit='+unit+'&story='+story+'&mode=1&nama_baru='+nama_baru;

            $.ajax({
                url: '<?=base_url()?>admin/manage_story_name',
                type: "POST",
                data: dataString,
                success: function(data) {
                    Swal('Berhasil', data, 'success');
                }
            });
        }

        $.showFile = function() {
            $("#dir0 th").remove();
            $("#dir1 div").remove();
            $("#dir2 div").remove();
            $("#dir3 div").remove();
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();
                dataString  = 'level='+level+'&unit='+unit+'&story='+story;
                
            $.ajax({
                url  : '<?=base_url()?>admin/story_list',
                type : 'POST',
                data : dataString,
                success : function(hasil){
                    $.showFileAudio();
                    var url = '<?=base_url()?>admin/download_tst_story?level='+level+'&unit='+unit+'&story='+story;
                    data1 = $.parseJSON(hasil);
                    $.each(data1, function( index, value ) {
                        var file_name   = value;
                            txt1        = $(`<th>`+file_name+`</th>
                                                <th>
                                                    <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                                                </th>
                                                <th>
                                                    <button type='button' class='btn btn-xs bg-red waves-effect' onclick = $.deleteData('`+file_name+`')> Delete </button>
                                                </th>`);
						$('#dir0').append(txt1)
					});
                }
            });
        }

        $.deleteData = function(file_name) {
            var file_name   = file_name;
                level       = $('#selectlevel').val();
                dataString  = 'file_name='+file_name+'&level='+level+'&mode=1';
            $.ajax({
            url     : '<?=base_url()?>admin/delete_tst_story',
            type    : "POST",
            data    : dataString,
            success: function (hasil) {
                $.showFile();
                Swal('Berhasil', hasil, 'success');
            }
            });
        }

        $.deleteDataaudio1 = function(file_name) {
            var file_name   = file_name;
                level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();
                dataString  = 'level='+level+'&unit='+unit+'&story='+story+'&file_name='+file_name+'&speed_level=Level1';
                
                $.url_del_audio(dataString);
            
        }

        $.deleteDataaudio2 = function(file_name) {
            var file_name   = file_name;
                level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();
                dataString  = 'level='+level+'&unit='+unit+'&story='+story+'&file_name='+file_name+'&speed_level=Level2';
                $.url_del_audio(dataString);
            
        }

        $.deleteDataaudio3 = function(file_name) {
            var file_name   = file_name;
                level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();
                dataString  = 'level='+level+'&unit='+unit+'&story='+story+'&file_name='+file_name+'&speed_level=Level3';
                $.url_del_audio(dataString);
            
        }

        $.url_del_audio = function(dataString) {
            $.ajax({
            url     : '<?=base_url()?>admin/delete_audio',
            type    : "POST",
            data    : dataString,
            success: function (hasil) {
                $.showFile();
                Swal('Berhasil', hasil, 'success');
            }
            });
        }

        $.clearData = function() {
            var level       = $('#selectlevel').val();
                unit        = $('#selectunit').val();
                story       = $('#selectstory').val();
                dataString  = 'unit='+unit+'&level='+level+'&story='+story+'&mode=1';
                
            $.ajax ({
                url: '<?=base_url()?>admin/clear_data_content',
                type: "POST",
                data: dataString,
                success: function (hasil) {
                    $.showFile();
                    Swal('Berhasil', hasil, 'success');							
                },

                error : function (hasil) {
                    alert (hasil);
                }
            });
        }

        $.showFileAudio = function(){
            var level  = $('#selectlevel').val();
                unit   = $('#selectunit').val();
                story  = $('#selectstory').val();
            $.ajax({
                url	    : '<?=base_url()?>admin/audio_list',
                type    : "POST",
                data    : 'level='+level+'&unit='+unit+'&story='+story+'&speed=Level1',
                success : function(hasil){
                    data1 = $.parseJSON(hasil);
                    $.each(data1, function( index, value ) {
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
            $.ajax({
                url	    : '<?=base_url()?>admin/audio_list',
                type    : "POST",
                data    : 'level='+level+'&unit='+unit+'&story='+story+'&speed=Level2',
                success : function(hasil){
                    data1 = $.parseJSON(hasil);
                    $.each(data1, function( index, value ) {
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
            $.ajax({
                url	    : '<?=base_url()?>admin/audio_list',
                type    : "POST",
                data    : 'level='+level+'&unit='+unit+'&story='+story+'&speed=Level3',
                success : function(hasil){
                    data1 = $.parseJSON(hasil);
                    $.each(data1, function( index, value ) {
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
    });

    $(document).ready(function() {
        $('#submit0').click(function(e) {
            if ($('#files0').val()) {
                e.preventDefault();
            }
            $.ajax({
                url: "<?=base_url()?>admin/upload_story",
                method: "POST",
                data: new FormData($('#formStory')[0]),
                contentType : false,
                processData : false,
                cache : false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    var progressbar = Math.round((e.loaded/e.total)*100);
                    $('#progressbarStory').css('width', progressbar + '%');
                    $('#progressbarStory').html('<div id="percentStory">' + progressbar +'%</div>');
                });
                    return xhr;
                },
                success: function(feedback){
                    Swal('Berhasil Upload', feedback, 'success');
                    $("#files0").replaceWith($("#files0").val('').clone(true));
                    $("#submit0").prop('disabled', true);
                    $('#progressbarStory').width('0%');
                    $('#percentStory').delay(1000).html('0%');
                    $.showFile();
                }
            })
        })

        $('#submit1').click(function(e) {
            if ($('#files1').val()) {
                e.preventDefault();
            }

            $.ajax({
                url: "<?=base_url()?>admin/upload_audio",
                method: "POST",
                data: new FormData($('#formAudio1')[0]),
                contentType : false,
                processData : false,
                cache : false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    var progressbar = Math.round((e.loaded/e.total)*100);
                    $('#progressbarAudio1').css('width', progressbar + '%');
                    $('#progressbarAudio1').html('<div id="percentAudio1">' + progressbar +'%</div>');
                });
                    return xhr;
                },
                success: function(feedback){
                    Swal('Berhasil Upload', feedback, 'success');
                    $("#files1").replaceWith($("#files1").val('').clone(true));
                    $("#submit1").prop('disabled', true);
                    $('#progressbarAudio1').width('0%');
                    $('#percentAudio1').delay(1000).html('0%');
                    $.showFile();
                }
            })
        })

        $('#submit2').click(function(e) {
            if ($('#files2').val()) {
                e.preventDefault();
            }

            $.ajax({
                url: "<?=base_url()?>admin/upload_audio",
                method: "POST",
                data: new FormData($('#formAudio2')[0]),
                contentType : false,
                processData : false,
                cache : false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    var progressbar = Math.round((e.loaded/e.total)*100);
                    $('#progressbarAudio2').css('width', progressbar + '%');
                    $('#progressbarAudio2').html('<div id="percentAudio2">' + progressbar +'%</div>');
                });
                    return xhr;
                },
                success: function(feedback){
                    Swal('Berhasil Upload', feedback, 'success');
                    $("#files2").replaceWith($("#files2").val('').clone(true));
                    $("#submit2").prop('disabled', true);
                    $('#progressbarAudio2').width('0%');
                    $('#percentAudio2').delay(1000).html('0%');
                    $.showFile();
                }
            })
        })

        $('#submit3').click(function(e) {
            if ($('#files3').val()) {
                e.preventDefault();
            }

            $.ajax({
                url: "<?=base_url()?>admin/upload_audio",
                method: "POST",
                data: new FormData($('#formAudio3')[0]),
                contentType : false,
                processData : false,
                cache : false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e){
                    var progressbar = Math.round((e.loaded/e.total)*100);
                    $('#progressbarAudio3').css('width', progressbar + '%');
                    $('#progressbarAudio3').html('<div id="percentAudio3">' + progressbar +'%</div>');
                });
                    return xhr;
                },
                success: function(feedback){
                    Swal('Berhasil Upload', feedback, 'success');
                    $("#files3").replaceWith($("#files3").val('').clone(true));
                    $("#submit3").prop('disabled', true);
                    $('#progressbarAudio3').width('0%');
                    $('#percentAudio3').delay(1000).html('0%');
                    $.showFile();
                }
            })
        })

        $('#selectstory').on('change', function () {
            $('#story_name').removeAttr('hidden');
            $('#upload').removeAttr('hidden');
        });
    });
</script>