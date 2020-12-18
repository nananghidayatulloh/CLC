<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body table-responsive">
                      <h4><?= $page_title.' for '.$role->role ?></h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="" class="" style="width:5%; vertical-align:middle;">No</th>
                                <th rowspan="" style="vertical-align:middle;" class="">Menu</th>
                                <th colspan="" class="" style="text-align:left;">Access</th>
                            </tr>

                        </thead>
                        <tbody>
                          <?php
                          $no =1;
                          $i = 0;
                          $akses = unserialize($role->access);
                          foreach ($menu as $m) : ?>
                            <tr>
                              <td><?= $no++ ?></td>
                              <td><?= $m->menu ?></td>
                              <td class="action">
                                <input <?= ($akses[$i]==$m->id?'checked':'') ?> data-id="<?= $m->id ?>" type="checkbox" id="1access<?= $no?>" name="access<?= $no?>" class="access" value="1">
                                <label class="1access<?= $no?>" for="1access<?= $no?>"><?= ($akses[$i]==$m->id?'Yes':'No') ?></label>
                              </td>
                            </tr>
                          <?php
                          $i++;
                        endforeach; ?>

                        </tbody>
                    </table>
                    <button class="button_save btn btn-success" name="button">Save</button>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </section>


  <script type="text/javascript">


    $(document).ready(function(){
      $('.button_save').on('click', function(){
        var access_serial = [];
        var access = [];
        $('.access').each(function(){
          if($(this).prop('checked')){
            access_serial.push($(this).data('id'));
            access.push($(this).data('id'));
          }else {
            access_serial.push(0);
            // access.push($(this).val());
          }
        });

        $.ajax({
        url:'<?php echo base_url("previlege/save_access") ?>',
        type:'POST',
        data:{
          'access[]':access,
          'access_serial[]':access_serial,
          role_id: '<?= $role->id ?>'
        },
        success: function(data){
          $('.button_save').html('<i class="material-icons">save</i> Save');
          Swal('Berhasil', 'Menyimpan data...', 'success');
          // alert(data);
          location.reload();

        },
        beforeSend:function(){
          $('.button_save').html(loader('Processing...'));
        }
       });

      });
    })

    function loader(pesan)
    {
      return `<img style="width:17px;" src="<?= base_url('assets/images/loader.gif') ?>" alt=""> `+pesan;
    }

    $('.access').on('click', function(){
      if($(this).prop('checked')){
        var a = $(this).attr('id');
        $('.'+a).text('Yes');
      }else {
        var a = $(this).attr('id');
        $('.'+a).text('No');
      }
    })
  </script>
