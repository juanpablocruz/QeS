<?php session_start();
include_once "connect.php";
$grupo= $_GET['grupo'];
$grupos = 'grupos'.$_SESSION['k_UserId'];
$getq = mysql_query("SELECT privacidad FROM $grupos WHERE name = '$grupo'");
$privacidad = mysql_fetch_row($getq);
$privacy = array(
        0=>'Abierto',
        1=>'Privado',
        );
 
function doSelect($n,$d,$s=null,$grupo)
    {
    $doSelect = "<form method='POST' action='cambioprivacidad.php'><select name=\"$n\">\n";
    foreach($d as $i=>$v)
        {
        $doSelect.="\t<option value=\"$i\"";
        $doSelect.=$s==$i?" selected":"";
        $doSelect.=">".$v."</option>\n";
        }
    $doSelect.="</select>
	<input type=hidden name='grupo' value='".$grupo."'>
	<button type='submit'>Edit Group</button>
	</form>";
    return $doSelect;
    }
echo doSelect("privacy",$privacy,$privacidad[0],$grupo);
?>