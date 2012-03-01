<?php session_start();
include_once "connect.php";
$grupo = $_GET['grupo'];
$tabla=$_SESSION['k_tabla'];

function showmessages($arr){
$len = sizeof($arr);
$i = 0;
echo "<table id='mensajestabla'>";
while($i<$len){
	$name = $arr[$i];
	$queryid = mysql_query("SELECT UserId FROM member WHERE loginName = '$name'");
	$id = mysql_fetch_row($queryid);
	$id = $id[0];
	$mismessages = "messages".$_SESSION['k_UserId'];	
	$getmsgquery = mysql_query("SELECT * FROM `$mismessages` WHERE `To`=$id OR `From`=$id");
	while ($message = mysql_fetch_array($getmsgquery)){
	$fromsg =$message['From'];
	$tomsg =$message['To'];
	$querynamefrom = mysql_query("SELECT loginName FROM member WHERE UserId ='$fromsg' ");
	$from = mysql_fetch_row($querynamefrom);
	$from = $from[0];
	$querynamefrom = mysql_query("SELECT loginName FROM member WHERE UserId = '$tomsg'");
	$to = mysql_fetch_row($querynamefrom);
	$to = $to[0];
	$from = str_replace(' ','/+./',$from);
	$to = str_replace(' ','/+./',$to);
	$subject =str_replace(' ','/+./',$message['Subject']);
	$date =str_replace(' ','/+./',$message['From_Date']);
	$descripcion =str_replace(' ','/+./',$message['Message_txt']);
	echo "<tr><td><div class='drag' onclick=viewmessage('".$from."','".$to."','".$subject."','".$date."','".$descripcion."','".$message['Answered']."','".$message['Viewed']."')>".$name."</div></td></tr>";
	}
	
	$i++;
}
echo "</table>";
};
if ($grupo != 'Desconocidos'){
				$arr = array();
				$qry = mysql_query("SELECT $grupo FROM $tabla");
				$i = 0;
				while ($row = mysql_fetch_row($qry)){
						if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
							$selectname = mysql_query("SELECT loginName,online FROM member WHERE UserId = $row[0]");
							$name = mysql_fetch_row($selectname);
							$name = $name[0];
							$arr[$i]=$name;		
							$i++;
						}
						
				}
	showmessages($arr);	
}

?>
