<?php
date_default_timezone_set('Asia/Jakarta'); 
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus background
if ($module=='background' AND $act=='hapus'){
  mysql_query("DELETE FROM background WHERE background_id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input background
elseif ($module=='background' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
 	$tgl_sekarang = date ('Ymd');
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    Uploadbackground($nama_file);
    mysql_query("INSERT INTO background(tgl_posting,
                                    background_gambar) 
                            VALUES('$tgl_sekarang',
                                   '$nama_file')");
  }
  else{
    mysql_query("INSERT INTO background(tgl_posting) 
                            VALUES('$tgl_sekarang')");
  }
  header('location:../../media.php?module='.$module);
}

// Update background
elseif ($module=='background' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
 	$tgl_sekarang = date ('Ymd');
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE background SET tgl_posting  = '$tgl_sekarang'
                             WHERE background_id = '$_POST[id]'");
  }
  else{
    Uploadbackground($nama_file);
    mysql_query("UPDATE background SET background_gambar    = '$nama_file'   
                             WHERE background_id = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
?>
