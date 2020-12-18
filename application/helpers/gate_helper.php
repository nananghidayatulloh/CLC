<?php

function has_privilege($path)
{
  $ci = get_instance();
  if(!$ci->session->userdata('username'))
  {
    redirect('auth', 'refresh');
  }
  else
  {
    $role_id = $ci->session->userdata('role_id');

    $getMenu = $ci->db->get_where('tb_menu', ['menu' => $path])->row_array();
    $getSubMenu = $ci->db->get_where('tb_access_submenu', ['sub_id' => $path])->row();
    $menu_id = $getMenu['id'];

    $aksesMenu  = $ci->db->get_where('tb_acces_menu', [
      'role_id' => $role_id,
      'menu_id' => $menu_id
    ]);


      $aksesSubMenu  = $ci->db->get_where('tb_access_submenu', [
        'role_id' => $role_id,
        'sub_id' => $path
      ]);


    if ($aksesMenu->num_rows() < 1 && $aksesSubMenu->num_rows() < 1)
    {
      // redirect('auth/access_denied');
      echo "Access Denied";
    }
  }
}

function check_access($role_id, $menu_id)
{
  $ci = get_instance();
  $acces = $ci->db->get_where('tb_access_menu', [
    'role_id' => $role_id,
    'menu_id' => $menu_id
  ]);

  if($acces->num_rows() > 0)
  {
    return "checked='checked'";
  }


}
