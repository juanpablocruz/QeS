<?php session_start();
include_once "connect.php";

if( empty($_POST['email'])||empty($_POST['pass']))
{
echo "Esta vacio";
}
else{
$email = $_POST['email'];
$pass = has($_POST['pass']);
$datetime = new DateTime;
$time = $datetime->format('Y/m/d H:i:s');
$chck = "SELECT `email` FROM `member` WHERE `email`='$email'";
$checkres = mysql_query($chck)
	or die (mysql_error());
	if(mysql_num_rows($checkres)==0)
	{
	echo "User doesn't exists";
	}
	else{
	$qry='SELECT password, email, loginName,phone, UserId FROM member WHERE email=\''.$email.'\'';
	$reslt = mysql_query($qry)
		or die(mysql_error());
	if(mysql_num_rows($reslt) == 0)
	{
	echo $pass."<br>";
	echo "User doesn't exist";
	}
	else{
	if($row = mysql_fetch_array($reslt)){
		if($row["password"] == $pass){
			$nombre = $row['loginName'];
			$query = "INSERT INTO login (loginName,loginTime)
				VALUES ('$nombre','$time')";
			$result = mysql_query($query)
				or die ("Couldn’t execute query.");
				$name = $row['loginName'];
				
			$status = mysql_query("UPDATE member SET online = 1 WHERE loginName = '$name'");
			$_SESSION["k_username"] = $row['loginName'];
			$_SESSION["k_email"] = $row['email'];
			$_SESSION["k_phone"] = $row['phone'];
			$_SESSION["k_UserId"]=$row['UserId'];
			echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'main.php';
			 </script>";
	}else{
	echo "Wrong pass";
	}
	}}}}
function has($parametro)
{
return (hash('whirlpool',$parametro));
}
?>