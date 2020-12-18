<div class="container-fluid">
    <div class="justify-content-center">
        <div class="card max-width-card">
                <div class="body margin-bottom-body">
                    <div class="row justify-content-center">
                        <!-- <div class="max-width-col"> -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <ul class="list-group text-center">
                                    <li class="list-group-item font-bold font-30" style="border:none; padding:2px;"> 
                                        <a href="<?=base_url()?>dashboard_siswa" class="btn btn-sm btn-warning waves-effect pull-left" style="margin-top:6px"> Back </a>
                                        <span><?=strtoupper($title)?></span>
                                    </li>
                                </ul>
                                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                    <li role="presentation" class="active"><a href="#meaning" data-toggle="tab">Meaning</a></li>
                                    <li role="presentation"><a href="#keyword" data-toggle="tab">Keyword</a></li>
                                    <li role="presentation"><a href="#arranging" data-toggle="tab">Arranging</a></li>
                                </ul>
                                <div class="tab-content">
                                  <div role="tabpanel" class="tab-pane fade in active" id="meaning">
                                    <div class="body table-responsive">
                                        <table class="table table-bordered table-striped table-hover table_history">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Level</th>
                                                    <th class="text-center">Subject</th>
                                                    <th class="text-center">Unit</th>
                                                    <th class="text-center">Content Type</th>
                                                    <th class="text-center">Mode</th>
                                                    <th class="text-center">Try</th>
                                                    <th class="text-center">Time</th>
                                                    <th class="text-center">Score</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach($meaning_spontan as $ms) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$ms['tgl_upload']?>
                                                            <div><small><?=$ms['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$ms['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($ms['subject'])?></td>
                                                        <td class="text-center"><?=getNameUnit($ms['subject'], $ms['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($ms['level'], $ms['subject']); 
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
                                                        <td class="text-center"><?=ucwords($ms['mode'])?></td>
                                                        <td class="text-center"><?=$ms['try']?></td>
                                                        <td class="text-center"><?=$ms['time']?></td>
                                                        <td class="text-center"><?=$ms['jumlah_benar']?>/<?=$ms['jumlah_benar']+$ms['jumlah_salah']?>(<?=$ms['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                                <input type="hidden" name="content_type" value="<?=getContentConfig($ms['level'], $ms['subject'])?>">
                                                                <input type="hidden" name="session" value="<?=$ms['session']?>">
                                                                <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($meaning_practice  as $mp) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$mp['tgl_upload']?>
                                                        <div><small><?=$mp['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$mp['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($mp['subject'], $mp['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($mp['subject'], $mp['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($mp['level'], $mp['subject']); 
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
                                                        <td class="text-center"><?=ucwords($mp['mode'])?></td>
                                                        <td class="text-center"><?=$mp['try']?></td>
                                                        <td class="text-center"><?=$mp['time']?></td>
                                                        <td class="text-center"><?=$mp['jumlah_benar']?>/<?=$mp['jumlah_benar']+$mp['jumlah_salah']?>(<?=$mp['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($mp['level'], $mp['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$mp['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($meaning_test  as $mt) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$mt['tgl_upload']?>
                                                        <div><small><?=$mt['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$mt['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($mt['subject'], $mt['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($mt['subject'], $mt['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($mt['level'], $mt['subject']); 
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
                                                        <td class="text-center"><?=ucwords($mt['mode'])?></td>
                                                        <td class="text-center"><?=$mt['try']?></td>
                                                        <td class="text-center"><?=$mt['time']?></td>
                                                        <td class="text-center"><?=$mt['jumlah_benar']?>/<?=$mt['jumlah_benar']+$mt['jumlah_salah']?>(<?=$mt['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                                <input type="hidden" name="content_type" value="<?=getContentConfig($mt['level'], $mt['subject'])?>">
                                                                <input type="hidden" name="session" value="<?=$mt['session']?>">
                                                                <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($meaning_review  as $mr) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$mr['tgl_upload']?>
                                                        <div><small><?=$mr['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$mr['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($mr['subject'], $mr['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($mr['subject'], $mr['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($mr['level'], $mr['subject']); 
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
                                                        <td class="text-center"><?=ucwords($mr['mode'])?></td>
                                                        <td class="text-center"><?=$mr['try']?></td>
                                                        <td class="text-center"><?=$mr['time']?></td>
                                                        <td class="text-center"><?=$mr['jumlah_benar']?>/<?=$mr['jumlah_benar']+$mr['jumlah_salah']?>(<?=$mr['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                                <input type="hidden" name="content_type" value="<?=getContentConfig($mr['level'], $mr['subject'])?>">
                                                                <input type="hidden" name="session" value="<?=$mr['session']?>">
                                                                <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($keyword_spontan  as $ks) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$ks['tgl_upload']?>
                                                        <div><small><?=$ks['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$ks['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($ks['subject'], $ks['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($ks['subject'], $ks['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($ks['level'], $ks['subject']); 
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
                                                        <td class="text-center"><?=ucwords($ks['mode'])?></td>
                                                        <td class="text-center"><?=$ks['try']?></td>
                                                        <td class="text-center"><?=$ks['time']?></td>
                                                        <td class="text-center"><?=$ks['jumlah_benar']?>/<?=$ks['jumlah_benar']+$ks['jumlah_salah']?>(<?=$ks['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($ks['level'], $ks['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$ks['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($keyword_practice  as $kp) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$kp['tgl_upload']?>
                                                        <div><small><?=$kp['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$kp['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($kp['subject'], $kp['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($kp['subject'], $kp['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($kp['level'], $kp['subject']); 
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
                                                        <td class="text-center"><?=ucwords($kp['mode'])?></td>
                                                        <td class="text-center"><?=$kp['try']?></td>
                                                        <td class="text-center"><?=$kp['time']?></td>
                                                        <td class="text-center"><?=$kp['jumlah_benar']?>/<?=$kp['jumlah_benar']+$kp['jumlah_salah']?>(<?=$kp['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($kp['level'], $kp['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$kp['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close();?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($keyword_test  as $kt) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$kt['tgl_upload']?>
                                                        <div><small><?=$kt['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$kt['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($kt['subject'], $kt['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($kt['subject'], $kt['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($kt['level'], $kt['subject']); 
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
                                                        <td class="text-center"><?=ucwords($kt['mode'])?></td>
                                                        <td class="text-center"><?=$kt['try']?></td>
                                                        <td class="text-center"><?=$kt['time']?></td>
                                                        <td class="text-center"><?=$kt['jumlah_benar']?>/<?=$kt['jumlah_benar']+$kt['jumlah_salah']?>(<?=$kt['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($kt['level'], $kt['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$kt['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($keyword_review  as $kr) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$kr['tgl_upload']?>
                                                        <div><small><?=$kr['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$kr['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($kr['subject'], $kr['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($kr['subject'], $kr['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($kr['level'], $kr['subject']); 
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
                                                        <td class="text-center"><?=ucwords($kr['mode'])?></td>
                                                        <td class="text-center"><?=$kr['try']?></td>
                                                        <td class="text-center"><?=$kr['time']?></td>
                                                        <td class="text-center"><?=$kr['jumlah_benar']?>/<?=$kr['jumlah_benar']+$kr['jumlah_salah']?>(<?=$kr['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($kr['level'], $kr['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$kr['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($arranging_spontan  as $as) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$as['tgl_upload']?>
                                                        <div><small><?=$as['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$as['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($as['subject'], $as['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($as['subject'], $as['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($as['level'], $as['subject']); 
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
                                                        <td class="text-center"><?=ucwords($as['mode'])?></td>
                                                        <td class="text-center"><?=$as['try']?></td>
                                                        <td class="text-center"><?=$as['time']?></td>
                                                        <td class="text-center"><?=$as['jumlah_benar']?>/<?=$as['jumlah_benar']+$as['jumlah_salah']?>(<?=$as['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($as['level'], $as['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$as['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($arranging_practice  as $ap) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$ap['tgl_upload']?>
                                                        <div><small><?=$ap['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$ap['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($ap['subject'], $ap['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($ap['subject'], $ap['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($ap['level'], $ap['subject']); 
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
                                                        <td class="text-center"><?=ucwords($ap['mode'])?></td>
                                                        <td class="text-center"><?=$ap['try']?></td>
                                                        <td class="text-center"><?=$ap['time']?></td>
                                                        <td class="text-center"><?=$ap['jumlah_benar']?>/<?=$ap['jumlah_benar']+$ap['jumlah_salah']?>(<?=$ap['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($ap['level'], $ap['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$ap['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($arranging_test  as $at) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$at['tgl_upload']?>
                                                        <div><small><?=$at['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$at['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($at['subject'], $at['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($at['subject'], $at['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($at['level'], $at['subject']); 
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
                                                        <td class="text-center"><?=ucwords($at['mode'])?></td>
                                                        <td class="text-center"><?=$at['try']?></td>
                                                        <td class="text-center"><?=$at['time']?></td>
                                                        <td class="text-center"><?=$at['jumlah_benar']?>/<?=$at['jumlah_benar']+$at['jumlah_salah']?>(<?=$at['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($at['level'], $at['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$at['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                                <?php foreach($arranging_review  as $ar) :?>
                                                    <tr>
                                                        <td class="text-center"><?=$no?>.</td>
                                                        <td class="text-center"><?=$ar['tgl_upload']?>
                                                        <div><small><?=$ar['tgl_sebenarnya']?></small></div>
                                                        </td>
                                                        <td class="text-center"><?=$ar['level']?></td>
                                                        <td class="text-center"><?=getNameSubject($ar['subject'], $ar['level'])?></td>
                                                        <td class="text-center"><?=getNameUnit($ar['subject'], $ar['unit'])?></td>
                                                        <td class="text-center">
                                                            <?php   $result = getContentConfig($ar['level'], $ar['subject']); 
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
                                                        <td class="text-center"><?=ucwords($ar['mode'])?></td>
                                                        <td class="text-center"><?=$ar['try']?></td>
                                                        <td class="text-center"><?=$ar['time']?></td>
                                                        <td class="text-center"><?=$ar['jumlah_benar']?>/<?=$ar['jumlah_benar']+$ar['jumlah_salah']?>(<?=$ar['completion']?>%)</td>
                                                        <td class="text-center">
                                                            <?=form_open('dashboard_siswa/callback_test')?>
                                                            <input type="hidden" name="content_type" value="<?=getContentConfig($ar['level'], $ar['subject'])?>">
                                                            <input type="hidden" name="session" value="<?=$ar['session']?>">
                                                            <button type="submit" class="btn btn-sm bg-teal">View</button>
                                                            <?=form_close()?>
                                                        </td>
                                                    </tr>
                                                <?php $no++; endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="keyword">
                                      <b>Profile Content</b>
                                      <p>
                                          Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                          Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                          pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                          sadipscing mel.
                                      </p>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="arranging">
                                      <b>Message Content</b>
                                      <p>
                                          Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                          Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                          pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                          sadipscing mel.
                                      </p>
                                  </div>
                              </div>
                                
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
        </div>
    </div>
</div>