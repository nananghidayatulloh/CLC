<?php

// $ci->session->userdata('role_id')
function akses_menu()
{
  $ci = get_instance();
  $ci->db->order_by("urut", "asc");
  return $ci->db->get_where('tb_acces_menu', ['role_id' => $ci->session->userdata['role']])->result();
}

function menu($id)
{
  $ci = get_instance();
  $ci->db->order_by('urutan', 'desc');
  return $ci->db->get_where('tb_menus', ['id' => $id])->row();
}

function sub_menu($id)
{
  $ci = get_instance();
  $ci->db->order_by('order', 'asc');
  return $ci->db->get_where('tb_sub_menu', ['menu_id' => $id, 'is_active' => 1, 'role_id' => $ci->session->userdata['role']])->result();
}

function child_menu($id)
{
  $ci = get_instance();
  $ci->db->order_by('order', 'asc');
  return $ci->db->get_where('tb_childmenu', ['sub_id' => $id, 'is_active' => 1, 'role_id' => $ci->session->userdata['role']])->result();
}
