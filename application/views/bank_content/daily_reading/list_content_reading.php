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
                                <li class="active">Daftar Content Reading</li>
                            </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <a href="<?=base_url()?>bank_content/content_reading_tambah" type="button" class="btn bg-teal btn-xs waves-effect">
                            <i class="material-icons">add</i>
                            <span>Tambah</span>
                        </a>
                        <div class="table-responsive" style="margin-top:6px">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Dibuat</th>
                                        <th class="text-center">Diubah</th>
                                        <th class="text-center">File Txt</th>
                                        <th class="text-center">File Audio</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($list_content as $key => $lc): ?>
                                    <tr>
                                        <td class="text-center"><?=$key + 1?></td>
                                        <td class="text-center"><?=$lc['code']?></td>
                                        <td class="text-center"><?=$lc['title']?></td>
                                        <td class="text-center"><?=$lc['tgl_create']." | ".$lc['id_admin']?></td>
                                        <td class="text-center"><?= ($lc['tgl_update'] == null) ? 'Belum Diubah' : $lc['tgl_update']." | ".$lc['id_admin']?></td>
                                        <td class="text-center">
                                            <ul>
                                                <?php foreach($lc['list_txt'] as $i => $txt) :?>
                                                    <li><?=$txt?></li>
                                                <?php endforeach?>
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <ul>
                                                <?php foreach($lc['list_audio'] as $i => $audio) :?>
                                                    <li><?=$audio?></li>
                                                <?php endforeach?>
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?=base_URL()?>bank_content/content_reading_edit/<?=encrypt_url($lc['id'])?>" class="btn btn-xs bg-orange waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                            <a href="<?=base_URL()?>bank_content/content_reading_edit/<?=encrypt_url($lc['id'])?>" class="btn bg-red btn-xs waves-effect tombol_hapus" title="Hapus"><i class="material-icons">delete</i><span>Hapus</span></a>
                                        </td>
                                    </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
</script>