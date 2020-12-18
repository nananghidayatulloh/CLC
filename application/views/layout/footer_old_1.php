    <script src="<?=base_url()?>assets/plugins/jquery/jquery.js"></script>
    <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/plugins/node-waves/waves.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="<?=base_url()?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="<?=base_url()?>assets/js/pages/ui/tooltips-popovers.js"></script>
    <script src="<?=base_url()?>assets/js/demo.js"></script>
    <script src="<?=base_url()?>assets/plugins/momentjs/moment.js"></script>
    <script src="<?=base_url()?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="<?=base_url()?>assets/js/sweetalert/dist/sweetalert2.all.min.js"></script>
    <script src="<?=base_url()?>assets/js/myscript.js"></script>
    <script src="<?=base_url()?>assets/plugins/light-gallery/js/lightgallery-all.js"></script>
    <script src="<?=base_url()?>assets/js/pages/medias/image-gallery.js"></script>
    <script src="<?=base_url()?>assets/js/admin.js"></script>
    <script src="<?=base_url()?>assets/js/pages/ui/notifications.js"></script>
    <script src="<?=base_url()?>assets/js/pages/examples/sign-in.js"></script>
    <script src="<?=base_url()?>assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="<?=base_url()?>assets/js/pages/ui/modals.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.dialog.js"></script>
    <script src="<?=base_url()?>assets/js/tableexcel.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script>
        $(function () {
            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
            });

            $('.datepicker1').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
            });

            $('.datepicker2').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
            });
        })

        $('#btn_submit').on('click', function () {
            var id   = $('#id').val();
                note = $('#note').val();
                mode = $(this).attr('data-mode');
            if (mode == 0) {
                $.ajax({
                    url: '<?=base_url()?>admin/log_note_edit',
                    type: 'POST',
                    data : {id : id, note : note, mode : mode},
                    success: function (response) {
                        Swal.fire('Berhasil', response, 'success');
                        window.setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                });
            } else {
                $.ajax({
                    url: '<?=base_url()?>admin/log_note_edit',
                    type: 'POST',
                    data : {id : id, note : note, mode : mode},
                    success: function (response) {
                        Swal.fire('Berhasil', response, 'success');
                        window.setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                });
            }
        });

        $('.delete_data').on('click',function(){
            var id  = $(this).attr('data');
                mode = $(this).attr('data-mode');
            Swal.fire({
                title: 'Yakin akan menghapus?',
                text: "Data Ini.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya'
            }).then(function(isConfirm) {
                if (isConfirm.value) {
                    $.ajax({
                        url     : '<?=base_url()?>admin/log_hapus',
                        type    : "POST",
                        data    : {id : id, mode : mode},
                        success: function(feedback){
                            Swal.fire('Kamu', feedback, 'success');
                            window.setTimeout(function(){
                                location.reload(true);
                            }, 1000);
                        }
                    });
                }
            })
        });

        $('.delete_exam').on('click',function(){
            var id  = $(this).attr('data');
            Swal.fire({
                title: 'Yakin akan menghapus?',
                text: "Data Ini.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya'
            }).then(function(isConfirm) {
                if (isConfirm.value) {
                    $.ajax({
                        url     : '<?=base_url()?>admin/log_exam_hapus',
                        type    : "POST",
                        data    : {id : id},
                        success: function(feedback){
                            Swal.fire('Kamu', feedback, 'success');
                            window.setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('.data_exam').DataTable( {
                "order": [],
                "info" :false,
                "searching" :true,
                "lengthChange" :false,
                "paging":false
            } );

            $('#btn_export_quiz').on('click', function(e) {
                e.preventDefault();
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!

                var yyyy = today.getFullYear();
                if (dd < 10) {
                dd = '0' + dd;
                } 
                if (mm < 10) {
                mm = '0' + mm;
                } 
                var today = dd + '/' + mm + '/' + yyyy;
                $(".data_quiz").table2excel({
                    filename: "Laporan Harian Log Dialog ("+today+").xls"
                });
            });

            $('#btn_export_recording').on('click', function(e) {
                e.preventDefault();
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!

                var yyyy = today.getFullYear();
                if (dd < 10) {
                dd = '0' + dd;
                } 
                if (mm < 10) {
                mm = '0' + mm;
                } 
                var today = dd + '/' + mm + '/' + yyyy;
                $(".data_recording").table2excel({
                    filename: "Laporan Harian Log Dialog Recording ("+today+").xls"
                });
            });

            $('#btn_export_exam').on('click', function(e) {
                e.preventDefault();
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!

                var yyyy = today.getFullYear();
                if (dd < 10) {
                dd = '0' + dd;
                } 
                if (mm < 10) {
                mm = '0' + mm;
                } 
                var today = dd + '/' + mm + '/' + yyyy;
                $(".data_exam").table2excel({
                    filename: "Laporan Harian Log Exam ("+today+").xls"
                });
            });
        } );
    </script>
    
</body>
</html>