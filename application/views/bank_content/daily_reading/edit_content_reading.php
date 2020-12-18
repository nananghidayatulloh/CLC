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
                                <li class="active">Edit Content Reading</li>
                            </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <?=form_open_multipart('bank_content/content_reading_create')?>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <b>Code</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="code" value="<?=$list_content['code']?>" required>
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
                                                <input type="text" class="form-control" name="title" value="<?=$list_content['title']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Txt</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="file" class="form-control" name="txt" accept=".txt" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Audio</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="file" class="form-control" name="ogg" accept=".ogg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>List Txt</b>
                                        <div class="input-group">
                                            <ul>
                                                <?php foreach($list_content['list_txt'] as $txt) :?>
                                                    <li><?=$txt?></li>
                                                <?php endforeach?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn bg-indigo waves-effect">
                                    <i class="material-icons">save</i>
                                    <span>SIMPAN</span>
                                </button>
                            </div>
                        <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
</script>