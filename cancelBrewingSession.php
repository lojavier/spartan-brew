<?php

require_once("config/spartanbrewdb.php");
require_once("classes/Login.php");
$login = new Login();

$brewing_session_id = intval($_POST['brewing_session_id']);

$sql = "DELETE FROM spartanbrewdb.brewing_sessions WHERE BREWING_SESSION_ID=".$brewing_session_id;
$result = mysqli_query($con,$sql);

?>


<!--
<p class="message success">Yes of course you can!</p>
<p class="message info">This is an info message.</p>
<p class="message warning">Note: Eve doesn´t claim to be perfect (me to)!</p>
<p class="message error">It is prohibited to turn this design into a fixed layout!</p>
-->