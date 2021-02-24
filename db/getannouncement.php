<?php
	require_once "koneksi.php";
	if(isset($_GET["id"])){ 
		$id = $_GET["id"];
		$sql = "select * from pemberitahuan where id_pem = ".$id;
	}else{
		$sql = "select * from pemberitahuan order by id_pem desc limit 0,1";
	}
	$pemberitahuan = $koneksi->query($sql) or die($koneksi->error);
?>