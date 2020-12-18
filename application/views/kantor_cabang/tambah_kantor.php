<section class="content">
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Kantor Cabang &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>admin/kantor_cabang"><i class="material-icons">place</i> Daftar Kantor Cabang</a></li>
                            <li class="active">Tambah</li>
                        </ol>
                        </h2>
                    </div>
                    <!-- Masked Input -->
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <?=form_open_multipart('admin/kantor_cabang_tambah', 'role="form"')?>
                                <div class="col-md-12">
                                    <b>Nama Kantor Cabang</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">place</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="nama_cabang" class="form-control" placeholder="Masukan Nama Kantor Cabang" required maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn bg-indigo waves-effect"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                <a href="<?=base_url()?>admin/kantor_cabang" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
                                </a>
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