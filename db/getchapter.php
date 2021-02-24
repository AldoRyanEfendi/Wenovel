<?php
	require_once "koneksi.php";
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "select chapter.isi_chapter, chapter.no_chapter, chapter.id_chapter, novel.id_novel, novel.view from chapter join novel on chapter.id_novel = novel.id_novel where chapter.id_chapter = ".$id;
		$sql2 = "select min(no_chapter) minch from chapter where id_novel = (select id_novel from chapter where id_chapter = ".$id.")";
		$sql3 = "select max(no_chapter) maxch from chapter where id_novel = (select id_novel from chapter where id_chapter = ".$id.")";
		$chdetail = $koneksi->query($sql) or die($koneksi->error);
		$chmin = $koneksi->query($sql2) or die($koneksi->error);
		$chmax = $koneksi->query($sql3) or die($koneksi->error);
	}elseif(isset($_GET['idnov'])){
			$resnum = 10;
		if(isset($_GET["p"])){
			if($_GET["p"]==NULL){
				$page=1;
			}else{
				$page = $_GET["p"];
			}
		}else{
			$page = 1;
		}
		$mulai_dari = ($page-1)*$resnum;
		$id = $_GET['idnov'];
		$sql = "select * from chapter where id_novel=".$id." order by tanggal desc, no_chapter desc limit ".$mulai_dari.", ".$resnum;
		$ch = $koneksi->query($sql) or die($koneksi->error);
		$jumlah = mysqli_num_rows($ch);
	}else{
		$sql = "select * from chapter";
		$chapter = $koneksi->query($sql) or die($koneksi->error);
	}
		
?>