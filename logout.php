<?php
  session_start();
  session_destroy();
  echo "<script language='javascript'>alert('Anda Telah Keluar dari Halaman');
				document.location='index.php'</script>";
?>
