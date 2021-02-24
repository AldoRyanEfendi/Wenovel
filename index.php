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
		if(!isset($_GET['cat'])){
			$cat="A";
		}else{
			$cat=$_GET['cat'];
		}
	?>
    <style>
		#Menu #NActive{
			border-bottom:1px solid black;
			text-align:center;
		}
		#Menu #Active{
			border-bottom:1px solid blue;
			text-align:center;
			padding-bottom:5px;
		}
		a{
			color:black;
			text-decoration:none;
		}
		#Menu a{
			color:black;
		}
		#Menu a:hover{
			color:blue;
			text-decoration:none;
		}
		#Active a{
			color:blue;
			text-decoration:none;
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
		<div class="row" id="Menu">
        <?php 
		?>
        	<div class="col-sm-3" <?php if($cat=="A"){ ?>id="Active"<?php }else{ ?>id="NActive"<?php } ?>>
            	<a href="?cat=A"><?php if($cat=="A"){ ?><b><?php } ?>Semua Novel Komedi<?php if($cat=="A"){ ?></b><?php } ?></a>
            </div>
        	<div class="col-sm-3" <?php if($cat=="N"){ ?>id="Active"<?php }else{ ?>id="NActive"<?php } ?>>
            	<a href="?cat=N"><?php if($cat=="N"){ ?><b><?php } ?>Novel Komedi Terbaru<?php if($cat=="N"){ ?></b><?php } ?></a>
            </div>
            <div class="col-sm-3" <?php if($cat=="P"){ ?>id="Active"<?php }else{ ?>id="NActive"<?php } ?>>
            	<a href="?cat=P"><?php if($cat=="P"){ ?><b><?php } ?>Novel Komedi Populer<?php if($cat=="P"){ ?></b><?php } ?></a>
            </div>
            <div class="col-sm-3" <?php if($cat=="B"){ ?>id="Active"<?php }else{ ?>id="NActive"<?php } ?>>
            	<a href="?cat=B"><?php if($cat=="B"){ ?><b><?php } ?>Novel Komedi Terbaik<?php if($cat=="B"){ ?></b><?php } ?></a>
            </div>
        </div>
        <?php if($cat=="N"){ require_once "db/newnovel.php";?>
		<div class="row">
        	<?php if($jumlahnew==0){ ?>
            <div class="col-sm-12">
            	<center>Tidak ada novel baru sejak 7 hari yang lalu.</center>
            </div>
            <?php } ?>
            	<?php
					while($baris = $newnovel->fetch_assoc()){
				?>
     		<div class="col-sm-2">
          		<a class="nav-link" href="novel/<?php echo $baris["id_novel"]; ?>">
                	<center><img src="img/<?php echo $baris["img"]; ?>" style="height: 15em;"/><br><?php echo $baris["judul_novel"]; ?></center>
                </a>
        	</div>
				<?php
					} 
				?>
            </div>
            <div class="row">
        <?php 
			if(!isset($_GET['p'])){$halaman = 1;}else{$halaman = $_GET['p'];}
			if($halaman != 1){
		?>
        <a href="?cat=N&p=<?php echo $halaman-1; ?>"><button type="button" class="btn btn-dark">Sebelumnya</button></a>
        <?php
			}if($jumlah == 12){
		?>
        <a href="?cat=N&p=<?php echo $halaman+1; ?>"><button type="button" class="btn btn-dark">Selanjutnya</button></a>
        <?php
			}
		?>
        	</div>
        <?php }else if($cat=="P"){ require_once "db/popularnovel.php";?>
        <div class="row">
            	<?php
					while($baris = $popnovel->fetch_assoc()){
				?>
     		<div class="col-sm-2">
          		<a class="nav-link" href="novel/<?php echo $baris["id_novel"]; ?>">
                	<center><img src="img/<?php echo $baris["img"]; ?>" style="height: 15em; width: 11em;"/><br><?php echo $baris["judul_novel"]; ?></center>
                </a>
        	</div>
				<?php
					} 
				?>
            </div>
            <div class="row">
        <?php 
			if(!isset($_GET['p'])){$halaman = 1;}else{$halaman = $_GET['p'];}
			if($halaman != 1){
		?>
        <a href="?cat=P&p=<?php echo $halaman-1; ?>"><button type="button" class="btn btn-dark">Sebelumnya</button></a>
        <?php
			}if($jumlah == 12){
		?>
        <a href="?cat=P&p=<?php echo $halaman+1; ?>"><button type="button" class="btn btn-dark">Selanjutnya</button></a>
        <?php
			}
		?>
        	</div>
        <?php }else if($cat=="B"){ require_once "db/bestnovel.php";?>
        <div class="row">
            	<?php
					while($baris = $bestnovel->fetch_assoc()){
				?>
     		<div class="col-sm-2">
          		<a class="nav-link" href="novel/<?php echo $baris["id_novel"]; ?>">
                	<center><img src="img/<?php echo $baris["img"]; ?>" style="height: 15em; width: 11em;"/><br><?php echo $baris["judul_novel"]; ?></center>
                </a>
        	</div>
				<?php
					} 
				?>
            </div>
            <div class="row">
        <?php 
			if(!isset($_GET['p'])){$halaman = 1;}else{$halaman = $_GET['p'];}
			if($halaman != 1){
		?>
        <a href="?cat=B&p=<?php echo $halaman-1; ?>"><button type="button" class="btn btn-dark">Sebelumnya</button></a>
        <?php
			}if($jumlah == 12){
		?>
        <a href="?cat=B&p=<?php echo $halaman+1; ?>"><button type="button" class="btn btn-dark">Selanjutnya</button></a>
        <?php
			}
		?>
        	</div>
        <?php }else{ require_once "db/allnovel.php";?>
        <div class="row">
            	<?php
					while($baris = $allnovel->fetch_assoc()){
				?>
     		<div class="col-sm-2">
          		<a class="nav-link" href="novel/<?php echo $baris["id_novel"]; ?>">
                	<center><img src="img/<?php echo $baris["img"]; ?>" style="height: 15em; width: 11em;"/><br><?php echo $baris["judul_novel"]; ?></center>
                </a>
        	</div>
				<?php
					} 
				?>
            </div>
            <div class="row">
        <?php 
			if(!isset($_GET['p'])){$halaman = 1;}else{$halaman = $_GET['p'];}
			if($halaman != 1){
		?>
        <a href="?p=<?php echo $halaman-1; ?>"><button type="button" class="btn btn-dark">Sebelumnya</button></a>
        <?php
			}if($jumlah == 12){
		?>
        <a href="?p=<?php echo $halaman+1; ?>"><button type="button" class="btn btn-dark">Selanjutnya</button></a>
        <?php
			}
		?>
        	</div>
        <?php } ?>
<!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
