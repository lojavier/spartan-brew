<?php
require_once("config/spartanbrewdb.php");
require_once("classes/Login.php");
$login = new Login();

$beer_id = intval($_POST['beer_id']);

$sql = "SELECT * FROM spartanbrewdb.brewing_sessions WHERE BREWER_ID=".$_SESSION['BREWER_ID'];
$result = mysqli_query($con,$sql);
$result_brewing_session_check = mysqli_num_rows($result);

$brewing_session_flag = $result_brewing_session_check == 0 ? true : false;

$date = time();

if($brewing_session_flag) {
	$date = time();
	if(date("I",$date) == 1) {
		$date = date("Y-m-d H:i:s",$date-28800);
	} else {
		$date = date("Y-m-d H:i:s",$date-32400);
	}
	$sql = "INSERT INTO spartanbrewdb.brewing_sessions (SPARTANBREW_ID,BREWER_ID,BEER_ID,BREWING_DATE_START) 
			VALUES ('".$_SESSION['SPARTANBREW_ID']."',".$_SESSION['BREWER_ID'].",".$beer_id.",'".$date."')";
	$result = mysqli_query($con,$sql);

	$sql = "SELECT BREWING_SESSION_ID FROM spartanbrewdb.brewing_sessions WHERE SPARTANBREW_ID=".$_SESSION['SPARTANBREW_ID']." AND BREWER_ID=".$_SESSION['BREWER_ID'];
	$result = mysqli_query($con,$sql);
	while ($row=mysqli_fetch_array($result)) {
		$brewing_session_id = $row['BREWING_SESSION_ID'];
	}
	
	echo "
	<h6 class='message success'>
		<strong>Brewing Session Activated!</strong>
	</h6>
	";
} else {
	echo "
	<h6 class='message error'><strong>Brewing Session Already In Progress!</strong></h6>
	";
}
?>