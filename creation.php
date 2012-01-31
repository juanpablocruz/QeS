<?php
include_once "connect.php";
$member = mysql_query("CREATE TABLE member(loginName varchar (20),password CHAR (255),createDate char(64),email char(64),phone CHAR (13), UserId int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(UserId))");
$login = mysql_query("CREATE TABLE login(loginName char(20),loginTime datetime)");
$images = mysql_query("CREATE TABLE images(UserId int(20),filename varchar(255),mime_type varchar(255),file_size int(11),file_data longblob)")

echo "Succes";
?>
