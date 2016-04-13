<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login | Sistem Informasi Kredit Motor</title>
<link rel="shortcut icon" href="assets/images/caption_logo.png" />
<meta name="author" content="Nava Gia Ginasta" />
<meta name="email" content="navagiaginasta@gmail.com" />
<style> 
		@import url("assets/css/login_style.css");		
		<?php
		include "config/koneksi.php";
		$background=mysql_query("SELECT * FROM background ORDER BY background_id");
		while($b=mysql_fetch_array($background)){
			 echo "
				body {
					background:url('background/$b[background_gambar]');
					background-color:#dfe3ee;
					background-attachment:fixed;
					background-size:cover;
					font-size: 12px;
		}";
		 }
		 ?> 
</style>
	<script type="text/javascript" src="assets/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="assets/js/cufon-yui.js"></script>
    <script type="text/javascript" src="assets/js/Delicious_500.font.js"></script>
    <script language="javascript">
	function validasi(form){
  if (form.username.value == ""){
      document.getElementById('eroruser').innerHTML = "<div class='error_msg'>Username Kosong</div>";
      form.username.focus();
      $(function() {
	Cufon.replace('#site-title');
	$('.msg').click(function() {
		$(this).fadeTo('slow', 0);
		$(this).slideUp(341);
	});
      });
    return (false);
  }

  if (form.password.value == ""){
    document.getElementById('erorpass').innerHTML = "<div class='error_msg'>Password Kosong</div>";
    form.password.focus();
    $(function() {
	Cufon.replace('#site-title');
	$('.msg').click(function() {
		$(this).fadeTo('slow', 0);
		$(this).slideUp(341);
	});
    });
    return (false);
  }
  return (true);
}
</script>

</head>

<body>
<div id="container">
	<div id="container">
    	<div id="leftcontent">
       		 <b>Selamat Datang</b> di Sistem Informasi Kredit Motor
       			 <br /><b><font color="#06C">Haurwangi Motor</font></b><br />
       				 <font size="4">Untuk Mengakses, Silahkan Login Terlebih Dahulu...</font>
       			 </div>
        <div id="centercontent"></div>
        <div id="rightcontent">
        	<div id="content">
        <table>
			<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
            <tr>
            	<td colspan="2"><div id="title">Silahkan Login</div></td>
            </tr>
        	<tr>
            	<td colspan="2"><input type="text" placeholder="Username" name="username" class="inputuser" /></td>
            </tr>
            <tr>
            	<td><input type="password" placeholder="Password" name="password" class="inputpass" />
                <input type="submit" title="Log in" class="button" name="login" value="" /></td>
            </tr>
            <tr>
            	<td colspan="2">
                <div id="erorpass"></div>
            	<div id="eroruser"></div></td>           
            </tr>
            </form>
        </table>
        </div>
        </div>
        <ul class="copy">
			<center>Copyright &copy; 2014 Sistem Informasi Kredit Motor <br />
			Crate by <a href="https://www.facebook.com/Nava10webmaster" target="_blank">Nava Gia Ginasta</a></center>
        </ul>
</body>
</html>
