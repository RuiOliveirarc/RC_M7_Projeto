<?php
	session_start();
	$_SESSION['login']="incorreto";
	header("refresh:2;url=index.php");
?>