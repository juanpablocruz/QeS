<?php session_start();
include_once "connect.php";
$grupo = $_POST['grupo'];
$tabla = 'tabla'.$_SESSION['k_UserId'];
$query =("ALTER TABLE $tabla ADD COLUMN $grupo CHAR (20)");
$result = mysql_query($query);
	echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>