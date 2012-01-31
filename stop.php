<?php session_start();
include_once "connect.php";

$tabla = "tabla".$_SESSION['k_UserId'];
$id = $_GET['id'];
$mid = $_SESSION['k_UserId'];
$grupo =$_GET['grupo'];
$id = preg_replace("/[^a-zA-Z0-9]/", "", $id);
$tbls = "tabla".$id;
$qry = "DELETE FROM $tabla WHERE Sigo=$id";
		$result=mysql_query($qry);
$qry2 = mysql_query("DELETE FROM $tbls WHERE $grupo = $mid");
echo
	"<SCRIPT LANGUAGE='javascript'>
	 location.href = 'main.php';
	</script>";
?>
