<?php session_start();
include_once "connect.php";
$columna = $_GET['name'];
$tabla = 'tabla'.$_SESSION['k_UserId'];
$query =mysql_query("ALTER TABLE $tabla DROP $columna");
	echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>