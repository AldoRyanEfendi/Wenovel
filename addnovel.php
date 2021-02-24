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
  	<script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/inline/ckeditor.js"></script>
    <script>
		$(function(){
    		$('#save').click(function () {
        		var isi = $('#editor').html();
        		$('#desc').val(isi);
    		});
		});
	</script>
    <?php
	if(!isset($_SESSION['iduser'])){
			header("Location: ../login/");
	}
	require_once "db/koneksi.php";
	function randomseed($name){
		$seed = (date("Y")-rand(1,2000)) + (strlen($name)*rand(1,4)) + rand(1,30) + date("d");
		if(rand(0,10)<5){
			$seed = $seed . "_";
		}else{
			$seed = $seed . "-";
		}
		if(rand(0,10)>5){
			$seed = "_" . $seed;
		}else{
			$seed = "-" . $seed;
		}
		$seed = $seed . $name;
		return $seed;
	}
	function checkname($nama){
		$namag = randomseed($nama);
		if (file_exists("img/".$nama)) {
			checkname($namag);
		}
		return $namag;
	}
	$judulstat=TRUE;
	$descstat=TRUE;
	$bahasastat=TRUE;
	$gambar=TRUE;
	if(isset($_POST['jnovel'])){
		if($_POST['jnovel']==NULL){
			$judulstat=FALSE;
		}
		if($_POST['desc']==NULL){
			$descstat=FALSE;
		}
		if($_POST['bahasa']==NULL){
			$bahasastat=FALSE;
		}
		$filename = basename($_FILES['cover']['name']);
		if($filename == NULL){
			$gambar=FALSE;
		}
		$seed = 1;
		if($judulstat == TRUE && $descstat == TRUE && $bahasastat == TRUE && $gambar == TRUE){
			$filename = checkname($filename);
    		$filetarget = "img/".$filename;
			$tipefile = strtolower(pathinfo($filetarget,PATHINFO_EXTENSION));
			if($tipefile == "jpg" or $tipefile == "png" or $tipefile == "jpeg") {
				if(move_uploaded_file($_FILES["cover"]["tmp_name"], $filetarget)){
					
				}
			}
			$sql = "insert into novel values(NULL,'".$_POST['jnovel']."','".$_POST['desc']."','".date('Y')."','".$_POST['author']."','".$_POST['bahasa']."','".$filename."','0')";
			if ($koneksi->query($sql) === TRUE) {
				header("Location: tambahch");
			} else {
    			echo "Error: " . $sql . "<br>" . $koneksi->error;
			}
		}else{
			echo "Error";
			exit();
		}
	}
	$alluser = "select id_user, username from user order by username asc";
	$getuser = $koneksi->query($alluser) or die($koneksi->error);
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
<form action="tambahnv" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="jdnovel">* Judul Novel : </label>
        <input type="text" class="form-control" id="judul" placeholder="Judul Novel" name="jnovel">
	</div>
    <div class="form-group">
		<label for="jdnovel">* Author : </label>
        <select name="author" id="author" class="form-control">
        	<?php
            	while($baris = $getuser->fetch_assoc()){
            ?>
            	<option value="<?php echo $baris["id_user"]; ?>"><?php echo $baris['username']; ?></option>   
            <?php
                }
            ?>
        </select>
	</div>
    <div class="form-group">
		<label for="descnovel">* Deskripsi : </label>
        <div id="editor"></div>
	</div>
    <div class="form-group">
		<label for="bhnovel">* Bahasa : </label>
        <input type="text" class="form-control" id="bahasa" placeholder="Bahasa Novel" name="bahasa">
	</div>
    <div class="form-group">
		<label for="cvnovel">* Cover : </label>
        <input type="file" class="form-control" name="cover" id="cover">
	</div>
	<div class="form-group">
		<input type="submit" id="save" class="btn btn-primary" value="Simpan"/>
	</div>
    <textarea id="desc" style="visibility:hidden;" name="desc"></textarea>
</form>
<script>
	InlineEditor
		.create( document.querySelector( '#editor' ) ,{
        	removePlugins: [ 'ImageUpload', 'EasyImage', 'Image' ]
    	} )
</script>
<!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
