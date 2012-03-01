<?php
$name=$_GET['to'];
$name1= str_replace('+',' ',$name);
echo
"<form id='formulaire' method='POST' action='sendmsg.php'>
<input id='subject' class='formulaire' type='text' placeholder='subject' name='subject'/>
<p id='tolist'>to ".$name1."</p>
<textarea id='descriptiontext' class='formulaire textarea' name='description' type='textarea' rows='1' cols='1'/>
<input id='sendmessage' class='formulaire' type='submit' />
<input type='hidden' name='to' value= '".$name."'>
</form>";
?>