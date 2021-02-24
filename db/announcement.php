<?php
	require_once "koneksi.php";
	$sql="select * from pemberitahuan order by tanggal_pem desc limit 0, 5";
	$pemberitahuan = $koneksi->query($sql) or die($koneksi->error);
?>