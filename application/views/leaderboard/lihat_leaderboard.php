<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div align="center">
                <h1 class="card-inside-title" style="font-size: 28px;">Leaderboard Siswa</h1>
                    <h2>Kantor Cabang : <?=$cabang?></h2>
                    <h2>Level : <?=$level?></h2>
                    <a href="<?=base_url()?>admin/leaderboard" type="button" class="btn btn-xs bg-indigo waves-effect"><i class="material-icons">arrow_back</i><span>KEMBALI</span></a>
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
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach(array_slice($crown, 0, 10) as $cr):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$cr['nama_siswa']?></td>
                                        <td class="text-center"><?=$cr['nama_cabang']?></td>
                                        <td class="text-center"><?=$cr['total']?></td>
                                    </tr>

                                    <?php 
                                        $no++;
                                        endforeach; 
                                    ?>
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
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach(array_slice($fluent,0 ,10) as $f):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$f['nama_siswa']?></td>
                                        <td class="text-center"><?=$f['nama_cabang']?></td>
                                        <td class="text-center"><?=$f['total']?></td>
                                    </tr>

                                    <?php 
                                        $no++;
                                        endforeach;
                                    ?>
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
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach(array_slice($tone,0 ,10) as $t):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$t['nama_siswa']?></td>
                                        <td class="text-center"><?=$t['nama_cabang']?></td>
                                        <td class="text-center"><?=$t['total']?></td>
                                    </tr>

                                    <?php 
                                        $no++;
                                        endforeach ;
                                    ?>
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
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach(array_slice($daily_submit,0 ,10) as $ds):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$ds['nama_siswa']?></td>
                                        <td class="text-center"><?=$ds['nama_cabang']?></td>
                                        <td class="text-center"><?=$ds['total']?></td>
                                    </tr>

                                    <?php 
                                        $no++;
                                        endforeach ;
                                    ?>
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
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach(array_slice($no_mistake,0 ,10) as $nm):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$nm['nama_siswa']?></td>
                                        <td class="text-center"><?=$nm['nama_cabang']?></td>
                                        <td class="text-center"><?=$nm['total']?></td>
                                    </tr>

                                    <?php 
                                        $no++;
                                        endforeach ;
                                    ?>
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
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach(array_slice($champion,0 ,10) as $champ):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$champ['nama_siswa']?></td>
                                        <td class="text-center"><?=$champ['nama_cabang']?></td>
                                        <td class="text-center"><?=$champ['total']?></td>
                                    </tr>

                                    <?php 
                                        $no++;
                                        endforeach ;
                                    ?>
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
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach(array_slice($overall_score,0 ,10) as $os):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$os['nama_siswa']?></td>
                                        <td class="text-center"><?=$os['nama_cabang']?></td>
                                        <td class="text-center"><?=$os['total']?></td>
                                    </tr>

                                    <?php 
                                        $no++;
                                        endforeach ;
                                    ?>
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
            <!-- #END# Input -->