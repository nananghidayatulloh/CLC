<section class="content">
    <div class="container-fluid">
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Administrator &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>admin/administrator"><i class="material-icons">people</i> Daftar Administrator</a></li>
                            <li class="active">Tambah</li>
                        </ol>
                        </h2>
                    </div>
                    <!-- Masked Input -->
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <?=form_open_multipart('admin/administrator_tambah', 'role="form"')?>
                                <div class="col-md-4">
                                    <b>Username</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <b>Password</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" name="password" class="form-control t" placeholder="Password" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <b>Level Admin</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="role_user">
                                                <option value="">-- Pilih Level --</option>
                                                <!-- <option value="superadmin">Super Admin</option>
                                                <option value="admin">Admin</option> -->
                                                <?php foreach ($role as $key => $data) : ?>
                                                  <option value="<?= $data->id ?>"><?= $data->role ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn bg-indigo waves-effect"> <i class="material-icons">save</i> <span>SIMPAN</span></button>
                                <a href="<?=base_url()?>admin/administrator" type="button" class="btn bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span>
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
