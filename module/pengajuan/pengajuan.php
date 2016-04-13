<script>
$(document).ready(function(){
	
$(document).ready(function(){
var debitur_penghasilan ;
var debitur_penghasilan2;
var penghasilan_total;
var dp;
var akad_hasil;
var bunga;
var ang;
var auto_refresh = setInterval(function(){
debitur_penghasilan = parseInt($("#debitur_penghasilan").val());
debitur_penghasilan2 = parseInt($("#debitur_penghasilan2").val());
penghasilan_total = debitur_penghasilan + debitur_penghasilan2;

dp = parseInt($("#akad_harga").val() * 10 / 100);
$("#dp").val(dp);
akad_hasil = parseInt(($("#akad_harga").val() - $("#dp").val() ) / $("#akad_tenor").val());
bunga = parseInt(akad_hasil * $("#bunga").val() / 100);
ang = akad_hasil + bunga;

if(isNaN(ang)){
ang = 0;
}
if(isNaN(penghasilan_total)){
penghasilan_total = 0;
}
$("#penghasilan_total").val(penghasilan_total);
$("#akad_angsuran").val(ang);
}, 1);


$(".tgl_lahir").datepicker({
yearRange:"-75:-18", 
changeMonth:true, 
changeYear:true, 
dateFormat:"yy-mm-dd",
showOtherMonths: true,
selectOtherMonths: true,

});
$(".tgl").datepicker({
yearRange:"-1:+1", 
changeMonth:true, 
changeYear:true, 
dateFormat:"yy-mm-dd",
showOtherMonths: true,
selectOtherMonths: true,

});

$("#form").validate({
rules:{
debitur_no_rekening:{
required:true,
lettersonly:true
},
debitur_nama:"required",
debitur_alamat:"required",
debitur_tgllahir:"required",
debitur_noktp:{
required:true,
lettersonly:true
},
debitur_pekerjaan:"required",
debitur_penghasilan:{
required:true,
number:true
},
debitur_penghasilan2:{
number:true
},
penjamin_no_penjamin:"required",
penjamin_nama:"required",
penjamin_alamat:"required",
penjamin_tgl_lahir:"required",
penjamin_hubungan:"required",
merk_motor:"required",
jenis_motor:"required",
warna:"required",
penghasilan_total:{
required:true,
number:true,
min:4 * $("#akad_angsuran").val()
},
akad_tenor:{
required:true,
number:true,
max:36
},
akad_no_dokumen:"required",
akad_harga:{
required:true,
number:true
},
dp:{
required:true,
number:true
},
akad_no_mesin:{
required:true,
lettersonly:true
},
akad_no_rangka:{
required:true,
lettersonly:true
},
bunga:{
required:true,
number:true
},
akad_angsuran:{
required:true,
number:true
}
},
messages:{
debitur_no_rekening:{
required:" Mohon isi nomor rekening debitur",
lettersonly:" Tidak ada spasi atau karakter unik"
},
debitur_nama:" Mohon isi nama debitur",
debitur_alamat:" Mohon isi alamat debitur",
debitur_tgllahir:" Mohon isi tanggal lahir debitur",
debitur_noktp:{
required:" Mohon isi nomor KTP debitur",
lettersonly:" Tidak ada spasi atau karakter unik"
},
debitur_pekerjaan:" Mohon isi pekerjaan debitur",
debitur_penghasilan:{
required:" Mohon isi penghasilan debitur",
number:" Hanya berupa angka"
},
debitur_penghasilan2:{
number:" Hanya berupa angka"
},
penjamin_no_penjamin:" Mohon isi nomor penjamin",
penjamin_nama:" Mohon isi nama penjamin",
penjamin_alamat:" Mohon isi alamat penjamin",
penjamin_tgllahir:" Mohon isi tanggal lahir penjamin",
penjamin_hubungan:" Mohon isi hubungan penjamin",
merk_motor:" Mohon isi merk motor",
jenis_motor:" Mohon isi jenis motor",
warna:" Mohon isi warna motor",
penghasilan_total:{
required:" Mohon isi penghasilan total",
number:" Hanya berupa angka",
min:" Minimal jumlah 4 kali angsuran"
},
akad_no_dokumen:" Mohon isi nomor dokumen",
akad_tenor:" Mohon isi tenor",
akad_harga:{
required:" Mohon isi harga motor",
number:" Hanya berupa angka"
},
dp:{
required:" Mohon isi pembayaran uang muka sekalipun 0",
number:" Hanya berupa angka"
},
akad_no_mesin:{
required:" Mohon isi nomor mesin motor",
lettersonly:" Tidak ada spasi atau karakter unik"
},
akad_no_rangka:{
required:" Mohon isi nomor rangka motor",
lettersonly:" Tidak ada spasi atau karakter unik"
},
bunga:{
required:" Mohon isi bunga pembayaran sekalipun angka 0",
number:" Hanya berupa angka"
},
akad_angsuran:{
required:" Mohon isi angsuran perbulan",
number:" Hanya berupa angka"
}
}
});
});
});
</script>
<?php
include "config/koneksi.php";
$aksi = "module/pengajuan/pengajuan_aksi.php";
switch ($_GET[act]){
	
default:
echo "<div id='title'>Pengajuan</div>
<input type='button' class='button' value='Tambah' onclick=\"window.location.href='?module=pengajuan&act=tambah-pengajuan';\" />
<div style='height:8px;'></div>
<table class='gtable sortable'>
<thead>
  <tr>
	<th>No</th>
	<th>Nomor Dokumen</th>
	<th>Nomor Rekening</th>		
	<th>Nama Debitur</th>
	<th>Jenis Motor</th>
	<th>Alamat</th>
	<th>Status</th>
	<th colspan='4'>Aksi</th>
  </tr></thead>";
  $no = 1;
$tampil = mysql_query("SELECT
						akad.akad_no_dokumen AS akad_no_dokumen,
						debitur.debitur_nama AS debitur_nama,
						debitur.debitur_alamat AS debitur_alamat,
						debitur.debitur_no_rekening AS debitur_no_rekening,
						penjamin.penjamin_no_penjamin AS penjamin_no_penjamin,
						aplikasi.aplikasi_no_aplikasi AS aplikasi_no_aplikasi,
						akad.akad_status AS akad_status,
						akad.akad_jenis_motor AS akad_jenis_motor,
						akad.akad_tgl AS akad_tgl
						FROM
						debitur
						INNER JOIN penjamin ON penjamin.penjamin_no_penjamin = debitur.penjamin_no_penjamin
						INNER JOIN aplikasi ON debitur.debitur_no_rekening = aplikasi.debitur_no_rekening
						INNER JOIN akad ON debitur.debitur_no_rekening = akad.debitur_no_rekening");
while($d=mysql_fetch_array($tampil))
{ 
	echo"<tr>
			 <td>$no</td>
			 <td>$d[akad_no_dokumen]</td>
			 <td>$d[debitur_no_rekening]</td>
			 <td>$d[debitur_nama]</td>
			 <td>$d[akad_jenis_motor]</td>
			 <td>$d[debitur_alamat]</td>
			 <td>$d[akad_status]</td>";
				if($d[akad_status]=="ditolak") { ?>
					<td align='center'>
							<a href="javascript:void(alert('Tidak Bisa diakses, Karena status Debitur ditolak'))">
							<img src='assets/images/penggunaDataL.png' title='Penyerahan' /></a>
					<?php } else {
			echo "<td align='center'>
							<a href='?module=pengajuan&act=penyerahan&no_dok=$d[akad_no_dokumen]'>
							<img src='assets/images/penggunaDataL.png' title='Penyerahan' /></a>"; 			} 
			echo" </td>
			 <td align='center'>
							<a href='?module=pengajuan&act=edit-pengajuan&no_dok=$d[akad_no_dokumen]'>
							<img src='assets/images/edit.png' title='Edit' /></a></td>
			<td align='center'>
							<a href='module/pengajuan/print.php?no_dok=$d[akad_no_dokumen]' target='_blank'>
							<img src='assets/images/print.png' title='Cetak' /></a></td>
			 <td align='center'>"; ?>	
	<a href="module/pengajuan/pengajuan_hapus.php?no_rek=<?php echo $d['debitur_no_rekening'] ?>&no_pen=<?php echo $d['penjamin_no_penjamin']; ?>" onclick="return confirm('Apakah anda akan Menghapus Pengajuan?');"><img src='assets/images/hapus.png'></a></td>
		<?php echo"</tr>";
$no++;
}
echo"</table>";
break;

case "tambah-pengajuan":

	//Aplikasi	
	$query = "SELECT max(aplikasi_no_aplikasi) as idMaks FROM aplikasi";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$aplikasi_no_aplikasi = $data['idMaks'];	
	//mengatur 6 karakter sebagai jumalh karakter yang tetap
	//mengatur 3 karakter untuk jumlah karakter yang berubah-ubah
	$noUrut = (int) substr($aplikasi_no_aplikasi, 7, 3);
	$noUrut++;	
	//menjadikan 201353 sebagai 6 karakter yang tetap
	$char = "APP/NO.";
	//%03s untuk mengatur 3 karakter di belakang 2014
	$app = $char . sprintf("%03s", $noUrut);
	
	//Penjamin
	$query = "SELECT max(penjamin_no_penjamin) as idMaks FROM penjamin";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$penjamin_no_penjamin = $data['idMaks'];	
	$noUrut = (int) substr($penjamin_no_penjamin, 7, 3);
	$noUrut++;	
	$char = "PEN-NO.";
	$pen = $char . sprintf("%03s", $noUrut);
	
	//Akad
	$query = "SELECT max(akad_no_dokumen) as idMaks FROM akad";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$akad_no_dokumen = $data['idMaks'];	
	$noUrut = (int) substr($akad_no_dokumen, 7, 3);
	$noUrut++;	
	$char = "DOK-NO.";
	$dok = $char . sprintf("%03s", $noUrut);
	
	if (isset($_POST['simpan']))
	{
	date_default_timezone_set('Asia/Jakarta');
	$debitur_no_rekening=$_POST['debitur_no_rekening'];
	$debitur_nama=$_POST['debitur_nama'];
	$debitur_alamat=$_POST['debitur_alamat'];
	$debitur_tgllahir=$_POST['debitur_tgllahir'];
	$debitur_noktp=$_POST['debitur_noktp'];
	$debitur_jk=$_POST['debitur_jk'];
	$debitur_pekerjaan=$_POST['debitur_pekerjaan'];
	$debitur_penghasilan=$_POST['debitur_penghasilan'];
	$debitur_penghasilan2=$_POST['debitur_penghasilan2'];
	$penjamin_no_penjamin=$_POST['penjamin_no_penjamin'];
	//penjamin
	$penjamin_no_penjamin=$_POST['penjamin_no_penjamin'];
	$penjamin_nama=$_POST['penjamin_nama'];
	$penjamin_alamat=$_POST['penjamin_alamat'];
	$penjamin_tgllahir=$_POST['penjamin_tgllahir'];
	$penjamin_hubungan=$_POST['penjamin_hubungan'];
	//aplikasi
	$aplikasi_no_aplikasi=$_POST['aplikasi_no_aplikasi'];
	$aplikasi_merk_motor=$_POST['merk_motor'];
	$aplikasi_jenis_motor=$_POST['jenis_motor'];
	$aplikasi_warna=$_POST['warna'];
	$aplikasi_tpenghasilan=($debitur_penghasilan + $debitur_penghasilan2);
	//akad
	$akad_no_dokumen=$_POST['akad_no_dokumen'];
	$akad_tgl=date('Y-m-d');
	$akad_tenor=$_POST['akad_tenor'];
	$akad_merk_motor=$_POST['merk_motor'];
	$akad_jenis_motor=$_POST['jenis_motor'];
	$akad_harga=$_POST['akad_harga'];
	$akad_no_rangka=$_POST['akad_no_rangka'];
	$akad_no_mesin=$_POST['akad_no_mesin'];
	$akad_angsuran=($akad_harga / $akad_tenor) + (($akad_harga / $akad_tenor) * 2/100);
	$akad_status=($aplikasi_tpenghasilan > 2000000)?'mengangsur':'ditolak';	
	//$akad_status=(($akad_angsuran * 4) < $aplikasi_tpenghasilan)?'diterima':'ditolak';	
	
	if($aplikasi_tpenghasilan < 2000000)
		{
		$status = "<div id='kuning'>Tidak Di ACC, karena Total Gaji Kurang dari Rp.2.000.000,-</div>";
		}else {
		$sql=mysql_query("INSERT INTO debitur
			(
				debitur_no_rekening,	
				debitur_nama,			
				debitur_alamat, 			
				debitur_tgllahir,			
				debitur_noktp,		
				debitur_jk,	
				debitur_pekerjaan,	
				debitur_penghasilan,			
				debitur_penghasilan2,	
				penjamin_no_penjamin
			)VALUES
			(
				'$debitur_no_rekening',	
				'$debitur_nama',			
				'$debitur_alamat', 			
				'$debitur_tgllahir',			
				'$debitur_noktp',		
				'$debitur_jk',	
				'$debitur_pekerjaan',	
				'$debitur_penghasilan',			
				'$debitur_penghasilan2',	
				'$penjamin_no_penjamin'
			)
		");
		//query penjamin
		$sql2=mysql_query("INSERT INTO penjamin 
			(
			penjamin_no_penjamin,	
			penjamin_nama,
			penjamin_alamat,		
			penjamin_tgllahir,		
			penjamin_hubungan
			)
			VALUES
			(
			'$penjamin_no_penjamin',	
			'$penjamin_nama',
			'$penjamin_alamat',		
			'$penjamin_tgllahir',		
			'$penjamin_hubungan'
			)
		");
		
		//query aplikasi
		$sql3=mysql_query("INSERT INTO aplikasi 
			(
			aplikasi_no_aplikasi,		
			aplikasi_merk_motor,	
			aplikasi_jenis_motor,		
			aplikasi_warna,			
			aplikasi_tpenghasilan,		
			debitur_no_rekening 
			)
			VALUES
			(
			'$aplikasi_no_aplikasi',		
			'$aplikasi_merk_motor',	
			'$aplikasi_jenis_motor',		
			'$aplikasi_warna',			
			'$aplikasi_tpenghasilan',		
			'$debitur_no_rekening' 
			)
		");
		//query akad
		$sql4=mysql_query("INSERT INTO akad 
			(
			akad_no_dokumen,	
			akad_tgl,
			debitur_no_rekening,			
			penjamin_no_penjamin,		
			akad_tenor,	
			akad_merk_motor,	
			akad_jenis_motor,		
			akad_harga,		
			akad_no_rangka,			
			akad_no_mesin,		
			akad_angsuran,		
			akad_status 
			)
			VALUES
			(
			'$akad_no_dokumen',
			'$akad_tgl',		
			'$debitur_no_rekening',			
			'$penjamin_no_penjamin',		
			'$akad_tenor',	
			'$akad_merk_motor',	
			'$akad_jenis_motor',	
			'$akad_harga',		
			'$akad_no_rangka',			
			'$akad_no_mesin',		
			'$akad_angsuran',		
			'$akad_status' 
			)
		");
		}
		if($sql && $sql2 && $sql3 && $sql4)
		{
			echo "<div id='green'>Berhasil Menyimpan</div>";
		}else{
			echo "$status";
		}
	}
	
echo "	<div id='title'>Pengajuan > Tambah</div>
		<div style='height:8px;'></div>
		<form method='POST' id='form' action='?module=pengajuan&act=tambah-pengajuan'>
		<table class='data form' width='100%' cellpadding='4'>
			<tr class='title'>
				<th colspan='3'>Data Debitur</th>
			</tr>
            <tr>
            	<td width='140'></td>
                <td width='1'></td>
                <td align='right'>Nomor Aplikasi : <input type='text'  name='aplikasi_no_aplikasi' value='$app' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Nama</td>
                <td>:</td>
                <td><input type='text' id='debitur_nama' name='debitur_nama' maxlength='20' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Alamat</td>
                <td>:</td>
                <td><input type='text' name='debitur_alamat' maxlength='20' style='width:475px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type='text' id='debitur_tgllahir' name='debitur_tgllahir' maxlength='20' style='width:95px;' class='tgl_lahir'  readonly/></td>
             </tr>
			<tr class='even'>
            	<td>Jenis Kelamin</td>
                <td>:</td>
              	<td><input type='radio' name='debitur_jk' value='Laki-Laki'><label for='Laki-Laki'>Laki-Laki</label>
					<input type='radio' name='debitur_jk' value='Perempuan'><label for='Perempuan'>Perempuan</label></td>
             </tr>
			<tr class='odd'>
            	<td>Pekerjaan</td>
                <td>:</td>
                <td><select name='debitur_pekerjaan' class='input'>
           			<option value='' selected>-- Pilih --</option>
           			<option value='PNS' >PNS</option>
           			<option value='ABRI' >ABRI</option>
           			<option value='Wiraswasta'>Wiraswasta</option>
           			<option value='Petani' >Petani</option>
           			<option value='Nelayan' >Nelayan</option>
           			<option value='Lainnya' >Lainnya</option>
                    </select></td>
             </tr>
			<tr class='even'>
            	<td>No.KTP</td>
                <td>:</td>
                <td><input type='text' name='debitur_noktp' maxlength='20' style='width:275px;' class='input' /></td>
             </tr>            
			<tr class='odd'>
            	<td>No.Rekening</td>
                <td>:</td>
                <td><input type='text' name='debitur_no_rekening' maxlength='20' style='width:275px;' class='input' /></td>
             </tr>     
			<tr class='even'>
            	<td>Penghasilan Utama</td>
                <td>:</td>
                <td><input id='debitur_penghasilan' type='text' name='debitur_penghasilan' maxlength='20' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Penghasilan Tambahan</td>
                <td>:</td>
                <td><input id='debitur_penghasilan2'  type='text' name='debitur_penghasilan2' maxlength='20' style='width:95px;' class='input' /></td>
               
             </tr>       
             </table>    
		<div style='height:8px;'></div>         
		<table class='data form' width='100%' cellpadding='3'>
			<tr class='title'>
				<th colspan='3'>Data Penjamin</th>
			</tr> 
			<tr class='even'>
            	<td width='140'>Nomor Penjamin</td>
                <td width='1'>:</td>
                <td><input type='text' value='$pen' name='penjamin_no_penjamin'  value='$pen' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Nama Penjamin</td>
                <td>:</td>
                <td><input type='text' name='penjamin_nama' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Alamat</td>
                <td>:</td>
                <td><input type='text' name='penjamin_alamat' style='width:475px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Hubungan</td>
                <td>:</td>
                <td><select name='penjamin_hubungan' class='input'>
           			<option value='' selected>- Pilih -</option>
           			<option value='Istri' >Istri</option>
           			<option value='Suami' >Suami</option>
           			<option value='Adik' >Adik</option>
           			<option value='Kakak' >Kakak</option>
           			<option value='Ayah' >Ayah</option>
           			<option value='Ibu' >Ibu</option>
           			<option value='Lainnya' >Lainnya</option>
                    </select></td>
             </tr>
            </table>
         <div style='height:8px;'></div>         
		<table class='data form' width='100%' cellpadding='3'>
			<tr class='title'>
				<th colspan='3'>Data Aplikasi</th>
			</tr> 
			<tr class='even'>
            	<td width='140'>Merk Motor</td>
                <td width='1'>:</td>
                <td><select name='merk_motor' class='input'>
           			<option value='' selected>-- Pilih --</option>
           			<option value='Honda' >Honda</option>
           			<option value='Yamaha' >Yamaha</option>
           			<option value='Suzuki'>Suzuki</option>
           			<option value='Kawasaki' >Kawasaki</option>
           			<option value='Vespa' >Vespa</option>
                    </select></td>
             </tr>
			<tr class='odd'>
            	<td width='140'>Jenis Motor</td>
                <td width='1'>:</td>
                <td><input type='text' name='jenis_motor' maxlength='20' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Warna Motor</td>
                <td>:</td>
                <td><input type='text' name='warna' maxlength='20' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
				<td width='140'>Penghasilan Total</td>
				<td width='1'>:</td>
				<td><input id='penghasilan_total' type='text' name='penghasilan_total' maxlength='20' style='width:95px;' class='input' readonly></td>
			</tr>
            </table>
         <div style='height:8px;'></div>   
		<table class='data form' width='100%' cellpadding='3'>
			<tr class='title'>
				<th colspan='3'>Data Akad</th>
			</tr> 
			<tr class='even'>
            	<td width='140'>Nomor Dokumen</td>
                <td width='1'>:</td>
                <td><input type='text' value='$dok' name='akad_no_dokumen'  value='$dok' maxlength='20' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Harga Motor</td>
                <td width='1'>:</td>
                <td><input type='text' id='akad_harga' name='akad_harga' maxlength='20' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Uang Muka</td>
                <td width='1'>:</td>
                <td><input type='text' id='dp' name='dp' maxlength='20' style='width:95px;' class='input' />10% Dari Harga Motor</td>
             </tr>  
			<tr class='odd'>
            	<td>Tenor</td>
                <td width='1'>:</td>
                <td><input type='text' id='akad_tenor' name='akad_tenor' maxlength='20' style='width:25px;' class='input' />Bulan *(Max 36 Bulan)</td>
             </tr> 
			<tr class='even'>
            	<td>Bunga</td>
                <td>:</td>
                <td><input type='text' id='bunga' name='bunga' maxlength='20' style='width:25px;' class='input' />%</td>
             </tr> 
			<tr class='odd'>
            	<td>Nomor Rangka</td>
                <td>:</td>
                <td><input type='text' name='akad_no_rangka'  style='width:125px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Nomor Mesin</td>
                <td>:</td>
                <td><input type='text' name='akad_no_mesin'  style='width:125px;' class='input' /></td>
             </tr>
			<tr class='odd'>
				<td width='140'>Angsuran / Bulan</td>
				<td width='1'>:</td>
				<td><input id='akad_angsuran' type='text' name='akad_angsuran' maxlength='20' style='width:100px;' class='input' readonly></td>
			</tr>
			<tr>
				<td colspan='3'><input type='submit'   name='simpan' class='button' value='Simpan'>
					<input type='button' class='button' value='Kembali' onClick='self.history.back()'></td>
			</tr>            
         </table>			
		</form>";
	break;
	

case "edit-pengajuan":

if (isset($_POST['update']))
{
	date_default_timezone_set('Asia/Jakarta');
	$debitur_no_rekening=$_POST['debitur_no_rekening'];
	$debitur_nama=$_POST['debitur_nama'];
	$debitur_alamat=$_POST['debitur_alamat'];
	$debitur_tgllahir=$_POST['debitur_tgllahir'];
	$debitur_noktp=$_POST['debitur_noktp'];
	$debitur_jk=$_POST['debitur_jk'];
	$debitur_pekerjaan=$_POST['debitur_pekerjaan'];
	$debitur_penghasilan=$_POST['debitur_penghasilan'];
	$debitur_penghasilan2=$_POST['debitur_penghasilan2'];
	$penjamin_no_penjamin=$_POST['penjamin_no_penjamin'];
	//penjamin
	$penjamin_no_penjamin=$_POST['penjamin_no_penjamin'];
	$penjamin_nama=$_POST['penjamin_nama'];
	$penjamin_alamat=$_POST['penjamin_alamat'];
	$penjamin_tgllahir=$_POST['penjamin_tgllahir'];
	$penjamin_hubungan=$_POST['penjamin_hubungan'];
	//aplikasi
	$aplikasi_no_aplikasi=$_POST['aplikasi_no_aplikasi'];
	$aplikasi_merk_motor=$_POST['merk_motor'];
	$aplikasi_jenis_motor=$_POST['jenis_motor'];
	$aplikasi_warna=$_POST['warna'];
	$aplikasi_tpenghasilan=($debitur_penghasilan + $debitur_penghasilan2);
	//akad
	$akad_no_dokumen=$_POST['akad_no_dokumen'];
	$akad_tgl=date('Y-m-d');
	$akad_tenor=$_POST['akad_tenor'];
	$akad_merk_motor=$_POST['merk_motor'];
	$akad_jenis_motor=$_POST['jenis_motor'];
	$akad_harga=$_POST['akad_harga'];
	$akad_no_rangka=$_POST['akad_no_rangka'];
	$akad_no_mesin=$_POST['akad_no_mesin'];
	$akad_angsuran=($akad_harga / $akad_tenor) + (($akad_harga / $akad_tenor) * 2/100);
	$akad_status=(($akad_angsuran * 4) < $aplikasi_tpenghasilan)?'diterima':'ditolak';	
	
		//query debitur
	$query1=mysql_query("UPDATE debitur SET
			debitur_no_rekening='$debitur_no_rekening',	
			debitur_nama='$debitur_nama',			
			debitur_alamat='$debitur_alamat', 			
			debitur_tgllahir='$debitur_tgllahir',			
			debitur_noktp='$debitur_noktp',		
			debitur_jk='$debitur_jk',	
			debitur_pekerjaan='$debitur_pekerjaan',	
			debitur_penghasilan='$debitur_penghasilan',			
			debitur_penghasilan2='$debitur_penghasilan2'
			WHERE debitur_no_rekening='$debitur_no_rekening'
	");
	//query penjamin
	$query2=mysql_query("UPDATE penjamin SET
		penjamin_nama='$penjamin_nama',
		penjamin_alamat='$penjamin_alamat',		
		penjamin_tgllahir='$penjamin_tgllahir',		
		penjamin_hubungan='$penjamin_hubungan'
		WHERE penjamin_no_penjamin='$penjamin_no_penjamin'
	");
	
	//query aplikasi
	$query3=mysql_query("UPDATE aplikasi SET		
		aplikasi_merk_motor='$aplikasi_merk_motor',	
		aplikasi_jenis_motor='$aplikasi_jenis_motor',		
		aplikasi_warna='$aplikasi_warna',			
		aplikasi_tpenghasilan='$aplikasi_tpenghasilan',		
		debitur_no_rekening='$debitur_no_rekening' 
		WHERE aplikasi_no_aplikasi='$aplikasi_no_aplikasi'
	");
	//query akad
	$query4=mysql_query("UPDATE akad SET	
		akad_tgl='$akad_tgl',
		debitur_no_rekening='$debitur_no_rekening',			
		penjamin_no_penjamin='$penjamin_no_penjamin',		
		akad_tenor='$akad_tenor',	
		akad_merk_motor='$akad_merk_motor',	
		akad_jenis_motor='$akad_jenis_motor',		
		akad_harga='$akad_harga',		
		akad_no_rangka='$akad_no_rangka',			
		akad_no_mesin='$akad_no_mesin',		
		akad_angsuran='$akad_angsuran',		
		akad_status='$akad_status'  
		WHERE akad_no_dokumen='$akad_no_dokumen'
	");		
		if($query && $query2 && $query3 && $query4)
		{
		echo "<div id='green'>Berhasil Memperbaharui</div>";
		}else {
		echo "<div id='green'>Berhasil Memperbaharui</div>";
		}
	
}

$no_dok=$_GET['no_dok'];
$query="
SELECT
debitur.debitur_no_rekening AS debitur_no_rekening,
debitur.debitur_nama AS debitur_nama,
debitur.debitur_alamat AS debitur_alamat,
debitur.debitur_tgllahir AS debitur_tgllahir,
debitur.debitur_noktp AS debitur_noktp,
debitur.debitur_jk AS debitur_jk,
debitur.debitur_pekerjaan AS debitur_pekerjaan,
debitur.debitur_penghasilan AS debitur_penghasilan,
debitur.debitur_penghasilan2 AS debitur_penghasilan2,
penjamin.penjamin_no_penjamin AS penjamin_no_penjamin,
penjamin.penjamin_nama AS penjamin_nama,
penjamin.penjamin_alamat AS penjamin_alamat,
penjamin.penjamin_tgllahir AS penjamin_tgllahir,
penjamin.penjamin_hubungan AS penjamin_hubungan,
aplikasi.aplikasi_no_aplikasi AS aplikasi_no_aplikasi,
aplikasi.aplikasi_merk_motor AS aplikasi_merk_motor,
aplikasi.aplikasi_jenis_motor AS aplikasi_jenis_motor,
aplikasi.aplikasi_warna AS aplikasi_warna,
aplikasi.aplikasi_tpenghasilan AS aplikasi_tpenghasilan,
akad.akad_no_dokumen AS akad_no_dokumen,
akad.akad_tgl AS akad_tgl,
akad.penjamin_no_penjamin AS penjamin_no_penjamin,
akad.akad_tenor AS akad_tenor,
akad.akad_merk_motor AS akad_merk_motor,
akad.akad_jenis_motor AS akad_jenis_motor,
akad.akad_harga AS akad_harga,
akad.akad_no_rangka AS akad_no_rangka,
akad.akad_no_mesin AS akad_no_mesin,
akad.akad_angsuran AS akad_angsuran,
akad.akad_status AS akad_status
FROM
debitur
INNER JOIN penjamin ON debitur.penjamin_no_penjamin = penjamin.penjamin_no_penjamin
INNER JOIN aplikasi ON debitur.debitur_no_rekening = aplikasi.debitur_no_rekening
INNER JOIN akad ON debitur.debitur_no_rekening = akad.debitur_no_rekening
WHERE akad.akad_no_dokumen='$no_dok'
";
$e=mysql_fetch_array(mysql_query($query));
echo "<div id='title'>Pengajuan > Edit</div>
		<div style='height:8px;'></div>
		<form method='POST' id='fromForm' action='?module=pengajuan&act=edit-pengajuan'>
		<table class='data form' width='100%' cellpadding='4'>
			<tr class='title'>
				<th colspan='3'>Data Debitur</th>
			</tr>
            <tr>
            	<td width='140'></td>
                <td width='1'></td>
                <td align='right'>Nomor Aplikasi : <input type='text'  name='aplikasi_no_aplikasi' value='$e[aplikasi_no_aplikasi]' disabled style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Nama</td>
                <td>:</td>
                <td><input type='text' name='debitur_nama' value='$e[debitur_nama]' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Alamat</td>
                <td>:</td>
                <td><input type='text' name='debitur_alamat' value='$e[debitur_alamat]' style='width:475px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type='text' name='debitur_tgllahir' value='$e[debitur_tgllahir]' style='width:95px;' class='tgl_lahir'  readonly/></td>
             </tr>";
		if($d[debitur_jk]=='Laki-Laki'){
			echo"<tr class='even'>
            	<td>Jenis Kelamin</td>
                <td>:</td>
              	<td><input type='radio' name='debitur_jk' value='Laki-Laki'><label for='Laki-Laki'>Laki-Laki</label>
					<input type='radio' name='debitur_jk' value='Perempuan'  checked><label for='Perempuan'>Perempuan</label></td>
             </tr>";
		}else {
			echo"<tr class='even'>
            	<td>Jenis Kelamin</td>
                <td>:</td>
              	<td><input type='radio' name='debitur_jk' value='Laki-Laki'  checked ><label for='Laki-Laki'>Laki-Laki</label>
					<input type='radio' name='debitur_jk' value='Perempuan'><label for='Perempuan'>Perempuan</label></td>
             </tr>";
			
		}
			echo"<tr class='odd'>
            	<td>Pekerjaan</td>
                <td>:</td>
                <td><select name='debitur_pekerjaan' class='input'>
           			<option value='$e[debitur_pekerjaan]' selected>$e[debitur_pekerjaan]</option>
           			<option value='PNS'>PNS</option>
           			<option value='ABRI'>ABRI</option>
           			<option value='Wiraswasta'>Wiraswasta</option>
           			<option value='Petani'>Petani</option>
           			<option value='Nelayan'>Nelayan</option>
           			<option value='Lainnya'>Lainnya</option>
                    </select></td>
             </tr>
		<tr class='even'>
            	<td>No.KTP</td>
                <td>:</td>
                <td><input type='text' name='debitur_noktp' value='$e[debitur_noktp]' style='width:275px;' class='input' /></td>
             </tr>            
			<tr class='odd'>
            	<td>No.Rekening</td>
                <td>:</td>
                <td><input type='text' id='debitur_no_rekening' name='debitur_no_rekening' value='$e[debitur_no_rekening]' style='width:275px;' class='input'  readonly/></td>
             </tr>     
			<tr class='even'>
            	<td>Penghasilan Utama</td>
                <td>:</td>
                <td><input id='debitur_penghasilan' type='text' name='debitur_penghasilan' value='$e[debitur_penghasilan]' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Penghasilan Tambahan</td>
                <td>:</td>
                <td><input id='debitur_penghasilan_2'  type='text' name='debitur_penghasilan2' value='$e[debitur_penghasilan2]' style='width:95px;' class='input' /></td>
               
             </tr>       
             </table>    
		<div style='height:8px;'></div>         
		<table class='data form' width='100%' cellpadding='3'>
			<tr class='title'>
				<th colspan='3'>Data Penjamin</th>
			</tr> 
			<tr class='even'>
            	<td width='140'>Nomor Penjamin</td>
                <td width='1'>:</td>
                <td><input type='text' name='penjamin_no_penjamin' value='$e[penjamin_no_penjamin]' disabled style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Nama Penjamin</td>
                <td>:</td>
                <td><input type='text' name='penjamin_nama' value='$e[penjamin_nama]' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Alamat</td>
                <td>:</td>
                <td><input type='text' name='penjamin_alamat' value='$e[penjamin_alamat]' style='width:475px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Hubungan</td>
                <td>:</td>
                <td><select name='penjamin_hubungan' class='input'>
           			<option value='$e[penjamin_hubungan]' selected>$e[penjamin_hubungan]</option>
           			<option value='Istri' >Istri</option>
           			<option value='Suami' >Suami</option>
           			<option value='Adik' >Adik</option>
           			<option value='Kakak' >Kakak</option>
           			<option value='Ayah' >Ayah</option>
           			<option value='Ibu' >Ibu</option>
           			<option value='Lainnya' >Lainnya</option>
                    </select></td>
             </tr>
            </table>
         <div style='height:8px;'></div>         
		<table class='data form' width='100%' cellpadding='3'>
			<tr class='title'>
				<th colspan='3'>Data Aplikasi</th>
			</tr> 
			<tr class='even'>
            	<td width='140'>Merk Motor</td>
                <td width='1'>:</td>
                <td><select name='merk_motor' class='input'>
           			<option value='$e[aplikasi_merk_motor]' selected>$e[aplikasi_merk_motor]</option>
           			<option value='Honda' >Honda</option>
           			<option value='Yamaha' >Yamaha</option>
           			<option value='Suzuki'>Suzuki</option>
           			<option value='Kawasaki' >Kawasaki</option>
           			<option value='Vespa' >Vespa</option>
                    </select></td>
             </tr>
			<tr class='odd'>
            	<td width='140'>Jenis Motor</td>
                <td width='1'>:</td>
                <td><input type='text' name='jenis_motor' value='$e[aplikasi_jenis_motor]' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Warna Motor</td>
                <td>:</td>
                <td><input type='text' name='warna' value='$e[aplikasi_warna]' style='width:95px;' class='input' /></td>
             </tr>
            </table>
         <div style='height:8px;'></div>   
		<table class='data form' width='100%' cellpadding='3'>
			<tr class='title'>
				<th colspan='3'>Data Akad</th>
			</tr> 
			<tr class='even'>
            	<td width='140'>Nomor Dokumen</td>
                <td width='1'>:</td>
                <td><input type='text' name='akad_no_dokumen' value='$e[akad_no_dokumen]' disabled style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Harga Motor</td>
                <td width='1'>:</td>
                <td><input type='text' id='akad_harga' name='akad_harga' value='$e[akad_harga]' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Tenor</td>
                <td width='1'>:</td>
                <td><input type='text' id='akad_tenor' name='akad_tenor' value='$e[akad_tenor]' style='width:25px;' class='input' />Bulan *(Max 36 Bulan)</td>
             </tr> 
			<tr class='odd'>
            	<td>Nomor Rangka</td>
                <td>:</td>
                <td><input type='text' name='akad_no_rangka' value='$e[akad_no_rangka]' style='width:125px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Nomor Mesin</td>
                <td>:</td>
                <td><input type='text' name='akad_no_mesin' value='$e[akad_no_mesin]' style='width:125px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Angsuran</td>
                <td>:</td>
                <td><input type='text' name='akad_angsuran' value='$e[akad_angsuran]' style='width:125px;' class='input' /></td>
             </tr>
			<tr class=even'>
            	<td>Status</td>
                <td>:</td>
                <td><input type='text' name='akad_status' value='$e[akad_status]' style='width:125px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Akad Tanggal</td>
                <td>:</td>
                <td><input type='text' name='akad_tgl' value='$e[akad_tgl]' style='width:125px;' class='input' id='tgl' /></td>
             </tr>
			<tr>
				<td colspan='3'><input type='submit'   name='update' class='button' value='Update'>
					<input type='button' class='button' value='Kembali' onClick='self.history.back()'></td>
			</tr>
            
         </table>	
		
		</form>";
	break;


//PENYERAHAAN//
case "penyerahan":

if (isset($_POST['simpan']))
{
	date_default_timezone_set('Asia/Jakarta');
	
	$nober=$_POST['no_berita_acara'];
	$nodok=$_POST['no_dokumen'];
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$merk_motor=$_POST['merk_motor'];
	$jenis_motor=$_POST['jenis_motor'];
	$nosur=$_POST['nosur'];
	$tgl=$_POST['tgl_penyerahan'];
	$nomesin=$_POST['no_mesin'];
	$norang=$_POST['no_rangka'];
	$warna=$_POST['warna'];
	$status=$_POST['akad_status'];
	$tgl=date('Y-m-d');
	$yang_menyerahkan=$_POST['yang_menyerahkan'];
	$no_polisi=$_POST['no_polisi'];
	
	//Debitur Validasi
	if ($no_polisi == ''){
	$g[] = "Nomor Polisi, ";
	}
	if ($nober == ''){
	$g[] = "Nomor Berita Acara, ";
	}
	if ($nosur== ''){
	$g[] = "Nomor Surat Jalan, ";
	}
	if ($yang_menyerahkan == ''){
	$g[] = "Yang Menyerahkan, ";
	}
	if ($tgl == ''){
	$g[] = "Tanggal Penyerahaan, ";
	}
		$query="INSERT INTO `penyerahan`(`no_berita_acara`,	
				`no_dokumen`,			
				`nama`, 			
				`alamat`,			
				`merk_motor`,		
				`jenis_motor`,		
				`no_surat_jalan`,	
				`tgl_penyerahan`,	
				`yang_menyerahkan`,		
				`no_polisi`,		
				`no_mesin`,							
				`no_rangka`,	
				`warna`,
				`status`)
				VALUES(
				'$nober',	
				'$nodok',			
				'$nama', 			
				'$alamat',			
				'$merk_motor',		
				'$jenis_motor',	
				'$nosur',	
				'$tgl',	
				'$yang_menyerahkan',
				'$no_polisi',
				'$nomesin',			
				'$norang',	
				'$warna',
				'$status')";
	if(isset($g))
	{
	echo "<div id='kuning'>Error: ".implode($g)."</div>";
	
	}else
	
	{
		if(mysql_query($query))
		{
		echo "<div id='green'>Berhasil Menyimpan</div>";
		}else
		{
		echo "<div id='red'>Gagal Menyimpan</div>";
		}
	}
	
}
	$no_dok=$_GET['no_dok'];
	$query=mysql_query("
	SELECT debitur.*, aplikasi.*, penjamin.*, akad.* FROM
	debitur
	INNER JOIN penjamin ON debitur.penjamin_no_penjamin = penjamin.penjamin_no_penjamin
	INNER JOIN aplikasi ON debitur.debitur_no_rekening = aplikasi.debitur_no_rekening
	INNER JOIN akad ON debitur.debitur_no_rekening = akad.debitur_no_rekening
	WHERE akad.akad_no_dokumen='$no_dok'
	");
	$d = mysql_fetch_array($query);
	echo "<div id='title'>Pengajuan > Penyerahaan</div>
		<div style='height:8px;'></div>	
		<form method='POST' id='fromForm' action='?module=pengajuan&act=penyerahan&no_dok=$d[akad_no_dokumen]'>
		<table class='data form' width='100%' cellpadding='4'>
			<tr class='title'>
				<th colspan='3'>Data Debitur</th>
			</tr>
			<tr class='even'>
            	<td width='140'>Nomor Dokumen</td>
                <td width='1'>:</td>
                <td><input type='text' name='no_dokumen' value='$d[akad_no_dokumen]' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td>Nama</td>
                <td>:</td>
                <td><input type='text' name='nama'  value='$d[debitur_nama]' maxlength='20' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Alamat</td>
                <td>:</td>
                <td><input type='text' name='alamat' value='$d[debitur_alamat]' style='width:475px;' class='input' /></td>
             </tr>
			</table>
		<div style='height:8px;'></div>
		<table class='data form' width='100%' cellpadding='4'>
			<tr class='title'>
				<th colspan='3'>Data Pesanan</th>
			</tr>
			<tr class='even'>
            	<td width='140'>Merk Motor</td>
                <td width='1'>:</td>
                <td><select name='merk_motor' class='input'>
           			<option value='$d[aplikasi_merk_motor]' selected>$d[aplikasi_merk_motor]</option>
           			<option value='Honda' >Honda</option>
           			<option value='Yamaha' >Yamaha</option>
           			<option value='Suzuki'>Suzuki</option>
           			<option value='Kawasaki' >Kawasaki</option>
           			<option value='Vespa' >Vespa</option>
                    </select></td>
             </tr>
			<tr class='odd'>
            	<td>Jenis Motor</td>
                <td>:</td>
                <td><input type='text' name='jenis_motor' value='$d[aplikasi_jenis_motor]' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td width='140'>Warna Motor</td>
                <td width='1'>:</td>
                <td><input type='text' name='warna' value='$d[aplikasi_warna]' style='width:95px;' class='input' /></td>
             </tr>
		</table>
		<div style='height:8px;'></div>
		<table class='data form' width='100%' cellpadding='4'>	
			<tr class='title'>
				<th colspan='3'>Kelengkapan Info</th>
			</tr>	
			<tr class='even'>
            	<td width='140'>Nomor Polisi</td>
                <td width='1'>:</td>
                <td><input type='text' name='no_polisi'  style='width:95px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td width='140'>Nomor Rangka</td>
                <td width='1'>:</td>
                <td><input type='text' name='no_rangka' value='$d[akad_no_rangka]' style='width:95px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td>Nomor Mesin</td>
                <td>:</td>
                <td><input type='text' name='no_mesin' value='$d[akad_no_mesin]' style='width:95px;' class='input' /></td>
             </tr>
		</table>
		<div style='height:8px;'></div>
		<table class='data form' width='100%' cellpadding='4'>	
			<tr class='title'>
				<th colspan='3'>Data Berita Acara</th>
			</tr>	
			<tr class='even'>
            	<td width='140'>Nomor Berita Acara</td>
                <td width='1'>:</td>
                <td><input type='text' name='no_berita_acara' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='odd'>
            	<td width='140'>Nomor Surat Jalan</td>
                <td width='1'>:</td>
                <td><input type='text' name='nosur' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td width='140'>Tanggal</td>
                <td width='1'>:</td>
                <td>";echo date('Y-m-d');
       echo"</td>
             </tr>
			<tr class='odd'>
            	<td width='140'>Yang Menyerahkan</td>
                <td width='1'>:</td>
                <td><input type='text' name='yang_menyerahkan' style='width:275px;' class='input' /></td>
             </tr>
			<tr class='even'>
            	<td width='140'>Status</td>
                <td width='1'>:</td>
                <td><input type='text' name='akad_status' value='$d[akad_status]' style='width:95px;' class='input' /></td>
             </tr>
			<tr>
				<td colspan='3'><input type='submit'   name='simpan' class='button' value='Simpan'>
					<input type='button' class='button' value='Kembali' onClick='self.history.back()'></td>
			</tr>
            
		</table>
		</form>";
	break;
}

?>