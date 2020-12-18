<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_admin();

        //fungsi tampil data admin
        function tampil_data_admin(){
            $.ajax({
                type     : 'ajax';
                url      : '<?=base_url()?>admin/data_admin',
                async    : false,
                dataType : 'json',
                success  : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td class="text-center">'+data[$i].username+'</td>'
                                '<td class="text-center">'+data[$i].password+'</td>'
                                '<td class="text-center">'+data[$i].level+'</td>'
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].id_admin+'">Edit</a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+data[i].id_admin+'">Hapus</a>'+
                                '</td>'+
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }
            });
        }
    })
</script>