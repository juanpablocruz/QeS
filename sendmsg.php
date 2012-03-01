<?php
session_start();
include_once "connect.php";
$from = $_SESSION['k_UserId'];
$toname = $_POST['to'];
$toname = str_replace('+',' ',$toname);
$getid = (mysql_query("SELECT UserId FROM member WHERE loginName = '$toname'"));
$getid = mysql_fetch_row($getid);
$toid = $getid[0];
$subject = $_POST['subject'];
$description = $_POST['description'];
$datetime = new DateTime;
$fecha = $datetime->format('Y-m-d H:i:s');
$messagetbl = "messages".$_SESSION['k_UserId'];
$messagetbl2 = "messages".$toid;
$key=$from."_".$toid;
$query = mysql_query("INSERT INTO `messages1`(`From`, `To`, `From_Date`, `Subject`, `Message_txt`, `Mssg_Key`, `Answered`, `Viewed`) VALUES ('$from','$toid','$fecha','$subject','$description','$key','0','0')")
										or die(mysql_error());
$query1 = mysql_query("INSERT INTO `messages2`(`From`, `To`, `From_Date`, `Subject`, `Message_txt`, `Mssg_Key`, `Answered`, `Viewed`) VALUES ('$from','$toid','$fecha','$subject','$description','$key','0','0')")
										or die(mysql_error());
  			echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>