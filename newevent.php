<?php session_start();
include_once "connect.php";

$hora =$_POST['hora'];
$date =$_POST['dia'];
$grupo=$_POST['grupo'];
$desc=$_POST['evntDescript'];
$title = $_POST['Event_Title'];
$id = $_SESSION['k_UserId'];
$datetime = new DateTime;
$datecreate = $datetime->format('Y/m/d H:i:s');
if($hora<10){
	$hora = '0'.$hora;
	}
$dateexpire = $date.' '.$hora.':00';
$query = mysql_query("INSERT INTO eventos (UserId,event_text,event_group,event_date_creation,event_date_expire,Event_Title)
										VALUES ('$id','$desc','$grupo','$datecreate','$dateexpire','$title')");
$eventoid = mysql_fetch_array(mysql_query("SELECT * FROM eventos WHERE UserId = '$id' AND event_date_creation='$datecreate'"));
$eventoid = $eventoid['EventId'];

$eventkey = $id.'_'.$eventoid;
$addkey = mysql_query("UPDATE eventos SET Event_Key = '$eventkey' WHERE EventId = '$eventoid'");

$inquery = mysql_query("");
$mitabla = 'tabla'.$id;
$miembros = mysql_query("SELECT $grupo FROM $mitabla");
$len = mysql_num_fields($miembros);

$meinvito = mysql_query("INSERT INTO $mitabla (eventos) VALUES ('$eventkey')");
$i=0;
while($i<$len){
	while($user = mysql_fetch_row($miembros)){
		$persona = $user[0];
		$sutabla = 'tabla'.$persona;
		$invitado = mysql_query("INSERT INTO $sutabla (eventos) VALUES ('$eventkey')");
	}
	$i++;
}
  			echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
?>