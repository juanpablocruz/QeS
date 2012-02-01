<?php
include_once "connect.php";
$eventid = $_GET['id'];
$query = mysql_query("SELECT * FROM eventos WHERE EventId = '$eventid'");
$arry = mysql_fetch_array($query);
	$eventgroup=$arry['event_group'];
	$idcreat = $arry['UserId'];
	$tabla = 'tabla'.$idcreat;
	$groupmmbr = mysql_query("SELECT $eventgroup FROM $tabla");
		while($member=mysql_fetch_row($groupmmbr)){
			$miembro = $member[0];
			if($miembro != 0){
				$tblborra = 'tabla'.$miembro;
				$qry =mysql_query("DELETE FROM $tblborra WHERE eventos = $eventid");
				}
			}
	$delevent = mysql_query("DELETE FROM eventos WHERE EventId = '$eventid' ");
echo "bien borrado";
?>