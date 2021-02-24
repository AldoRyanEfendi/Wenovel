<?php
	require_once "koneksi.php";
	$resnum = 12;
	if(isset($_GET["p"])){
		$page = $_GET["p"];
	}else{
		$page = 1;
	}
	$mulai_dari = ($page-1)*$resnum;
	$sql = "select novel.id_novel, judul_novel, img from novel group by novel.id_novel order by view desc limit ".$mulai_dari.", ".$resnum;
	$popnovel = $koneksi->query($sql) or die($koneksi->error);
	$jumlah = mysqli_num_rows($popnovel);
?>