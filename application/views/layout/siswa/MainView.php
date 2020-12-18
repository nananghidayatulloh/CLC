<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>CLC Mandarin</title>
        <link rel="icon" href="<?=base_url()?>assets/images/favicon.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="<?=base_url()?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="<?=base_url()?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
        <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/calendar.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/themes/theme-orange.css" rel="stylesheet" />
        <link href="<?=base_url()?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
        <script src="<?=base_url()?>assets/plugins/jquery/jquery.js"></script>
        <script src="<?=base_url()?>assets/js/jquery.plugin.js"></script>
        <script src="<?=base_url()?>assets/js/jquery.countdown.js"></script>
        <style>
            @font-face {
                font-family: 'Kaiti';
                src: url('<?=base_url()?>assets/font/kaiti_gb2312-webfont.woff2') format('woff2');
                src: url('<?=base_url()?>assets/font/KaiTi_GB2312.woff') format('woff');
                src: url('<?=base_url()?>assets/font/KaiTi_GB2312.ttf')  format('truetype'); /* Safari, Android, iOS */
            }
            
            .justify-content-center {
                display:flex;
                justify-content:center;
            }

            .max-width-card {
                max-width:75em;
                width:1024px;
            }

            .margin-bottom-body {
                margin-bottom:-50px;
            }

            .max-width-col {
                max-width:40em
            }

            .margin-bottom-col {
                margin-bottom:-20px;
            }

            body {
                background-image: url('<?=base_url()?>assets/icon/BG.png');
                /* font-family: Kaiti; */
            }

            .rotate-display {
                display: none;
                z-index: 1004;
                position: fixed;
                top: 0;
                width: 100%;
                height: 100%;
                background: #383b3f;
            }
        </style>
    </head>

    <body class="theme-orange">
        <div class="rotate-display">
            <!-- <img src="<?=base_url()?>assets/icon/BG.png"> -->
            <p style="text-align: center; color:white; margin-top: 50%; padding-top:50%;">Landscape</p>
        </div>
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-amber">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Mohon Tunggu Sebentar...</p>
            </div>
        </div>
        <div class="overlay"></div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- <div class="navbar-header" style="width: calc(100% + 30px);"> -->
                <!-- <div class="navbar-header"> -->
                    <div class="row">
                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg align-center m-t-5">
                            <?php if ($this->uri->segment(2) != 'submit_content') :?>
                                <a href="<?=base_url();?>">
                                    <img src="<?=base_url()?>assets/CLC-Logo11.png" style="max-width: 100px; max-height: 50px">
                                </a>
                            <?php else : ?>
                                <img src="<?=base_url()?>assets/CLC-Logo11.png" style="max-width: 100px; max-height: 50px">
                            <?php endif;?>
                        </div>
                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg pull-right">
                            <div class="pull-right" style="margin-top:5px; margin-right:15px;">
                                <a href="<?=base_url();?>login/signout"><img src="<?=base_url()?>assets/icon/logout.png" style="max-width: 70px; max-height: 40px"></a>
                            </div>
                        </div>
                        <div class="col-xs-12 hidden-sm hidden-md hidden-lg align-center m-t-3">
                            <div style="font-size: calc(24px + (26 - 14) * ((100vw - 300px) / (1600 - 300)))">
                                <span class="label bg-blue m-r-5">
                                    <span><?=decrypt_url($this->session->userdata('id_siswa'))?></span>
                                    <span><?=$this->session->userdata('nama_siswa')?></span>
                                    <span><?=$this->session->userdata('level')?></span>
                                </span>
                                <?php if($this->uri->segment(2) != "history") : ?>
                                    <?php $hidden = ($this->uri->segment(2) != 'submit_content') ? 'none' : '' ;?>
                                        <span class="label bg-teal m-r-5 btn_time" style="display: <?=$hidden?>">
                                            <span class="hitmundur"></span>
                                            <span><?php echo $show = ($this->uri->segment(2) != 'submit_content') ? '' : ucwords($mode) ;?></span>
                                        </span>
                                    <span class="label bg-cyan" style="display: <?=$hidden?>">
                                        <?=$title?>
                                    </span>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 hidden-xs m-t-5">
                            <?php if ($this->uri->segment(2) != 'submit_content') :?>
                                <a href="<?=base_url();?>">
                                    <img src="<?=base_url()?>assets/CLC-Logo11.png" style="max-width: 100px; max-height: 50px">
                                </a>
                            <?php else : ?>
                                <img src="<?=base_url()?>assets/CLC-Logo11.png" style="max-width: 100px; max-height: 50px">
                            <?php endif;?>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 hidden-xs m-t-3 align-center">
                            <div style="font-size: calc(14px + (26 - 14) * ((100vw - 300px) / (1600 - 300))); margin-top:1.2%">
                                <span class="label bg-blue m-r-5">
                                    <span><?=decrypt_url($this->session->userdata('id_siswa'))?></span>
                                    <span><?=$this->session->userdata('nama_siswa')?></span>
                                    <span><?=$this->session->userdata('level')?></span>
                                </span>
                                <?php if($this->uri->segment(2) != "history") : ?>
                                    <?php $hidden = ($this->uri->segment(2) != 'submit_content') ? 'none' : '' ;?>
                                    <span class="label bg-teal m-r-5 btn_time" style="display: <?=$hidden?>">
                                        <span class="hitmundur"></span>
                                        <span><?php echo $show = ($this->uri->segment(2) != 'submit_content') ? '' : ucwords($mode) ;?></span>
                                    </span>
                                    <span class="label bg-cyan" style="display: <?=$hidden?>">
                                        <?=$title?>
                                    </span>
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <div class="col-sm-3 col-md-3 col-lg-3 hidden-xs pull-right">
                            <div class="pull-right" style="margin-top:5px;">
                                <a href="<?=base_url();?>login/signout"><img src="<?=base_url()?>assets/icon/logout.png" style="max-width: 70px; max-height: 40px"></a>
                            </div>
                        </div>
                    </div>
                    
                <!-- </div> -->
            </div>
        </nav>
        <section class="content" style="margin: 100px 15px auto;">
            <?php $this->load->view($content); ?>
        </section>
        
        <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.js"></script>
        <script src="<?=base_url()?>assets/plugins/node-waves/waves.js"></script>
        <script src="<?=base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>assets/plugins/jquery-validation/jquery.validate.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
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
        <script src="<?=base_url()?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="<?=base_url()?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script>
            // function rotate() {
            //     window.addEventListener("orientationchange", function() {
            //         console.log(screen.orientation);
            //         if (screen.orientation.angle == 0) {
            //             var test = '<img src="<?=base_url()?>assets/icon/BG.png" class="img-rotate">'
            //             $('.theme-orange').html(test);
            //             console.log('asfkjasgfjkg')
            //         } else {
            //             console.log('asf')
            //             $('.img-rotate').remove();
            //         }
            //     });
            // }

            setTimeout( function() {
            var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
                // if(window.innerHeight > window.innerWidth){
                //     $('.rotate-display').show();
                // } else {
                //     $('.rotate-display').hide();
                // }
            }, 100);
            $(document).ready( function () {
                $('.table_history').DataTable({
                    // "order" : [[0, "desc"]]
                });


                // // Find matches
                // var mql = window.matchMedia("(orientation: portrait)");

                // // If there are matches, we're in portrait
                // if(mql.matches) {  
                //     // var test = '<img src="<?=base_url()?>assets/icon/BG.png" class="img-rotate">'
                //     //     $('.theme-orange').after(test);
                //     console.log('test')
                //     $('.rotate-display').show();
                // } else {  
                //     console.log('test1')
                //     $('.rotate-display').hide();
                //     // $('.img-rotate').remove();
                //     // Landscape orientation
                // }
            } );
        </script>
    </body>
</html>