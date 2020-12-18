<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>LOG HARIAN SELFTEST</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <?=form_open('admin/log_selftest')?>
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <b>Dari</b><input type="hidden" id="dari_tanggal" value="<?=$dari?>">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="dari_tanggal" value="<?=$dari?>" placeholder="Mohon Pilih Tanggal Disini...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Sampai</b><input type="hidden" id="sampai_tanggal" value="<?=$sampai?>">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="sampai_tanggal" value="<?=$sampai?>" placeholder="Mohon Pilih Tanggal Disini...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">

                                                <button type="submit" name="submit" class="btn bg-grey btn-xs waves-effect">
                                                    <i class="material-icons">date_range</i>
                                                    <span>SELECT TANGGAL</span>
                                                </button>
                                            </div>
                        <?=form_close()?>   
                                            <div class="col-sm-6">
                                                <?=form_open('export/export_log_quiz')?>
                                                    <input type="text" name="dari_tanggal" value="<?=$dari?>" hidden>
                                                    <input type="text" name="sampai_tanggal" value="<?=$sampai?>" hidden>
                                                    <input type="text" name="mode" value="selftest" hidden>
                                                    <button type="submit" class="btn bg-red btn-xs waves-effect">
                                                        <i class="material-icons">file_download</i>
                                                            <span>Export Excel</span>
                                                    </button>
                                                <?=form_close()?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="height: 480px; width: 100%; top: 50px; bottom: 0; overflow-y: scroll;">
                                <table class="table table-bordered table-striped table-hover data_quiz">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID Siswa</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Level</th>
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Subject</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Content Type</th>
                                            <th class="text-center">Completion</th>
                                            <th class="text-center">Persen</th>
                                            <th class="text-center">Try</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center">Tanggal Upload</th>
                                            <th class="text-center">Tanggal Masehi</th>
                                            <th class="text-center">Jam</th>
                                            <th class="text-center">Mode</th>
                                            <th class="text-center">Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $idAndDate = array();
                                            foreach($log_meaning_quiz as $lm):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$lm['id_siswa']?></td>
                                            <td class="text-center"><?=$lm['nama_siswa']?></td>
                                            <td class="text-center"><?=$lm['level']?></td>
                                            <td class="text-center"><?=$lm['nama_cabang']?></td>
                                            <td class="text-center"><?=$lm['subject']?></td>
                                            <td class="text-center"><?=$lm['unit']?></td>
                                            <td class="text-center">
                                                <?php   $result = getContentConfig($lm['level'], $lm['subject']); 
                                                        if ($result == 1) {
                                                            echo "Meaning";
                                                            } else if($result == 2) {
                                                            echo "Keyword";
                                                            } else if($result == 3) {
                                                            echo "Arranging";
                                                            } else {
                                                            echo "";
                                                            }
                                                ?>
                                            </td>
                                            <td class="text-center">                                                
                                            <?php 
                                                if (!isset($idAndDate[$lm['id_siswa']][$lm['level']][$lm['id_selftest_meaning_quiz']])) $idAndDate[$lm['id_siswa']][$lm['level']][$lm['id_selftest_meaning_quiz']] = "";
                                                                                    
                                                if ($lm['completion'] == '100') {
                                                    echo "Passed";
                                                } else {
                                                    $jumlah_soal = $lm['jumlah_benar']+$lm['jumlah_salah'];
                                                    echo $lm['jumlah_benar']."/".$jumlah_soal;
                                                }
                                            ?>
                                            </td>
                                            <td class="text-center"><?=$lm['completion'].'%'?></td>
                                            <td class="text-center"><?=$lm['try']?></td>
                                            <td class="text-center"><?=$lm['time']?></td>
                                            <td class="text-center"><?=$lm['tgl_upload']?></td>
                                            <td class="text-center"><?=$lm['tgl_sebenarnya']?></td>
                                            <td class="text-center"><?=$lm['jam']?></td>
                                            <td class="text-center"><?=ucwords(str_replace('_', ' ', $lm['mode']))?></td>
                                            <td class="text-center">
                                                <?= form_open('selftest/selftest_print', 'target="_blank"') ?>
                                                    <input type="hidden" name="content_type" value="<?=getContentConfig($lm['level'], $lm['subject'])?>">
                                                    <input type="hidden" name="session" value="<?=$lm['session']?>">
                                                    <button type="submit" class="btn btn-info btn-xs"><i class="material-icons"> print </i>     <span> Print </span></button>
                                                <?= form_close(); ?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>

                                        <?php foreach($log_keyword_quiz as $lk) : ?>
                                        <tr>
                                            <td class="text-center"><?=$lk['id_siswa']?></td>
                                            <td class="text-center"><?=$lk['nama_siswa']?></td>
                                            <td class="text-center"><?=$lk['level']?></td>
                                            <td class="text-center"><?=$lk['nama_cabang']?></td>
                                            <td class="text-center"><?=$lk['subject']?></td>
                                            <td class="text-center"><?=$lk['unit']?></td>
                                            <td class="text-center">
                                                <?php   $result = getContentConfig($lk['level'], $lk['subject']); 
                                                        if ($result == 1) {
                                                            echo "Meaning";
                                                            } else if($result == 2) {
                                                            echo "Keyword";
                                                            } else if($result == 3) {
                                                            echo "Arranging";
                                                            } else {
                                                            echo "";
                                                            }
                                                ?>
                                            </td>
                                            <td class="text-center">                                                
                                            <?php 
                                                if (!isset($idAndDate[$lk['id_siswa']][$lk['level']][$lk['id_selftest_keyword_quiz']])) $idAndDate[$lk['id_siswa']][$lk['level']][$lk['id_selftest_keyword_quiz']] = "";
                                                                                    
                                                    $idAndDate[$lk['id_siswa']][$lk['level']][$lk['id_selftest_keyword_quiz']] = $lk['tgl_sebenarnya'];
                                                    if ($lk['completion'] == '100') {
                                                        echo "Passed";
                                                    } else {
                                                        $jumlah_soal = $lk['jumlah_benar']+$lk['jumlah_salah'];
                                                        echo $lk['jumlah_benar']."/".$jumlah_soal;
                                                    }
                                            ?>
                                            </td>
                                            <td class="text-center"><?=$lk['completion'].'%'?></td>
                                            <td class="text-center"><?=$lk['try']?></td>
                                            <td class="text-center"><?=$lk['time']?></td>
                                            <td class="text-center"><?=$lk['tgl_upload']?></td>
                                            <td class="text-center"><?=$lk['tgl_sebenarnya']?></td>
                                            <td class="text-center"><?=$lk['jam']?></td>
                                            <td class="text-center"><?=ucwords(str_replace('_', ' ', $lk['mode']))?></td>
                                            <td class="text-center">
                                                <?= form_open('selftest/selftest_print', 'target="_blank"') ?>
                                                    <input type="hidden" name="content_type" value="<?=getContentConfig($lk['level'], $lk['subject'])?>">
                                                    <input type="hidden" name="session" value="<?=$lk['session']?>">
                                                    <button type="submit" class="btn btn-info btn-xs"><i class="material-icons"> print </i>     <span> Print </span></button>
                                                <?= form_close(); ?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>

                                        <?php foreach($log_arranging_quiz as $la) : ?>
                                        <tr>
                                            <td class="text-center"><?=$la['id_siswa']?></td>
                                            <td class="text-center"><?=$la['nama_siswa']?></td>
                                            <td class="text-center"><?=$la['level']?></td>
                                            <td class="text-center"><?=$la['nama_cabang']?></td>
                                            <td class="text-center"><?=$la['subject']?></td>
                                            <td class="text-center"><?=$la['unit']?></td>
                                            <td class="text-center">
                                                <?php   $result = getContentConfig($la['level'], $la['subject']); 
                                                        if ($result == 1) {
                                                            echo "Meaning";
                                                            } else if($result == 2) {
                                                            echo "Keyword";
                                                            } else if($result == 3) {
                                                            echo "Arranging";
                                                            } else {
                                                            echo "";
                                                            }
                                                ?>
                                            </td>
                                            <td class="text-center">                                                
                                            <?php 
                                                if (!isset($idAndDate[$la['id_siswa']][$la['level']][$la['id_selftest_arranging_quiz']])) $idAndDate[$la['id_siswa']][$la['level']][$la['id_selftest_arranging_quiz']] = "";
                                                                                    
                                                    $idAndDate[$la['id_siswa']][$la['level']][$la['id_selftest_arranging_quiz']] = $la['tgl_sebenarnya'];
                                                    if ($la['completion'] == '100') {
                                                        echo "Passed";
                                                    } else {
                                                        $jumlah_soal = $la['jumlah_benar']+$la['jumlah_salah'];
                                                        echo $la['jumlah_benar']."/".$jumlah_soal;
                                                    }
                                            ?>
                                            </td>
                                            <td class="text-center"><?=$la['completion'].'%'?></td>
                                            <td class="text-center"><?=$la['try']?></td>
                                            <td class="text-center"><?=$la['time']?></td>
                                            <td class="text-center"><?=$la['tgl_upload']?></td>
                                            <td class="text-center"><?=$la['tgl_sebenarnya']?></td>
                                            <td class="text-center"><?=$la['jam']?></td>
                                            <td class="text-center"><?=ucwords(str_replace('_', ' ', $la['mode']))?></td>
                                            <td class="text-center">
                                                <?= form_open('selftest/selftest_print', 'target="_blank"') ?>
                                                    <input type="hidden" name="content_type" value="<?=getContentConfig($la['level'], $la['subject'])?>">
                                                    <input type="hidden" name="session" value="<?=$la['session']?>">
                                                    <button type="submit" class="btn btn-info btn-xs"><i class="material-icons"> print </i>     <span> Print </span></button>
                                                <?= form_close(); ?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {

    $('.data_quiz').DataTable( {
        "order": [[ 8, 'desc' ], [ 9, 'desc' ]],
        "info" :false,
        "searching" :true,
        "lengthChange" :false,
        "paging":false
    });
});
</script>