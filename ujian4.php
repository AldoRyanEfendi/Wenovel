<?php
	$menu = array("Mie Ayam", "Bakso Rudal", "Nasi Goreng", "Ketoprak");
	$num=0;
	echo "Daftar Makanan<br>";
	while($num<sizeof($menu)){
		echo $num+1,". ",$menu[$num],"<br>";
		$num++;
	}
	$nama="Aldo";$npm="10117449";$kelas="4KA27";$matkul="Pemrograman Web";$uts=90;$uas=95;$total=($uts*0.3)+($uas*0.7);
	if($total>80){
		$gr="A";
	}elseif($total>60){
		$gr="B";
	}elseif($total>40){
		$gr="C";
	}elseif($total>20){
		$gr="D";
	}else{
		$gr="E";
	}
	echo "Nama : ",$nama,"<br>NPM : ",$npm,"<br>Kelas : ",$kelas,"<br>Matkul : ",$matkul;
	echo "<br>UTS : ",$uts,"<br>UAS : ",$uas,"<br>Total : ",$total,"<br>Grade : ",$gr;
?>