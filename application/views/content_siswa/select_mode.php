<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
            <?php $this->load->view($header_content)?>

            <div class="body">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"">
                        <?=form_open('dashboard_siswa/matching_quiz');?>
                            <input type="hidden" name="subject" value="<?=$subject?>">
                            <input type="hidden" name="unit" value="<?=$unit?>">
                            <input type="hidden" name="mode" value="practice">
                            <button class="thumbnail" style="border:none">
                                <img src="<?=base_url()?>assets/icon/news.png" style="width:50%">
                                    <p class="text-center font-bold col-orange" style="font-size:1em">Practice</p>
                                    <i class="material-icons font-bold" style="font-size:1em">clear</i> <span class="icon-name font-bold" ><?=$try_practice?></span>
                            </button>
                        <?=form_close();?>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"">
                        <?php if ($test == 1) : ?>
                            <button class="thumbnail" style="border:none" disabled>
                                <img src="<?=base_url()?>assets/icon/news.png" style="width:50%">
                                <p class="text-center font-bold col-orange" style="font-size:1em">Test <span class="material-icons col-black">lock</span></p>
                                <i class="material-icons font-bold" style="font-size:1em">clear</i> <span class="icon-name font-bold" ><?=$try_test?></span>
                            </button>
                        <?php else : ?>
                            <?=form_open('dashboard_siswa/matching_quiz');?>
                                <input type="hidden" name="subject" value="<?=$subject?>">
                                <input type="hidden" name="unit" value="<?=$unit?>">
                                <input type="hidden" name="mode" value="test">
                                <button class="thumbnail" style="border:none">
                                    <img src="<?=base_url()?>assets/icon/news.png" style="width:50%">
                                    <p class="text-center font-bold col-orange" style="font-size:1em">Test</p>
                                    <i class="material-icons font-bold" style="font-size:1em">clear</i> <span class="icon-name font-bold" ><?=$try_test?></span>
                                </button>
                            <?=form_close();?>
                        <?php endif;?>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"">
                        <?php if ($review == 0) : ?>
                            <button class="thumbnail" style="border:none" disabled>
                                <img src="<?=base_url()?>assets/icon/news.png" style="width:50%">
                                <p class="text-center font-bold col-orange" style="font-size:1em">Review <span class="material-icons col-black">lock</span></p>
                                <i class="material-icons font-bold" style="font-size:1em">clear</i> <span class="icon-name font-bold" ><?=$try_review?></span>
                            </button>
                        <?php else : ?>
                            <?=form_open('dashboard_siswa/matching_quiz');?>
                                <input type="hidden" name="subject" value="<?=$subject?>">
                                <input type="hidden" name="unit" value="<?=$unit?>">
                                <input type="hidden" name="mode" value="review">
                                <button class="thumbnail" style="border:none">
                                    <img src="<?=base_url()?>assets/icon/news.png" style="width:50%">
                                    <p class="text-center font-bold col-orange" style="font-size:1em">Review</p>
                                    <i class="material-icons font-bold" style="font-size:1em">clear</i> <span class="icon-name font-bold" ><?=$try_review?></span>
                                </button>
                            <?=form_close();?>
                        <?php endif;?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>