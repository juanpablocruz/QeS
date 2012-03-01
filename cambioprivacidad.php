<?php session_start();
include_once "connect.php";
$privacidad = $_POST['privacy'];
$grupo = $_POST['grupo'];
$grupos = 'grupos'.$_SESSION['k_UserId'];
$getq = mysql_query("UPDATE $grupos SET privacidad=$privacidad WHERE name = '$grupo'");
	echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";

?>