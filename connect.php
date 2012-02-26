<?php
		$user="Sql124682";
		$host="62.149.150.66";
		$password="ff15effc";
		$connection = mysql_connect($host,$user,$password)
			or die ("couldn’t connect to server");
		$database = "Sql124682_3";
		$db = mysql_select_db($database,$connection)
			or die ("Couldn’t select database");
?>