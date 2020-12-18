<div class="container-fluid">
    <div class="justify-content-center">
        <div class="card max-width-card">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
                <div class="body margin-bottom-body">
                    <div class="row justify-content-center">
                        <div class="max-width-col">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <ul class="list-group text-center">
                                    <li class="list-group-item font-bold font-30" style="border:none; padding:2px;"> <?=strtoupper($title)?></li>
                                </ul>
                            </div>
                            <?=form_open('dashboard_siswa/select_subject', 'id="form_post"')?>
                                <input type="hidden" name="level" value="<?=$this->session->userdata('level')?>">
                            <?=form_close()?>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <a href="javascript:void(0)" class="thumbnail select_subject" style="border:none">
                                    <img src="<?=base_url()?>assets/icon/self_test.png" class="img-responsive img-rounded">
                                        <p class="text-center font-bold col-orange" style="font-size:1.2em">SELF TEST</p>
                                </a>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <a href="<?=base_url()?>news_siswa" class="thumbnail" style="border:none">
                                    <img src="<?=base_url()?>assets/icon/news2.png" class="img-responsive img-rounded">
                                        <p class="text-center font-bold col-orange" style="font-size:1.2em">NEWS</p>
                                </a>
                            </div>
                            <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"">
                                <a href="<?=base_url()?>arrange_words" class="thumbnail" style="border:none">
                                    <img src="<?=base_url()?>assets/icon/Leaderboard.png" class="img-responsive img-rounded">
                                        <p class="text-center font-bold col-orange" style="font-size:1.2em">LEADERBOARD</p>
                                </a>
                            </div> -->
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <a href="<?=base_url()?>dashboard_siswa/history" class="thumbnail" style="border:none">
                                    <img src="<?=base_url()?>assets/icon/History.png" class="img-responsive img-rounded">
                                        <p class="text-center font-bold col-orange" style="font-size:1.2em">HISTORY</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.select_subject').on('click', function() {
            $('#form_post').submit();
        });
    });
</script>