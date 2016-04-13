<?php

include "../../config/koneksi.php";
$no_rek=$_GET['no_rek'];
$no_pen=$_GET['no_pen'];
mysql_query("DELETE FROM debitur WHERE debitur_no_rekening='$no_rek'");
mysql_query("DELETE FROM penjamin WHERE penjamin_no_penjamin='$no_pen'");
mysql_query("DELETE FROM aplikasi WHERE debitur_no_rekening='$no_rek'");
mysql_query("DELETE FROM akad WHERE debitur_no_rekening='$no_rek'");
header('location:../../media.php?module=pengajuan');

?>
					
