<?php
	require_once "koneksi.php";
	if(isset($_GET["idnov"])){
		$id = $_GET["idnov"];
		$sql = "select user.id_user, view, novel.id_novel, thn_rilis, judul_novel, deskripsi, bahasa, img, username, avg(nilai_rate), count(nilai_rate) from novel join user on novel.id_user = user.id_user join rate on novel.id_novel = rate.id_novel where novel.id_novel = ".$id;
	}else{
		$sql = "select * from novel order by judul_novel asc";
	}
	$getnovel = $koneksi->query($sql) or die($koneksi->error);
?>