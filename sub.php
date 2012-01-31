<?php
include_once "connect.php";
$name = $_POST['name'];
$email = $_POST['email'];
$pass = has($_POST['password']);
$movil = $_POST['movil'];
$hoy = date("Y-m-d");

if( empty($_POST['name'])||empty($_POST['email'])||empty($_POST['password']))
{
echo "Esta vacio";
}
else{

$chck = "SELECT `loginName` FROM `member` WHERE `loginName`='$name'";
$checkres = mysql_query($chck)
	or die (mysql_error());
	if(mysql_num_rows($checkres)==0)
	{
	$query = "INSERT INTO member (loginName,password,createDate,email,phone)
		VALUES ('$name','$pass','$hoy','$email','$movil')";
	$result = mysql_query($query)
		or die ("Couldn't execute query.");
	$qry = ("SELECT * FROM member WHERE loginName = '$name'");
	$res = mysql_query($qry)
	or die(mysql_error());
	$row= mysql_fetch_row($res);
	$id = $row[5];
	$table = "tabla".$id[0];
	$query2 = mysql_query("CREATE TABLE $table(eventos int(20),Sigo CHAR (20),Abierto CHAR (20))");
  			echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'index.html';
			 </script>";
			 }
else{
	echo "user allready exists";
}}
/* ----------------ENCRYPTION FUNCTION--------------------*/
function has($parametro)
{
return (hash('whirlpool',$parametro));
}
?>