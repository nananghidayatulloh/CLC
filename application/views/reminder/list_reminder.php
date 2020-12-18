<section class="content">
    <div class="container-fluid">
        <!-- Basic Table -->
        <!-- Notifikasi -->
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Reminder &nbsp;&nbsp;
                        <ol class="breadcrumb pull-right">
                            <li><a href="<?=base_url()?>admin/reminder"><i class="material-icons">flag</i> Reminder</a></li>
                            <li class="active">Edit</li>
                        </ol>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="demo-masked-input">
                            <div class="row clearfix">
                                <?=form_open('admin/reminder_kirim', 'role="form"')?>
                                <input type="hidden" name="id" value="<?=$reminder['id']?>">
                                <div class="col-md-4">
                                    <b>Username</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="title" class="form-control"  value="<?=$reminder['title']?>" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b>Time</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">alarm</i>
                                        </span>
                                        <div class="form-line">
                                            <select class="form-control" name="hour">
                                                <?php
                                                    for ($i=0; $i < 24; $i++) { 
                                                        $h = ($i < 10) ? "0".$i : $i;
									                    $selected = ($h == $reminder['hour']) ? "selected" : "";
                                                ?>
                                                <option value="<?=$h?>"<?=$selected;?>><?=$h;?> : 00</option>
                                                <?php
                                                }
							                    ?>
                                                
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-4">
                                    <input type="checkbox" id="md_checkbox_14" name="status" value="1" class="chk-col-amber" <?php if ($reminder['status'] == 1) echo "checked";?>/>
                                    <label for="md_checkbox_14">Active</label>
                                </div>
                                <div class="col-md-12">
                                    <b>Message</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">message</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="message" class="form-control" value="<?=$reminder['message']?>" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" onclick="return confirm('Apakah anda yakin akan mengirimkan data ini?')" class="btn bg-indigo waves-effect"> <i class="material-icons">send</i> <span>Kirim Reminder</span></button>
                                <?=form_close()?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->
    </div>
</section>