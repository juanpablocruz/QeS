<?php session_start();
include_once "connect.php";
$name = $_GET['name'];
$number = $_GET['number'];
$email = $_GET['email'];
$id=$_SESSION['k_UserId'];
$$query = mysql_query( "UPDATE `member` SET `loginName` ='$name',`phone`='$number',`email`='$email' WHERE `UserId` ='$id' ");
	echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>