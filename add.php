<?php session_start();
include_once "connect.php";

$tabla = "tabla".$_SESSION['k_UserId'];
		$connection = mysql_connect($host,$user,$password)
			or die ("couldn�t connect to server");
		$db = mysql_select_db($database,$connection)
			or die ("Couldn�t select database");
		$id = $_GET['id'];
		$id = preg_replace("/[^a-zA-Z0-9]/", "", $id);
		$grupo = preg_replace("/[^a-zA-Z0-9]/", "", $_GET['group']);
		$mid = $_SESSION['k_UserId'];
		$tablasuya = "tabla".$id;
		$check1= mysql_query("SELECT $grupo FROM $tablasuya WHERE $grupo = $id");
		$check2 = mysql_query("SELECT Sigo FROM $tabla WHERE Sigo = $id");
		$checkrow = mysql_fetch_row($check1);
		$checkrow2 = mysql_fetch_row($check2);
		if($checkrow[0] != $id){
			if($checkrow2[0] != $id){
				$qry = mysql_query("INSERT INTO $tabla (sigo)
									VALUES ($id)");
				}
				$seguir = mysql_query("INSERT INTO $tablasuya ($grupo)
							VALUES ($mid)");
				echo
					"<SCRIPT LANGUAGE='javascript'>
					 location.href = 'main.php';
					 </script>";
			}
		else{
			echo
				"<SCRIPT LANGUAGE='javascript'>
				 alert('ya le sigues');
				 location.href = 'main.php';
				 </script>";
			}
?>
