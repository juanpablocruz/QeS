<?php
include_once "connect.php";
$eventid = $_GET['id'];
$miid =$_SESSION['k_UserId'];
$eventkey = $miid.'_'.$eventid;
$query = mysql_query("SELECT * FROM eventos WHERE EventId = '$eventid'");
$arry = mysql_fetch_array($query);
	$eventgroup=$arry['event_group'];
	$idcreat = $arry['UserId'];
	$mitabla = 'tabla'.$_SESSION['k_UserId'];
	$tabla = 'tabla'.$idcreat;
	$qry =mysql_query("DELETE FROM $mitabla WHERE eventos = $eventkey");
	$groupmmbr = mysql_query("SELECT $eventgroup FROM $tabla");
		while($member=mysql_fetch_row($groupmmbr)){
			$miembro = $member[0];
			if($miembro != 0){
				$tblborra = 'tabla'.$miembro;
				$qry =mysql_query("DELETE FROM $tblborra WHERE eventos = $eventkey");
				}
			}
	$delevent = mysql_query("DELETE FROM eventos WHERE EventId = '$eventkey' ");
  			echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>