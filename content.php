<?php

include "config/koneksi.php";
if($_GET['module']=='home') {
	echo"<div id='title'>Home</div>
		<div id='content'>Selamat Datang di Sistem Informasi Kredit Motor <b>Haurwangi Motor</b>.</br></div>";
}
elseif($_GET['module']=='pengajuan'){
	include "module/pengajuan/pengajuan.php";
}

elseif($_GET['module']=='background'){
	include "module/background/background.php";
}

elseif($_GET['module']=='users'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
	include "module/users/users.php";
}
}
?>
