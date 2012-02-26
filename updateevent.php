<?php
include_once "connect.php";
$datetime = new DateTime;
$datecreate = $datetime->format('Y-m-d');
$query = mysql_query("SELECT * FROM eventos WHERE event_date_expire LIKE '%$datecreate%'");
while($arry = mysql_fetch_array($query)){
	$eventgroup=$arry['event_group'];
	$idsevent = $arry['EventId'];
	echo $idsevent;
	$idcreat = $arry['UserId'];
	$tabla = 'tabla'.$idcreat;
	$groupmmbr = mysql_query("SELECT $eventgroup FROM $tabla");
		while($member=mysql_fetch_row($groupmmbr)){
			$miembro = $member[0];
			if($miembro != 0){
				$tblborra = 'tabla'.$miembro;
				$qry =mysql_query("DELETE FROM $tblborra WHERE eventos = $idsevent");
				}
			}
		}
	$delevent = mysql_query("DELETE FROM eventos WHERE EventId = '$idsevent' ");


?>