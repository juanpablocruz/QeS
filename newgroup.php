<?php session_start();
include_once "connect.php";
$query =("ALTER TABLE $tabla ADD COLUMN $_POST[grupo] CHAR (20)");
$result = mysql_query($query);
	echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>