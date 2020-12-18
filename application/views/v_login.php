<body class="login-page" style="background-color:#66ffbb">
    <div class="login-box">
        <div class="logo">
            <a href="<?=base_url()?>"><img class="center" src="<?=base_url()?>assets/CLC-Logo11.png"></a>
        </div>
        <div class="card">
            <div class="body">
                <!-- notifikasi Masuk -->
                <?php
                    if ($this->session->flashdata('gagal')) {
                        echo '<div class="flash-error" data-flasherror="'.$this->session->flashdata('gagal').'"></div>';
                    } 
                    // else if ($this->session->flashdata('logout')) {
                    //     echo '<div class="flash-akun" data-flashakun="'.$this->session->flashdata('logout').'"></div>';
                    // }
                ?>
                <?=form_open('login/checkLogin', 'method="post"')?>
                    <div class="msg">Masuk untuk memulai akun anda...</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-block bg-pink waves-effect" name="submit" type="submit">MASUK</button>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xs-12">
                            <a href="<?=base_url()?>login/download_apk" class="btn btn-block bg-blue waves-effect">Download Apk Teacher</a>
                        </div>
                    </div> -->
                <?=form_close()?>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>assets/plugins/jquery/jquery.js"></script>
    <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/plugins/node-waves/waves.js"></script>
    <script src="<?=base_url()?>assets/js/sweetalert/dist/sweetalert2.all.min.js"></script>
    <script src="<?=base_url()?>assets/js/myscript.js"></script>
</body>
</html>