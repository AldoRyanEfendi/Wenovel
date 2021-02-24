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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <?php
		require_once "db/popularnovel.php";
		require_once "db/newnovel.php";
		require_once "db/announcement.php";
	?>
	<style>
	.fakeimg {
		height: 200px;
    	background: #aaa;
	}
	</style>
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
	<div class="row">
    	<div class="col-sm-4">
      		<h2>Novel Komedi terpopuler</h2>
      		<p>Novel Komedi Populer!!</p>
      		<ul class="nav nav-pills flex-column">
            	<?php
					while($baris = $popnovel->fetch_assoc()){
				?>
     						<li class="nav-item">
          						<a class="nav-link" href="novel/<?php echo $baris["id_novel"]; ?>"><img src="img/<?php echo $baris["img"]; ?>" style="width: 5em; margin-left:25%;"/><br><?php echo $baris["judul_novel"]; ?></a>
        					</li>
				<?php
					}
				?>
      		</ul>
      		<p>Pengumuman</p>
      		<ul class="nav nav-pills flex-column">
            <?php while($baris = $pemberitahuan->fetch_assoc()){ ?>
    			<li class="nav-item">
          			<a class="nav-link" href="announcement/<?php echo $baris["id_pem"]; ?>"><?php echo $baris["judul_pem"]; ?></a>
        		</li>
            <?php
				}
			?>
      		</ul>
	</div>
    <div class="col-sm-8">
      	<h2>Baru Diupdate!!</h2>
        <?php
			while($baris = $newnovel->fetch_assoc()){
		?>
        <center>
      	<img src="img/<?php echo $baris["img"]; ?>" style="width: 10em"/>
      	<a href="novel/<?php echo $baris["id_novel"]; ?>"><b><p><?php echo $baris["judul_novel"]; ?></p></b></a>
        <p>Terakhir diupdate : <?php echo $baris["tanggal"]; ?></p>
        </center>
      	<p><?php echo substr($baris["deskripsi"],0,200); ?><a href="novel/<?php echo $baris["id_novel"]; ?>">read more...</a></p>
      	<br>
        <?php
			} if(!isset($_GET['p'])){$halaman = 1;}else{$halaman = $_GET['p'];}
			if($halaman !=1){
		?>
        <a href="?p=<?php echo $halaman-1; ?>"><button type="button" class="btn btn-dark">Sebelumnya</button></a>
        <?php
			}if($jumlah ==3){
		?>
        <a href="?p=<?php echo $halaman+1; ?>"><button type="button" class="btn btn-dark">Selanjutnya</button></a>
        <?php
			}
		?>
    	</div>
  <!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
