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
		$ban = FALSE;
		if(isset($_POST['username']) and isset($_POST['pwd'])){
			$sql = "select id_user, admin from user where username = '".$_POST['username']."' and password = '".$_POST['pwd']."'";
			$hasil = $koneksi->query($sql) or die($koneksi->error);
			if($hasil->num_rows != 0){
				if($dataid = $hasil->fetch_assoc()){
						$_SESSION['iduser'] = $dataid['id_user'];
						if($dataid['admin']==1){
							$_SESSION['admin'] = TRUE;
						}else{
							$_SESSION['admin'] = FALSE;
						}
				}
				header ('Location: ../login/');
			}
			header ('Location: login?suc=0');
		}
		if(isset($_SESSION['iduser'])){
			header ('Location: index.php');
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
	 <form action="login" method="post">
     	<?php
			if(isset($_GET['suc'])){
				if($_GET['suc']==0){
				?>
        <div class="form-group">
        	<div class="alert alert-warning">
  				Username/Password salah
			</div>
        </div>
                <?php
				}else{
				?>
        <div class="form-group">
        	<div class="alert alert-warning">
  				Login untuk membaca novel
			</div>
        </div>
                <?php
				}
			}
		?>
        <?php
			if($ban == TRUE){
				?>
        <div class="form-group">
        	<div class="alert alert-warning">
  				Akun anda telah dibanned karena melanggar perturan. Jika ini adalah kesalahan, silahkan hubungi admin di email aldoryanefendi123@gmail.com 
			</div>
        </div>
                <?php
			}
		?>
  		<div class="form-group">
    		<label for="username">Username:</label>
    		<input type="username" class="form-control" placeholder="Enter username" id="username" name="username">
 	 	</div>
		<div class="form-group">
	    	<label for="pwd">Password:</label>
    		<input type="password" class="form-control" placeholder="Enter password" id="pwd" name="pwd">
  		</div>
  		<div class="form-group form-check">
    		<label class="form-check-label">Masih Belum Punya akun? <a href="register">Daftar Sebagai User</a></label>
  		</div>
  		<input  type="submit" class="btn btn-primary" value="Login"></button>
	</form> 
<!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
