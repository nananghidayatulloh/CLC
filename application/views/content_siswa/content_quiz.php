<script>
    var array_jawaban_user = {};
    var count_per_page = [];
    var total_quiz = 0;
</script>

<div class="container-fluid">
    <div class="justify-content-center">
        <div class="card max-width-card">
            <div class="body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <?=form_open('dashboard_siswa/submit_matching_quiz')?>
                                <?php for ($i=0; $i < count($data_quiz['list_pertanyaan']); $i++) : ?>
                                    <table class="table table-bordered table-striped table-hover" id="table_question<?=$i+1?>" style="display:none; font-size: 23px;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Question</th>
                                                <th class="text-center">Your Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody id="matching_quiz<?=$i+1?>">
                                            <?php $no = 1; foreach($data_quiz['list_pertanyaan'][$i] as $question):?>
                                            <tr>
                                                <td class="text-center"> <?=$no?> </td>

                                                <?php 
                                                    $attr_id = preg($question).'_'.($i+1)."_pertanyaan";
                                                    $attr_class = "index_question_".($i+1)."_".($no-1);
                                                    $data_value = str_replace(" ", "_", $question);
                                                ?>

                                                <td id="<?=$attr_id?>" class="text-center question <?=$attr_class?>" data-index="<?=$no-1;?>" data-value="<?=$data_value?>" data-find="<?=$attr_id?>" style="font-family:'Kaiti' !important; font-size:30px;"> 
                                                	<span class="material-icons pull-right" id="<?=$attr_id?>_icons" style="font-size: 23px; line-height: 3;">panorama_fish_eye</span>
                                                	<?php $exp_question = explode(" ", $question)?>
					                                <center>
					                                    <table border="0">
					                                        <tr style="border: 0 !important;">
					                                            <?php foreach($exp_question as $q) : ?>
					                                                <td style = "padding: 0px; border:0 !important; font-size: 11px" align="center">
					                                                    <?php if ($data_quiz['pinyin_test'] == 1) echo $data_quiz['list_pinyin'][$q];?>
					                                                </td>
					                                            <?php endforeach;?>
					                                        </tr>
					                                        <tr style="border: 0">
					                                            <?php foreach($exp_question as $q) : ?>
                                                                <td style = "padding: 0px; border:0!important"  align="center">
					                                                    <span style="color:black; font-size: 27px !important; font-family:'Kaiti' !important;"><?=$q?></span>
					                                                </td>
					                                            <?php endforeach;?>
					                                        </tr>
					                                    </table>
					                                </center>
                                                </td>
                                                
                                                <?php
                                                    $attr_id_jwb = preg($data_quiz['list_jawaban'][$i][$no-1])."_".($i+1)."_jawaban";
                                                    $attr_class_jwb = "index_answe_".($i+1)."_".($no-1);
                                                    $data_value_jwb = str_replace(" ", "_", $data_quiz['list_jawaban'][$i][$no-1]);
                                                ?>

                                                <td id="<?=$attr_id_jwb?>_jawaban" class="text-center answer <?=$attr_class_jwb?>" data-value="<?=$data_value_jwb?>" data-find="<?=$attr_id_jwb?>" data-index_answer="<?=$no-1;?>" style="<?php echo $retVal = ($content_type == 2) ? "font-family:'Kaiti' !important; font-size:30px;" : "vertical-align:middle; line-height:2;" ;?>">
                                                    <span class="material-icons pull-left" id="<?=$attr_id_jwb?>_icons" style="font-size: 23px; line-height: 3;">panorama_fish_eye</span> 
                                                        <?php if ($content_type == 2) : ?>
                                                            <?php $exp_answer = explode(" ", $data_quiz['list_jawaban'][$i][$no-1])?>
                                                            
                                                                <center>
                                                                    <table border="0">
                                                                        <tr style="border: 0 !important;">
                                                                            <?php foreach($exp_answer as $ans) : ?>

                                                                            <td style = "padding: 0px; border:0 !important; font-size: 11px" align="center">

                                                                                <?php if ($data_quiz['pinyin_test'] == 1) echo $data_quiz['list_pinyin'][$ans];?>

                                                                            </td>
                                                                            <?php endforeach;?>
                                                                        </tr>
                                                                        <tr style="border: 0">
                                                                            <?php foreach($exp_answer as $ans) : ?>
                                                                            <td style = "padding: 0px; border:0!important"  align="center">
                                                                                <span style="color:black; font-size: 27px !important; font-family:'Kaiti' !important;"><?=$ans?></span>
                                                                            </td>
                                                                            <?php endforeach;?>
                                                                        </tr>
                                                                    </table>
                                                                </center>
                                                        <?php else : ?>
                                                            <?=$data_quiz['list_jawaban'][$i][$no-1]?>
                                                        <?php endif;?>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach;?>
                                        </tbody>
                                    </table>
                                    <script>
                                        count_per_page[count_per_page.length] = parseInt('<?=count($data_quiz['list_pertanyaan'][$i])?>');
                                        total_quiz += parseInt('<?=count($data_quiz['list_pertanyaan'][$i])?>');
                                    </script>
                                <?php endfor;?>
                                    <p align="right"> page: <span id="page"></span> / <?=count($data_quiz['list_pertanyaan'])?>
                                        
                                    </p>
                                    <nav>
                                        <ul class="pager">
                                            <li class="previous">
                                                <a type="button" class="waves-effect btn btn-sm btn-warning" id="btn_prev"><i class="material-icons">navigate_before</i><span aria-hidden="true"> Prev </span> </a>
                                            </li>
                                            <li class="next">
                                                <a href="javascript:void(0)" class="waves-effect btn btn-sm btn-warning pull-right" id="btn_submit" style="display:<?php echo (count($data_quiz['list_pertanyaan']) > 1) ? 'none' : '' ;?>; color:black; font-weight:black;"><i class="material-icons">send</i><span> Submit </span></a>
                                                <a type="button" class="waves-effect btn btn-sm btn-warning" id="btn_next" style="display:<?php echo (count($data_quiz['list_pertanyaan']) > 1) ? '' : 'none' ;?>;"><span aria-hidden="true"> Next </span><i class="material-icons">navigate_next</i></a>
                                            </li>
                                        </ul>
                                    </nav>
                            <?=form_close()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=form_open('dashboard_siswa/callback_test', 'id="callback_test"')?>
        <input type="hidden" name="content_type">
        <input type="hidden" name="session">
    <?=form_close()?>
</div>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    $(function() {
        changePage(1);

        var current_page     = 1;
        var records_per_page = 1;
        var count_page = <?=count($data_quiz['list_pertanyaan']);?>;
        var access_submit = "";
        var testing_waktu = '<?php echo $this->session->userdata('time_limit') - strtotime(date('H:i:s'))?>';
        var cek_data = 0;
        var $this_question_awal = "";
        var id_question_awal = "";
        var $this_question = "";
        var id_question_find = "";
        var id_question_value = "";
        var obj_next_question = "";
        var isScrolling = false;
        
        for (let index = 1; index <= count_page; index++) {
            for (let index_s = 0; index_s < count_per_page[(index - 1)]; index_s++) {
                var index_question = 'index_question_'+index+'_'+index_s;
                var question = $('.'+index_question).data('value');
                if(array_jawaban_user[index] == null) array_jawaban_user[index] = {}
                array_jawaban_user[index][question.split('_').join(' ')] = '';
            }
        }


        $(".hitmundur").countdown({
            until: testing_waktu,
            compact:true,
            onExpiry:waktuHabis,
            onTick: hampirHabis
        });	

        $('#btn_prev').on('click', function(){
            var question_prevPage = $("#table_question"+current_page);
            var answer_prevPage = $("#table_answer"+current_page);
            var btn_submit = $("#btn_submit");
                question_prevPage.hide();
                answer_prevPage.hide();
                btn_submit.hide();
            if (current_page > 1) {
                current_page--;
                changePage(current_page);
            }
        });

        $('#btn_next').on('click', function(){
            var count_question = Object.keys(array_jawaban_user[current_page]).length;
            var count_jawaban  = 0;

            for (let index_jawaban = 0; index_jawaban < count_question; index_jawaban++) {
                var index_user     = 'index_question_'+current_page+'_'+index_jawaban;
                var question_user  = $('.'+index_user).data('value');
                var split_question = question_user.split('_').join(' ');

                if (array_jawaban_user[current_page][split_question] != '') {
                    count_jawaban += 1;
                }
            }

            if( count_jawaban < count_per_page[current_page-1]) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please complete/fill all the answers.',
                });
            } else {
                var question_nextPage = $("#table_question"+current_page);
                var answer_nextPage = $("#table_answer"+current_page);
                    question_nextPage.hide();
                    answer_nextPage.hide();
                if (current_page < numPages()) {
                    current_page++;
                    changePage(current_page);
                }
            }
        });

        $('#btn_submit').on('click', function() {
            var count_jawaban_per_page = Object.keys(array_jawaban_user).length;
            var count_jawaban = 0;
            

            for (let index = 1; index <= count_jawaban_per_page; index++) {
                for (let index_jawaban = 0; index_jawaban < Object.keys(array_jawaban_user[index]).length; index_jawaban++) {
                    var index_user     = 'index_question_'+index+'_'+index_jawaban;
                    var question_user  = $('.'+index_user).data('value');
                    var split_question = question_user.split('_').join(' ');

                    if (array_jawaban_user[index][split_question] != '') {
                        count_jawaban += 1;
                    }
                }
            }

            if(count_jawaban < total_quiz) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please complete/fill all the answers.',
                });
            } else {
                $.submit_jawaban();
            }
        });

        var access_token = 0
        function waktuHabis() {
            if (access_token != 0) return; 
            $.submit_jawaban();
            access_token = 1;
        }

        function hampirHabis(periods){
            if($.countdown.periodsToSeconds(periods) == 20){
                $('.btn_time').removeClass('bg-teal');
                $('.btn_time').addClass('bg-red');
            }
        }

        function changePage(page)
        {
            var btn_next = document.getElementById("btn_next");
            var btn_prev = document.getElementById("btn_prev");
            var btn_submit = $("#btn_submit");
            var question_table = $("#table_question"+page);
            var answer_table = $("#table_answer"+page);
            var page_span = document.getElementById("page");
        
            // Validate page
            if (page < 1) page = 1;
            if (page > numPages()) page = numPages();
            page_span.innerHTML = page;

            if (page == 1) {
                btn_prev.style.visibility = "hidden";
                question_table.show();
                answer_table.show();
            } else {
                btn_prev.style.visibility = "visible";
                question_table.show();
                answer_table.show();
            }

            if (page == numPages()) {
                btn_next.style.visibility = "hidden";
                btn_submit.show();
            } else {
                btn_next.style.visibility = "visible";
            }
        }
        
        $('.question').on('click touchend', function(e){      
            
            e.preventDefault();
            
            if (isScrolling == false) {
                $this_question = $(this);
                id_question_find = $this_question.data('find');
                id_question_value = $this_question.data('value');
                console.log(id_question_value);
                array_jawaban_user[current_page][id_question_value.split('_').join(' ')] = '';

                if(cek_data != 0) {
                    // if ($this_question_awal != "") {
                        var value_awal = $this_question_awal.data('value').split('_').join(' ');
                        array_jawaban_user[current_page][value_awal] = '';

                        $($this_question_awal).css("background-color", "");
                        $('#'+id_question_awal+'_icons').html("panorama_fish_eye").css('color', '');
                        $this_question_awal = "";
                        id_question_awal = "";
                        cek_data = 0;
                    // }
                }

                $this_question_awal = $this_question;
                id_question_awal = id_question_find;
                
                obj_next_question = $this_question.next();
                var find_answer_by_question = $this_question.next().data('find');

                $(this).css("background-color", "#c9faff");
                $('#'+id_question_find+'_icons').html("lens").css('color', '#f2821b');

                $('#'+find_answer_by_question+'_icons').html("panorama_fish_eye").css('color', '');

                cek_data = 1;

                console.log(array_jawaban_user);
            } else {
                isScrolling = false;
            }
        }).on('touchmove', function(e) {
            isScrolling = true;
        });

        $('.answer').on('click touchend', function(e){

            e.preventDefault();
            if (isScrolling == false) {
                $this_question.css('background-color', '');

                if (cek_data != 1) return;
                cek_data = 0;

                var $this_answer = $(this); 
                var id_answer_find  = $this_answer.data('find')
                var id_answer_value = $this_answer.data('value')
                var find_question_by_answer = $this_answer.prev().data('find');                                
                var value_question_by_answer = $this_answer.prev().data('value');
                var repl_id_question = id_question_value.replace(/_/g, " ");

                if (find_question_by_answer != id_question_find) {
                    $('#'+find_question_by_answer+'_icons').html('panorama_fish_eye').css('color', '');
                    array_jawaban_user[current_page][value_question_by_answer.split('_').join(' ')] = "";
                }

                icons = $this_answer.prev().children().html();
                $('#'+id_question_find).after($this_answer);

                if (icons == "panorama_fish_eye") {
                    $('#'+find_question_by_answer).after(obj_next_question);                    
                    $('#'+id_answer_find+'_icons').html('panorama_fish_eye').css('color', '');
                } else {                    
                    array_jawaban_user[current_page][repl_id_question] = "";
                    $('#'+id_answer_find+"_icons").html('panorama_fish_eye').css('color', '');
                }

                $('#'+find_question_by_answer).after(obj_next_question);
                $('#'+id_answer_find+'_icons').html('lens').css('color', '#f2821b');

                if(array_jawaban_user[current_page] == null) array_jawaban_user[current_page] = {};
                array_jawaban_user[current_page][repl_id_question] = id_answer_value.replace(/_/g, " ");

            } else {
                isScrolling = false;
            }
        }).on('touchmove', function(e) {
            isScrolling = true;
        });

        $.submit_jawaban = function() {
            var jawaban_user = JSON.stringify(array_jawaban_user);
            var subject      = '<?=$subject?>';
            var unit         = '<?=$unit?>';
            var content_type = '<?=$content_type?>';
            var mode         = '<?=$mode?>';

            $.ajax({
                url         : '<?=base_url()?>dashboard_siswa/submit_answer_quiz',
                method      : "POST",
                data        : {jawaban_user : jawaban_user, subject : subject, unit : unit, content_type : content_type, mode : mode},
                async       : true,
                dataType    : 'JSON',
                cache       : false,
                success: function (callback) {
                    console.log(callback)
                    $('input[name="session"]').val(callback.session);
                    $('input[name="content_type"]').val(callback.content_type);
                    $('#callback_test').submit();
                },

                error : function (data) {
                    alert (data.responseText);
                }
            });
        };

        function numPages()
        {
            return Math.ceil(<?=count($data_quiz['list_pertanyaan'])?> / records_per_page);
        }
    });
</script>