<?php
		$user="root";
		$host="localhost";
		$password="";
		$connection = mysql_connect($host,$user,$password)
			or die ("couldn’t connect to server");
		$database = "qes";
		$db = mysql_select_db($database,$connection)
			or die ("Couldn’t select database");
?>