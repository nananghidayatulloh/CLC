<div class="container-fluid">
    <div class="justify-content-center">
        <div class="card max-width-card">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
            <div class="body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="list-group text-center">
                            <li class="list-group-item font-bold font-30" style="border:none; padding:2px;">
                                <a href="<?=base_url()?>" class="btn btn-sm btn-warning waves-effect pull-left" style="margin-top:6px"> Back </a>
                                <?=strtoupper($title)?>
                            </li>
                        </ul>
                    </div>
                    <?=form_open('dashboard_siswa/select_unit', 'id="form_post"')?>
                        <input type="hidden" name="subject">
                    <?=form_close();?>
                    <?php foreach($subject_active as $subject) : ?>
                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                            <a href="javascript:void(0)" class="thumbnail select_unit" style="border:none" data-select_subject="<?=$subject['subject']?>">
                                <img src="<?=base_url()?>assets/icon/Subject.png" class="img-responsive img-rounded">
                                    <p class="text-center font-bold col-orange" style="font-size:1em"><?=$subject['name']?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $('.select_unit').on('click', function() {
        var subject = $(this).data('select_subject');
        $('input[name="subject"]').val(subject);
        $('#form_post').submit();
    });
</script>