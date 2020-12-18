<?php
    if ($this->session->flashdata('sukses')) {
        echo '<div class="flash-akun" data-flashakun="'.$this->session->flashdata('sukses').'"></div>';
    } elseif ($this->session->flashdata('simpan')) {
        echo '<div class="flash-data" data-flashdata="'.$this->session->flashdata('simpan').'"></div>';
    } else {
        echo '<div class="flash-error" data-flashdata="'.$this->session->flashdata('gagal').'"></div>';
    }
    $session = $this->session->userdata('role_user');
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>admin/log_daily_reading">
                    <div class="info-box bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">chrome_reader_mode</i>
                        </div>
                        <div class="content">
                            <div style="font-size:12px; margin-top: 0px;">DAILY READING</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="15"><?=$daily_reading?></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>admin/log_dialog">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                                <div style="font-size:12px; margin-bottom: -6px;">DIALOG</div>
                            <div class="content">
                                <div style="font-size:12px; margin-left: -10px;margin-top: -15px;">QUIZ</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="15"><?=$dialog_quiz?></div>
                            </div>
                            <div class="content">
                                <div style="font-size:12px;">RECORDING</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="15"><?=$dialog_recording?></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>admin/log_comprehension">
                    <div class="info-box bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">list</i>
                        </div>
                            <div class="content">
                                <div style="font-size:12px; margin-bottom: -6px;">COMPREHENSION</div>
                                <div class="content">
                                    <div style="font-size:12px; margin-left: -10px;margin-top: -15px;">QUIZ</div>
                                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="15"><?=$comprehension_quiz?></div>
                                </div>
                                <div class="content">
                                    <div style="font-size:12px;">RECORDING</div>
                                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="15"><?=$comprehension_recording?></div>
                                </div>
                            </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>admin/log_exam">
                    <div class="info-box bg-light-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">mic</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size:12px;">EXAM</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="15"><?=$exam?></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>admin/log_daily_speaking">
                    <div class="info-box bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">album</i>
                        </div>
                        <div class="content">
                            <div style="font-size:12px; margin-top: 0px;">DAILY SPEAKING</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="15"><?=$daily_speaking?></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>admin/log_daily_quiz">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">school</i>
                        </div>
                        <div class="content">
                            <div style="font-size:12px; margin-top: 0px;">DAILY QUIZ</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="15"><?=$daily_quiz?></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="<?=base_url()?>admin/log_selftest">
                    <div class="info-box bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">laptop</i>
                        </div>
                        <div class="content">
                                <div style="font-size:12px; margin-bottom: -6px;">SELFTEST</div>
                            <div class="content">
                                <div style="font-size:12px; margin-left: -10px;margin-top: -15px;">MATCHING QUIZ</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="15"><?=$selftest_meaning_quiz?></div>
                            </div>
                            <div class="content">
                                <div style="font-size:12px;">KEYWORD QUIZ</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="15"><?=$selftest_keyword_quiz?></div>
                            </div>
                            <div class="content">
                                <div style="font-size:12px;">ARRANGING QUIZ</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="15"><?=$selftest_arranging_quiz?></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="block-header">
                <h2>KALENDER CLC</h2>
            </div>
            <div class="col-lg-12 well pull-right-lg table-responsive">
                <table class="table table-bordered table-style">
                    <thead>
                        <tr>
                            <input type="hidden" name="bulan" value="" id="input_bulan">
                            <input type="hidden" name="tahun" value="" id="input_tahun">
                            <th colspan="2" class="text-center"><button class="btn btn-xs btn-primary" id="prev" value="PREV"><i class="material-icons">navigate_before</i><span class="icon-name">PREV</span></button></th>
                            <th colspan="4" class="text-center" id="bulan"></th>
                            <th colspan="2" class="text-center"><button class="btn btn-xs btn-primary" id="next" value="NEXT"><span class="icon-name">NEXT</span><i class="material-icons">navigate_next</i></button></th>
                        </tr>
                        <tr>
                            <th class="text-center">WEEK</th>
                            <th class="text-center">SENIN</th>
                            <th class="text-center">SELASA</th>
                            <th class="text-center">RABU</th>
                            <th class="text-center">KAMIS</th>
                            <th class="text-center">JUM'AT</th>
                            <th class="text-center">SABTU</th>
                            <th class="text-center">MINGGU</th>
                        </tr>
                    </thead>
                    <tbody id="table">

                    </tbody>
                        <tr>
                            <th colspan="8" class="text-center"><button class="btn btn-sm btn-primary" id="submit"><i class="material-icons">send</i><span class="icon-name">Submit</span></button></th>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById("next").addEventListener("click", function(e)
    {
        e.preventDefault();
        var next    = $("#next").val();
            bulan   = $("#input_bulan").val();
            tahun   = $("#input_tahun").val();
            data_post(next, bulan, tahun);
    });

    document.getElementById("prev").addEventListener("click", function(e)
    {
        e.preventDefault();
        var prev    = $("#prev").val();
            bulan   = $("#input_bulan").val();
            tahun   = $("#input_tahun").val();
            data_post(prev, bulan, tahun);
    });

    function data_post(id, bulan, tahun)
    {
        $.ajax({
            url     : '<?=base_url()?>dashboard/data_calendar',
            type    : "POST",
            dataType : "json",
            data    : {id : id, bulan : bulan, tahun : tahun},
            success : function(response) {
                var mount  = response['bulan'];
                    year   = response['tahun'];
                    submit = "Submit";
                    $.ajax({
                        url      : '<?=base_url()?>dashboard/calendar',
                        type     : "POST",
                        dataType : "json",
                        data     : {bulan : mount, tahun : year, submit : submit},
                        success  : function(response) {
                            data_calendar(response)
                        }
                    })
            } 
        })
    }

    function data_calendar(data)
    {
        var nama_bulan          = data.bulan_tahun;
            bulan               = $("#input_bulan").val(data.bulan);
            tahun               = $("#input_tahun").val(data.tahun);
            clc_format_length   = data.clc_format.length;
            html_clc_format     = "";
            for (i = 0; i < clc_format_length; i++) {
                var clc_format      = data.clc_format[i];
                    hari            = data.hari[i+1];
                    day_length      = Object.keys(hari).length;
                    html_hari       = "";
                    week            = hari[1];
                    
                    for (j = 1; j <= day_length; j++) {
                        var data_hari   = hari[j];
                            if (data_hari == "0") {
                                data_hari = "";
                            }
                            html_hari   += `<td class="text-center">`+data_hari+`</td>`;
                    }
                    html_clc_format += `<tr>
                                        <td>
                                            <input type="hidden" class="form-control text-center" name="dayofweek`+i+`" id="dayofweek`+i+`" value="`+week+`">
                                            <input type="text" class="form-control text-center" name="week`+i+`" id="week`+i+`" value="`+clc_format+`"></input>
                                        </td>
                                        `+html_hari+`
                                        </tr>`;
            }
            document.getElementById("table").innerHTML = html_clc_format;
            document.getElementById("bulan").innerText = nama_bulan;
    }

    document.getElementById("submit").addEventListener("click", function(e)
    {
        e.preventDefault();
            var dayofweek0 = $("#dayofweek0").val(); dayofweek1 = $("#dayofweek1").val(); dayofweek2 = $("#dayofweek2").val();
                dayofweek3 = $("#dayofweek3").val(); dayofweek4 = $("#dayofweek4").val(); dayofweek5 = $("#dayofweek5").val();
                if (dayofweek5 == undefined) {
                        dayofweek5 = "";
                    }
                
            var week0 = $("#week0").val(); week1 = $("#week1").val(); week2 = $("#week2").val();
                week3 = $("#week3").val(); week4 = $("#week4").val(); week5 = $("#week5").val();
                if (week5 == undefined) {
                    week5 = "undefined";
                }
            bulan     = $("#input_bulan").val();
            tahun     = $("#input_tahun").val();

            $.ajax({
                    url      : "<?=base_url()?>dashboard/post_calendar_clc",
                    type     : "POST",
                    // dataType : "JSON",
                    data     : {dayofweek0 : dayofweek0, dayofweek1 : dayofweek1, dayofweek2 : dayofweek2, dayofweek3 : dayofweek3, dayofweek4 : dayofweek4, dayofweek5 : dayofweek5, week0 : week0, week1 : week1, week2 : week2, week3 : week3, week4 : week4, week5 : week5, bulan : bulan, tahun: tahun},
                    success  : function(data) {
                        Swal.fire('Berhasil', 'Save Data', 'success');
                    }
                });
            
    })

    $(document).ready(function()
    {
        tampil_data();
        function tampil_data() {
            $.ajax({
                type: 'ajax',
                url : '<?=base_url()?>dashboard/calendar',
                async : true,
                method: "POST",
                dataType : 'json',
                contentType: "application/json",
                success : function(data){
                    data_calendar(data);
                },
            });
        }
    })
</script>