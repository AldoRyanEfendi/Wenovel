<?php
	$sname = "localhost";
	$uname = "root";
	$pass = "";
	$dbname = "wenovel";
	$koneksi = new mysqli($sname, $uname, $pass, $dbname);
	
	if($koneksi->connect_error){
		die("Connection failed: ". $koneksi->connect_error);
	}
?>