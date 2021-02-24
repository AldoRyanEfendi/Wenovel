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
		if(!isset($_SESSION['iduser'])){
			header("Location: ../login");
		}
		require_once "db/koneksi.php";
		$sqlcl = "select id_usersource dari, id_usertarget ke from contact_list where id_usersource = '".$_SESSION['iduser']."' or id_usertarget = '".$_SESSION['iduser']."'";
    	$sqlpesan = "select pesan.id_cl, detail, id_usersource dari, id_usertarget ke from pesan join contact_list on pesan.id_cl = contact_list.id_cl where pesan.id_cl = any (select id_cl from contact_list where id_usersource = '".$_SESSION['iduser']."' or id_usertarget = '".$_SESSION['iduser']."') order by id_pesan desc;";
		$sqluser = "select * from user";
		$getcl = $koneksi->query($sqlcl) or die($koneksi->error);
		$getpesan = $koneksi->query($sqlpesan) or die($koneksi->error);
		if(isset($_GET['idtar'])){
			$gettarget = $koneksi->query($sqluser." where id_user = '".$_GET['idtar']."'");
			if($gettar = $gettarget->fetch_assoc()){
				$namatarget = $gettar['username'];
			}
		}
		if(isset($_POST['balas'])){
			$balas = "insert into pesan values('', '".$_SESSION['cl']."', '".$_POST['balas']."');";
			if($koneksi->query($balas) === TRUE){
				header("Location: p?idtar=".$_GET['idtar']);
			}else{
				echo "Error: " . $balas . "<br>" . $koneksi->error;
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
        <h2>Contact List</h2>
        <ul class="nav nav-pills flex-column">
        	<?php 
			while($contact = $getcl->fetch_assoc()){ 
				if($contact['dari'] == $_SESSION['iduser']){
					$getuser = $koneksi->query($sqluser) or die($koneksi->error);
					while($name = $getuser->fetch_assoc()){
						if($contact['ke'] == $name['id_user']){
							?>
                            <li class="nav-item">
          						<a class="nav-link <?php if(isset($_GET['idtar'])){if($contact['ke']==$_GET['idtar']){echo "active";}} ?>" href="p?idtar=<?php echo $contact["ke"]; ?>"><?php echo $name["username"];  ?></a>
        					</li>
                            <?php
						}
					}
				}
			}
			?>
        </ul>
        </div>
        <div class="col-sm-8">
        <h2>Pesan</h2>
        	<?php
				if(isset($_GET['idtar'])){
					while($pesan = $getpesan->fetch_assoc()){						
						if($pesan['dari'] == $_GET['idtar'] or $pesan['ke'] == $_GET['idtar']){
							if($pesan['dari'] == $_SESSION['iduser']){
								$_SESSION['cl']=$pesan['id_cl'];
							}else{
								$_SESSION['cl']=$pesan['id_cl']-1;
							}
							?>
                            <ul class="media-list">
								<li class="media">
									<div class="media-body">
										<span class="text-muted pull-right">
											<small class="text-muted"></small>
                        				</span>
                        				<strong class="text-success"><?php if($pesan['dari']==$_GET['idtar']){echo $namatarget;}else{echo "Me";}?></strong>
                                		<p><?php echo $pesan['detail']; ?></p>
                					</div>
        						</li>
							</ul>
                            <?php
						}
					}
					?>
                    <form action="p?idtar=<?php echo $_GET['idtar']; ?>" method="post">
                    	<textarea class="form-control" placeholder="Kirim Pesan" rows="3" name="balas"></textarea>
                    	<br>
                    	<input type="submit" class="btn btn-info pull-right" value="Kirim"></button>
                   	</form>
                    <?php
				}else{
					echo "<h5>Pilih Contact Disebelah kiri untuk melihat pesan</h5>";
				}
			?>
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
