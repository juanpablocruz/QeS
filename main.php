<?php session_start();
if (isset($_SESSION['k_username'])) {
  }
  else{
  			echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'index.html';
			 </script>";
		}
		$user="root";
		$host="localhost";
		$password="";
		$tabla = "tabla".$_SESSION['k_UserId'];
		$connection = mysql_connect($host,$user,$password)
			or die ("couldn�t connect to server");
		$database = "qes";
		$db = mysql_select_db($database,$connection)
			or die ("Couldn�t select database");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>QeD</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/jquery-ui-1.8.17.custom.css" />
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
		<script>
			$(function() {
				$( ".calendar" ).datepicker();
			});
			$(function() {
				$( ".drag" ).draggable();
			});
			$(function() {
				$( "#tabs" ).tabs();
			});
		</script>
		<script type="text/javascript">
			$(function(){
				$('#buscar_users').autocomplete({
					source : 'busqueda.php',
					select : function(event, ui){
							var name = ui.item.value.replace(/ /g,"_");
                            $('#livesearch').load(
								
                                'perfil.php?name=' + name
                            );
							}
					});
				});
		</script>
	</head>

	<body>

<div id="tabs">
	<ul>
		<li><div><a>QeD</a></div></li>
		<li><a href="#tabs-1">Home</a></li>
		<li><a href="#tabs-2">Perfil</a></li>
		<li><a href="#tabs-3">Amigos</a></li>
		<li><a href="#tabs-4">Eventos</a></li>
		<li><a id="search"><form>
		<input id="buscar_users" name="search" type="text" placeholder="Buscar..." autocomplete="off" class="hint">
		</form></a></li>
		<li><div style="width:5cm"></div></li>
		<li><p id="lg">conectado como <?php echo '<b>'.$_SESSION['k_username'].'</b>.';?></p></li>
	</ul>
	<div id="tabs-1" class="Page">
		<div id="evento" class="drag">
			Hoy...<br>
			Ma�ana...<br>
			Pasado...<br>
			<a href="logout.php">Logout</a><br>
		</div>
		<div id="tablon" >
			<p>Novedades</p>
			<ul id="mensajes" style="list-style:none;">
				<li>
					<div class="post drag back first">
						<div class="imag"><img src="img/avatar.png" /></div>
						<div class="content">#1</div>
					</div>
				</li>
				<li>
					<div class="post drag mainpost">
						<div class="imag"><img src="img/avatar.png"/></div>
						<div class="content">#2</div>
					</div>
				</li>
				<li>
					<div class="post drag back second">
						<div class="imag"><img src="img/avatar.png" /></div>
						<div class="content">#3</div>
					</div>
				</li>
			</ul>
		</div>
		<div id="perf" class="drag">
		<div id="perfi">
		<?php 
		
		echo "<script>function aqui(){
		alert('puf');
		$('#aqui').load('perfil.php?name=strin');}
		</script>";
		
		echo "		Sugerencias<br>";
		$qry = mysql_query("SELECT * FROM $tabla");
		$row= mysql_fetch_row($qry);
		$result = mysql_query("SELECT loginName,UserId FROM member")
			or die(mysql_error());
		echo "<br><table>";
		while($row3= mysql_fetch_array($result, MYSQL_NUM)){
		if(($row[0] != $row3[1])&&($row3[1] != $_SESSION['k_UserId'])){
			echo "<tr><td>". $row3[0]."</td><td><a href=add.php?id='$row3[1]'&group='abierto'>Seguir</a></form></td></tr>";
			$adid= "addid".$row3[1];
			$_SESSION[$adid] = $row3[1];
		}
		}
		echo "</table>";
		?>

		</div>
		<div id="calendar" class="calendar drag"></div>
		</div>
	</div>
	<div id="tabs-2" class="Page">
		
		<table style="width:97%">
		<tr><td></td><td><p>Perfil</p></td><td></td>
		</tr>
		<tr>
		<td>
		<div id="even" class= "drag">
		<p>Nombre:<?php echo '<b>'.$_SESSION['k_username'].'</b>.';?></p>
		<p>Numero movil:<?php echo '<b>'.$_SESSION['k_phone'].'</b>.';?></p>
		<p>email:<?php echo '<b>'.$_SESSION['k_email'].'</b>.';?></p>
		</div>
		</td>
		<td></td>
		<td>
		<div class="image drag"><img src='img/contact.png'></div>
		</tr>
		</table>
	</div>
	<div id="tabs-3" class="Page">
	<p>friends</p>
	<?php
	echo "<section id=friend;>";
	$query = ("SELECT * FROM $tabla");
	$result = mysql_query($query);		
	$i=0;
	$len = mysql_num_fields($result);
	while ($i<$len){
		$grup= mysql_field_name($result,$i);
		if ($grup!='Sigo'){
		echo "
		<div class='grupo drag sigo'>
		<div class='group'><a href='deletegroup.php?name=$grup'>x</a><br>".$grup."</div>";}
		else{
		echo "
		<div class='grupo drag';'>
		<div class='group'><br>".$grup."</div>";
		}
		
		$qry = mysql_query("SELECT $grup FROM $tabla");
		while ($row = mysql_fetch_row($qry)){
			if ($grup == 'Sigo'){
				if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
					$selectname = mysql_query("SELECT loginName FROM member WHERE UserId = $row[0]");
					$name = mysql_fetch_row($selectname);
					echo "
					<div class='drag friends'>".$name[0]."<a href=stop.php?id=$row[0]&grupo=$grup>x</a>
					</div>";
				}
			}
			else{
				if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
					$selectname = mysql_query("SELECT loginName FROM member WHERE UserId = $row[0]");
					$name = mysql_fetch_row($selectname);
					echo "
					<div class='drag friends'>".$name[0]."</div>";		
				}
			}
		}echo "	</div>";
		$i++;
	}
	echo "</section>";
	echo "<aside id=formulario>
	<form method=post action='newgroup.php'><input type=text name='grupo' placeholder='New Group'><button id='newgroupbutton' type=submi>Create</button></form>
	</aside>";
	?>
	<div id="livesearch" class=drag>
	<?php
	$mename=$_SESSION['k_username'];
	$query = ("SELECT * FROM member WHERE loginName='$mename'");
$resulta = mysql_query($query)
	or die(mysql_error());
$row= mysql_fetch_array($resulta);
echo $row['loginName']."<br>".$row['email']."<br>";
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
			
		echo "
		<div>".$grup."</div></td></tr>";}
		else{
		echo "Sigue:";
		$qry = mysql_query("SELECT $grup FROM $tabla");
		while ($row = mysql_fetch_row($qry)){
				if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
					$selectname = mysql_query("SELECT loginName FROM member WHERE UserId = $row[0]");
					$name = mysql_fetch_row($selectname);
					echo "
					<td>".$name[0]."</td>";
				}	
		}
		echo "</tr>";
		}
		$i++;
	}?>
	</div>
	</div>
	<div id="tabs-4" class="Page">
	<p>Eventos</p>
	</div>
</div>
	</body>
</html>