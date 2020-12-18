<section class="content">
        <div class="container-fluid">
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Guru &nbsp;&nbsp;
                            <ol class="breadcrumb pull-right">
                                <li><a href="<?=base_url()?>admin/guru"><i class="material-icons">people</i> Daftar Guru</a></li>
                                <li class="active">Edit</li>
                            </ol>
                            </h2>
                        </div>
                        <!-- Masked Input -->
                        <div class="body">
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <?=form_open('admin/guru_edit', 'role="form"')?>
                                    <div class="col-sm-12">
                                        <b>ID Guru</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">view_quilt</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="id_guru" value="<?=$guru['id_guru']?>" class="form-control" placeholder="Masukan ID Guru" required autofocus readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <b>Nama Guru</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">tag_faces</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="nama_guru" value="<?=$guru['nama_guru']?>" class="form-control" placeholder="Masukan Nama Guru" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <b>Password</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" name="password" value="<?=$guru['password']?>"class="form-control" placeholder="Masukan Password" required autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <b>Examiner</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">tag_faces</i>
                                            </span>
                                            <select class="form-control show-tick" name="id_examiner">
                                                <option value="">-- Pilih Examiner --</option>
                                                <?php 
                                                    foreach($id_guru as $gr):
                                                    if ($gr['id_guru'] !== $guru['id_guru'] && $gr['id_guru'] !== "") :
                                                ?>
                                                    <option value="<?=$gr['id_guru']?>" 
                                                        <?php if($guru['id_examiner'] == $gr['id_guru']) { 
                                                                echo "selected=selected" ; 
                                                            } 
                                                        ?>
                                                    > 
                                                    <?=$gr['nama_guru']?> </option>
                                                    <?php endif; endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Max Device</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" name="device_limit" value="<?= $guru['device_limit'] ?>" class="form-control" required autofocus min="1" max="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">devices</i>
                                            </span>
                                                <input type="checkbox" name="clear_device" value="1" id="basic_checkbox_1" />
                                                <label for="basic_checkbox_1"><b>Clear Device</b></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Current Devices</b>
                                            <div class="box" style="overflow: auto; width:auto; height:150px;">
                                                <?php 
                                                    $no = 1;
                                                    foreach($device_guru as $dg): 
                                                ?>
                                                <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">devices</i>
                                                        </span>
                                                    <label><?=$no?>. <?=$dg['device_type']?></label>
                                                </div>
                                                <?php $no++; endforeach ?>
                                            </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn bg-indigo waves-effect">
                                            <i class="material-icons">save</i>
                                            <span>SIMPAN</span>
                                        </button>
                                        <a href="<?=base_url()?>admin/guru" type="button" class="btn bg-indigo waves-effect">
                                            <i class="material-icons">arrow_back</i>
                                            <span>KEMBALI</span>
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