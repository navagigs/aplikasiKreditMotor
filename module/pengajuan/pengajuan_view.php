<?php
session_start();
include "../../config/koneksi.php";
$no_dok=$_GET['no_dok'];
$query="SELECT 
debitur.debitur_nama AS debitur_nama,
debitur.debitur_alamat AS debitur_alamat,
debitur.debitur_noktp AS debitur_noktp,
debitur.debitur_jk AS debitur_jk,
debitur.debitur_pekerjaan AS debitur_pekerjaan,
debitur.debitur_penghasilan AS debitur_penghasilan,
debitur.debitur_penghasilan2 AS debitur_penghasilan2,
debitur.debitur_tgllahir AS debitur_tgllahir,
penjamin.penjamin_no_penjamin AS penjamin_no_penjamin,
penjamin.penjamin_nama AS penjamin_nama,
penjamin.penjamin_alamat AS penjamin_alamat,
penjamin.penjamin_tgllahir AS penjamin_tgllahir,
penjamin.penjamin_hubungan AS penjamin_hubungan,
debitur.debitur_no_rekening AS debitur_no_rekening,
aplikasi.aplikasi_no_aplikasi AS aplikasi_no_aplikasi,
aplikasi.aplikasi_warna AS aplikasi_warna,
aplikasi.aplikasi_tpenghasilan AS aplikasi_tpenghasilan,
akad.akad_no_dokumen AS akad_no_dokumen,
akad.akad_tgl AS akad_tgl,
akad.akad_tenor AS akad_tenor,
akad.akad_merk_motor AS akad_merk_motor,
akad.akad_jenis_motor AS akad_jenis_motor,
akad.akad_harga AS akad_harga,
akad.akad_no_rangka AS akad_no_rangka,
akad.akad_no_mesin AS akad_no_mesin,
akad.akad_angsuran AS akad_angsuran,
akad.akad_status AS akad_status

FROM
penjamin
INNER JOIN debitur ON debitur.penjamin_no_penjamin = penjamin.penjamin_no_penjamin
INNER JOIN aplikasi ON debitur.debitur_no_rekening = aplikasi.debitur_no_rekening
INNER JOIN akad ON debitur.debitur_no_rekening = akad.debitur_no_rekening
WHERE akad.akad_no_dokumen='$no_dok'
";
$send=mysql_query($query) ;
$res=mysql_fetch_array($send);

$query2 = "SELECT no_berita_acara, no_surat_jalan, yang_menyerahkan, tgl_penyerahan, no_polisi FROM penyerahan WHERE no_dokumen='$no_dok'";
$send2=mysql_query($query2) ;
$res2=mysql_fetch_array($send2);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detail </title>
<style type="text/css">
<!--
.style23 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; margin-bottom:20px;}
.style24 {font-size: 10px;}
.style25 {font-size:11px; }
.style26 {font-size:12px; font-weight:bold; padding:3px; }
#judul {
}
table {
	border:none;
	font-size:10px;
}
.ttd {
	margin:20px auto;	
	border-bottom:1px solid #000 dashed;
}
.judul {
	padding:4px;
	margin:auto;
	font-size:18px;
	font-weight:bold;
	border:1px solid #000 dashed;
}
td {
	font-size:9px;
	padding-bottom:3px;
}
p {
	font-size:10px;
	border-bottom:1px solid #000;
	font-weight:bold;
}
.detail {
	font-size:14px;
	margin:auto;
}
</style>
</head>
<body>
<div id="judul"><span class="style23">HAURWANGI MOTOR</span></div>
<table class="data form" width="398" height="62">
	<tr>
    	<td colspan="3" class="judul"><p align="center"><span class='detail'>DETAIL DATA DEBITUR</span></p></td>
    </tr>
	<tr><td colspan="3"></td></tr>
    <tr>
    	<td width="170">Nomor Dokumen</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_no_dokumen']; ?></td>
 	</tr>
	<tr>
    	<td colspan="3" ><p align="center">DATA DEBITUR</p></td>
    </tr>
    <tr>
    	<td width="170">Nomor Rekening</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['debitur_no_rekening'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Nama Lengkap</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['debitur_nama'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Alamat Lengkap</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['debitur_alamat'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Jenis Kelamin</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['debitur_jk'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Tanggal Lahir</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['debitur_tgllahir'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Nomor KTP</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['debitur_noktp'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Pekerjaan</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['debitur_pekerjaan'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Penghasilan / Bulan</td>
        <td width="13">:</td>
    	<td width="550">Rp. <?=$res['debitur_penghasilan'] ?>, 00</td>
 	</tr>
    <tr>
    	<td width="170">Penghasilan Tambahan</td>
        <td width="13">:</td>
    	<td width="550">Rp. <?=$res['debitur_penghasilan2'] ?>, 00</td>
 	</tr>
	<tr>
    	<td colspan="3" ><p align="center">DATA PENJAMIN</p></td>
    </tr>
    <tr>
    	<td width="170">Nama Lengkap</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['penjamin_nama'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Alamat</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['penjamin_alamat'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Hubungan</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['penjamin_hubungan'] ?></td>
 	</tr>
	<tr>
    	<td colspan="3" ><p align="center">DATA APLIKASI</p></td>
    </tr>
    <tr>
    	<td width="170">Nomor Aplikasi</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['aplikasi_no_aplikasi'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Warna Motor</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['aplikasi_warna'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Penghasilan Total</td>
        <td width="13">:</td>
    	<td width="550">Rp. <?=$res['aplikasi_tpenghasilan'] ?>, 00</td>
 	</tr>
	<tr>
    	<td colspan="3" ><p align="center">DATA PENYERAHAN</p></td>
    </tr>
    <tr>
    	<td width="170">Tanggal Penyerahan</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_tgl'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Merk Motor</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_merk_motor'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Jenis Motor</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_jenis_motor'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Tenor</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_tenor'] ?> Bulan</td>
 	</tr>
    <tr>
    	<td width="170">Harga Motor</td>
        <td width="13">:</td>
    	<td width="550">Rp. <?=$res['akad_harga'] ?>, 00</td>
 	</tr>
    <tr>
    	<td width="170">Nomor Rangka Motor</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_no_rangka'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Nomor Mesin Motor</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_no_mesin'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Nomor Polisi</td>
        <td width="13">:</td>
    	<td width="550"><?=$res2['no_polisi'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Angsuran / Bulan</td>
        <td width="13">:</td>
    	<td width="550">Rp. <?=$res['akad_angsuran'] ?>, 00</td>
 	</tr>
    <tr>
    	<td width="170">Status</td>
        <td width="13">:</td>
    	<td width="550"><?=$res['akad_status'] ?> </td>
 	</tr>
    <tr>
    	<td width="170">Nomor Berita Acara</td>
        <td width="13">:</td>
    	<td width="550"><?=$res2['no_berita_acara'] ?></td>
 	</tr>
    <tr>
    	<td width="170">Nomor Surat Jalan</td>
        <td width="13">:</td>
    	<td width="550"><?=$res2['no_surat_jalan'] ?></td>
 	</tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    </tr>
    	<tr>
        	<td colspan="2"><p align="left">Ttd,<br />Yang Menerima<br /><br /><br /><br /><br /><br /><br />
    	(<?=$res['debitur_nama'] ?>)</p></td>
        	<td colspan="3"><p align="right">Ttd,<br />Yang Menyerahkan<br /><br /><br /><br /><br /><br /><br />
    	(<?=$res2['yang_menyerahkan'] ?>)</p></td>
      	</tr>
    <tr>
    	<td colspan="3"><div class="ttd"></div></td>
    </tr>
	<tr>
    	<td colspan="3"><b>DETAIL DATA DEBITUR</b></td>
    </tr>
</table>

</body>
</html>