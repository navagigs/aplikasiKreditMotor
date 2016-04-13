<?php
$url = 'localhost';
$user = 'root';
$pass = '';
$db	  = 'db_ujikom_nava';

mysql_connect($url,$user,$pass) or die('Gagal');
mysql_select_db($db) or die ('Tidak ada');
?>