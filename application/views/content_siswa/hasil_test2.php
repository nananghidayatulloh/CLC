<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        /* @page { margin-top: 15px; margin-left: 15px;} */
        body{
            font-size: 12px;
            width: auto;
            height: 595px;
            font-family : sans-serif;
            /* background: #F19999; */
        }

        .header { 
            position: fixed; 
            height: 151px; 
            width: 100%; 
            background: teal; 
            display: block;  
        }

        .main{ 
            margin-top: 50px;
            z-index: 20;
            height: 100px; 
            width: 100%; 
            background: cyan; 
            display: block; 
        }
        
        .page-first{
            width : 50%;
            /* background: red; */
            float: left;
        }

        .page-second {
            width: 50%;
            /* background: green; */
            float: right;
        }

        .page-thirt {
            width: 100%;
            padding-right: 3%;
            padding-top: 15%;
            /* background: red; */
        }

        .img-logo {
            margin-left: 35px;
            width: 70%;
        }

        .text-center {
            text-align: center;
        }

        .pt--15 {
            padding-top: -15px;
        }

        .table {
            margin-left : 10px;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-spacing: 0;
        }
        
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .tr-score, .th-score, .td-score {
            border: 1px solid black;
        }

        .th-score {
            padding : 6.2px;
        }

        .th-second {
            padding : 2px;
        }

        .pull-right {
            float: right;
        }

        .pull-left {
            float: left;
        }

        .score {
            padding-left: -15px;
        }

        .font-mandarin {
            font-family:'Kaiti' !important;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="page-first">
            <img src="<?=base_url()?>assets/CLC-Logo11.png" alt="logo_clc.png" class="img-logo">
            <h3 class="text-center pt--15"><?=$content_type." ".ucwords($data['mode'])?></h3>
                <div class="score">
                    <table class="table text-center">
                        <tbody>
                            <tr class="tr-score">
                                <th class="th-score" style="background-color:<?=$color?> !important">Score</th>
                                <td class="td-score" colspan="2" style="background-color:<?=$color?> !important"><?=$data['jumlah_benar']?> / <?=$data['jumlah_salah'] + $data['jumlah_benar']?></td>
                            </tr>
                            <tr>
                                <th class="th-score" style="background-color:<?=$color?> !important">%</th>
                                <td class="td-score" style="background-color:<?=$color?> !important"><?=$data['completion']?>%</td>
                                <td class="td-score" style="background-color:<?=$color?> !important">-<?=$data['jumlah_salah']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
        <!-- <h1>ibmphp.blogspot.com</h1> -->
        <div class="page-second">
            <table class="table text-center">
                <tbody>
                    <tr>
                        <th class="th-second">Name Student :</th>
                        <td style="background-color:<?=$color?> !important"><?=getNamaSiswa($data['id_siswa'])?></td>
                    </tr>
                    <tr>
                        <th class="th-second">Student ID :</th>
                        <td><?=$data['id_siswa']?></td>
                    </tr>
                    <tr>
                        <th class="th-second">Product / Class :</th>
                        <td><?=ucwords(getProdukName($data['id_siswa'])." / ".getClassName($data['id_siswa']))?></td>
                    </tr>
                    <tr>
                        <th class="th-second">Subject :</th>
                        <td style="background-color:<?=$color?> !important"><?=getNameSubject($data['subject'], $data['level'])?></td>
                    </tr>
                    <tr>
                        <th class="th-second">Unit :</th>
                        <td style="background-color:<?=$color?> !important"><?=getNameUnit($data['subject'], $data['unit'])?></td>
                    </tr>
                    <tr>
                        <th class="th-second">Exam Time :</th>
                        <td><?=$data['tgl_sebenarnya']." ".$data['jam']?></td>
                    </tr>
                    <tr>
                        <th class="th-second">Time Elapsed :</th>
                        <td><?=$data['time']?></td>
                    </tr>
                    <tr>
                        <th class="th-second">Exam :</th>
                        <td style="background-color:<?=$color?> !important"><?=$data['try']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="main">
        <?php $this->load->view($content_table)?>
    </div>
</body>
</html>