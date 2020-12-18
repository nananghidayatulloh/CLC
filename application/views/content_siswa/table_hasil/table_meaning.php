<?php 
    if ($data['completion'] != 100) {
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
    } else {
        $explode_jawaban_benar = explode('%', $data['jawaban_benar']);
        $data_array = [];
        for ($i=0; $i < count($explode_jawaban_benar)-1 ; $i++) { 
            $data_array[$i] = explode('?', $explode_jawaban_benar[$i]);
        }
    }

    $array_table = [4, 9, 14, 19, 24, 29, 34, 39];
?>
<?php $no = 0; ?>
<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="width:25%; text-decoration: underline;">Question</th>
            <th class="text-center" style="width:25%; border-right: 3px solid #000 !important; text-decoration: underline;">Choices</th>
            <th class="text-center" colspan="2" style="text-decoration: underline;">Reviews</th>
        </tr>
    </thead>
    <tbody style="font-family:'Noto Serif SC' !important;">
        <?php for ($i=0; $i < 5 ; $i++) : ?>
            <tr>
                <td class="text-center">
                    <div style="color:black; font-size:12.5px !important">
                        <?php $exp_question = explode(" ", $data_array[$i][0])?>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <?php foreach($exp_question as $question) : ?>                                    
                                            <td class="text-center">
                                                <?php if ($pinyin_result == 1) { 
                                                    echo $list_pinyin[$question];
                                                } else {
                                                    echo "<br>";
                                                }
                                                ?>
                                            </td>
                                        <?php endforeach;?>
                                    </tr>

                                    <tr>
                                        <?php foreach($exp_question as $question) : ?>                                    
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important"><?=$question?></span>
                                            </td>
                                        <?php endforeach;?>

                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </td>
                <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">
                    <?=$data_array[$i][1]?>
                </td>
                <?php if ($data['completion'] != 100) : ?>
                    <td class="text-center" style="border-bottom: 2px solid #000">
                        <div style="color:red; font-size:12.5px !important">
                            <?php $exp_review = explode(" ", $jawaban_sebenarnya[$no][0])?>
                            <table class="table" style="width:90% !important">
                                <tbody>
                                    <tr>
                                        <?php foreach($exp_review as $review) : ?>
                                            <td class="text-center">
                                                <?php if ($pinyin_result == 1) {
                                                    echo $list_pinyin[$review];
                                                } else {
                                                    echo "<br>";
                                                }?> 
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                    <tr>
                                        <?php foreach($exp_review as $review) : ?>
                                            <td class="text-center">
                                                <span class="font-mandarin" style="font-size: 23px !important"><?=$review?></span>                                              
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>

                    <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000"><?=$jawaban_sebenarnya[$no][1]?></td>
                <?php else : ?>
                    <td class="text-center" style="border-bottom: 2px solid #000;">
                        <div style="color:black; font-size:12.5px !important">
                            <?php $exp_question = explode(" ", $data_array[$i][0])?>
                                <table class="table" style="width: 90% !important;">
                                    <tr style="border: 0 !important;">
                                        <?php foreach($exp_question as $question) : ?>                                    
                                            <td style = "padding: 0px; border:0 !important; font-size: 11px" align="center">
                                                <?php if ($pinyin_result == 1) { 
                                                    echo $list_pinyin[$question];
                                                } else {
                                                    echo "<br>";
                                                }?>
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                    <tr style="border: 0">
                                        <?php foreach($exp_question as $question) : ?>                                    
                                            <td style = "padding: 0px; border:0!important"  align="center">
                                                <span style="color:black; font-size: 27px !important; font-family:'Kaiti' !important;"><?=$question?></span>
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                </table>
                        </div>
                    </td>
                    <td class="text-center" style="color:red !important; vertical-align:middle; border-bottom: 2px solid #000 !important;">
                        <?=$data_array[$i][1]?>
                    </td>
                <?php endif;?>
            </tr>
        <?php $no++; endfor;?>
    </tbody>
    
    <div style="position : fixed; margin-top: 43rem; z-index:1000;"> HK C01 FCR <?=getNameUnit($data['subject'], $data['unit'])?> - CMT</div>
    <div style="position : fixed; margin-top: 40rem; margin-left:20rem; font-size:20px; font-weight:bold; z-index:1000;"> M 28 TI</div>
</table>



<?php foreach($array_table as $key => $table) : ?>
    <?php if(count($data_array) != $table + 1) : ?>
        <?php if($no > $array_table[$key] ) : ?>
            <?php if(count($data_array) < $array_table[$key] + 6 ) {
                $count = count($data_array);
            } else {
                $count = $array_table[$key] + 6;
            }
            ?>
            <section class="section"></section>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" style="width:25%; text-decoration: underline;">Question</th>
                        <th class="text-center" style="width:25%; border-right: 3px solid #000 !important; text-decoration: underline;">Choices</th>
                        <th class="text-center" colspan="2" style="text-decoration: underline;">Reviews</th>
                    </tr>
                </thead>
                <tbody style="font-family:'Noto Serif SC' !important;">
                    <?php for ($i=$array_table[$key] + 1; $i < $count ; $i++) : ?>
                        <tr>
                            <td class="text-center">
                                <div style="color:black; font-size:12.5px !important">
                                    <?php $exp_question = explode(" ", $data_array[$i][0])?>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <?php foreach($exp_question as $question) : ?>                                    
                                                        <td class="text-center">
                                                            <?php if ($pinyin_result == 1) { 
                                                                    echo $list_pinyin[$question];
                                                                } else {
                                                                    echo "<br>";
                                                                }
                                                            ?>                                                
                                                        </td>
                                                    <?php endforeach;?>
                                                </tr>

                                                <tr>
                                                    <?php foreach($exp_question as $question) : ?>                                    
                                                        <td class="text-center">
                                                            <span class="font-mandarin" style="font-size: 23px !important"><?=$question?></span>
                                                        </td>
                                                    <?php endforeach;?>

                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </td>
                            <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;">
                                <?=$data_array[$i][1]?>
                            </td>
                            <?php if ($data['completion'] != 100) : ?>
                                <td class="text-center" style="border-bottom: 2px solid #000">
                                    <div style="color:red; font-size:12.5px !important">
                                        <?php $exp_review = explode(" ", $jawaban_sebenarnya[$no][0])?>
                                        <table class="table" style="width:90% !important">
                                            <tbody>
                                                <tr>
                                                    <?php foreach($exp_review as $review) : ?>
                                                        <td class="text-center">
                                                            <?php if ($pinyin_result == 1) { 
                                                                    echo $list_pinyin[$review];
                                                                } else {
                                                                    echo "<br>";
                                                                }
                                                            ?>                                                
                                                        </td>
                                                    <?php endforeach;?>
                                                </tr>
                                                <tr>
                                                    <?php foreach($exp_review as $review) : ?>
                                                        <td class="text-center">
                                                            <span class="font-mandarin" style="font-size: 23px !important"><?=$review?></span>                                              
                                                        </td>
                                                    <?php endforeach;?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>

                                <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000"><?=$jawaban_sebenarnya[$no][1]?></td>
                            <?php else : ?>
                                <td class="text-center" style="border-bottom: 2px solid #000;">
                                    <div style="color:black; font-size:12.5px !important">
                                        <?php $exp_question = explode(" ", $data_array[$i][0])?>
                                            <table class="table" style="width: 90% !important;">
                                                <tr style="border: 0 !important;">
                                                    <?php foreach($exp_question as $question) : ?>                                    
                                                        <td style = "padding: 0px; border:0 !important; font-size: 11px" align="center">
                                                            <?php if ($pinyin_result == 1) { 
                                                                    echo $list_pinyin[$question];
                                                                } else {
                                                                    echo "<br>";
                                                                }
                                                            ?>                                                
                                                        </td>
                                                    <?php endforeach;?>
                                                </tr>
                                                <tr style="border: 0">
                                                    <?php foreach($exp_question as $question) : ?>                                    
                                                        <td style = "padding: 0px; border:0!important"  align="center">
                                                            <span style="color:black; font-size: 27px !important; font-family:'Kaiti' !important;"><?=$question?></span>
                                                        </td>
                                                    <?php endforeach;?>
                                                </tr>
                                            </table>
                                    </div>
                                </td>
                                <td class="text-center" style="color:red !important; vertical-align:middle; border-bottom: 2px solid #000 !important;">
                                    <?=$data_array[$i][1]?>
                                </td>
                            <?php endif;?>
                        </tr>
                    <?php $no++; endfor;?>
                </tbody>

                <div style="position : fixed; margin-top: 43rem; z-index:1000;"> HK C01 FCR <?=getNameUnit($data['subject'], $data['unit'])?> - CMT</div>
                <div style="position : fixed; margin-top: 40rem; margin-left:20rem; font-size:20px; font-weight:bold; z-index:1000;"> M 28 TI</div>
            </table>
        <?php endif;?>
    <?php endif;?>
<?php endforeach;?>
