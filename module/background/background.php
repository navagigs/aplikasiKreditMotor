
<?php
$aksi="module/background/aksi_background.php";
switch($_GET[act]){
  // Tampil background
  default:  
  case "editbackground":
    $edit = mysql_query("SELECT * FROM background WHERE background_id='1'");
    $r    = mysql_fetch_array($edit);

    echo "<div id='title'>Background</div>
          <form  method=POST enctype='multipart/form-data' action=$aksi?module=background&act=update>
          <input type=hidden name=id value=$r[background_id]>
		<table class='data form' width='100%' cellpadding='4'>
			<tr class='title'>
				<th colspan='4'>Ganti Background</th>
			</tr>
		 	<tr class='even'>
				<td width='140'>Gambar</td>
				<td width='1'>:</td>
				<td> <img src='background/$r[background_gambar]' height=150 width=200></td>
		    </tr>
		 	<tr class='odd'>
				<td width='140'>Ganti Gambar</td>
				<td width='1'>:</td>
				<td><input type=file name='fupload' size=30></td></tr>
		    </tr>
			<tr>
				<td colspan='4'><input type='submit'   name='update' class='button' value='Update'>
					<input type='button' class='button' value='Kembali' onClick='self.history.back()'></td>
			</tr>
          </table></form>";
    break;  
}
?>
