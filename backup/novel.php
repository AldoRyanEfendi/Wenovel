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
		require_once "db/getnovel.php";
		require_once "db/getchapter.php";
		require_once "db/getcomment.php";
		//Rating
		if(isset($_POST['rate'])){
			$rate= "insert into rate values('', '".$_POST['rate']."', '".$_POST['idnov']."', '".$_SESSION['iduser']."')";
			if ($koneksi->query($rate) === TRUE) {
				header("Location: novel/".$_POST['idnov']);
			} else {
    			echo "Error: " . $rate . "<br>" . $koneksi->error;
			}
		}
		//Komentar
		if(isset($_POST['komentar'])){
			if($_POST['komentar']!=''){
				$tgl=date("Y/m/d");
				$sqlkomentar = "insert into comment values('','".$_POST['komentar']."', '".$_SESSION['iduser']."', '".$_POST['idnov']."', '".$tgl."')";
				if ($koneksi->query($sqlkomentar) === TRUE) {
					header("Location: novel/".$_POST['idnov']);
				} else {
    				echo "Error: " . $sqlkomentar . "<br>" . $koneksi->error;
				}
			}else{
				
			}
		}
		//Cekidnovel
		if(isset($_POST['idnov'])){
			header("Location: novel/".$_POST['idnov']);
		}elseif(!isset($_GET['idnov'])){
			header("Location: index.php");
		}
		//cek rating user
		$sqluserrate = "select id_user from rate where id_novel = ".$_GET['idnov'];
		$userrate = $koneksi->query($sqluserrate) or die($koneksi->error);
		$alreadyrate = false;
		while($cek = $userrate->fetch_assoc()){
			if(isset($_SESSION['iduser'])){
				if($cek['id_user']==$_SESSION['iduser']){
					$alreadyrate=true;
				}
			}
		}
	?>
<style>
.comment-wrapper .panel-body {
    max-height:650px;
    overflow:auto;
}
.comment-wrapper .media-list .media img {
    width:64px;
    height:64px;
    border:2px solid #e5e7e8;
}
.comment-wrapper .media-list .media {
    border-bottom:1px dashed #efefef;
    margin-bottom:25px;
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
        <?php while($baris = $getnovel->fetch_assoc()){ if($baris['id_user'] == NULL){header("Location: ../");}?>
    		<div class="col-sm-4">
            	<center>
            	<h5><?php echo $baris["judul_novel"]; ?></h5>
                <br>
            	<img src="../img/<?php echo $baris["img"]; ?>" style="width: 15em;"/>
                <table class="table table-hover" style="width: 15em;">
        			<tr>
            			<td>Author</td>
                		<td><?php echo $baris["username"] ?></td>
             		</tr>
                    <tr>
            			<td>Bahasa</td>
                		<td><?php echo $baris["bahasa"] ?></td>
             		</tr>
                    <tr>
            			<td>Rilis</td>
                		<td><?php echo $baris["thn_rilis"] ?></td>
             		</tr>
                    <tr>
            			<td>Rating</td>
                		<td><?php if($baris["avg(nilai_rate)"]!= NULL){echo substr($baris["avg(nilai_rate)"],0,3);}else{echo "0";} ?> (<?php echo $baris["count(nilai_rate)"]; ?> Users)</td>
             		</tr>
                    <tr>
            			<td>Rate</td><?php if(isset($_SESSION['iduser']) and $alreadyrate==false){?>
                		<td><form action="../novel.php" method="post">
                        <select name="rate">
						<?php for($x=1;$x<=5;$x++){ ?><option value="<?php echo $x; ?>"><?php echo $x; ?></option><?php } ?>
                        </select> 
                        <input type="submit" class="btn btn-primary" value="rate">
                        <input type="text" style="visibility:hidden;" value="<?php echo $baris["id_novel"]; ?>" name="idnov">
                        </form>
                        </td>
                        <?php }elseif($alreadyrate==true){ ?>
						<td>Terimakasih Ratenya</td>
                         <?php }else{ ?>
                        <td>Login untuk menilai novel</td>
                        <?php } ?>
             		</tr>
        		</table>
                </center>
            </div>
            <div class="col-sm-8">
				<div class="container-fluid text-center">
            	<h4>Deskripsi</h4>
            	<span lang="id"><?php echo $baris["deskripsi"]; ?></span><br>          
       		  	</div>
                <table class="table table-hover">
        			<tr class="table-active">
            			<td>Tanggal</td>
                		<td>Chapter</td>
                        <?php 
						if(isset($_SESSION['iduser'])){
							if($baris['id_user']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){
								?>
                        <td>Operasi</td>
                                <?php
							}
						}
						?>
             		</tr>
                    <?php while($cha = $ch->fetch_assoc()){ ?>
             		<tr>
             			<td><?php echo $cha["tanggal"]; ?></td>
                		<td><a href="<?php if(isset($_SESSION['iduser'])){ ?>../read/<?php echo $cha["id_chapter"]; }else{?>../login?suc=1<?php } ?>">
                        <?php 
						if($cha["no_chapter"]==0){
							echo "Prologue";
						}else{?>
                        Chapter <?php echo $cha["no_chapter"]; ?>
                        <?php } ?>
                        </a></td>
                        <?php 
						if(isset($_SESSION['iduser'])){
							if($baris['id_user']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){
								?>
                        <td><a href="../ubahch/<?php echo $cha['id_chapter'] ?>">Ubah</a> | <a href="../del.php?idch=<?php echo $cha['id_chapter'] ?>">Hapus</a></td>
                                <?php
							}
						}
						?>
             		</tr>
                    <?php } ?>
        		</table>
                <?php if($_GET['p']==NULL){$halaman = 1;}else{$halaman = $_GET['p'];}
					if($halaman !=1){
				?>
        		<a href="<?php echo $_GET['idnov'];?>-<?php echo $halaman-1; ?>"><button type="button" class="btn btn-dark">Sebelumnya</button></a>
        		<?php
					}if($jumlah ==5){
				?>
        		<a href="<?php echo $_GET['idnov'];?>-<?php echo $halaman-1; ?>"><button type="button" class="btn btn-dark">Selanjutnya</button></a>
        		<?php
					}
				?>
            <?php } ?>
            <!-- Komentar -->
            <div class="row bootstrap snippets">
    			<div class="col-md-15 col-md-offset-2 col-sm-12">
        			<div class="comment-wrapper">
            			<div class="panel panel-info">
                			<div class="panel-heading">Komentar</div>
                <div class="panel-body">
                	<?php
						if(isset($_SESSION['iduser'])){
					?>
                    <form action="../novel.php" method="post">
                    	<textarea class="form-control" placeholder="Tulis komentarmu!" rows="3" name="komentar"></textarea>
                    	<br>
                    	<input type="submit" class="btn btn-info pull-right" value="Kirim"></button>
                        <input type="text" style="visibility:hidden;" name="idnov" value="<?php echo $_GET['idnov']; ?>">
                    </form>
                    <div class="clearfix"></div>
                    <?php
                    }else{ echo "Login untuk komentar"; }
					?>
                    <hr>
                    <ul class="media-list">
                    <?php
						while($comment = $komentar->fetch_assoc()){
					?>
                        <li class="media">
                            <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-muted"><?php echo $comment['tanggal_comment']; ?></small>
                                </span>
                                <strong class="text-success"><?php echo $comment['username']; ?></strong>
                                <p id="<?php echo $comment['id_comment']; ?>"><?php echo $comment['comment']; ?></p>
                                <?php
								if(isset($_SESSION['iduser'])){if($comment['id_user']==$_SESSION['iduser'] or $_SESSION['admin'] == TRUE){
								?>
                                 <a href="../del.php?idcm=<?php echo $comment['id_comment']; ?>">Hapus</a>
                                <?php
								}}
								?>
                            </div>
                        </li>
                     <?php
						}
					 ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
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
