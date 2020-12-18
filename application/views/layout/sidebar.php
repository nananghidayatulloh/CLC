<?php
    $CI =& get_instance();
    $CI->load->model(['m_current', 'm_app_version']);

    $current        = $CI->m_current->getCurrentTerm()->result_array()[0];
    $app_version	= $CI->m_app_version->getAppVersion()->result_array();
    $session        = $this->session->userdata('role');
    $total_guru 	= $this->db->get('guru')->num_rows() - 1;
    $total_siswa 	= $this->db->get('siswa')->num_rows();
    $maintance_days = $this->db->get('maintenance_tracker')->row_array();
?>

<body class="theme-orange">
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
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?=base_url()?>admin">CHILDREN LEARNING CHINESE</a>
            </div>
            <?php if ($session == 1) :?>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-center navbar-header">
                        <li class="navbar-brand">CURRENT TERM : <?=$current['from_date']?> - <?=$current['to_date']?> <span><button class="btn btn-xs btn-primary waves-effect" data-toggle="modal" data-target="#modal_current_term">EDIT</button></span></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                    </ul>
                </div>
            <?php endif;?>
        </div>
    </nav>

    <section>
        <aside id="leftsidebar" class="sidebar">
            <div class="menu">
                <ul class="list">



                  <?php foreach (akses_menu() as $akses) :
                    $url = $this->uri->segment(2);
                    // $cek = $this->db->get_where('tb_sub_menu', ['url' => $url, 'menu_id' => $akses->menu_id])->row();
                    $link = menu($akses->menu_id)->class;
                    $pecah = explode('/', $link);
                    ?>

                    <li class="<?php if($this->uri->segment(1) == end($pecah) || $this->uri->segment(2) == end($pecah)){echo "active";} ?>">
                        <a href="<?= (menu($akses->menu_id)->url=='#'?'javascript:void(0);':base_url(menu($akses->menu_id)->url)) ?>" data-toggle="modal" class="<?= menu($akses->menu_id)->url=='#'?'menu-toggle':'' ?>">
                            <i class="material-icons"><?= menu($akses->menu_id)->icon ?></i>
                            <span> <?= ucfirst(menu($akses->menu_id)->menu) ?> </span>
                        </a>
                        <?php if(menu($akses->menu_id)->url=='#'): ?>
                        <ul class="ml-menu">

                            <?php foreach (sub_menu($akses->menu_id) as $key => $sub) :
                              $pecah = explode('/', $sub->url);
                               ?>

                            <li <?php if($this->uri->segment(2)==end($pecah) || $this->uri->segment(2)==end($pecah) || $this->uri->segment(2)==end($pecah) || $this->uri->segment(2)==end($pecah) || $this->uri->segment(2)==end($pecah) || $this->uri->segment(2)==end($pecah)) { echo 'class="active"'; } ?>>
                                <a href="<?= $sub->url=='#'?'javascript:void(0);':base_url($sub->url); ?>" class="<?= $sub->url=='#'?'menu-toggle':'' ?>"><?= $sub->title ?></a>
                                <?php if($sub->url == '#'): ?>
                                <ul class="ml-menu">
                                  <?php foreach (child_menu($sub->id) as $key => $child) :
                                    $link = explode('/', $child->url);
                                    ?>
                                    <li <?php if($this->uri->segment(2)==end($link) || $this->uri->segment(2)=="add_".end($link)) { echo 'class="active"'; } ?>>
                                        <a href="<?=base_url($child->url)?>">
                                            <span><?= $child->title ?></span>
                                        </a>
                                    </li>
                                  <?php endforeach; ?>
                                </ul>
                              <?php endif; ?>
                            </li>
                          <?php endforeach; ?>




                        </ul>
                      <?php endif; ?>
                    </li>

                  <?php endforeach; ?>

                    <li>
                        <a href="<?=base_url()?>login/signout">
                            <i class="material-icons">text_fields</i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">CLC - Children Learning Chinese</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <?php if ($session == 1) :?>
            <aside id="rightsidebar" class="right-sidebar">
                <div role="tabpanel" class="tab-pane fade in active in active" id="settings">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header text-center">
                                    <h2> APP VERSION </h2>
                                </div>
                                <div class="body">
                                    <?=form_open('dashboard/app_version_edit', 'id="form_app_version"')?>
                                        <?php foreach ($app_version as $av): ?>
                                        <ul class="list-group">
                                            <label><?=strtoupper(str_replace("_"," ",$av['app_version_for']))?></label>
                                            <input type="text" class="form-control" name="<?=$av['app_version_for']?>" value="<?=$av['current_version']?>" onKeyPress="return onlyNumbersWithDot(event);" >
                                        </ul>
                                        <?php endforeach?>
                                        <ul class="list-group">
                                            <button class="btn btn-primary btn-block waves-effect" id="submit_app_version">SUBMIT</button>
                                        </ul>
                                    <?=form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        <?php endif;?>
    </section>
    <div class="modal fade" id="modal_current_term" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="largeModalLabel">Edit Current Term</h4>
                </div>
                <div class="modal-body">
                    <?=form_open('dashboard/current_term_edit')?>
                        <input type="hidden" name="no" value="<?=$current['no']?>">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <b>Dari</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker1" name="from_date" value="<?=$current['from_date']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>Sampai</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker2" name="to_date" value="<?=$current['to_date']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <b>Notice</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">announcement</i>
                                        </span>
                                        <div class="form-line">
                                            <textarea class="form-control" rows="8" name="end_term_notice"><?=$current['end_term_notice']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="input-group">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block waves-effect">
                                            <i class="material-icons">input</i>
                                            <span>SUBMIT</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?=form_close()?>
                    <!-- <button class="btn btn-danger btn-block waves-effect clear_percentage">
                        <i class="material-icons">delete</i>
                        <span> Clear Percentage All Siswa</span>
                    </button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_maintenance" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="largeModalLabel">Maintenance Days</h4>
                </div>
                <div class="modal-body">
                    <?=form_open('admin/setting_maintance')?>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <b>Mentenance Days</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">settings_applications</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="maintenance_days" value="<?=$maintance_days['maintenance_days']?>" min="0" max="999" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="input-group">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block waves-effect">
                                            <i class="material-icons">input</i>
                                            <span>SUBMIT</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($session == 1) :?>
        <script>
        $(document).ready(function()
        {
            document.querySelector('#form_app_version').addEventListener('submit', function (e) {
                var form = $("#form_app_version").serialize();
                    e.preventDefault();

                Swal.fire({
                    title: 'Yakin akan merubah versi?',
                    text: "Merubah versi akan berpengaruh di aplikasi.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, merubah ini!'
                }).then(function(isConfirm) {
                    if (isConfirm.value) {
                        $.ajax({
                            url     : '<?=base_url()?>dashboard/app_version_edit',
                            type    : "POST",
                            data    : form,
                            success: function(feedback){
                                if (feedback == "Harap isi data!") {
                                    Swal.fire('Pemberitahuan', feedback, 'info');
                                } else {
                                    Swal.fire('Berhasil', feedback, 'success');
                                }
                            }
                        });
                    }
                })
            });

            $.onlyNumbersWithDot = function(e) {
                var charCode;
                if (e.keyCode > 0) {
                    charCode = e.which || e.keyCode;
                }
                else if (typeof (e.charCode) != "undefined") {
                    charCode = e.which || e.keyCode;
                }
                if (charCode == 46)
                    return true
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            };
        });
        </script>
    <?php endif;?>
    <script>
        $(document).ready(function(){
            $('.clear_percentage').on('click', function() {
               alert('Berhasil') ;
            });
        });
    </script>
