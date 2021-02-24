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
  	<style>
  		.fakeimg {
    	height: 200px;
    	background: #aaa;
  	}
  	</style>
    <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/inline/ckeditor.js"></script>
    <script>
		$(function(){
    		$('#save').click(function () {
        		var isi = $('#editor').html();
        		$('#isich').val(isi);
    		});
		});
	</script>
    <?php 
		require_once 'db/getchapter.php';
		if(!isset($_SESSION['iduser'])){
			header("Location: ../login/");
		}
		$checksql = "select id_user, id_novel from novel where id_novel = (select id_novel from chapter where id_chapter = '".$_GET['id']."')";
		$checkquery = $koneksi->query($checksql);
		while($check = $checkquery->fetch_assoc()){if($check['id_user']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){}else{header("Location: ../novel/".$check['id_novel']);}}
		if(isset($_POST['noch'])){
			$update = 'update chapter set';
			$nomorch = "no_chapter = '".$_POST['noch']."'";
			$isi = "isi_chapter = '".$_POST['isi']."'";
			$sqlupdate = $update." ".$nomorch.", ".$isi." where id_chapter = '".$_POST['idch']."'";
			if ($koneksi->query($sqlupdate) === TRUE) {
				header("Location: ../read/".$_GET['id']);
			} else {
    			echo "Error: " . $sqlupdate . "<br>" . $koneksi->error;
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
<!-- Create the toolbar container -->
	<form action="../ubahch/<?php echo $_GET['id']; ?>" method="post">
    <?php while($get = $chdetail->fetch_assoc()){ ?>
    <div class="form-group">
    	<label for="noch">Chapter : </label>
    	<input type="text" class="form-control" id="noch" placeholder="Masukan Nomor chapter Gunakan 0 untuk prolog" name="noch" value="<?php echo $get['no_chapter']; ?>">
  	</div>
    <div class="form-group">
    	<label for="isi">Isi Chapter : </label>
    	<div id="editor"><?php echo $get['isi_chapter']; ?></div>
  	</div>
    <div class="form-group">
    	<input type="submit" id="save" class="btn btn-primary" value="Simpan"/>
    </div>
    <textarea id="isich" style="visibility:hidden;" name="isi"></textarea>
    <textarea id="idch" style="visibility:hidden;" name="idch"><?php echo $get['id_chapter']; ?></textarea>
    <?php } ?>
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
