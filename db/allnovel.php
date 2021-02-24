<?php
	require_once "koneksi.php";
	$resnum = 12;
	if(isset($_GET["p"])){
		$page = $_GET["p"];
	}else{
		$page = 1;
	}
	$mulai_dari = ($page-1)*$resnum;
	require_once "koneksi.php";
	$sql = "select * from novel order by judul_novel asc limit ".$mulai_dari.", ".$resnum;
	$allnovel = $koneksi->query($sql) or die($koneksi->error);
	$jumlah = mysqli_num_rows($allnovel);
?>