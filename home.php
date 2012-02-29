<?php session_start();
if (isset($_SESSION['k_username'])) {
  }
  else{
  			echo
			"<SCRIPT LANGUAGE='javascript'>
			 location.href = 'index.html';
			 </script>";
		}
		include_once "connect.php";
		$tabla = "tabla".$_SESSION['k_UserId'];
		$id = $_SESSION['k_UserId'];	
?>
<html>
	<head>
		<title>QeS</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="css/jquery-ui-1.8.17.custom.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
		<script>		
		$(function() {
				$( "#calendar" ).datepicker({
				onSelect: function(dateText, inst) {
						alert(dateText);
						}
					 }
					);
			});
			</script>
	</head>
	<body>
	
	<div>
		<div id="evento" class="drag">
		<a href="logout.php">Logout</a><br>
		Eventos próximos:<br>
		<?php
		$eventqry = mysql_query("SELECT eventos FROM $tabla");
		$eventnmbr = mysql_num_rows($eventqry);
		$i=0;
		while($i<$eventnmbr){
			$evento = mysql_fetch_row($eventqry);
			if ($evento[0] != 0){
				$idento =$evento[0];
				$qry = mysql_query("SELECT * FROM eventos WHERE EventId = '$idento'");
				$datetime = new DateTime;
				$datecreate = $datetime->format('Y-m-d');
				$evnt = mysql_fetch_array($qry);
				$dia = $evnt['event_date_expire'];
				$date = explode(" ", $dia);
				$gethora = explode(":", $date[1]);
				$hora = $gethora[0].":".$gethora[1];
				if($datecreate == $date[0]){
					echo "Hoy: ".$evnt['Event_Title']." a las ".$hora."<br>";
				}
				$day = explode("-",$datecreate);
				if ($day[2] < 10){
					$eldia = ($day[0]."-".$day[1]."-0".($day[2]+1));
					}
				else{
					$eldia = ($day[0]."-".$day[1]."-".($day[2]+1));
				}
				if($eldia == $date[0]){
					echo "Tomorrow: ".$evnt['Event_Title']." a las ".$hora."<br>";
				}
				if ($day[2] < 10){
					$eldia = ($day[0]."-".$day[1]."-0".($day[2]+2));
					}
				else{
					$eldia = ($day[0]."-".$day[1]."-".($day[2]+2));
				}
				if($eldia == $date[0]){
					echo "Pasado: ".$evnt['Event_Title']." a las ".$hora."<br>";
				}
			}
			$i++;
		}
		?>
			
		</div>
		<div id="tablon" >
			<p>Novedades</p>
			<ul id="mensajes" style="list-style:none;">
				<li>
					<div class="post drag back first">
						<div class="imag"><img src="img/contact.png" /></div>
						<div class="content">#1</div>
					</div>
				</li>
				<li>
					<div class="post drag mainpost">
						<div class="imag"><?php
					echo"<img src='view.php?id=$id'>" ?></div>
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
				echo "
					<script>
						function aqui(){
							alert('puf');
							$('#aqui').load('perfil.php?name=strin');}
					</script>";	
				echo "Sugerencias<br>";
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
				<div style="clear: both;"></div>
			</div>
			
		<div id="calendar" class="drag" style="float:right;"></div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</body>
	</html>