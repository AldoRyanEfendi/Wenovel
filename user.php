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
        $sqlus = "select * from user where id_user = '".$_GET['iduser']."';";
		$sqlno = "select novel.id_novel, judul_novel, tanggal from novel join chapter on novel.id_novel = chapter.id_novel where id_user = '".$_GET['iduser']."' group by id_novel order by tanggal desc;";
		$sqlko = "select novel.id_novel, judul_novel, tanggal_comment, id_comment from comment join novel on novel.id_novel = comment.id_novel where comment.id_user = '".$_GET['iduser']."' group by id_novel order by tanggal_comment desc;";
		$user = $koneksi->query($sqlus) or die($koneksi->error);
		if(mysqli_num_rows($user) === 0){
			header("Location: ../");
		}
		$novel = $koneksi->query($sqlno) or die($koneksi->error);
		$komen = $koneksi->query($sqlko) or die($koneksi->error);
		$availabel = FALSE;
		if(isset($_SESSION['iduser'])){
			$sqlcheck = "select id_cl from contact_list where id_usersource = '".$_GET['iduser']."' and id_usertarget = '".$_SESSION['iduser']."'";
			$cek = $koneksi->query($sqlcheck) or die($koneksi->error);
			if($cek->num_rows == 0 and $_GET['iduser']!=$_SESSION['iduser']){
				$availabel = TRUE;
			}
		}
		if(isset($_POST['cl'])){
			$defsql = "insert into contact_list values";
			$defwelsql = "insert into pesan values";
			$idtar = $_GET['iduser'];
			$idso = $_SESSION['iduser'];
			if($koneksi->query($defsql."('','".$idtar."','".$idso."')") === TRUE and $koneksi->query($defsql."('','".$idso."','".$idtar."')") or die($koneksi->error())){
				$sqlidcl = "select id_cl from contact_list where id_usersource = '".$idso."' and id_usertarget = '".$idtar."'";
				$getidcl = $koneksi->query($sqlidcl) or die($koneksi->error());
				if($idcl = $getidcl->fetch_assoc()){$_SESSION['cl'] = $idcl['id_cl'];}
				if($koneksi->query($defwelsql."('','".$_SESSION['cl']."','Halo, Ayo berbincang!')")){
					header("Location: ../p?idtar=".$idtar);
				}
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
		<div class="row">
    	<div class="col-sm-4">
        	<table class="table table-bordered" style="width: 15em;">
            <?php while($baris = $user->fetch_assoc()){ ?>
        		<tr>
            		<td colspan="2"><center><?php echo $baris['username']; ?></center></td>
            	</tr>
                <tr>
                	<td>Umur</td>
                	<td><?php 
						if($baris['tanggal_lahir']==NULL){
							echo "Pengguna tidak memberikan tanggal lahirnya";
						}else{
							echo date("Y")-substr($baris['tanggal_lahir'],0,4);
						} ?></td>
                </tr>
                <tr>
                	<td>Tgl Lahir</td>
                    <td><?php 
						if($baris['tanggal_lahir']==NULL){
							echo "Pengguna tidak memberikan tanggal lahirnya";
						}else{
							echo $baris['tanggal_lahir'];
						} ?></td>
                </tr>
                <tr>
                	<td colspan="2"><center><?php 
						if($baris['bio']==NULL){
							echo "Tinggalkan Pesanmu";
						}else{
							echo $baris['bio'];
						} ?></center></td>
                <?php if(isset($_SESSION['iduser'])){if($availabel == TRUE){ ?>
                <tr>
                    <td colspan="2"><form action="../user/<?php echo $_GET['iduser']; ?>" method="post"><center><input type="submit" class="btn btn-info pull-right" value="Tambahkan Contact"><input type="text" value="1" name="cl" style="visibility:hidden;"></center></center></td>
                </tr>
                <?php }elseif($availabel==FALSE and $_GET['iduser'] != $_SESSION['iduser']){ ?>
				<tr>
                	<td colspan="2"><center><a href="../p?idtar=<?php echo $_GET['iduser']; ?>"><button class="btn btn-info pull-right">Kirim Pesan</button></a></center></td>
                </tr>	
				<?php }elseif($_GET['iduser']==$_SESSION['iduser']){
				?>
                <tr>
                	<td colspan="2"><center><a href="../editprofile"><button class="btn btn-info pull-right">Ubah data</button></a></center></td>
                </tr>
                <?php
					}} ?>
            <?php } ?>
        	</table>
		</div>
    	<div class="col-sm-8">
        	<table class="table table-bordered table-hover">
        		<tr>
            		<td colspan="<?php if(isset($_SESSION['iduser'])){if($_GET['iduser']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){echo "3";}else{echo "2";}}else{echo "2";} ?>"><center>Novel Terbaru</center></td>
            	</tr>
                <tr>
                	<td>Judul</td>
                    <td>Update terbaru</td>
                    <?php 
						if(isset($_SESSION['iduser'])){
							if($_GET['iduser']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){ ?>
					<td>Operasi</td>
					<?php	}
						}
					?>
                </tr>
                <?php
				while($baris=$novel->fetch_assoc()){
				?>
                <tr>
                	<td><a href="../novel/<?php echo $baris['id_novel']; ?>"><?php echo $baris['judul_novel']; ?></a></td> 
                    <td><?php echo $baris['tanggal']; ?></td>
                    <?php 
						if(isset($_SESSION['iduser'])){
							if($_GET['iduser']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){ ?>
					<td><a href="../ubahnv/<?php echo $baris['id_novel']; ?>">Ubah</a> | <a href="../del.php?idnov=<?php echo $baris['id_novel']; ?>">Hapus</a></td>
					<?php	}
						}
					?>
                </tr>
                <?php } ?>
        	</table>
            <table class="table table-bordered table-hover">
        		<tr>
            		<td colspan="<?php if(isset($_SESSION['iduser'])){if($_GET['iduser']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){echo "3";}else{echo "2";}}else{echo "2";} ?>"><center>Komentar Terbaru</center></td>
            	</tr>
                <?php while($baris = $komen->fetch_assoc()){ ?>
                <tr>
                	<td><a href="../novel/<?php echo $baris['id_novel']; ?>#<?php echo $baris['id_comment']; ?>"><?php echo $baris['judul_novel']; ?></a></td> 
                    <td><?php echo $baris['tanggal_comment']; ?></td>
                    <?php 
						if(isset($_SESSION['iduser'])){
							if($_GET['iduser']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){ ?>
					<td><a href="../del.php?idcm=<?php echo $comment['id_comment']; ?>">Hapus</a></td>
					<?php	}
						}
					?>
                </tr>
                <?php } ?>
        	</table>
    	</div>
        </div>
<!-- InstanceEndEditable -->
	</div>
	</div>
	<div class="jumbotron text-center" style="margin-bottom:0">
  		<p>Wenovel™ @2020</p>
	</div>
</body>
<!-- InstanceEnd --></html>
