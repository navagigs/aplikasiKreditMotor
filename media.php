<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<script language='javascript'>alert('Silahkan Login');
				document.location='index.php'</script>";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Informasi Kredit Motor | Nava Gia Ginasta</title>
<link rel="shortcut icon" href="assets/images/caption_logo.png" />
<meta name="author" content="Nava Gia Ginasta" />
<meta name="email" content="navagiaginasta@gmail.com" />
<style> 
		@import url("assets/css/template.css");
		@import url("assets/css/datatable.css"); 
		@import url("assets/js/jquery_ui/development-bundle/themes/smoothness/jquery.ui.core.css");
		@import url("assets/js/jquery_ui/development-bundle/themes/smoothness/jquery.ui.theme.css");
		@import url("assets/js/jquery_ui/development-bundle/themes/smoothness/jquery.ui.datepicker.css");		
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
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/dateDiff.js"></script>
<script src="assets/js/jquery_validation/jquery.validate.min.js"></script>
<script src="assets/js/jquery_validation/additional-methods.min.js"></script>
<script src="assets/js/jquery_ui/development-bundle/ui/minified/jquery.ui.core.min.js"></script>
<script src="assets/js/jquery_ui/development-bundle/ui/minified/jquery.ui.widget.min.js"></script>
<script src="assets/js/jquery_ui/development-bundle/ui/minified/jquery.ui.datepicker.min.js"></script>

</head>

<body>
<div id="container">
<div id="menubar">
	<ul class="menu">
    	<li><span><a href="?module=home"><img src="assets/images/beranda.png" style="margin:6px"  title="Home" /></a></span></li>
    	<li><span><a href="?module=users"><img src="assets/images/pengguna.png" style="margin:6px"  title="Setting Akun"/></a></span></li>
    	<li><span><a href="?module=background"><img src="assets/images/penggunaLogBg.png" style="margin:6px" title="Setting Background"/></a></span></li>
    </ul>
    <ul class="menu" style="float:right;">
    	<li><span><a href="logout.php" onClick="return confirm('Apakah anda akan Keluar?');"><img src="assets/images/keluar.png" style="margin:6px"  title="Logout" /></a></span></li>
    </ul>
</div>
<div id="wrap_header"><img src="assets/images/header_.PNG" /></div>
	<div id="wrap">
   <!--left-->
   		 <div id="left-content">
    		<div id="main">
    		<div id="list-content">
            	<div align="center"><img src="assets/images/pengajuan.png" />
                <br /><a href="?module=pengajuan">Pengajuan</a></div>
              </div>
    		<div id="list-content">
            	<div align="center"><a href="#"><img src="assets/images/angsuran.png" /><br />Angsuran</a></div>
              </div>
    		<div id="list-content">
            	<div align="center"><a href="#"><img src="assets/images/tunggakan.png" /><br />Tunggakan</a></div>
              </div>
    		<div id="list-content">
            	<div align="center"><a href="#"><img src="assets/images/pemeliharaan.png"  /><br />Pemeliharaan</a></div>
              </div>
    		<div id="list-content">
            	<div align="center"><a href="#"><img src="assets/images/perbaikan.png"/><br />Perbaikan</a></div>
              </div>
    		<div id="list-content">
            	<div align="center"><a href="#"><img src="assets/images/pelunasan.png" /><br />Pelunasan</a></div>
              </div>
    		<div id="list-content">
            	<div align="center"><a href="#"><img src="assets/images/polisi.png" /><br />Kasus</a></div>
              </div>
    		<div id="list-content">
            	<div align="center"><a href="#"><img src="assets/images/penyitaan.png" /><br />Penyitaan</a></div>
              </div>
    		</div>
         </div>
       <!-- end-left -->        
         
       <!-- center-->        
        <div id="center-content">
        	<div id="main">
            	<div id="content">
           	<?php include "content.php";?>
               </div>
             </div>
         </div>        
   </div> 
   <!-- end-center--> 

  <div style="clear:both;"></div> 
  <br /> 
<div id="menubar" >
	<ul class="menu">
    	<li><span><a href="https://www.facebook.com/Nava10webmaster" target="_blank">copyright &copy; Nava Gia Ginasta </a></span>		</li>
    </ul>
</div>
</div>
</body>
</html>

<?php
}
}
?>
