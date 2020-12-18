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
<table class="table" style="margin-left:<?php echo ($data['completion'] != 100) ? '-5px' : '-17px'; ?>">
    <thead>
        <tr>
            <th class="text-center" style="width:25%; text-decoration: underline;">Question</th>
            <th class="text-center" style="width:25%; border-right: 2px solid #000 !important; text-decoration: underline;">Choices</th>
            <th class="text-center" colspan="2" style="text-decoration: underline;">Reviews</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i < 5 ; $i++) : ?>
            <tr>
                <td class="text-center">
                    <div style="color:black; font-size:12.5px !important">
                        <?php $exp_question = explode(" ", $data_array[$i][0])?>
                            <table class="table" style="margin-bottom: 10px;">
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
                <td class="text-center" style="border-right: 2px solid #000 !important;">
                    <div style="color:black; font-size:12.5px !important;">
                        <?php $exp_question = explode(" ", $data_array[$i][0])?>
                            <table class="table" style="margin-bottom: 10px; margin-right:3px;">
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
                                                <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </td>

                <?php if ($data['completion'] != 100) : ?>
                    <td class="text-center" style=" border-bottom: #000 solid 2px;">
                        <div style="color:black; font-size:12.5px !important;">
                            <?php $exp_question = explode(" ", $jawaban_sebenarnya[$no][0])?>
                                <table class="table" style="margin-bottom: 10px; margin-left:5px; margin-right:3px;">
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
                                                    <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                </td>
                                            <?php endforeach;?>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                <?=$list_inggris[$jawaban_sebenarnya[$no][0]]?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </td>

                    <td class="text-center" style="border-bottom: #000 solid 2px; border-left: #000 solid 2px dotted;">
                        <div style="color:black; font-size:12.5px !important;">
                            <?php $exp_question = explode(" ", $jawaban_sebenarnya[$no][1])?>
                                <table class="table" style="margin-bottom: 10px;">
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
                                                    <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                </td>
                                            <?php endforeach;?>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                <?=$list_inggris2[$jawaban_sebenarnya[$no][0]]?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </td>
                <?php else : ?>
                    <td class="text-center" style=" border-bottom: #000 solid 2px;">
                        <div style="color:black; font-size:12.5px !important;">
                            <?php $exp_question = explode(" ", $data_array[$i][0])?>
                                <table class="table" style="margin-bottom: 10px; margin-left:5px; margin-right:3px;">
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
                                                    <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                </td>
                                            <?php endforeach;?>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                <?=$list_inggris[$data_array[$i][0]]?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </td>

                    <td class="text-center" style="border-bottom: #000 solid 2px; border-left: #000 solid 2px dotted;">
                        <div style="color:black; font-size:12.5px !important;">
                            <?php $exp_question = explode(" ", $data_array[$i][1])?>
                                <table class="table" style="margin-bottom: 10px;">
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
                                                    <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                </td>
                                            <?php endforeach;?>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                <?=$list_inggris[$data_array[$i][0]]?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
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

            <table class="table" style="margin-left:<?php echo ($data['completion'] != 100) ? '-5px' : '-17px'; ?>">
                <thead>
                    <tr>
                        <th class="text-center" style="width:25%; text-decoration: underline;">Question</th>
                        <th class="text-center" style="width:25%; border-right: 2px solid #000 !important; text-decoration: underline;">Choices</th>
                        <th class="text-center" colspan="2" style="text-decoration: underline;">Reviews</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=$array_table[$key] + 1; $i < $count ; $i++) : ?>
                        <tr>
                            <td class="text-center">
                                <div style="color:black; font-size:12.5px !important">
                                    <?php $exp_question = explode(" ", $data_array[$i][0])?>
                                        <table class="table" style="margin-bottom: 10px;">
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
                            <td class="text-center" style="border-right: 2px solid #000 !important;">
                                <div style="color:black; font-size:12.5px !important;">
                                    <?php $exp_question = explode(" ", $data_array[$i][0])?>
                                        <table class="table" style="margin-bottom: 10px; margin-right:3px;">
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
                                                            <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                        </td>
                                                    <?php endforeach;?>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </td>

                            <?php if ($data['completion'] != 100) : ?>
                                <td class="text-center" style=" border-bottom: #000 solid 2px;">
                                    <div style="color:black; font-size:12.5px !important;">
                                        <?php $exp_question = explode(" ", $jawaban_sebenarnya[$no][0])?>
                                            <table class="table" style="margin-bottom: 10px; margin-left:5px; margin-right:3px;">
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
                                                                <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                            </td>
                                                        <?php endforeach;?>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                            <?=$list_inggris[$jawaban_sebenarnya[$no][0]]?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </td>

                                <td class="text-center" style="border-bottom: #000 solid 2px; border-left: #000 solid 2px dotted;">
                                    <div style="color:black; font-size:12.5px !important;">
                                        <?php $exp_question = explode(" ", $jawaban_sebenarnya[$no][1])?>
                                            <table class="table" style="margin-bottom: 10px;">
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
                                                                <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                            </td>
                                                        <?php endforeach;?>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                            <?=$list_inggris2[$jawaban_sebenarnya[$no][0]]?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </td>
                            <?php else : ?>
                                <td class="text-center" style=" border-bottom: #000 solid 2px;">
                                    <div style="color:black; font-size:12.5px !important;">
                                        <?php $exp_question = explode(" ", $data_array[$i][0])?>
                                            <table class="table" style="margin-bottom: 10px; margin-left:5px; margin-right:3px;">
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
                                                                <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                            </td>
                                                        <?php endforeach;?>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                            <?=$list_inggris[$data_array[$i][0]]?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </td>

                                <td class="text-center" style="border-bottom: #000 solid 2px; border-left: #000 solid 2px dotted;">
                                    <div style="color:black; font-size:12.5px !important;">
                                        <?php $exp_question = explode(" ", $data_array[$i][1])?>
                                            <table class="table" style="margin-bottom: 10px;">
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
                                                                <span class="font-mandarin" style="color: red; font-size: 23px !important; "><?=$question?></span>
                                                            </td>
                                                        <?php endforeach;?>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="color:blue;" colspan="<?=count($exp_question)?>">
                                                            <?=$list_inggris[$data_array[$i][0]]?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
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