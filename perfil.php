<?php session_start();
include_once "connect.php";
$strin = $_GET['name'];
$strin = str_replace('_',' ',$strin);
$query = ("SELECT * FROM member WHERE loginName LIKE '$strin'");
$resulta = mysql_query($query)
	or die(mysql_error());
$row= mysql_fetch_array($resulta);
$id = $row['UserId'];
echo "<div class='perfilcontact'><div class='imageperfil'><img src='view.php?id=$id'></div>";
echo $row['loginName']."<br>".$row['email']."<br>";
$nombre = $row['loginName'];
$seguir = $row['UserId'];
$tabla = "tabla".$row['UserId'];
$gr = mysql_query("SELECT * FROM $tabla");
$qr = ("SELECT * FROM $tabla");
	$result = mysql_query($qr);		
	echo "<table cellspacing='0' cellpadding='2'>
	";
	$i=0;
	$len = mysql_num_fields($result);
	while ($i<$len){
		echo "<tr>
			<td>";
		$grup= mysql_field_name($result,$i);
		if ($grup!='Sigo'){
			if ($grup != 'eventos'){
			
			$grupos = 'grupos'.$seguir;
			$getq = mysql_query("SELECT privacidad FROM $grupos WHERE name = '$grup'");
			$privacidad = mysql_fetch_row($getq);
			if ($privacidad[0] == 0 && $nombre!= $_SESSION['k_username']){
				echo "<div><a href=add.php?id='$seguir'&group=$grup style='color:#666666'>".$grup."</a></div></td></tr>";
			}
			else{
				echo "<div>".$grup."</div></td></tr>";
				}
			}
		}
		else{
		echo "Sigue:";
					$qry = mysql_query("SELECT $grup FROM $tabla");
					while ($row = mysql_fetch_row($qry)){
						if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
							$selectname = mysql_query("SELECT loginName FROM member WHERE UserId = $row[0]");
							$name = mysql_fetch_row($selectname);
							echo "<td><div onclick = viewperfi('".$name[0]."')>".$name[0]."</div></td>";
						}
				}	
		}
		echo "</tr>";
		
		$i++;
	}
	echo "</table></div>";

?>