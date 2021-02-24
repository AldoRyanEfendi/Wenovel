<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/Site template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<?php
		if(!isset($_SESSION)){
			session_start();
		}
	?>
<!-- InstanceBeginEditable name="doctitle" -->
	<title>Wenovel</title>
<!-- InstanceEndEditable -->
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="https://1wenovel1.000webhostapp.com/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="https://1wenovel1.000webhostapp.com/img/favicon.ico" type="image/x-icon">
<!-- InstanceBeginEditable name="head" -->
  	<?php
	require_once "db/koneksi.php";
	$unameproblem = FALSE;
	$passproblem = FALSE;
	if(isset($_POST['user'])){
		$check = "select username, max(id_user) from user;";
		$chek = $koneksi->query($check) or die($koneksi->error);
		while($cek = $chek->fetch_assoc()){
			if($cek['username']==$_POST['user']){
				$unameproblem = TRUE;
			}
			$iduser=$cek['max(id_user)'];
		}
		$iduser=$cek['max(id_user)'];
		if($_POST['pass']!=NULL and $_POST['user']!=NULL and $unameproblem==FALSE){
			if($_POST['tgl']==NULL){
				$tgl = "NULL";
			}else{
				$tgl = "'".$_POST['tgl']."'";
			}
			if($_POST['bio']==NULL){
				$bio = "NULL";
			}else{
				$bio = "'".$_POST['bio']."'";
			}
			$sql="insert into user values('','".$_POST['user']."','".$_POST['pass']."',".$tgl.",".$bio.",'0');";
			if ($koneksi->query($sql) === TRUE) {
				header("Location: login");
			} else {
    			echo "Error: " . $sql . "<br>" . $koneksi->error;
			}
		}
		if($_POST['user']==NULL){
			$unameproblem = TRUE;
		}
		if($_POST['pass']==NULL){
			$passproblem = TRUE;
		}
	}
	?>
<!-- InstanceEndEditable -->
</head>
<body style="background:rgb(232,232,232);">
	<div class="jumbotron" style="margin-bottom:0;background:url(https://1wenovel1.000webhostapp.com/img/Header.jpg)">
  		<h1>.</h1>
  		<p>.</p> 
	</div>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  		<img class="navbar-brand" src="https://1wenovel1.000webhostapp.com/img/logo.png" style="width:2em">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    		<span class="navbar-toggler-icon"></span>
  		</button>
	  	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
            <?php 
            	if(!isset($_SESSION['iduser'])){
            ?>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/">Home</a>
 	     	</li>
    	  	<li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/login">Login</a>
	      	</li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/tentang">Tentang Kami</a>
	      	</li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/kontak">Hubungi Kami</a>
	      	</li>
            <?php
            	}else if(isset($_SESSION['admin'])){if($_SESSION['admin']==1){
            ?>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/">Home</a>
 	     	</li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/user/<?php echo $_SESSION['iduser']; ?>">Profile</a>
	      	</li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/tambahnv">Tambahkan Novel</a>
	      	</li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/tambahch">Tambahkan Chapter</a>
	      	</li>
            <li class="nav-item">
            	<a class="nav-link" href="https://1wenovel1.000webhostapp.com/s">Search</a>
            </li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/logout.php">Logout</a>
	      	</li>
            <?php
            	}else{
            ?>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/">Home</a>
 	     	</li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/user/<?php echo $_SESSION['iduser']; ?>">Profile</a>
	      	</li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/author">Semua Pengarang</a>
	      	</li>
            <li class="nav-item">
            	<a class="nav-link" href="https://1wenovel1.000webhostapp.com/s">Search</a>
            </li>
            <li class="nav-item">
        		<a class="nav-link" href="https://1wenovel1.000webhostapp.com/logout.php">Logout</a>
	      	</li>
            <?php
            	}}
            ?>
    	</ul>
  		</div>  
	</nav>
	<div class="container" style="margin-top:30px;">
<!-- InstanceBeginEditable name="Content" -->
	<form action="register" method="post">
    <div class="form-group">
    	<label for="idnovel">Username : </label>
        <input type="text" class="form-control" placeholder="username" name="user" <?php if($unameproblem==TRUE){ ?>style="box-shadow:0px 1px 5px red;"<?php } ?>> *Wajib <?php if($unameproblem==TRUE){ echo '<span style="color:red">username sudah dipakai/kosong</span>'; } ?>
  	</div>
    <div class="form-group">
    	<label for="noch">Password : </label>
    	<input type="password" class="form-control" placeholder="password" name="pass" <?php if($passproblem==TRUE){ ?>style="box-shadow:0px 1px 5px red;"<?php } ?>> *Wajib <?php if($passproblem==TRUE){ echo '<span style="color:red">Password tidak boleh kosong</span>'; } ?>
  	</div>
    <div class="form-group">
    	<label for="isi">Bio : </label>
    	<input type="textarea" class="form-control" name="bio">
  	</div>
    <div class="form-group">
    	<label for="isi">tanggal lahir : </label>
    	<input type="date" class="form-control" name="tgl">
  	</div>
    <div class="form-group">
    	<input type="submit" id="save" class="btn btn-primary" value="Simpan"/>
    </div>
    </form>
<!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
