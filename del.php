<?php
session_start();
require_once "db/koneksi.php";
$del = FALSE;
if(isset($_GET['idnov'])){
	$checksql = "select id_user from novel where id_novel = '".$_GET['idnov']."'";
	$checkquery = $koneksi->query($checksql) or die($koneksi->error);
	while($check = $checkquery->fetch_assoc()){if($check['id_user']!=$_SESSION['iduser'] and $_SESSION['admin'] == FALSE){header("Location: ../");}else{$del = TRUE;}}
	if($del==TRUE){
		$delsql = "delete from novel where id_novel = '".$_GET['idnov']."'";
		$delsql2 = "delete from chapter where id_novel = '".$_GET['idnov']."'";
	}
	$from = "nv";
}elseif(isset($_GET['idch'])){
	$checksql = "select id_user, id_novel from novel where id_novel = (select id_novel from chapter where id_chapter = '".$_GET['idch']."')";
	$checkquery = $koneksi->query($checksql) or die($koneksi->error);
	while($check = $checkquery->fetch_assoc()){if($check['id_user']!=$_SESSION['iduser'] and $_SESSION['admin'] == FALSE){header("Location: ../");}else{$del = TRUE; $idnov = $check['id_novel'];}}
	if($del==TRUE){
		$delsql = "delete from chapter where id_chapter = '".$_GET['idch']."'";
	}
	$from = "ch";
}elseif(isset($_GET['idcm'])){
	$checksql = "select id_user, id_novel from novel where id_novel = (select id_novel from comment where id_comment = '".$_GET['idcm']."')";
	$checkquery = $koneksi->query($checksql) or die($koneksi->error);
	while($check = $checkquery->fetch_assoc()){if($check['id_user']!=$_SESSION['iduser'] and $_SESSION['admin'] == FALSE){header("Location: ../");}else{$del = TRUE; $idnov = $check['id_novel'];}}
	if($del==TRUE){
		$delsql = "delete from comment where id_comment = '".$_GET['idcm']."'";
	}
	$from = "cm";
}
if(isset($delsql)){
	if ($koneksi->query($delsql) === TRUE) {
		if($from=="nv"){
			if ($koneksi->query($delsql2) === TRUE) {
				header("Location: user/".$_SESSION['iduser']);
			}
		}else{
			header("Location: novel/".$idnov);
		}
	}
}
?>