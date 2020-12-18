<?php 
    $explode_jawaban_sebenarnya = explode('%', $data['jawaban_sebenarnya']);
    $jawaban_sebenarnya = [];
    for ($i=0; $i < count($explode_jawaban_sebenarnya)-1 ; $i++) { 
        $jawaban_sebenarnya[$i] = explode('?', $explode_jawaban_sebenarnya[$i]);
    }

    $array_table = [3, 7, 11, 15, 19, 23, 27, 31, 35, 39];
?>
<?php $no = 0; ?>
<table class="table">
    <tbody>
        <?php for ($i=0; $i < 4 ; $i++) : ?>
        <tr>
            <td style="vertical-align:middle; border-bottom: 2px #000 solid;" class="text-center"><?=$i+1?>.</td>
            <?php if($jawaban_sebenarnya[$i][1] == ' ') : ?>
                <td class="text-center" style="vertical-align:middle; border-bottom: 2px #000 solid;"><img src="<?=base_url('assets/icon/icons-completed.png')?>" alt=""></td>
            <?php else :?>
                <td class="text-center" style="vertical-align:middle; border-bottom: 2px #000 solid;"><img src="<?=base_url('assets/icon/icons-cross.png')?>" style="height: 0.8rem;"> </td>
            <?php endif;?>
            <td class="text-left" style="font-size: 12px !important; border-bottom: 2px #000 solid;" >
                <table border="0">
                    <?php $explode_data = explode(" ", $jawaban_sebenarnya[$i][0] ); ?>
                    <tr style="border: 0 !important">
                        <?php foreach($explode_data as $jawaban) :?>
                            <td style = "padding: 0px; border:0 !important; font-size: 11px" align="center">
                                <?php echo $retVal = ($pinyin_result == 1) ? (isset($list_pinyin[$jawaban]) ? $list_pinyin[$jawaban] : '' ) : '';?>
                            </td>
                        <?php endforeach;?>
                    </tr>
                    <tr style="border: 0 !important">
                        <?php foreach($explode_data as $jawaban) :?>
                            <td style = "font-family:'Kaiti' !important; padding:5px; border:0 !important; font-size: 12px" align="center">
                                <?=$jawaban;?>
                            </td>
                            <!-- <?=$nbsp;?> -->
                        <?php endforeach;?>
                    </tr>
                </table>
                <?php if($jawaban_sebenarnya[$i][1] != ' ') : ?>
                    <table border="0">
                        <?php $explode_data1 = explode(" ", $jawaban_sebenarnya[$i][1]); ?>
                        <tr style="border: 0 !important">
                            <?php foreach($explode_data1 as $jawaban1) :?>
                                <td style = "padding: 0px; border:0 !important; font-size: 11px; color:red !important" align="center">
                                <?php echo $retVal1 = ($pinyin_result == 1) ? $list_pinyin[$jawaban1] : '';?>
                                </td>
                            <?php endforeach;?>
                        </tr>
                        <tr style="border: 0 !important">
                            <?php foreach($explode_data1 as $jawaban1) :?>
                                <td style = "font-family:'Kaiti' !important;  padding:5px; border:0 !important; font-size: 12px; color:red !important" align="center">
                                    <?=$jawaban1;?>
                                </td>
                            <?php endforeach;?>
                        </tr>
                    </table>
                <?php endif;?>
            </td>
        </tr>
        <?php $no++; endfor;?>
    </tbody>
</table>

<?php foreach($array_table as $key => $table) : ?>
    <?php if(count($jawaban_sebenarnya) != $table + 1) : ?>
        <?php if($no > $array_table[$key] ) : ?>
            <?php if(count($jawaban_sebenarnya) < $array_table[$key] + 5 ) {
                $count = count($jawaban_sebenarnya);
            } else {
                $count = $array_table[$key] + 5;
            }
            ?>
            <section class="section"></section>

            <table class="table">
                <tbody>
                    <?php for ($i=$array_table[$key] + 1; $i < $count ; $i++) : ?>
                    <tr>
                        <td style="vertical-align:middle; border-bottom: 2px #000 solid;" class="text-center"><?=$i+1?>.</td>
                        <?php if($jawaban_sebenarnya[$i][1] == ' ') : ?>
                            <td class="text-center" style="vertical-align:middle; border-bottom: 2px #000 solid;"><img src="<?=base_url('assets/icon/icons-completed.png')?>" alt=""></td>
                        <?php else :?>
                            <td class="text-center" style="vertical-align:middle; border-bottom: 2px #000 solid;"><img src="<?=base_url('assets/icon/icons-cross.png')?>" style="height: 0.8rem;"> </td>
                        <?php endif;?>
                        <td class="text-left" style="font-size: 12px !important; border-bottom: 2px #000 solid;" >
                            <table border="0">
                                <?php $explode_data = explode(" ", $jawaban_sebenarnya[$i][0] ); ?>
                                <tr style="border: 0 !important">
                                    <?php foreach($explode_data as $jawaban) :?>
                                        <td style = "padding: 0px; border:0 !important; font-size: 11px" align="center">
                                            <?php echo $retVal = ($pinyin_result == 1) ? (isset($list_pinyin[$jawaban]) ? $list_pinyin[$jawaban] : '' ) : '';?>
                                        </td>
                                    <?php endforeach;?>
                                </tr>
                                <tr style="border: 0 !important">
                                    <?php foreach($explode_data as $jawaban) :?>
                                        <td style = "font-family:'Kaiti' !important; padding:5px; border:0 !important; font-size: 12px" align="center">
                                            <?=$jawaban;?>
                                        </td>
                                        <!-- <?=$nbsp;?> -->
                                    <?php endforeach;?>
                                </tr>
                            </table>
                            <?php if($jawaban_sebenarnya[$i][1] != ' ') : ?>
                                <table border="0">
                                    <?php $explode_data1 = explode(" ", $jawaban_sebenarnya[$i][1]); ?>
                                    <tr style="border: 0 !important">
                                        <?php foreach($explode_data1 as $jawaban1) :?>
                                            <td style = "padding: 0px; border:0 !important; font-size: 11px; color:red !important" align="center">
                                            <?php echo $retVal1 = ($pinyin_result == 1) ? $list_pinyin[$jawaban1] : '';?>
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                    <tr style="border: 0 !important">
                                        <?php foreach($explode_data1 as $jawaban1) :?>
                                            <td style = "font-family:'Kaiti' !important;  padding:5px; border:0 !important; font-size: 12px; color:red !important" align="center">
                                                <?=$jawaban1;?>
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                </table>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php $no++; endfor;?>
                </tbody>
            </table>
            <?php endif;?>
    <?php endif;?>
<?php endforeach;?>