<?php
	require_once "koneksi.php";
	$resnum = 12;
	if(isset($_GET["p"])){
		$page = $_GET["p"];
	}else{
		$page = 1;
	}
	//Masukan tanggal dan durasi saat ini
			$tahun=date("Y");
			$bulan=date("m");
			$tanggal=date("d");
			$durasi=7;
			//Tentukan Tanggal/Bulan
			if($tanggal-$durasi<1){
				$bulan--;
				if($bulan<8){if($bulan%2==0){$hari=30;}else{$hari=31;}}else{if($bulan%2!=0){$hari=30;}else{$hari=31;}}
				if($bulan==2){if($tahun%4==0){$hari=29;}else{$hari=28;}}
				$tanggal=$durasi-$tanggal;
				$tanggal=$hari-$tanggal;
			}else{
				$tanggal=$tanggal-$durasi;
			}
			$tgl=$tahun."-".$bulan."-".$tanggal;
	$mulai_dari = ($page-1)*$resnum;
	$sql = "select novel.id_novel, judul_novel, img from novel join chapter on novel.id_novel = chapter.id_novel where tanggal in (select max(tanggal) from chapter group by id_novel) and tanggal > '".$tgl."' group by novel.id_novel order by tanggal desc limit ".$mulai_dari.", ".$resnum;
	$newnovel = $koneksi->query($sql) or die($koneksi->error);
	$jumlahnew = mysqli_num_rows($newnovel);
	$sql = "select novel.id_novel, judul_novel, img from novel join chapter on novel.id_novel = chapter.id_novel group by novel.id_novel order by tanggal desc limit ".$mulai_dari.", ".$resnum;
	$newnovel = $koneksi->query($sql) or die($koneksi->error);
	$jumlah = mysqli_num_rows($newnovel);
?>