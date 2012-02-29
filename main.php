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
		$_SESSION['k_tabla']=$tabla;
		$id = $_SESSION['k_UserId'];
		$query = mysql_query("SELECT * FROM member WHERE UserId = '$id'");
		$firstrow = mysql_fetch_array($query);
			$_SESSION["k_username"] = $firstrow['loginName'];
			$_SESSION["k_email"] = $firstrow['email'];
			$_SESSION["k_phone"] = $firstrow['phone'];
			
?>

<!DOCTYPE html>
<html>
	<head>
		<title>QeS</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/jquery-ui-1.8.17.custom.css" />
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
		<script>

			function edit(){
				$('.perfil_val').css('border','solid');
				$('.perfil_val').css('border-width','1px');
				$('#save').css('visibility','visible');
				$('#canceleditprof').css('visibility','visible');
				$('.perfil_val').removeAttr('readonly');
			}
			function save(){
				$('.perfil_val').css('border','none');
				$('.perfil_val').attr('readonly','readonly');
				$('#save').css('visibility','hidden');
				var name = document.getElementsByName('perfilname')[0].value;
				var number = document.getElementsByName('perfilnumber')[0].value;
				var email = document.getElementsByName('perfilemail')[0].value;
				location.href = 'editprofile.php'+'?name='+name+'&number='+number+'&email='+email;
			}
			function canceleditprof(){	
					$('.perfil_val').css('border','none');
					$('.perfil_val').attr('readonly','readonly');
					$('#save').css('visibility','hidden');	
					$('#canceleditprof').css('visibility','hidden');					

				}
				
			$(function() {
				$(".calendar").datepicker({dateFormat: 'yy/mm/dd'});
			});
			$(function() {
				$( "#calendar" ).datepicker({
				onSelect: function(dateText, inst) {
						alert(dateText);
						}
					 }
					);
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
			function viewperfi(name){
				$('#livesearch').load(
					'perfil.php?name=' + name
                 );
			}
			$(document).ready(function(){
				$(".btn-slide").click(function(){
				  $("#load_img").slideToggle("slow");
					$(this).toggleClass("active");
				});
				
			});	
		</script>
		<script type="text/javascript">
			function canceleEvent(){	
					$('#CreationForm').css('display','none');	
					$('#cancelEvent').css('visibility','hidden');
					$("#NewEventButton").css("visibility","visible");					
				}
			function sethora(){
				var now = new Date();
				var hora = now.getHours();
				var minute  = now.getMinutes();
				if (minute<"10"){
					minute = "00";
				}
				else{
					minute = minute-(minute%10);
				}
				var ele = document.getElementById("EventHora");
				ele.value = hora+":"+minute;
			};
			function loadhora(){
				$('#horas').css('visibility','visible');				
				var now = new Date();
				var hora = now.getHours();
				var cuadrohoras = document.getElementById("horas");
				var i = 0;
				cuadrohoras.innerHTML = "";
				while (i < hora){
					if(i<10){
					cuadrohoras.innerHTML += "<a href=javascript:void(0);>0"+(i)+":00</a><br>";
					}
					else{
					cuadrohoras.innerHTML += "<a href=javascript:void(0);>"+(i)+":00</a><br>";
					}
					i++;
				}
				var j = 0;
				while (hora+j < 24){
					cuadrohoras.innerHTML += "<a href=javascript:void(0);>"+(hora+j)+":00</a><br>";
					j++;
				}
			
			}
			$(document).ready(function(){
				$("#NewEventButton").click(function(){
				  $(".CF").slideToggle("slow");
					$(this).toggleClass("active");
					$("#NewEventButton").css("visibility","hidden");
					$('#cancelEvent').css('visibility','visible');
					sethora();
				});
			});
			 $(function() {
				$( "#EGroupList" ).selectable({
					selected: function(event, ui) { 
						var grupo = (ui.selected.innerHTML);
						grupo = grupo.replace(/<.*?>/g,'');
						$('#livesearch').load(
							'groupedit.php?grupo=' + grupo
						);
					}
				});
			});
			 $(function() {
				$( "#ToLists" ).selectable({
					selected: function(event, ui) { 
						var friend = (ui.selected.innerHTML);
						friend = friend.replace(/<.*?>/g,'');
						alert(friend);
						
					}
				});
			});
			 $(function() {
				$( "#MGroupList" ).selectable({
					selected: function(event, ui) { 
						var grupo = (ui.selected.innerHTML);
						grupo = grupo.replace(/<.*?>/g,'');
						$('#Message').load(
							'messages.php?grupo=' + grupo
						);
					}
				});
			});
			 $(function() {
				$( "#GroupList" ).selectable({
					selected: function(event, ui) { 
						var grupo = (ui.selected.innerHTML);
						grupo = grupo.replace(/<.*?>/g,'');
						window.groupto = grupo;
					}
				});
				$("#horas").selectable({
					selected: function(event, ui) { 
						var cuadrohoras = document.getElementById("EventHora");
						cuadrohoras.value = (ui.selected.text);
						$('#horas').css('visibility','hidden');
					}
				});
			});
			function createevent(){
					var hora = document.getElementById("EventHora").value;
					var dia = document.getElementById("EventDay").value;
					var inputh = document.getElementById("inputhora");
					inputh.setAttribute("name", "hora");
					inputh.setAttribute("value", hora);
					var inputd = document.getElementById("inputdia");
					inputd.setAttribute("name", "dia");
					inputd.setAttribute("value", dia);
					var inputg = document.getElementById("inputgrupo");
					inputg.setAttribute("name", "grupo");
					inputg.setAttribute("value", groupto);
					document.getElementById("FormularioEvento").submit();
				};
			function newmssg(friend){
				$('#Message').load(
							'newmessage.php?to='+friend
						);
			}
			function ShowFriends(){
				$('#Message').load(
							'friendlist.php'
				);
			}
function viewmessage(from,to,subject,date,descripcion,answered,viewed){
			from=from.replace("/+./"," ");
			to=to.replace("/+./"," ");
			subject=subject.replace("/+./"," ");
			date=date.replace("/+./"," ");
			descripcion=descripcion.replace("/+./"," ");
			from=from.replace("/+./"," ");
			var string = 'From:'+from+' To:'+to+' Subject:'+subject+' '+date+'\n'+descripcion;
			alert(string);
			}
		</script>
	</head>

	<body>

<div id="tabs">
	<ul>
		<li><div><a id="logo"><div class="log"><img src="img/qed2.jpg" /></div></a></div></li>
		<li><a href="#tabs-1">Home</a></li>
		<li><a href="#tabs-2">Perfil</a></li>
		<li><a href="#tabs-3">Contactos</a></li>
		<li><a href="#tabs-4">Eventos</a></li>
		<li><a href="#tabs-5">Mensajes</a></li>
		<li>
			<a id="search">
			<form class="searchform">
				<input id="buscar_users" name="search" type="text" placeholder="Buscar..." autocomplete="off" class="hint searchfield">
			</form>
			</a>
		</li>
		<li><div style="width:5cm"></div></li>
		<li><p id="lg">logged as <?php echo '<b>'.$_SESSION['k_username'].'</b>.';?></p></li>
	</ul>
	<div id="tabs-1" class="Page">
		<div id="evento">
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
					<div class="post back first">
						<div class="imag"><img src="img/contact.png" /></div>
						<div class="content">#1</div>
					</div>
				</li>
				<li>
					<div class="post mainpost">
						<div class="imag"><?php
					echo"<img src='view.php?id=$id'>" ?></div>
						<div class="content">#2</div>
					</div>
				</li>
				<li>
					<div class="post back second">
						<div class="imag"><img src="img/avatar.png" /></div>
						<div class="content">#3</div>
					</div>
				</li>
			</ul>
		</div>
		<div id="perf">
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
			
		<div id="calendar" style="float:right;"></div>
		</div>
		<div style="clear: both;"></div>
	</div>
	<div id="tabs-2" class="Page">
		<p>Perfil</p>
		<div id="even">
			<p id="canceleditprof" class="cancel" style="float:right" onClick=canceleditprof()>X</p>
			<p>Nombre:<?php echo "<input name=perfilname id='perfil_val' class=perfil_val type=text readonly value='".$_SESSION['k_username']."' style='border:none'>";?></p>
			<p>Numero movil: <?php if($_SESSION['k_phone']!=''){echo "<input name=perfilnumber class=perfil_val type=text readonly value=".$_SESSION['k_phone']." style='border:none'>";}
									else{echo "<input name=perfilnumber class=perfil_val type=text readonly value='' style='border:none' placeholder='phone'>";}?></p>
			<p>email:<?php echo "<input name=perfilemail class=perfil_val type=text readonly value=".$_SESSION['k_email']." style='border:none'>";?></p>
			<button id=edit onClick=edit()>Edit</button><button id=save onClick=save() style="visibility:hidden">save</button>
		</div>
		
		<div class="image"><?php echo"<img src='view.php?id=$id'>" ?></div>
		<div id="imgload">
			<div id="load_img">
			<form method="post" action="process.php" enctype="multipart/form-data">
				<input type="file" name="image" />
				<input type="submit" value="Upload Image" />
			</form>
			</div>
			<div class="slide">
				<a href="#" class="btn-slide">Change Image</a>
			</div>
		</div>
	</div>
	<div id="tabs-3" class="Page">
	<p>friends</p>
	<?php
		echo "<section id=friend>";
		$query = ("SELECT * FROM $tabla");
		$result = mysql_query($query);		
		$i=0;
		$len = mysql_num_fields($result);
		while ($i<$len){
			$grup= mysql_field_name($result,$i);
			if($grup!='eventos'){
				if ($grup!='Sigo'&&($grup != 'eventos')){
					echo "
						<div class='grupo drag sigo'>
						<div class='group'><a href='deletegroup.php?name=$grup'>x</a><br>".$grup."</div>";
				}
				if ($grup == 'Sigo')
					{
						echo "
							<div class='grupo drag';'>
							<div class='group'><br>".$grup."</div>";
					
				}
				$qry = mysql_query("SELECT $grup FROM $tabla");
				$j = 1;
				$k = 1;
				while ($row = mysql_fetch_row($qry)){
					if ($grup == 'Sigo'){
						if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
							$selectname = mysql_query("SELECT loginName,online FROM member WHERE UserId = $row[0]");
							$name = mysql_fetch_row($selectname);
							if ($name[1] == 0){
							echo "
								<div class='drag friends offline' id='".$grup.$j."' onclick = viewperfi('".$name[0]."')>".$name[0]."<a href=stop.php?id=$row[0]>x</a>
								</div>";
							}
							if ($name[1] ==1){	
							echo "
								<div class='drag friends online' id='".$grup.$j."' onclick = viewperfi('".$name[0]."')>".$name[0]." <a href=stop.php?id=$row[0]>x</a>
								</div>";							
							}
							$j++;
						}
					}
					else{
							if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
								$selectname = mysql_query("SELECT loginName,online FROM member WHERE UserId = $row[0]");
								$name = mysql_fetch_row($selectname);
								if ($name[1] == 0){
								echo "
									<div class='drag friends offline ".$grup.$k."' onclick = viewperfi('".$name[0]."')>".$name[0]."</div>";
								}
								if ($name[1] ==1){	
								echo "
									<div class='drag friends online ".$grup.$k."' onclick = viewperfi('".$name[0]."')>".$name[0]."</div>";
								}
							$k++;									
						}
					}	
				}
				echo "	</div>";
			}
			$i++;
		}
		echo "</section>";
		echo "<aside id=formulario>
			<form method=post action='newgroup.php'><input type=text name='grupo' placeholder='New Group'><button id='newgroupbutton' type=submi>Create</button></form>
			</aside>";
	?>
	<div id="livesearch">
		<?php
			$mename=$_SESSION['k_username'];
			$query = ("SELECT * FROM member WHERE loginName='$mename'");
			$resulta = mysql_query($query)
				or die(mysql_error());
			$row= mysql_fetch_array($resulta);
			echo "<div class='perfilcontact'><div class='imageperfil'><img src='view.php?id=$id'></div>";
			echo $row['loginName']."<br>".$row['email']."<br>";
			$seguir = $row['UserId'];
			$tabla = "tabla".$row['UserId'];
			$qr = ("SELECT * FROM $tabla");
			$result = mysql_query($qr);		
			echo "<table cellspacing='0' cellpadding='2'>";
			$i=0;
			$len = mysql_num_fields($result);
			while ($i<$len){
				echo "<tr><td>";
				$grup= mysql_field_name($result,$i);
				if ($grup!='Sigo'){
					echo "<div>".$grup."</div></td></tr>";}
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
					echo "</tr>";
				}
				$i++;
			}
			echo "</table></div>";
		?>
	</div>
		<div id="editgroups" class="GroupsLis">
			Edit Groups:
			<?php
				$result = mysql_query($qr);		
				echo "<ul id='EGroupList' class='groupelement' style='list-style:none;'>";
				$i=0;
				$len = mysql_num_fields($result);
				while ($i<$len){
					$grup= mysql_field_name($result,$i);
					if ($grup!='Sigo' && $grup != 'eventos'){
						echo "<li><div class='editgroup elementlist'>".$grup."</div></li>";}
					$i++;
				}
				echo "</ul>";
			?>
		</div>
	</div>
	<div id="tabs-4" class="Page">
	<p>Eventos</p>
	<div>
		<button id="NewEventButton">Crear Evento</button>
	</div>
		<div id="CreationForm" class="CF" onload="sethora()">
			<form method=post action=newevent.php id="FormularioEvento">
				<p id="cancelEvent" class="cancel" style="float:right" onClick=canceleEvent()>X</p>
				
				<header style="padding-left:40%;">New Event</header>
				
				<div id="DateEvent"><input type="text" class="calendar" id="EventDay" placeholder="Date" name="date"/>
				
				<span id="Hour"><input type="text" class="inline" tabindex="3" name="time" id="EventHora" onclick="loadhora()"></div></span>
				<div id="horas"></div>
				<div id="EventInfo" name="EventDescription">
					<input type=text name="Event_Title" placeholder="Title"/>
					<textarea class="textarea" rows="1" cols="1" placeholder="Description" name="evntDescript"></textarea>
				</div>
				<div id="CreationGroups" class="GroupsLis" name="GroupList"
				>
					Groups:
					<?php
						$result = mysql_query($qr);		
						echo "<ul id='GroupList' class='groupelement' style='list-style:none;'>";
						$i=0;
						$len = mysql_num_fields($result);
						while ($i<$len){
							$grup= mysql_field_name($result,$i);
							if ($grup!='Sigo' && $grup != 'eventos'){
								echo "<li><div class='elementlist'>".$grup."</div></li>";}
							$i++;
						}
						echo "</ul>";
					?>
				</div>
				<div style="clear: both;"></div>
				<div>
					<input type=hidden id="inputdia"/>
					<input type=hidden id="inputhora"/>
					<input type=hidden id="inputgrupo"/>
				</div>
			</form>
			<button type="submit" id="SubmitEvent" onClick="createevent()">Create Event</button>
		</div>
	<div id="miseventos">
		<?php
		$eventlist = mysql_query("SELECT * FROM eventos WHERE UserId = $id");
		if ($len = mysql_num_fields($eventlist)){
		$i = 0;
		while($i<=$len){
			$evento = mysql_fetch_array($eventlist);
			$user= $_SESSION['k_username'];
			$idevent = $evento['EventId'];
			if($evento['UserId']!=0){
				echo "<div id='evento' class='evento drag'>Mis eventos:<p>".$evento['Event_Title']."</p><br><p>Dia:".$evento['event_date_expire']."<br>
					 Grupo: ".$evento['event_group']."<br><p>Descripcion:<br>".$evento['event_text']."</p>
					 </p><a href='deletevent.php?id=".$idevent."'>Borrar evento</a></div>";
			}
			$i++;
		}
		}
		?>	
	</div>
	<div id="ListaEventos">
		<?php
		$sigo = mysql_query("SELECT sigo FROM $tabla");
		if($len = mysql_num_fields($sigo)){
		$i = 0;
		while($i<=$len){
			$seguido = mysql_fetch_row($sigo);
			if($seguido[0]!=0){
				$query = mysql_query("SELECT * FROM eventos WHERE UserId = '$seguido[0]'");
				$lista = mysql_fetch_array($query);
				$idcreator = $lista['UserId'];
				$query = mysql_query("SELECT * FROM member WHERE UserId = '$idcreator'");
				$user= mysql_fetch_array($query);
				if ($lista['UserId'] !=0){
					echo "<div id='evento' class='evento'><p>".$lista['Event_Title']."</p><p>Creador: ".$user['loginName']." <img src=view.php?id='".$user['UserId']."'><br>
					Grupo: ".$lista['event_group']." Fecha: ".$lista['event_date_expire']."<br>
					<p>Descripcion:<br>".$lista['event_text']."</p></p></div>";
				}
			}
			$i++;
		}
		}
		?>
	</div>
	</div>
	<div id="tabs-5" class="Page">
			<div id="CrearMsg">
			<button id="newmssg" onclick="ShowFriends()">New Message</button>
			</div>
			<div id="MssgGroups" class="GroupsLis">
			<?php
				$result = mysql_query($qr);		
				echo "<ul id='MGroupList' class='groupelement'>";
				$i=0;
				$len = mysql_num_fields($result);
				while ($i<$len){
					$grup= mysql_field_name($result,$i);
					if ($grup!='Sigo' && $grup != 'eventos'){
						echo "<li><div class='mssggroup elementlist'>".$grup."</div></li>";}
					$i++;
				}
				echo "<li><div class='mssggroup elementlist'>Desconocidos</div></li>";
				echo "</ul>";
			?>
		</div>
		<div id="msg">
		<div id="Message">
		<div id="ElMensaje">
		</div>
		</div>
		<div id="FriendsList">
		</div>
		</div>
	</div>
	</body>
</html>