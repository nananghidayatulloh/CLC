<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>News &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>news"><i class="material-icons">people</i> News</a></li>
                            <li class="active">Edit</li>
                        </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <?=form_open_multipart('news/edit_news', 'role="form"')?>
                                    <input type="hidden" name="id_news" id="id_news" value="<?=set_value('id_news', $news['id_news'])?>">
                                    <div class="col-md-6">
                                        <b>Title</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="<?=set_value('title', $news['title'])?>" required>
                                                <?=form_error('title', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Image Large</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">photo_camera</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="file" name="image_large" id="image_large" value="<?=set_value('image_large')?>" class="form-control" accept=".png,.jpg,.jpeg">
                                                <small class="text-danger pl-3">*Format File : .png, .jpg, .jpeg | Max : 5MB</small>
                                                <?=form_error('image_large', '<small class="text-danger pl-3">', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Description</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">view_headline</i>
                                            </span>
                                            <div class="form-line">
                                                <textarea rows="10" class="form-control" name="description" id="description" value="<?=set_value('description')?>" placeholder="Description" required><?=$news['description']?></textarea>
                                                <?=form_error('description', '<small class="text-danger pl-3>', '</small>')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-indigo waves-effect"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                        <a href="<?=base_url()?>news" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
                                        </a>
                                    </div>
                                <?=form_close()?>
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