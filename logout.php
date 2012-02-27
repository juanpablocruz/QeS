<?php session_start();
include_once "connect.php";
// Borramos toda la sesion
$name = $_SESSION["k_username"];
$status = mysql_query("UPDATE member SET online = 0 WHERE loginName = '$name'");
session_destroy();
?>
<SCRIPT LANGUAGE="javascript">
location.href = "index.html";
</SCRIPT>