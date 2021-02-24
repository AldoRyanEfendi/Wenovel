<?php
include "../db/koneksi.php";
session_start();
$tgl=date("Y-m-d");
				$sqlkomentar = "insert into comment values('','".$_POST['komentar']."', '".$_SESSION['iduser']."', '".$_POST['idnov']."', '".$tgl."')";
				if ($koneksi->query($sqlkomentar) === TRUE) {
					header("Location: novel/".$_POST['idnov']);
				} else {
    				echo "Error: " . $sqlkomentar . "<br>" . $koneksi->error;
				}
?>