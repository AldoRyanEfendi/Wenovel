<?php
	session_start();
	unset($_SESSION['iduser']);
	unset($_SESSION['cl']);
	unset($_SESSION['admin']);
	header("Location: index.php");
?>