<section class="content">
    <div class="container-fluid">
        <!-- Notifikasi -->
        <?php 
            if ($this->session->flashdata('simpan')){
            echo '<div class="flash-akun" data-flashakun="'.$this->session->flashdata('simpan').'"></div>';
            } else if ($this->session->flashdata('salah')){
            echo '<div class="flash-error" data-flasherror="'.$this->session->flashdata('salah').'"></div>';
            }
        ?>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Daftar Talk Mandarin
                            <!-- <a href="<?=base_url()?>admin/level_siswa_tambah" type="button" class="btn bg-teal btn-xs waves-effect">
                                <i class="material-icons">add</i>
                                <span>Tambah</span>
                            </a> -->
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%;">No</th>
                                        <th class="text-center" style="width:5%;">Level</th>
                                        <th class="text-center">Jumlah Unit</th>
                                        <th class="text-center" style="width:55%;">Unit</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                            foreach($level as $lvl): 
                                    ?>
                                    <tr id="tr<?=$no;?>">
                                        <td class="text-center"><?=$no?>.</td>
                                        <td class="text-center"><?=$lvl['id_level']?>
                                            <input type="hidden" id="id_level<?=$no?>" value="<?=$lvl['id_level']?>">
                                        </td>
                                        <td class="text-center">
                                            <input type="type" class="text-center" style="width:80px"  id="total_unit<?=$no?>" name="total_unit<?=$no?>" value="<?=$lvl['total_unit']?>" onchange="$.totalUnitChange(<?=$no?>)" oninput="this.onchange()" >
                                            
                                        </td>
                                        <td class="text-center" id="unit<?=$no?>"></td>
                                            <input type="hidden" id="isi_unit<?=$no?>" value="<?=$lvl['unit_talk_mandarin']?>">
                                        <td class="text-center">
                                            <a type="button" id="button" onclick="$.submit(<?=$no?>)"  class="btn bg-orange btn-xs waves-effect" title="Edit"><i class="material-icons">create</i><span>Edit</span></a>
                                            <!-- <a href="<?=base_URL()?>admin/talk_mandarin/talk_mandarin_hapus<?=encrypt_url($lvl['id_level'])?>" class="btn btn-xs bg-red waves-effect tombol_hapus" title="Hapus"><i class="material-icons">delete</i><span>Hapus</span></a> -->
                                        </td>
                                    </tr>
                                    <?php $no++; endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>
<script>
    $( document ).ready(function() {
        // var id_level = $("#level").val();
        // console.log(id_level);
        
        $.totalUnitChange = function(t){
            var id = t;
            var total_unit = $("#total_unit"+t).val();
            var unit_aktif = $("#isi_unit"+t).val();
            
            if(unit_aktif != null){
                var unit_aktif_split = unit_aktif.split("-");
            }
            
            // inisialisasi checkbox untuk unit
            $("td[id='unit"+id+"']").html("");
            var indexunit = 0;
            for(var i = 1; i <= total_unit; i++){
                if(unit_aktif_split[indexunit] == i){
                    var txt1 = `<div class="switch" style='display:inline-block;'>
                                    <div class="demo-switch-title">`+i+`</div>
                                        <label><input type="checkbox" id='unit`+id+`' name='unit[]' value='`+i+`' onchange='$.editBg(`+id+`)' checked><span class="lever switch-col-amber"></span></label>
                                    </div>
                                `;
                    indexunit++;
                }else{
                    var txt1 = `<div class='switch' style='display: inline-block'>
                                    <div class="demo-switch-title">`+i+`</div>
                                        <label><input type="checkbox" id='unit`+id+`' name='unit[]' value='`+i+`' onchange='$.editBg(`+id+`)'><span class="lever switch-col-amber"></span></label>
                                    </div>
                                </div>`;                         
                }
                $("td[id='unit"+id+"']").append(txt1);
            }
            
        }

        $.editBg = function(i){
            $("tr[id='tr"+i+"']").css("background-color", "#9EDBFF");
        }
        $.submit = function(button){
            var unit = $("input[id='unit"+button+"']:checked").serialize();
            var id_level = $("#id_level"+button).val();
            var total_unit = $("#total_unit"+button).val();
                $.ajax({
                url: "<?=base_url()?>talk_mandarin/talk_mandarin_edit?"+unit+"&id_level="+id_level+"&total_unit="+total_unit,
                type: 'GET',
                success: function(){
                    Swal('Berhasil','Berhasil Merubah Data', 'success');
                    $("tr[id='tr"+button+"']").css("background-color", "");
                },
            });
        }
        var index = <?=$no-1;?>;
        for(var i = 1; i <= index; i++){
            $.totalUnitChange(i);
        }
        
    });
</script>