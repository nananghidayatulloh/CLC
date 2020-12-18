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
?>
<div class="wrapper">
    <div class="page-thirt">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" style="width:25%; text-decoration: underline;">Question</th>
                    <th class="text-center" style="width:25%; border-right: 3px solid #000 !important; text-decoration: underline;">Choices</th>
                    <th class="text-center" colspan="2" style="text-decoration: underline;">Reviews</th>
                </tr>
            </thead>
            <tbody style="font-family:'Noto Serif SC' !important;">
                <?php $no = 0; foreach($data_array as $array) : ?>
                <tr>
                    <td class="text-center">
                        <div style="color:black; font-size:12.5px !important">
                            <?php $exp_question = explode(" ", $array[0])?>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <?php foreach($exp_question as $question) : ?>
                                                <td class="text-center font-mandarin">
                                                    <?php if ($pinyin_result == 1) echo $list_pinyin[$question];?>
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
                    <td class="text-center" style="color:red !important; vertical-align:middle; border-right: 3px solid #000 !important;"><?=$array[1]?></td>
                    <td class="text-center" style="border-bottom: 2px solid #000">
                        <div style="color:red; font-size:12.5px !important">
                            <table class="table" style="width:90% !important">
                                <tbody>
                                    <tr>
                                        <td class="text-center font-mandarin">wú</td>
                                        <td class="text-center font-mandarin">lǐ</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="font-mandarin" style="font-size: 23px !important">无</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="font-mandarin" style="font-size: 23px !important">礼</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td class="text-center" style="color:blue !important; vertical-align:middle; border-bottom: 2px solid #000">No matter</td>
                </tr>
                <?php $no++; endforeach;?>
            </tbody>
        </table>
    </div>
</div>