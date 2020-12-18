<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content Self Test
                            <ol class="breadcrumb pull-right">
                                <li> <a href="<?=base_url()?>selftest"><i class="material-icons">file_upload</i> Upload Content </a></li>
                                <li class="active">Self Test</li>
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
                                                <option value="">Pilih Subject</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="display_other" style="display:none">
                                    <div class="col-md-3">
                                        <b>Content Type</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <select class="form-control show-tick" name="content_type" id="content_type" required>
                                                <option value=""> - Pilih Content Type - </option>
                                                <option value="1">Meaning</option>
                                                <option value="2">Keyword</option>
                                                <option value="3">Arranging</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <b>Standard</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">book</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="standart_goal" max="999" min="1" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons" style="color:yellow">turned_in</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="standart_kuning" max="999" min="1" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons" style="color:green">turned_in</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="standart_hijau" max="999" min="1" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons" style="color:blue">turned_in</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="standart_biru" max="999" min="1" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons" style="color:red">turned_in</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="standart_merah" max="999" min="1" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row clearfix">
                                            <div class="col-md-6">
                                                <b>Time Limit</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">filter_list</i>
                                                    </span>
                                                    <input type="number" name="time_limit" id="time_limit" style="width: 50px" min="1" max="99" value="1" required> : 00
        
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <br>
                                                <input type="number" name="set_spontan" hidden/>
                                                <div class="input-group">
                                                    <input type="checkbox" id="set_spontan" class="chk-col-teal"/>
                                                    <label for="set_spontan">Set Spontan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button id="submit_setting_subject" class="btn-block btn-xs bg-indigo waves-effect"><span>SIMPAN SETTING SUBJECT</span>
                                        </button>
                                    </div>

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

                                    <div class="col-md-6">
                                        <b>Jumlah Unit</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">book</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" class="form-control" min="1" max="300" required id="jumlah_unit" readonly>
                                            </div>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                                <!-- <button type="submit" id="clear_data_content" class="btn-block btn-xs bg-red waves-effect">
                                    <span>CLEAR DATA</span>
                                </button> -->
                                <div id="upload_content" style="display:none">
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
        $.checkFile = function(i) {
            if(document.getElementById("files"+i).files.length !=0 ){
                document.getElementById("submit_upload"+i).disabled = false;
            } else {
                document.getElementById("submit_upload"+i).disabled = true;
            }
        }

        window.setInterval(function(){
            var jumlah_unit = $('#jumlah_unit').val();
            for (let index = 1; index <= jumlah_unit; index++) {
                $.checkFile(index);
            }
        }, 1500);

        function show_subject_name() {
            var level   = $('#selectlevel').val();
                subject = $('#selectsubject').val();
                
            $.ajax({
                url: '<?=base_url()?>selftest/selftest_subject_name',
                method: "POST",
                data: {level : level, subject : subject},
                async: true,
                dataType: 'JSON',
                success: function(hasil) {
                    $('#subject_name').val(hasil.name);
                }
            });
        }

        function refresh_show_file(url, unit) {
            var aksi = "";
                if (file_name != "No File") {
                    aksi =  `<div class="col-sm-2 col-md-2 col-lg-2">
                                <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2">
                                <button type='button' class='btn btn-xs bg-red waves-effect' onclick=$.delete_content('`+file_name+`')> Delete </button>
                            </div>
                            `;
                }
        }

        function show_jumlah_unit() {
            var level           = $('#selectlevel').val();
            var subject         = $('#selectsubject').val();
            var content_type    = $("#content_type").val();
                
            $.ajax({
                url: '<?=base_url()?>selftest/selftest_jumlah_unit',
                method: "POST",
                data: {level : level, subject : subject, content_type : content_type},
                async: true,
                dataType: 'JSON',
                success: function(hasil) {
                    var obj_length = Object.keys(hasil).length;
                    $('#jumlah_unit').val(obj_length);
                    $('#upload_content').empty();
                    var html_content_upload = "";
                    
                    for (let i = 0; i < obj_length; i++) {
                        var unit        = i + 1;
                        var file_name   = hasil[unit].file_name; 
                        var url         = '<?=base_url()?>selftest/selftest_download_file?level='+level+'&subject='+subject+'&content_type='+content_type+'&file_name='+file_name;

                            html_content_upload += `
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="border:thin solid #00BCD4; height: 270px;">
                                    </br>
                                    <b>File Upload Unit `+unit+`</b>
                                        <form action="<?=base_url()?>selftest/upload_file_selftest" id="form_upload`+unit+`" method="post" accept-charset="utf-8">
                                            <div class="input-group" style="margin-bottom:0px; margin-top: 20px;">
                                                <input name="level" id="level_selftest`+unit+`" value="`+level+`" hidden>
                                                <input name="subject" id="subject_selftest`+unit+`" value="`+subject+`" hidden>
                                                <input name="unit" id="unit_selftest`+unit+`" value="`+unit+`" hidden>
                                                <input name="content_type" id="submit_content_type`+unit+`" value="`+content_type+`" hidden>
                                                <div class="form-line">
                                                    <input type="file" name="files"  id="files`+unit+`" accept=".txt" class="form-control" autofocus>
                                                </div>
                                                <button type="submit" name="submit" value="upload" id="submit_upload`+unit+`" onclick="return $.submit_upload(`+unit+`);" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                    <span>UPLOAD</span>
                                                </button>
                                        </form>
                                                <div class="progress" id="progress_upload`+unit+`">
                                                    <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_upload`+unit+`" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <div id=refresh_file_`+unit+`>
                                                </div>
                                                <div class="input-group">
                                                    <div class="form-line">
                                                        <input type="text" name="unit_name" id="unit_name`+unit+`" class="form-control" maxlength="20" autofocus placeholder="Unit Name" value="`+hasil[unit].unit_name+`">
                                                    </div>
                                                    <button type="button" onclick="return $.submit_unit_name(`+unit+`);" class="btn-block btn-xs bg-indigo waves-effect">
                                                        <span>SIMPAN</span>
                                                    </button>
                                                </div>
                                            </div>
                                </div>
                                `;
                    }
                    $('#upload_content').append(html_content_upload);
                    $.show_file(obj_length);
                }
            });
        }

        $.show_file = function(jumlah_unit) {
            var level           = $('#selectlevel').val();
            var subject         = $('#selectsubject').val();
            var content_type    = $('#content_type').val();

            for (let index = 1; index <= jumlah_unit; index++) {
                $("#refresh_file_"+index+" div").remove();
    
                $.ajax({
                    url     : '<?=base_url()?>selftest/selftest_file_content',
                    method  : 'POST',
                    data    : {level : level, subject : subject, content_type : content_type, unit : index},
                    async   : true,
                    dataType: 'JSON',
                    success : function(hasil){
                        var file_name  = hasil.data;
                        var url        = '<?=base_url()?>selftest/selftest_download_file?level='+level+'&subject='+subject+'&content_type='+content_type+'&file_name='+file_name;
                        var aksi = "";

                        if (hasil.data != "No File") {
                            aksi =  `<div class="pull-right">
                                        <th>
                                            <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                                        </th>
                                        <th>
                                            <button type='button' class='btn btn-xs bg-red waves-effect' onclick=$.delete_content('`+file_name+`')> Delete </button>
                                        </th>
                                     </div>
                                    `;
                        }

                        $('#file_name_'+index).html(file_name);
                            txt1 =$(`
                                        <div class="col-sm-12" style="margin-bottom:0px">
                                            <th>`+file_name+`</th>
                                            `+aksi+`
                                            <br>
                                        </div>
                                    `);
                            $('#refresh_file_'+index).append(txt1)
                    }
                });
            }
        }

        $('#selectlevel').on('change', function(){
            var level = $(this).val();
            $('#level_selftest').val(level);

            $.ajax({
                url: '<?=base_url()?>selftest/selftest_subject',
                method: 'POST',
                data : {level : level},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    $('#display_subject').show();
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i]['subject_number']+'>'+data[i]['subject_number']+' '+data[i]['subject_title']+'</option>';
                        }
                        $('#selectsubject').html(html);
                }
            });
            return false;
        });

        $('#selectsubject').on('change', function(){
            var level   = $('#selectlevel').val();
                subject = $(this).val();
                          $('#subject_selftest').val($(this).val());
            $.ajax({
                url: '<?=base_url()?>selftest/selftest_content_config',
                method: 'POST',
                data : {level : level, subject : subject},
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    $("#content_type").val(data.content_type);
                    $('input[name="standart_goal"]').val(data.standart_goal);
                    $('input[name="standart_kuning"]').val(data.standart_kuning);
                    $('input[name="standart_merah"]').val(data.standart_merah);
                    $('input[name="standart_biru"]').val(data.standart_biru);
                    $('input[name="standart_hijau"]').val(data.standart_hijau);
                    $('#time_limit').val(data.time_limit);
                    if (data.set_spontan == "1") {
                        $('#set_spontan').prop("checked", true);
                        $('input[name="set_spontan"]').val(data.set_spontan);
                    } else {
                        $('#set_spontan').prop("checked", false);
                        $('input[name="set_spontan"]').val(data.set_spontan);
                    }
                    $('#display_other').show();
                    $('#upload_content').show();
                    show_subject_name();
                    show_jumlah_unit();
                }
            });
        });

        $('#content_type').on('change', function() {
            content_type = $(this).val();
            $('#submit_content_type').val(content_type);
        })

        $('#set_spontan').on('click', function() {
            var checkBoxes = $(this);
            if(checkBoxes.prop("checked") == true)
                $('input[name="set_spontan"]').val(1);
            else
                $('input[name="set_spontan"]').val(0);
        });

        $('#submit_setting_subject').on('click', function() {
            var level           = $('#selectlevel').val();
                subject         = $('#selectsubject').val();
                content_type    = $('#content_type').val();
                standart_goal   = $('input[name="standart_goal"]').val();
                standart_kuning = $('input[name="standart_kuning"]').val();
                standart_merah  = $('input[name="standart_merah"]').val();
                standart_biru   = $('input[name="standart_biru"]').val();
                standart_hijau  = $('input[name="standart_hijau"]').val();
                time_limit      = $('#time_limit').val();
                spontan         = $('input[name="set_spontan"]').val();

            $.ajax({
                url         : '<?=base_url()?>selftest/submit_setting_subject',
                method      : "POST",
                data        : { level : level, subject : subject, content_type : content_type, standart_goal : standart_goal, standart_kuning : standart_kuning, standart_merah : standart_merah, standart_biru : standart_biru, standart_hijau : standart_hijau, time_limit : time_limit, spontan : spontan },
                async       : true,
                dataType    : 'JSON',
                success     : function(callback) {
                    Swal('Berhasil', callback.callback, 'success');
                }
            });
        });

        $('#submit_subject').on('click', function(e) {
            var level           = $('#selectlevel').val();
            var subject         = $('#selectsubject').val();
            var subject_name    = $('#subject_name').val();

                $.ajax({
                    url: '<?=base_url()?>selftest/selftest_submit_subject',
                    method: 'POST',
                    data : {level : level, subject : subject, subject_name : subject_name},
                    async: true,
                    dataType : 'JSON',
                    success : function(data) {
                        Swal('Berhasil', data.name, 'success');
                    }
                })
        });

        $.submit_unit_name = function(unit) {
            var level           = $('#selectlevel').val();
            var subject         = $('#selectsubject').val();
            var unit_name       = $('#unit_name'+unit).val();

                $.ajax({
                    url: '<?=base_url()?>selftest/selftest_submit_unit',
                    method: 'POST',
                    data : {level : level, subject : subject, unit : unit, unit_name : unit_name},
                    async: true,
                    dataType : 'JSON',
                    success : function(data) {
                        Swal('Berhasil', data.name, 'success');
                    }
                });
            return false;
        }

        $('#submit_unit').on('click', function(e){
            var level           = $('#selectlevel').val();
                subject         = $('#selectsubject').val();
                unit            = $('#selectunit').val();
                unit_name       = $('#unit_name').val();

                $.ajax({
                    url: '<?=base_url()?>selftest/selftest_submit_unit',
                    method: 'POST',
                    data : {level : level, subject : subject, unit : unit, unit_name : unit_name},
                    async: true,
                    dataType : 'JSON',
                    success : function(data) {
                        Swal('Berhasil', data.name, 'success');
                    }
                })
        });

        $.submit_upload = function(i) {
            var jumlah_unit = $('#jumlah_unit').val();
            $.ajax({
                url: "<?=base_url()?>selftest/upload_file_selftest",
                method: "POST",
                data: new FormData($('#form_upload'+i)[0]),
                contentType : false,
                processData : false,
                cache : false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            var percent = Math.round((e.loaded / e.total) * 100);
                            $('#bar_upload'+i).css('width', percent + '%');
                            $('#bar_upload'+i).html('<div id="percent_upload'+i+'">' + percent +'%</div>');
                        }
                        });
                    return xhr;
                },
                success: function(feedback){
                    Swal('Berhasil Upload', feedback, 'success');
                    $("#files"+i).replaceWith($("#files"+i).val('').clone(true));
                    $("#submit_upload"+i).prop('disabled', true);
                    $('#bar_upload'+i).width('0%');
                    $('#percent_upload'+i).delay(1000).html('0%');
                    $.show_file(jumlah_unit);
                }
            });
            return false;
        };

        $('#clear_data_content').on("click", function(e) {
            var level = $('#selectlevel').val();
                unit = $('#selectunit').val();
                mode  = "matching_quiz";

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
                subject     = $('#selectsubject').val();
                content_type= $('#content_type').val();
            
                $.ajax({
                    url     : '<?=base_url()?>selftest/selftest_delete_file',
                    method  : "POST",
                    data    : {file_name : file_name, level : level, subject : subject, content_type : content_type},
                    async   : true,
                    dataType: 'JSON',
                    success : function (hasil) {
                        show_jumlah_unit();
                        Swal('Berhasil', hasil.ADD_INFO, 'success');
                    }
                });
        };

    }); 
</script>