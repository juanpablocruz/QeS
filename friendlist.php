<html>
	<head>	
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
		<script>
			$(function() {
				$( ".ToLists" ).selectable({
					selected: function(event, ui) { 
						var friend = (ui.selected.innerHTML);
						friend = friend.replace(/<.*?>/g,'');
						newmssg(friend);
					}
				});
			});
		</script>
	</head>
	<body>
<?php session_start();
include_once "connect.php";
$tabla=$_SESSION['k_tabla'];
echo "<section id='ToLists' class='GroupsLis'>";
		$query = ("SELECT * FROM $tabla");
		$result = mysql_query($query);		
		$i=0;
		$len = mysql_num_fields($result);
		while ($i<$len){
			$grup= mysql_field_name($result,$i);
			if($grup!='eventos'){
			
					echo "
						
						".$grup."<ul class='groupelement ToLists'>";
				$qry = mysql_query("SELECT $grup FROM $tabla");
				$j = 1;
				$k = 1;
				while ($row = mysql_fetch_row($qry)){
						if ($row[0] != 0 && $row[0] != $_SESSION['k_UserId']){
							$selectname = mysql_query("SELECT loginName,online FROM member WHERE UserId = $row[0]");
							$name = mysql_fetch_row($selectname);
							if ($name[1] == 0){
							echo "
								<li class='toelement elementlist'><div class='drag offline' id='".$grup.$j."'>".$name[0]."
								</div></li>";
							}
							if ($name[1] ==1){	
							echo "
								<li class='toelement elementlist'><div class='drag online' id='".$grup.$j."')>".$name[0]." 
								</div></li>";							
							}
							$j++;
						}
						
				}
				echo "	</ul>";
			}
			$i++;
		}
		echo "</section>";
?>
</body>