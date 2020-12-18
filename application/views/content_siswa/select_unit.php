<div class="container-fluid">
    <div class="justify-content-center">
        <div class="card max-width-card">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
            <div class="body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="list-group text-center">
                            <li class="list-group-item font-bold font-30" style="border:none; padding:2px;"> 
                                <?=form_open('dashboard_siswa/select_subject')?>
                                    <input type="hidden" name="level" value="<?=$this->session->userdata('level')?>">
                                    <button type="submit" class="btn btn-sm btn-warning waves-effect pull-left" style="margin-top:6px"> Back </button>
                                <?=form_close()?>
                                <span>
                                    <?=strtoupper($title)?>
                                </span>
                            </li>
                        </ul>
                        <?=form_open('dashboard_siswa/submit_content', 'id="submit_content"')?>
                            <input type="hidden" name="subject">
                            <input type="hidden" name="subject_name" value="<?=$title?>">
                            <input type="hidden" name="unit">
                            <input type="hidden" name="content_type">
                            <input type="hidden" name="mode">
                        <?=form_close();?>
                    </div>
                    <?php $no = 1; foreach($unit_active as $unit) : ?>
                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3" style="display:none;" id="unit_<?=$no?>">
                            <?php if ($unit['content'] == 0) : ?>
                                <button class="thumbnail" style="border:none" disabled>
                                    <img src="<?=base_url()?>assets/icon/Unit.png" class="img-responsive img-rounded">
                                    <p class="text-center font-bold col-orange" style="font-size:1em"><?=$unit['name']?> <span class="material-icons col-orange" style="font-size:1em">lock</span></p>
                                </button>
                            <?php else : ?>
                                <a href="javascript:void(0)" class="thumbnail mode" data-subject="<?=$unit['subject']?>" data-unit="<?=$unit['unit']?>" data-name="<?=$unit['name']?>" style="border:none">
                                    <img src="<?=base_url()?>assets/icon/Unit.png" class="img-responsive img-rounded">
                                    <p class="text-center font-bold col-orange" style="font-size:1em"><?=$unit['name']?></p>
                                </a>
                            <?php endif;?>
                        </div>
                        <p class="unlock_test<?=$no?>" style="display:none;"><?=$unit['unlock_test']?></p>
                    <?php $no++; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_mode" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="unit_name"></h4>
            </div>
            <div class="modal-body">
                <ul class="list-group text-center">
                    <li class="list-group-item list_spontan" style="border:none; display:none;">
                        <a type="button" class="btn bg-teal btn-block btn-md select_mode" id="spontan" href="javascript:void(0)" data-mode="spontan">SPONTAN <span class="spontan"></span>
                        </a>
                    </li>
                    <li class="list-group-item list_practice" style="border:none; display:none;">
                        <a type="button" class="btn bg-teal btn-block btn-md select_mode" id="practice" href="javascript:void(0)" data-mode="practice">PRACTICE <span class="practice"></span>
                        </a>
                    </li>
                    <li class="list-group-item list_test" style="border:none; display:none;">
                        <a type="button" class="btn bg-teal btn-block btn-md select_mode" id="test" href="javascript:void(0)" data-mode="test"><i class="material-icons" id="icon_unlock_test" style="font-size:15px;">lock</i> TEST <span class="test"></span></a>
                    </li>
                    <li class="list-group-item list_review" style="border:none; display:none;">
                        <a type="button" class="btn bg-teal btn-block btn-md select_mode" id="review" href="javascript:void(0)" data-mode="review">REVIEW <span class="review"></span></a>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_ready" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="title"></h5>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th class="text-center">Last Score : </th>
                            <td class="text-center" id="last_score"></td>
                        <tr>
                            <th class="text-center">Date And Time : </th>
                            <td class="text-center" id="last_date"></td>
                        </tr>
                        <tr>
                            <th class="text-center">Try : </th>
                            <td class="text-center" id="last_try"></td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="text-center">Are You Ready?</h3>
                <button type="button" class="btn btn-info waves-effect pull-left submit_content">Yes, I'm Ready</button>
                <button type="button" class="btn btn-warning waves-effect pull-right" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
    $(function() {
        $.set_modal_last = function(callback) {
            $('#last_date').html(callback.date+" "+callback.time);
            $('#last_try').html(callback.try);
            var html_last_score = callback.jumlah_benar+`/`+callback.jumlah_soal+`(`+callback.completion+`%)`;
            $('#last_score').html(html_last_score);
        };

        $.set_mode_button = function(data) {
            if (data == '1') {
                $('#spontan').removeClass('bg-teal');
                $('#spontan').addClass('bg-grey');
                $('#spontan').addClass('disabled');
            } else if(data == '2') {
                $('#practice').removeClass('bg-teal');
                $('#practice').addClass('bg-grey');
                $('#practice').addClass('disabled');
            } else if(data == '3') {
                $('#test').removeClass('bg-teal');
                $('#test').addClass('bg-grey');
                $('#test').addClass('disabled');
                $('#icon_unlock_test').html('lock')
            } else if(data == '4') {
                $('#review').removeClass('bg-teal');
                $('#review').addClass('bg-grey');
                $('#review').addClass('disabled');
            } else {
                $('.select_mode').removeClass('bg-teal');
                $('.select_mode').addClass('bg-grey');
                $('.select_mode').addClass('disabled');
            }
        };

        $.active_button_test = function() {
            $('#test').addClass('bg-teal');
            $('#test').removeClass('bg-grey');
            $('#test').removeClass('disabled');
            $('#icon_unlock_test').html('')
        };

        $.select_mode = function(subject, unit, content_mode, mode) {

            $.ajax({
                url     : '<?=base_url()?>dashboard_siswa/selftest_select_mode',
                method  : "POST",
                data    : {subject : subject, unit : unit, content_mode : content_mode, mode : mode},
                async   : true,
                dataType: 'JSON',
                success : function (callback) {
                    
                    var html_last_score = `___________`;
                    var html_last_date  = `___________`;
                    var html_last_try   = `___________`;
                    
                    if (callback.completion != '-') {
                        $.set_modal_last(callback);
                    } else {
                        $('#last_score').html(html_last_score);
                        $('#last_date').html(html_last_date);
                        $('#last_try').html(html_last_try);
                    }
                }
            });
        };

        $('.mode').on('click', function(){
            var subject      = $(this).data('subject');
            var unit         = $(this).data('unit');
            var unlock_test  = $('.unlock_test'+unit).html();
            var name         = $(this).data('name');
            var content_type = '<?=$content_type?>';

            $('input[name="subject"]').val(subject);
            $('input[name="unit"]').val(unit);
            $('#title').html(name);
            $('input[name="content_type"]').val(content_type);
            $('input[name="mode"]').val('');
            $('#unit_name').html('<?=$title?> '+name);

            $.ajax({
                url     : '<?=base_url()?>dashboard_siswa/permission_selftest',
                method  : "POST",
                data    : { subject : subject, unit : unit, content_type : content_type},
                async   : true,
                dataType: 'JSON',
                success : function (callback) {
                    console.log(callback);

                    if (callback.access_spontan == 1) {
                        $('.list_spontan').show();
                        $('.list_practice').hide();
                        $('.list_test').hide();
                    } else {
                        $('.list_spontan').hide();
                        $('.list_practice').show();
                        $('.list_test').show();
                    }

                    if (callback.access != 0) $.set_mode_button('all');
                    if (callback.spontan == 0) $.set_mode_button('1');
                    if (callback.practice == 0) $.set_mode_button('2');
                    if (callback.review == 0) $.set_mode_button('4');

                    if (unlock_test == 1) {
                        if (callback.access_practice == 1) {
                                if (callback.test == 0) {
                                    $.set_mode_button('3');
                                } else {
                                    $.active_button_test();
                                };
                        } else {
                        }
                    } else {
                        $.set_mode_button('3');
                    }

                    if(callback.access_test == 1) {
                        $.set_mode_button('3');
                    }

                    if (callback.goal_test == 1) {
                        $('.list_review').show();
                        $('.list_test').hide();
                    } else {
                        $('.list_review').hide();
                    }

                    $('.spontan').html("("+callback.spontan+")");
                    $('.practice').html("("+callback.practice+")");
                    $('.test').html("("+callback.test+")");
                    $('.review').html("("+callback.review+")");
                    $('#modal_mode').modal('show');
                },
                error : function (callback) {
                    console.log(callback)
                }
            });
        });

        $('.select_mode').on('click', function(){
            var subject_mode = $('input[name="subject"]').val();
            var unit_mode    = $('input[name="unit"]').val();
            var unit_name    = $('#title').html();
            var content_type = '<?=$content_type?>';
            var mode         = $(this).data('mode');

            $('input[name="mode"]').val(mode);
            $('#modal_mode').modal('hide');
            $('#title').html('<?=$title?>'+" "+mode.toUpperCase()+" "+unit_name);
            $.select_mode(subject_mode, unit_mode, content_type, mode);
            $('#modal_ready').modal('show');
        });

        $('.submit_content').on('click', function(){
            $('#submit_content').submit();
        });

        custom_active();

        function custom_active() {
            var subject     = '<?=$subject?>';
            var id_siswa    = '<?=$this->session->userdata('id_siswa')?>';

            $.ajax({
                url     : '<?=base_url()?>dashboard_siswa/get_custom',
                method  : "POST",
                data    : {subject : subject, id_siswa : id_siswa},
                async   : true,
                dataType: 'JSON',
                success : function (callback) {
                    if (callback.mulai_dari != undefined) {
                        var unit_goal = callback.mulai_dari;

                        for (let i = callback.mulai_dari; i >= 0; i--) {
                            $('.unlock_test'+i).html(1);
                        }
                        for (let index = 0; index < callback.unit_aktif.length; index++) {
                            $('#unit_'+callback.unit_aktif[index]).show();
                        }
                    } else {
                        var count = '<?=count($unit_active)?>';

                        for (let index = 0; index <= count; index++) {
                            $('#unit_'+index).show();
                        }
                    }
                }
            });
        }
    });
</script>