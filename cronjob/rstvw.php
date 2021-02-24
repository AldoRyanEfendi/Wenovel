<?php
	$sname = "sql206.epizy.com";
	$uname = "epiz_25304016";
	$pass = "L4eQ4DtART";
	$dbname = "epiz_25304016_wenovel";
	$koneksi = new mysqli($sname, $uname, $pass, $dbname);
	if($koneksi->connect_error){
		die("Connection failed: ". $koneksi->connect_error);
	}
	$resetview = "update novel set view = 0";
	if ($koneksi->query($resetview) === TRUE) {
		echo "sukses";			
	} else {
		echo "Error: " . $sql . "<br>" . $koneksi->error;
	}
?>