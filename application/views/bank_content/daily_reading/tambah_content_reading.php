<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Content Reading
                            <ol class="breadcrumb pull-right">
                                <li> <a href="<?=base_url()?>bank_content"><i class="material-icons">file_upload</i> Upload Content </a></li>
                                <li>Bank Content</li>
                                <li class="active">Tambah Content Reading</li>
                            </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <b>Code</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="code" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>Title</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" id="submit" class="btn bg-indigo waves-effect btn-block">
                                        <i class="material-icons">save</i>
                                        <span>SIMPAN</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row clearfix" id="upload" style="display:none">
                                <?=form_open('bank_content/content_reading_upload', 'id="form_upload"')?>
                                    <div class="col-md-6">
                                        <b>Txt</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="file" class="form-control" name="txt" accept=".txt" required>
                                                <input type="hidden" name="code" id="code_txt">
                                                <input type="hidden" name="version" value="1">
                                                <button id="uploadTxt" class="btn btn-info waves-effect btn-block btn-sm"><span>Upload</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?=form_close()?>
                                <div class="col-md-6">
                                    <b>Audio</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">filter_list</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="file" class="form-control" name="ogg[]" multiple="multiple" accept=".ogg">
                                            <input type="hidden" name="code" id="code_audio">
                                            <input type="hidden" name="version" value="1">
                                            <button id="uploadAudio" class="btn btn-info waves-effect btn-block btn-sm"><span>Upload</span>
                                             </button>
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
        $('#submit').on('click', function(e){
            e.preventDefault();
            var code  = $('input[name="code"]').val();
            var title = $('input[name="title"]').val();

            if(code == '' || title == "") {
                Swal('Maaf', 'Code dan Title tidak boleh Kosong', 'error');
            } else {
                $.ajax({
                    type : 'POST',
                    url : '<?=base_url()?>bank_content/content_reading_create',
                    data : {code : code, title : title},
                    async: true,
                    dataType: 'JSON',
                    success : function(feedback){
                        console.log(feedback)
                        if(feedback.success == "Berhasil") {
                            Swal('Selamat Anda', feedback['success'], 'success');

                            $('#upload').show();
                            $('#code_txt').val(feedback.data.code);
                            $('#code_audio').val(feedback.data.code);
                        } else if(feedback.success == "Ada") {
                            Swal('Code Sudah ', feedback, 'warning');
                        }
                    }
                });
            }
        });

        $('#uploadTxt').on('click', function(e){
            e.preventDefault();
            var formData = new FormData($('#form_upload')[0]);

            $.ajax({
                type : 'POST',
                url : '<?=base_url()?>bank_content/content_reading_upload_txt',
                data : formData,
                processData : false,
                contentType : false,
                success : function(feedback){
                    console.log(feedback)
                    // if(feedback == "Berhasil") {
                    //     Swal('Selamat Anda', feedback, 'success');

                    //     $('#upload').show();
                    // } else if(feedback == 2) {
                    //     Swal('Code Sudah ', feedback, 'warning');
                    // }
                }
            });
        });
    });
</script>