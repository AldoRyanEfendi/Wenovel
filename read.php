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
		if(!isset($_GET["id"])){
			header("Location: ../");
		}
		require_once "db/getchapter.php";
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
  <div class="container-fluid">
  		<?php 
			if(!isset($_SESSION)){
				session_start();
			}
			while($baris = $chmin->fetch_assoc()){$min=$baris["minch"];} while($baris = $chmax->fetch_assoc()){$max=$baris["maxch"];} while($baris = $chdetail->fetch_assoc()){ 
				//Pastikan Belum dibuka sebelumnya
				$sudahdibaca=false;
				if(!isset($_SESSION['read'])){
					$_SESSION['read'] = array($_GET['id']);
				}else{
					for($x=0;$x<count($_SESSION['read']);$x++){
						if($_SESSION['read'][$x]==$_GET['id']){
							$sudahdibaca=true;
						}
					}
				}
				//Jika belum dibaca
				if($sudahdibaca==false){
					//Ambil jumlah view lalu tambahkan
					$view = $baris["view"];
					$view++;
							
					//Update jumlah view
					$plusview = "update novel set view = ".$view." where id_novel = ".$baris['id_novel'];
					if ($koneksi->query($plusview) === TRUE) {
					
					} else {
						echo "Error: " . $sql . "<br>" . $koneksi->error;
					}
					//Tinggalkan data dibaca
					array_push($_SESSION['read'], $baris['id_chapter']);
				}
				//ambil id chapter selanjutnya
				$selanjutnya = $baris['no_chapter'];
				$sql4="select id_chapter from chapter where id_novel = ".$baris['id_novel']." limit ".$selanjutnya.",1";
				$nextch=$koneksi->query($sql4) or die($koneksi->error);
				while($next=$nextch->fetch_assoc()){$nextchid=$next["id_chapter"];}
				
				//ambil id chapter sebelumnya
				$prev = $baris['no_chapter']-2;
				if($prev<0){$prev=0;}
				$sql5="select id_chapter from chapter where id_novel = ".$baris['id_novel']." limit ".$prev.",1";
				$prevch=$koneksi->query($sql5) or die($koneksi->error);
				while($prev=$prevch->fetch_assoc()){$prevchid=$prev["id_chapter"];}
		?>
  	<center>
    	<?php if($baris["no_chapter"] != $min){ ?>
    	<a href="../read/<?php echo $prevchid; ?>"><img src="../img/back.png" style="width:6em"/></a>
        <?php } ?>
        <a href="../novel/<?php echo $baris["id_novel"]; ?>"><img src="../img/toc.png" style="width:6em"/></a>
        <?php if($baris["no_chapter"] != $max){ ?>
        <a href="../read/<?php echo $nextchid; ?>"><img src="../img/forward.png" style="width:6em"/></a>
        <?php } ?>
        <br><br>
    	<h3><?php 
				if($baris["no_chapter"]==0){
					echo "Prologue";
				}else{?>
                    Chapter <?php echo $baris["no_chapter"]; ?>
             <?php } ?></h3>
    </center>
        <?php echo $baris["isi_chapter"]; ?>
    <center>
    	<?php if($baris["no_chapter"] != $min){ ?>
    	<a href="../read/<?php echo $prevchid; ?>"><img src="../img/back.png" style="width:6em"/></a>
        <?php } ?>
        <a href="../novel/<?php echo $baris["id_novel"]; ?>"><img src="../img/toc.png" style="width:6em"/></a>
        <?php if($baris["no_chapter"] != $max){ ?>
        <a href="../read/<?php echo $nextchid; ?>"><img src="../img/forward.png" style="width:6em"/></a>
        <?php } ?>
        <br><br>
    </center>
    <?php } ?>
  </div>
<!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
