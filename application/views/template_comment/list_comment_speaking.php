<section class="content">
    <div class="container-fluid">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('simpan');?>"></div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Template Comment Daily Speaking
                        <button type="button" class="btn bg-teal btn-xs waves-effect" onclick="$.addMore()" id="addBtn">
                            <i class="material-icons">add</i>
                                <span>Tambah</span>
                        </button>
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Comment</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table_comment">
                                <?php 
                                    $no = 1;
                                    foreach($template as $tmp):
                                ?>
                                <tr id="tr<?=$tmp['id']?>">
                                    <td class="text-center"><?=$no?></td>
                                    <td class="text-center">
                                        <input type="text" id="comment<?=$tmp['id']?>" class="form-control" style="width:100%" name="comment" value="<?=$tmp['comment']?>" oninput="$.editBg(<?=$tmp['id']?>)" onchange="$.save(<?=$tmp['id']?>)" maxlength="140">
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="btn bg-red btn-xs waves-effect" title="Delete" onclick="$.delete(<?=$tmp['id']?>)"><i class="material-icons">delete</i><span>Delete</span></button>
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
</section>
<script>
$(document).ready(function() {
    $.addMore = function(){
        document.getElementById("addBtn").disabled = true;
        var moreColumn =    `<tr id="trnew">
                                <td class="text-center">`+<?=$no?>+`</td>
                                <td class="text-center">
                                    <input id="commentnew" type="text" name="comment" class="form-control" value="" style="width:100%" oninput="$.editBg('new')" onchange="$.save('new')" maxlength="140">
                                </td>
                                <td class="text-center"></td>
                            </tr>`;
        $("#table_comment").append(moreColumn);
    }
    $.save = function(id){
        var comment = $("#comment"+id).val();
            dataString = 'id='+id+'&comment='+comment+'&mode=0'
        $.ajax({
            url: "<?=base_url()?>admin/template_comment_speaking",
            type: 'POST',
            data: dataString,
            success: function(output){
                $("tr[id='tr"+id+"']").css("background-color", "");
                if (id == "new") {
                    swal.fire('Berhasil!', output, 'success');
                    window.setInterval(function(){
                        location.reload();
                    }, 2500);
                } else {
                    swal.fire('Berhasil!', output, 'success');
                    window.setInterval(function(){
                        location.reload();
                    }, 2500);
                }
            }
        });
    }
    $.editBg = function(i){
        $("tr[id='tr"+i+"']").css("background-color", "#FFDAA3");
    }
    $.delete = function(id){
        var dataString = 'id='+id+'&mode=1';
        Swal.fire({
                title: 'Yakin akan menghapus data ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya'
            }).then(function(isConfirm) {
                if (isConfirm.value) {
                    $.ajax({
                        url : "<?=base_url()?>admin/template_comment_speaking",
                        type: "POST",
                        data: dataString,
                        success : function(output){
                            swal.fire('Berhasil!', output, 'success');
                            $("tr[id='tr"+id+"']").remove();
                                window.setInterval(function(){
                                    location.reload();
                                }, 3000);
                        }
                    });
                }
            })
    }
});
</script>