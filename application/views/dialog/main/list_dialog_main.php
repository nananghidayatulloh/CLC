<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content Dialog Main
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>dialog/dialog_main"><i class="material-icons">file_upload</i> Upload Content</a></li>
                            <li>Dialog</li>
                            <li class="active">Main</li>
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
                                    <div id="clear" style="display:none">
                                        <button type="submit" id="clear_data_content" class="btn-block btn-xs bg-red waves-effect">
                                            <span>CLEAR DATA</span>
                                        </button>
                                    </div>
                                </div>
                                    <div id="dialog" style="display:none">
                                        <div class="col-md-8">
                                            <b>File Dialog Main</b>
                                            <div><small>Please Name The File Based On Level And Dialog Number (eg: P1D1.txt, P1D2.txt, P1D3.txt, ....)</small></div>
                                            <?=form_open_multipart('dialog/upload_dialog_new', "id='formDialog'"); ?>
                                                <div class="input-group">
                                                    <input name="level" id="level_dialog" hidden>
                                                    <input name="mode" value="dialog_main" hidden>
                                                    <div class="form-line">
                                                        <input type="file" name="files[]" multiple id="files" accept=".txt" class="form-control" autofocus required>
                                                    </div>
                                                    <button type="submit" name="submit" value="upload" id="submit_dialog" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                        <span>UPLOAD</span>
                                                    </button>
                                            <?= form_close() ?>
                                                    <div class="progress" id="progress_dialog">
                                                        <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_dialog" aria-valuemin="0" aria-valuemax="100">
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
    </div>
</section>
<script>
    var levelsel = "";
    function checkFile(){
				
        if( document.getElementById("files").files.length !=0 ){
            document.getElementById("submit_dialog").disabled = false;
        }
    }
    
    
    window.setInterval(function(){
        checkFile();
    }, 2000);

    $(document).ready(function(){
        $('#selectlevel').on('change', function(){
            var level        = $(this).val();
            var dialog_level = $('#level_dialog').val(level);

            $('#dialog').show();
            $('#clear').show();
            $.show_file();
        });

        $.show_file = function() {
            $("#dir div").remove();
            var level = $('#selectlevel').val();
                mode  = "dialog_main";
            $.ajax({
                url     : '<?=base_url()?>dialog/dialog_list_file_new',
                method  : 'POST',
                data    : { level : level, mode : mode},
                async   : true,
                dataType: 'JSON',
                success : function(hasil){
                    var url     = '<?=base_url()?>admin/download_dialog_text_new';
                    parsedata   = $.parseJSON(hasil.data);
                    $.each(parsedata, function( index, value ) {
                        var file_name = value;
                            url = '<?=base_url()?>dialog/download_dialog_file_new?level='+level+'&file_name='+file_name+'&mode=dialog_main';
                            txt1 = $(`<div class="col-sm-4">
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
                }
            });
        }

        $.delete_data = function(file_name) {
            var level = $('#selectlevel').val();
                mode  = "dialog_main";

            $.ajax({
            url     : "<?=base_url()?>dialog/delete_dialog_file_new",
            method  : "POST",
            data    : {file_name : file_name, level : level, mode : mode},
            async   : true,
            dataType: 'JSON',
            cache   : false,
            success : function (hasil) {
                $.show_file();
                Swal('Berhasil', hasil.data, 'success');
            },
            error   : function(){
                alert('error');
            }
            });
        }
    });

    $('#submit_dialog').on("click", function (e) {
        $("#progress_dialog").show();
        e.preventDefault();

        $.ajax({
            url: "<?=base_url()?>dialog/upload_file_dialog_new",
            method: "POST",
            data: new FormData($('#formDialog')[0]),
            contentType : false,
            processData : false,
            cache : false,
            xhr: function() {
                var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                    if(e.lengthComputable){
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#bar_dialog').css('width', percent + '%');
                        $('#bar_dialog').html('<div id="percent_dialog">' + percent +'%</div>');
                    }
                    });
                return xhr;
            },
            success: function(feedback){
                Swal('Berhasil Upload', feedback, 'success');
                $("#files").replaceWith($("#files").val('').clone(true));
                $("#submit_dialog").prop('disabled', true);
                $('#bar_dialog').width('0%');
                $('#percent_dialog').delay(1000).html('0%');
                $.show_file();
            }
        })
    });

    $('#clear_data_content').on("click", function(e) {
        var level = $('#selectlevel').val();
            mode  = "dialog_main";

        $.ajax ({
            url         : '<?=base_url()?>dialog/dialog_clear_data_content_new',
            method      : "POST",
            data        : {level : level, mode : mode},
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
</script>