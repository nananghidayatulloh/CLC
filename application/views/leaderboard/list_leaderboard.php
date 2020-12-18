<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LEADERBOARD</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <!-- <?=form_open('admin/leaderboard_lihat')?> -->
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <b>Kantor Cabang</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">place</i>
                                            </span>
                                            <div class="form-line">
                                                <!-- <input type="date" class="form-control date"  name="dari_tanggal"> -->
                                                <select class="form-control show-tick" name="id_cabang" id="id_cabang" required>
                                                    <option value=""> - Pilih Cabang - </option>
                                                    <option value="0">ALL</option>
                                                    <?php
                                                        foreach($cabang as $c):
                                                    ?>
                                                    <option value="<?=$c['id_cabang']?>"><?=$c['nama_cabang']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Level</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">filter_list</i>
                                            </span>
                                            <select class="form-control show-tick" name="id_level" id="id_level" required>
                                                <option value=""> - Pilih Level - </option>
                                                <?php
                                                    foreach($level as $l):
                                                ?>
                                                <option value="<?=$l['id_level']?>"><?=$l['id_level']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                            <button type="submit" name="submit" id="btn_proses" disabled class="btn btn-block btn-success btn-xs waves-effect">
                                                <i class="material-icons">sync</i>
                                                <span id="html_proses">PROSES</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- <?=form_close()?> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="coba" style="display:none">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div align="center">
                            <h1 class="card-inside-title" style="font-size: 28px;">Leaderboard Siswa</h1>
                            <h4>Kantor Cabang : <span id="nama_cabang"></span></h4>
                            <h4>Level : <span id="nama_level"></span></h4>
                        </div>
                            <div class="body">
                                <ul class="nav nav-tabs tab-col-amber" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#crown" data-toggle="tab">CROWN</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#fluent" data-toggle="tab">FLUENT</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tone" data-toggle="tab">TONE</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#daily_submit" data-toggle="tab">DAILY SUBMIT</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#no_mistake" data-toggle="tab">NO MISTAKE</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#champion" data-toggle="tab">CHAMPION</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#overall_score" data-toggle="tab">OVERALL SCORE</a>
                                    </li>
                                </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="crown">
                                    <div align="center">
                                        <h2 style="font-size:22px;">Top 10 Crown</h2>
                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Rank</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_crown">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="fluent">
                                    <div align="center">
                                        <h2 style="font-size:22px;">Top 10 Fluent</h2>
                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Rank</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_fluent">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tone">
                                    <div align="center">
                                        <h2 style="font-size:22px;">Top 10 Tone</h2>
                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Rank</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_tone">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="daily_submit">
                                    <div align="center">
                                        <h2 style="font-size:22px;">Top 10 Daily Submit</h2>
                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Rank</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_daily_submit">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="no_mistake">
                                    <div align="center">
                                        <h2 style="font-size:22px;">Top 10 No Mistake</h2>
                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Rank</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_no_mistake">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="champion">
                                    <div align="center">
                                        <h2 style="font-size:22px;">Top 10 Champion</h2>
                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Rank</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_champion">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="overall_score">
                                    <div align="center">
                                        <h2 style="font-size:22px;">Top 10 Overall Score</h2>
                                    </div>
                                    <div class="body table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Rank</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_overall_score">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modal_proses" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div align="center">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-amber">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>                    
            </div>
            <span style="color: white;">Mohon Tunggu Sebentar...</span>
        </div>
    </div>
</div>
<script>
    function enabled_button() {
        if (id_cabang != "" && id_level != "") {
            $("#btn_proses").attr("disabled", false);
        } else {
            $("#btn_proses").attr("disabled", true);
        }
    }
    $(document).ready(function(){
        $('#id_cabang').on("change", function () {
            id = $(this).val();
            id_cabang = id;
            enabled_button();
        });

        $('#id_level').on("change", function() {
            id_1 = $(this).val();
            id_level = id_1;
            enabled_button();
        });
    });

    $(document).ready(function(){
        $('#btn_proses').on("click", function() {
            id_cabang   = $('#id_cabang').val();
            id_level    = $('#id_level').val();
            $.ajax({
                url: "<?=base_url()?>admin/proses_leaderboard",
                type: "POST",
                data : "id_cabang="+id_cabang+"&id_level="+id_level,
                success: function(data) {
                    var parse         = JSON.parse(data);
                        nama_cabang   = parse.nama_cabang;
                        ////======= Crown List========////
                        slice_crown   = parse['crown'].slice(0, 10);
                        crown_length  = slice_crown.length;
                        html_crown    = "";

                        ////======= Fluent List========////
                        slice_fluent  = parse['fluent'].slice(0, 10);
                        fluent_length = slice_fluent.length;
                        html_fluent   = "";

                        ////======= Tone List========////
                        slice_tone  = parse['tone'].slice(0, 10);
                        tone_length = slice_tone.length;
                        html_tone   = "";

                        ////======= Daily Submit List========////
                        slice_daily_submit  = parse['daily_submit'].slice(0, 10);
                        daily_submit_length = slice_daily_submit.length;
                        html_daily_submit   = "";

                        ////======= No Mistake List========////
                        slice_no_mistake  = parse['no_mistake'].slice(0, 10);
                        no_mistake_length = slice_no_mistake.length;
                        html_no_mistake   = "";

                        ////======= Champion List========////
                        slice_champion  = parse['champion'].slice(0, 10);
                        champion_length = slice_champion.length;
                        html_champion   = "";

                        ////======= Overall Score List========////
                        slice_overall_score  = parse['overall_score'].slice(0, 10);
                        overall_score_length = slice_overall_score.length;
                        html_overall_score   = "";

                        no_crown = 1;
                        for (var i = 0; i < crown_length; i++) {
                            html_crown +=   `<tr>
                                                <td class="text-center">`+no_crown+`</td>
                                                <td class="text-center">`+slice_crown[i]['nama_siswa']+`</td>
                                                <td class="text-center">`+slice_crown[i]['nama_cabang']+`</td>
                                                <td class="text-center">`+slice_crown[i]['total']+`</td>
                                            </tr>`;
                            no_crown++
                        }

                        no_fluent = 1;
                        for (var i = 0; i < fluent_length; i++) {
                            html_fluent +=   `<tr>
                                                <td class="text-center">`+no_fluent+`</td>
                                                <td class="text-center">`+slice_fluent[i]['nama_siswa']+`</td>
                                                <td class="text-center">`+slice_fluent[i]['nama_cabang']+`</td>
                                                <td class="text-center">`+slice_fluent[i]['total']+`</td>
                                            </tr>`;
                            no_fluent++
                        }

                        no_tone = 1;
                        for (var i = 0; i < tone_length; i++) {
                            html_tone +=   `<tr>
                                                <td class="text-center">`+no_tone+`</td>
                                                <td class="text-center">`+slice_tone[i]['nama_siswa']+`</td>
                                                <td class="text-center">`+slice_tone[i]['nama_cabang']+`</td>
                                                <td class="text-center">`+slice_tone[i]['total']+`</td>
                                            </tr>`;
                            no_tone++
                        }

                        no_daily_submit = 1;
                        for (var i = 0; i < daily_submit_length; i++) {
                            html_daily_submit +=   `<tr>
                                                <td class="text-center">`+no_daily_submit+`</td>
                                                <td class="text-center">`+slice_daily_submit[i]['nama_siswa']+`</td>
                                                <td class="text-center">`+slice_daily_submit[i]['nama_cabang']+`</td>
                                                <td class="text-center">`+slice_daily_submit[i]['total']+`</td>
                                            </tr>`;
                            no_daily_submit++
                        }

                        no_no_mistake = 1;
                        for (var i = 0; i < no_mistake_length; i++) {
                            html_no_mistake +=   `<tr>
                                                <td class="text-center">`+no_no_mistake+`</td>
                                                <td class="text-center">`+slice_no_mistake[i]['nama_siswa']+`</td>
                                                <td class="text-center">`+slice_no_mistake[i]['nama_cabang']+`</td>
                                                <td class="text-center">`+slice_no_mistake[i]['total']+`</td>
                                            </tr>`;
                            no_no_mistake++
                        }

                        no_champion = 1;
                        for (var i = 0; i < champion_length; i++) {
                            html_champion +=   `<tr>
                                                <td class="text-center">`+no_champion+`</td>
                                                <td class="text-center">`+slice_champion[i]['nama_siswa']+`</td>
                                                <td class="text-center">`+slice_champion[i]['nama_cabang']+`</td>
                                                <td class="text-center">`+slice_champion[i]['total']+`</td>
                                            </tr>`;
                            no_champion++
                        }
                        
                        no_overall_score = 1;
                        for (var i = 0; i < overall_score_length; i++) {
                            html_overall_score +=   `<tr>
                                                <td class="text-center">`+no_overall_score+`</td>
                                                <td class="text-center">`+slice_overall_score[i]['nama_siswa']+`</td>
                                                <td class="text-center">`+slice_overall_score[i]['nama_cabang']+`</td>
                                                <td class="text-center">`+slice_overall_score[i]['total']+`</td>
                                            </tr>`;
                            no_overall_score++
                        }

                        $('#nama_level').html(parse.id_level);
                        $('#nama_cabang').html(nama_cabang);
                        $('#tbl_crown').html(html_crown);
                        $('#tbl_fluent').html(html_fluent);
                        $('#tbl_tone').html(html_tone);
                        $('#tbl_daily_submit').html(html_daily_submit);
                        $('#tbl_no_mistake').html(html_no_mistake);
                        $('#tbl_champion').html(html_champion);
                        $('#tbl_overall_score').html(html_overall_score);
                        $('#modal_proses').modal('hide');
                        $("#coba").slideDown();
                }
            });
        })
    });
    
</script>