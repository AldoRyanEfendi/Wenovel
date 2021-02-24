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
    <?php
    	require_once "db/koneksi.php";
        if(isset($_GET['s']) and isset($_GET['t'])){
        	if($_GET['t'] == 'novel'){
            	$sql = "select * from novel where judul_novel like '%".$_GET['s']."%';";
            }elseif($_GET['t'] == 'user'){
            	$sql = "select * from user where username like '%".$_GET['s']."%';";
            }else{
				header("Location: s");
			}
            $sresult = $koneksi->query($sql) or die($koneksi->error);
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
	<form action="s" method="get">
    <div class="form-group">
    	<input type="text" class="form-control" id="search" placeholder="Search" name="s" <?php if(isset($_GET['s'])){ echo 'value="'.$_GET["s"].'"';} ?>>
  	</div>
    <div class="form-group">
    	<select name="t" class="form-control"><option value="novel">Novel</option><option value="user">Pengarang</option></select>
    </div>
    <div class="form-group">
    	<input type="submit" id="cari" class="btn btn-primary" value="Cari"/>
    </div>
    </form>
    <?php if(isset($_GET['s'])){ ?>
    <?php if($_GET['t'] == 'novel'){ ?>
    <?php while($result = $sresult->fetch_assoc()){ ?>
    <li class="media">
    	<div class="media-body">
            <center>
      			<img src="img/<?php echo $result["img"]; ?>" style="width: 10em"/>
      			<a href="novel/<?php echo $result["id_novel"]; ?>"><b><p><?php echo $result["judul_novel"]; ?></p></b></a>
        	</center>
      		<p><?php echo substr($result["deskripsi"],0,300); ?><a href="novel/<?php echo $result["id_novel"]; ?>">read more...</a></p>
      		<br>
        </div>
    </li>
    <?php } ?>
    <?php }elseif($_GET['t'] == 'user'){ ?>
    <?php while($result = $sresult->fetch_assoc()){ ?>
    <li class="media">
    	<div class="media-body">
      			<a href="user/<?php echo $result["id_user"]; ?>"><b><p><?php echo $result["username"]; ?></p></b></a>
      		<p><?php if($result["bio"] == NULL){echo "Author tidak menulis bio";}else{echo $result["bio"];} ?><a href="user/<?php echo $result["id_user"]; ?>"></a></p>
            <p>Umur : <?php if($result["tanggal_lahir"] == NULL){echo "Private";}else{echo date("Y")-substr($result['tanggal_lahir'],0,4);} ?>
      		<br>
        </div>
    </li>
    <?php } ?>
    <?php } ?>
    <?php } ?>
<!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
