<section class="content">
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Upload Content
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>dialog/dialog"><i class="material-icons">file_upload</i> Upload Content</a></li>
                            <li class="active">Comprehension</li>
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
                                    <div id="comprehension" style="display:none">
                                        <div class="col-md-8">
                                            <b>File Comprehension</b>
                                            <div><small>Please Name The File Based On Level And Dialog Number (eg: P1U1.txt, P1U2.txt, P1U3.txt, ....)</small></div>
                                            <?=form_open_multipart('comprehension/upload_comprehension', "id='form_comprehension'"); ?>
                                                <div class="input-group">
                                                    <input name="level" id="level_comprehension" hidden>
                                                    <div class="form-line">
                                                        <input type="file" name="files[]" multiple id="files" accept=".txt" class="form-control" autofocus required>
                                                    </div>
                                                    <button type="submit" name="submit" value="upload" id="submit_comprehension" class="btn-block btn-xs bg-cyan waves-effect" disabled>
                                                        <span>UPLOAD</span>
                                                    </button>
                                            <?= form_close() ?>
                                                    <div class="progress" id="progress_comprehension">
                                                        <div class="progress-bar bg-orange progress-bar-striped active" role="progressbar" id="bar_comprehension" aria-valuemin="0" aria-valuemax="100">
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
				
        if(document.getElementById("files").files.length !=0 ){
            document.getElementById("submit_comprehension").disabled = false;
        }
    }
    
    
    window.setInterval(function(){
        checkFile();
    }, 2000);

    $(document).ready(function(){
        $('#selectlevel').on('change', function(){
            var level = $(this).val();
            var comprehension_level = $('#level_comprehension').val(level);

            $('#comprehension').show();
            $('#clear').show();
            $.show_file();
        });

        $.show_file = function() {
            $("#dir th").remove();
            var level = $('#selectlevel').val();
            $.ajax({
                url     : '<?=base_url()?>comprehension/comprehension_list_file',
                method  : 'POST',
                data    : { level : level} ,
                async   : true,
                dataType: 'JSON',
                success : function(hasil){
                    parsedata   = $.parseJSON(hasil.data);
                    $.each(parsedata, function( index, value ) {
                        var file_name = value;
                            url = '<?=base_url()?>comprehension/download_comprehension_file?level='+level+'&file_name='+file_name;
                            txt1 = $(`<th>`+value+`</th> 
                        				<th>
                                            <a href='`+url+`' type='button' class='btn btn-xs bg-orange waves-effect'>Edit</a>
                        				</th>
                        				<th>
                        					<button type='button' class='btn btn-xs bg-red waves-effect' onclick = $.delete_data('`+file_name+`')> Delete </button>
                        				</th>`);
						$('#dir').append(txt1)
					});
                }
            });
        }

        $.delete_data = function(file_name) {
            var level = $('#selectlevel').val();

            $.ajax({
            url     : "<?=base_url()?>comprehension/delete_comprehension_file",
            method  : "POST",
            data    : {file_name : file_name, level : level},
            async   : true,
            dataType: 'JSON',
            cache   : false,
                success: function (hasil) {
                    $.show_file();
                    Swal('Berhasil', hasil.data, 'success');
                },
                error: function(){
                    alert('error');
                }
            });
        }
    });
    

    $('#submit_comprehension').on("click", function (e) {
        $("#progress_comprehension").show();
        e.preventDefault();

        $.ajax({
            url: "<?=base_url()?>comprehension/upload_file_comprehension",
            method: "POST",
            data: new FormData($('#form_comprehension')[0]),
            contentType : false,
            processData : false,
            cache : false,
            xhr: function() {
                var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                    if(e.lengthComputable){
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#bar_comprehension').css('width', percent + '%');
                        $('#bar_comprehension').html('<div id="percent_comprehension">' + percent +'%</div>');
                    }
                    });
                return xhr;
            },
            success: function(feedback){
                Swal('Berhasil Upload', feedback, 'success');
                $("#files").replaceWith($("#files").val('').clone(true));
                $("#submit_comprehension").prop('disabled', true);
                $('#bar_comprehension').width('0%');
                $('#percent_comprehension').delay(1000).html('0%');
                $.show_file();
            }
        })
    });

    $('#clear_data_content').on("click", function(e) {
        var level = $('#selectlevel').val();

        // console.log(level);
        $.ajax ({
            url         : '<?=base_url()?>comprehension/comprehension_clear_data_content',
            method      : "POST",
            data        : {level : level},
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