<?php
/*
LLamad a la funcion que querais dependiendo del estado de la base de datos.
*/
include_once "connect.php";

function login(){
$member = mysql_query("CREATE TABLE member(loginName varchar (20),password CHAR (255),createDate char(64),email char(64),phone CHAR (13), UserId int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(UserId))");
$login = mysql_query("CREATE TABLE login(loginName char(20),loginTime datetime)");
}
function images(){
$images = mysql_query("CREATE TABLE images(UserId int(20),filename varchar(255),mime_type varchar(255),file_size int(11),file_data longblob)")
}
function events(){
$events = mysql_query("CREATE TABLE events(UserId int(20),event_text longtext,event_group varchar(25),event_date_creation datetime,event_date_expire datetime,event_tags varchar(255),Exclusiones int(150))")
}
events();
echo "Succes";
?>
