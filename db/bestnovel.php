<?php
	require_once "koneksi.php";
	$resnum = 12;
	if(isset($_GET["p"])){
		$page = $_GET["p"];
	}else{
		$page = 1;
	}
	$mulai_dari = ($page-1)*$resnum;
	$sql = "select novel.id_novel, judul_novel, img, avg(nilai_rate) as nil from novel join rate on novel.id_novel = rate.id_novel group by novel.id_novel order by nil desc limit ".$mulai_dari.", ".$resnum;
	$bestnovel = $koneksi->query($sql) or die($koneksi->error);
	$jumlah = mysqli_num_rows($bestnovel);
?>