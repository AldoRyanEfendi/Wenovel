<?php
	require_once "koneksi.php";
	if(isset($_GET['idnov'])){
		$sqlkom = "select id_comment, comment, user.id_user, user.username , tanggal_comment from comment join user on comment.id_user = user.id_user where id_novel = '".$_GET['idnov']."' order by tanggal_comment desc";
		$komentar = $koneksi->query($sqlkom) or die($koneksi->error);
	}
?>