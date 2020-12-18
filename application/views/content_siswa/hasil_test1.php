<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>CLC Mandarin</title>
    </head>
        <section class="container">
            <div class="container-fluid">
                <div class="card">
                    <?php 
                        $explode_jawaban_salah = explode('%', $data['jawaban_salah']);
                        $data_array = [];
                        for ($i=0; $i < count($explode_jawaban_salah)-1 ; $i++) { 
                            $data_array[$i] = explode('?', $explode_jawaban_salah[$i]);
                        }
    
                        $explode_jawaban_sebenarnya = explode('%', $data['jawaban_sebenarnya']);
                        $jawaban_sebenarnya = [];
                        for ($i=0; $i < count($explode_jawaban_sebenarnya)-1 ; $i++) { 
                            $jawaban_sebenarnya[$i] = explode('?', $explode_jawaban_sebenarnya[$i]);
                        }
                    ?>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3 class="text-center" style="color:#555"><?=$content_type?></h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th class="text-center">Score</th>
                                                            <td colspan="2" class="text-center"><?=$data['jumlah_benar']?> / <?=$data['jumlah_salah'] + $data['jumlah_benar']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">%</th>
                                                            <td class="text-center"><?=$data['completion']?>%</td>
                                                            <td class="text-center">-<?=$data['jumlah_salah']?></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">Name Student</th>
                                                <td style="background-color:<?=$color?>" class="font-bold"><?=$data['id_siswa']?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Student ID</th>
                                                <td class="font-bold"><?=$data['id_siswa']?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Class</th>
                                                <td class="font-bold"><?=$data['level']?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Unit</th>
                                                <td style="background-color:<?=$color?>" class="font-bold"><?=$data['unit']?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Exam Time</th>
                                                <td class="font-bold"><?=$data['tgl_sebenarnya']." ".$data['jam']?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Time Elapsed</th>
                                                <td class="font-bold"><?=$data['time']?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Exam</th>
                                                <td style="background-color:<?=$color?>" class="font-bold"><?=$data['try']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:25%;">Question</th>
                                                <th class="text-center" style="width:25%;">Choices</th>
                                                <th class="text-center" colspan="2">Reviews</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; foreach($data_array as $data) : ?>
                                                <tr>
                                                    <td class="text-center"><?=$data[0]?></td>
                                                    <td class="text-center red"><?=$data[1]?></td>
                                                    <td class="text-center red"><?=$jawaban_sebenarnya[$no][0]?></td>
                                                    <td class="text-center blue"><?=$jawaban_sebenarnya[$no][1]?></td>
                                                </tr>
                                            <?php $no++; endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>