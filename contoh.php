<?php
	$bahasa= "PHP";
	print("\"SelamatBelajarPHP\"<BR>\n");
	print("\$bahasa= $bahasa");
	print("<br>");
	$gaji= 2000000;
	printf("Gajisemula= %d <br>", $gaji);
	$gaji= 1.5 * $gaji;
	printf("Gajisekarang= %d <br>", $gaji);
	print("<br>");
	$total_beli= 200000;
	$keterangan= "Tak dapat diskon";
	if ($total_beli>= 100000){
		$keterangan= "Dapat diskon";
		print("$keterangan<BR>\n");
	}
	print("<br>");
	$pil=1;
	switch($pil) {
		case 1:print("Pilihan 1");
		case 2:print("pilihan 2");
	}
	print("<br>");
	for($a=0;$a<5;$a++){
		print($a);
	}
	print("<br>");
	function cetak(){
		print("Halo<br>");
	}
	cetak();
	function kembali(){
		return 5;
	}
	print(kembali());
	
?>