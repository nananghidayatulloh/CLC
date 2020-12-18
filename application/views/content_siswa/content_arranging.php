<script>
    var data_question   = [];
    var count_per_page  = [];
    var jumlah_answer   = [];
    var total_quiz      = 0;
    var answer = [];
</script>
<div class="container-fluid">
    <div class="justify-content-center">
        <div class="card max-width-card">
            <div class="body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php $no = 1; for($i=0; $i < count($random_arranging); $i++) : ?>
                            <ul class="list-group" id="list_group<?=$i+1?>" style="display:none;">
                                <?php for ($k=0; $k < count($random_arranging[$i]); $k++) : ?>
                                    <li class="list-group-item text-center answer_<?=$i+1?>_<?=$no?>" style="font-size: calc(20px + (26 - 14) * ((100vw - 300px) / (1600 - 300))); border-left:none; border-top:none; border-right:none; border-bottom: 0px solid #ddd;">
                                            <span class="pull-left position_question_<?=$i+1?>_<?=$no?>"><?=trim($no)?>.</span>
                                            <script>
                                                var group = '<?=$i+1?>';
                                                var no = '<?=$no?>';
                                                data_question['data_question_'+group+'_'+no] = "";
                                            </script>
                                                <?php 
                                                    $kataPertama = $data_quiz['list_pertanyaan'][$i][$random_arranging[$i][$k]][0];
                                                    shuffle($data_quiz['list_pertanyaan'][$i][$random_arranging[$i][$k]])
                                                ?>
                                                    <?php $group = $i+1; for ($j=0; $j < count($data_quiz['list_pertanyaan'][$i][$random_arranging[$i][$k]]); $j++) : ?>
                                                        <?php
                                                            $warnaBg = ""; 
                                                            if ($data_quiz['list_pertanyaan'][$i][$random_arranging[$i][$k]][$j] == $kataPertama) { 
                                                                $warnaBg = "bg-orange";
                                                            } else {
                                                                $warnaBg = "bg-green";
                                                            }                                                   
                                                        ?>
                                                        <span class="label <?=$warnaBg;?> empty_<?=$group."_".$no?> question_<?=$group."_".$no."_".$j?> m-l-5" style="font-family:'Kaiti' !important; font-size:25px" role="button" onclick="$.question('<?=$group?>', '<?=$no?>', '<?=$j?>')"><?=trim($data_quiz['list_pertanyaan'][$i][$random_arranging[$i][$k]][$j])?></span>

                                                        <script>
                                                            data_question['data_question_'+'<?=$group."_".$no?>'] += `<span class="label <?=$warnaBg;?> empty_<?=$group."_".$no?> question_<?=$group."_".$no."_".$j?> m-l-5" style="font-family:'Kaiti' !important; font-size:25px" role="button" onclick="$.question('<?=$group?>', '<?=$no?>', '<?=$j?>')"><?=trim($data_quiz['list_pertanyaan'][$i][$random_arranging[$i][$k]][$j])?></span>`;
                                                        </script>
                                                    <?php endfor;?>

                                            <span><button class="btn bg-teal btn-circle waves-effect waves-circle waves-float pull-right refresh" data-refresh="<?=$group."_".$no?>"><i class="material-icons">refresh</i></button></span>
                                    </li>
                                    <hr style="border-top: 10px solid #eee; margin-left:7%; margin-right:7%;">
                                    <li class="list-group-item target_question_<?=$i+1?>_<?=$no?> text-center" style="font-size: calc(29px + (26 - 14) * ((100vw - 300px) / (1600 - 300))); border-left:none; border-top:none; border-right:none; border-bottom: 5px solid #ddd; margin-left: 7%; margin-top: 1%; margin-right:7%; font-family:'Kaiti' !important"></li>
                                <?php $no++; endfor;?>
                                <script>
                                    count_per_page[count_per_page.length] = parseInt('<?=count($random_arranging[$i])?>');
                                    jumlah_answer[jumlah_answer.length] = parseInt(akumulasi) + parseInt('<?=count($random_arranging[$i])?>');
                                    total_quiz += parseInt('<?=count($random_arranging[$i])?>');
                                </script>
                            </ul>
                        <?php endfor;?>
                        <p align="right"> page: <span id="page"></span> / <?=count($data_quiz['list_pertanyaan'])?></p>
                        <nav>
                            <ul class="pager">
                                <li class="previous">
                                    <a type="button" class="waves-effect btn btn-sm btn-warning" id="btn_prev"><i class="material-icons">navigate_before</i><span aria-hidden="true"> Prev </span> </a>
                                </li>
                                <li class="next">
                                    <a type="button" class="waves-effect btn btn-sm btn-warning" <?php echo (count($data_quiz['list_pertanyaan']) > 1) ? '' : 'id="btn_next" style="display:none"' ;?>><span aria-hidden="true"> Next </span><i class="material-icons">navigate_next</i></a>
                                </li>
                            </ul>
                        </nav>
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

        var current_page = 1;
        var records_per_page = 1;
        var count_page = <?=count($data_quiz['list_pertanyaan']);?>;

        var testing_waktu = '<?php echo $this->session->userdata('time_limit') - strtotime(date('H:i:s'))?>';

        var step  = 0;
        var group = "";
        var data  = "";
        var index = "";
        var index_span = "";
        var array_jawaban_user = [];

        $(".hitmundur").countdown({
            until: testing_waktu,
            compact:true,
            onExpiry:waktuHabis,
            onTick: hampirHabis
        });

        var access_token = 0

        function waktuHabis() {
            if (access_token != 0) return; 

            for (let index = 1; index <= count_page; index++) {
                var list_group_length = $('#list_group'+index).children().length;
                array_jawaban_user[index - 1] = [];
                
                for (let i = 0; i < list_group_length; i++) {
                    var sum = i + 1;
                    const answer_length = $('.answer_'+index+'_'+sum+' span').length;
                    array_jawaban_user[index - 1][i] = "";

                    for (let j = 1; j < answer_length; j++) {

                        array_jawaban_user[index - 1][i] += $('.answer_'+index+'_'+sum+' span')[j].textContent;
                        if (j < answer_length - 1)
                            array_jawaban_user[index - 1][i] += " ";
                    }                    
                }
            }

            $.submit_jawaban();
            access_token = 1;
        }

        function hampirHabis(periods){
            if($.countdown.periodsToSeconds(periods) == 30){
                $('.btn_time').removeClass('bg-teal');
               $('.btn_time').addClass('bg-red');
            }
        }

        $.question = function(group, index, index_span){
            $('.question_'+group+'_'+index+'_'+index_span).removeClass('bg-green');
            $('.question_'+group+'_'+index+'_'+index_span).addClass('bg-orange');

            data = $('.question_'+group+'_'+index+'_'+index_span).html();
            $('.target_question_'+group+'_'+index).append(data+" ");
            $('.question_'+group+'_'+index+'_'+index_span).remove();
        };

        $('.refresh').on('click', function(){
            var data_refresh = $(this).data('refresh');
            var index        = 'data_question_'+data_refresh;
            $('.empty_'+data_refresh).remove();
            $('.position_question_'+data_refresh).after(data_question[index]);
            $('.target_question_'+data_refresh).empty();
        });

        function changePage(page)
        {
            var btn_next = document.getElementById("btn_next");
            var btn_prev = document.getElementById("btn_prev");
            var btn_submit = $("#btn_submit");
            var question_table = $("#list_group"+page);
            var page_span = document.getElementById("page");
        
            if (page < 1) page = 1;
            if (page > numPages()) page = numPages();
            page_span.innerHTML = page;

            if (page == 1) {
                btn_prev.style.visibility = "hidden";
                question_table.show();
            } else {
                btn_prev.style.visibility = "visible";
                question_table.show();
            }

        }

        function numPages()
        {
            return Math.ceil(<?=count($data_quiz['list_pertanyaan'])?> / records_per_page);
        }

        $('#btn_prev').on('click', function(){
            $("."+group+"_"+index+"_"+index_span).removeClass('bg-orange');
            $("."+group+"_"+index+"_"+index_span).addClass('bg-green');
            step = 0;
            var question_prevPage = $("#list_group"+current_page);
                question_prevPage.hide();

            var html_next = '<span aria-hidden="true"> Next </span><i class="material-icons">navigate_next</i>';
                $('#btn_next').html(html_next)
            if (current_page > 1) {
                current_page--;
                changePage(current_page);
            }
        });

        $('#btn_next').on('click', function(){
            array_jawaban_user[current_page - 1] = [];

            var idxAwal = (jumlah_answer[current_page - 1] - count_per_page[current_page - 1]);            
            for (let index = 1; index <= count_per_page[current_page - 1]; index++) {
                array_jawaban_user[current_page - 1][index - 1] = $('.target_question_'+current_page+'_'+(index + idxAwal)).html();
                if (array_jawaban_user[current_page - 1][index - 1] == "") {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please complete/fill all the answers.',
                    });
                    return;
                }              
            }

            if (current_page == count_per_page.length - 1) {
                var html_submit = '<i class="material-icons">send</i><span>Submit</span>';
                $('#btn_next').html(html_submit)
            }

            if (current_page == count_per_page.length) {
                $.submit_jawaban();
            } else {
                if (array_jawaban_user[current_page - 1].length == count_per_page[current_page - 1]) {
                    var question_nextPage = $("#list_group"+current_page);
                    question_nextPage.hide();
                    if (current_page < numPages()) {
                        current_page++;
                        changePage(current_page);
                    }
                }
            }
        });

        $('#btn_submit').on('click', function(){
            var list_group_length = $('#list_group'+current_page).children().length;
            array_jawaban_user[current_page - 1] = [];
            
            for (let i = 0; i < list_group_length; i++) {
                var sum = i + 1;
                const answer_length = $('.answer_'+current_page+'_'+sum+' span').length;
                array_jawaban_user[current_page - 1][i] = "";

                for (let j = 1; j < answer_length; j++) {

                    array_jawaban_user[current_page - 1][i] += $('.answer_'+current_page+'_'+sum+' span')[j].textContent;
                    if (j < answer_length - 1)
                        array_jawaban_user[current_page - 1][i] += " ";
                }                    
            }

            $("."+group+"_"+index+"_"+index_span).removeClass('bg-orange');
            $("."+group+"_"+index+"_"+index_span).addClass('bg-green');
            step = 0;

            $.submit_jawaban();
        });

        $.submit_jawaban = function() {
            var jawaban_user = JSON.stringify(array_jawaban_user);
                subject      = '<?=$subject?>';
                unit         = '<?=$unit?>';
                content_type = '<?=$content_type?>';
                mode         = '<?=$mode?>';

            $.ajax({
                url         : '<?=base_url()?>dashboard_siswa/submit_answer_quiz',
                method      : "POST",
                data        : {jawaban_user : jawaban_user, subject : subject, unit : unit, content_type : content_type, mode : mode},
                async       : true,
                dataType    : 'JSON',
                cache       : false,
                success: function (callback) {
                    $('input[name="session"]').val(callback.session);
                    $('input[name="content_type"]').val(callback.content_type);
                    $('#callback_test').submit();
                },

                error : function (data) {
                    alert (data.responseText);
                }
            });
        };
    });
</script>