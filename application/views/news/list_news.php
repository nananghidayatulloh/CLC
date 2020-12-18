<section class="content">
    <div class="container-fluid">
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>News &nbsp;&nbsp;
                            <a href="<?=base_url()?>news/tambah_news" type="button" class="btn bg-teal btn-xs waves-effect">
                                <i class="material-icons">add</i>
                                <span>Tambah</span>
                            </a>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Image Url Large</th>
                                    <!-- <th class="text-center">Image Url Small</th> -->
                                    <th class="text-center">Created Date</th>
                                    <th class="text-center">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    foreach($news as $new):
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <textarea cols="3" class="form-control text-center no-resize" readonly><?=$no?></textarea>
                                    </td>
                                    <td class="text-center">
                                        <textarea cols="40" class="form-control text-center no-resize" readonly><?=$new['title']?></textarea>
                                    </td>
                                    <td class="text-center">
                                        <textarea cols="100" class="form-control text-center no-resize" readonly><?=$new['description']?></textarea>
                                    </td>
                                    <td class="text-center">
                                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix aniimated-thumbnials">
                                            <a href="<?=$new['image_url_large']?>" data-sub-html="Gambar News.png">
                                                <img src="<?=$new['image_url_large']?>" alt="" class="img-responsive thumbnail">
                                            </a>
                                        </div>
                                        <!-- <textarea cols="60" class="form-control text-center no-resize" readonly><?=$new['image_url_large']?></textarea> -->
                                    </td>
                                    <!-- <td class="text-center">
                                        <textarea cols="60" class="form-control text-center no-resize" readonly><?=$new['image_url_small']?></textarea>
                                    </td> -->
                                    <td class="text-center">
                                        <textarea cols="10" class="form-control text-center no-resize" readonly><?=$new['created_date']?></textarea>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?=base_url()?>news/edit_news/<?=encrypt_url($new['id_news'])?>" class="btn btn-xs bg-orange waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                        <a href="<?=base_url()?>news/hapus_news/<?=encrypt_url($new['id_news'])?>" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Hapus"><i class="material-icons">delete</i><span>Hapus</span></a>
                                    </td>
                                </tr>
                                <?php $no++; endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>