<?php session_start();
include_once "connect.php";
$grupo = $_POST['grupo'];
$tabla = 'tabla'.$_SESSION['k_UserId'];
$grupos = 'grupos'.$_SESSION['k_UserId'];
$addtogroups = mysql_query("INSERT INTO $grupos(name,privacidad) VALUES ('$grupo','0')");
$query =("ALTER TABLE $tabla ADD COLUMN $grupo CHAR (20)");
$result = mysql_query($query);
	echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>