<div class="header">
    <div class="justify-content-center">
        <div class="card max-width-card">
            <div class="body" style="margin-bottom:-20px;">
                <div class="row">
                    <!-- <div class="max-width-col"> -->
                        <div class="hidden-xs hidden-sm col-md-6 col-lg-6 text-left" style="font-size: calc(1vw + 1vh + 0vmin)">
                            <ul class="list-group">
                                <li class="list-group-item" style="border:none;">ID : <?=decrypt_url($this->session->userdata('id_siswa'))?></li>
                                <li class="list-group-item" style="border:none;">Name : <?=$this->session->userdata('nama_siswa')?></li>
                            </ul>
                        </div>
                        <div class="hidden-xs hidden-sm col-md-6 col-lg-6 text-right" style="font-size: calc(1vw + 1vh + 0vmin)">
                            <ul class="list-group">
                                <li class="list-group-item" style="border:none;">Level : <?=$this->session->userdata('level')?></li>
                                <li class="list-group-item" style="border:none;">Cabang : <?=getNamaCabang($this->session->userdata('id_cabang'))?></li>
                            </ul>
                        </div>
                        <div class="hidden-md hidden-lg col-sm-12 col-lg-12 text-left" style="font-size: calc(1vw + 1vh + 1vmin)">
                            <ul class="list-group">
                                <li class="list-group-item" style="border:none;">ID : <?=decrypt_url($this->session->userdata('id_siswa'))?></li>
                                <li class="list-group-item" style="border:none;">Name : <?=$this->session->userdata('nama_siswa')?></li>
                                <li class="list-group-item" style="border:none;">Level : <?=$this->session->userdata('level')?></li>
                                <li class="list-group-item" style="border:none;">Cabang : <?=getNamaCabang($this->session->userdata('id_cabang'))?></li>
                            </ul>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>