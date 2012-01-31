<?php session_start();
include_once "connect.php";
$hora =$_POST['hora'];
$date =$_POST['dia'];
$grupo=$_POST['grupo'];
$desc=$_POST['evntDescript'];
$id = $_SESSION['k_UserId'];
$datetime = new DateTime;
$datecreate = $datetime->format('Y/m/d H:i:s');
if($hora<10){
	$hora = '0'.$hora;
	}
$dateexpire = $date.' '.$hora.':00';
$query = mysql_query("INSERT INTO eventos (UserId,event_text,event_group,event_date_creation,event_date_expire)
										VALUES ('$id','$desc','$grupo','$datecreate','$dateexpire')");
$mitabla = 'tabla'.$id;
$miembros = mysql_query("SELECT $grupo FROM $mitabla");
$len = mysql_num_fields($miembros);
$eventoid = mysql_fetch_array(mysql_query("SELECT * FROM eventos WHERE UserId = '$id' AND event_date_creation='$datecreate'"));
$eventoid = $eventoid['EventId'];
$i=0;
while($i<$len){
	while($user = mysql_fetch_row($miembros)){
		$persona = $user[0];
		$sutabla = 'tabla'.$persona;
		$invitado = mysql_query("INSERT INTO $sutabla (eventos) VALUES ('$eventoid')");
	}
	$i++;
}
echo
	"<SCRIPT LANGUAGE='javascript'>
		location.href = 'main.php';
	 </script>";						
?>