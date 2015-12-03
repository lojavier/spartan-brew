<?php
require_once("config/spartanbrewdb.php");
require_once("classes/Login.php");
$login = new Login();

$ingredient_variable = $_POST['ingredient_variable'];

$sql = "SELECT * FROM spartanbrewdb.brewing_sessions WHERE BREWER_ID=".$_SESSION['BREWER_ID'];
$result = mysqli_query($con,$sql);
$result_brewing_session_check = mysqli_num_rows($result);

$_SESSION['BREWING_SESSION_FLAG'] = $result_brewing_session_check == 1 ? true : false;

if($_SESSION['BREWING_SESSION_FLAG']) {
	while ($row=mysqli_fetch_array($result)) {
		// Check for a flag if an ingredient needs to be added
		$sanitize_equipment_flag = $row['SANITIZE_EQUIPMENT'];
		$add_water_flag = $row['ADD_WATER_FLAG'];
		$add_grains_flag = $row['ADD_GRAINS_FLAG'];
		$remove_grains_flag = $row['REMOVE_GRAINS_FLAG'];
		$add_lme_flag = $row['ADD_LME_FLAG'];
		$add_dme_flag = $row['ADD_DME_FLAG'];
		$add_hops_1_flag = $row['ADD_HOPS_1_FLAG'];
		$add_hops_2_flag = $row['ADD_HOPS_2_FLAG'];
		$add_hops_3_flag = $row['ADD_HOPS_3_FLAG'];
		$add_hops_4_flag = $row['ADD_HOPS_4_FLAG'];
		$add_whirlfloc_flag = $row['ADD_WHIRLFLOC_FLAG'];
		$add_yeast_flag = $row['ADD_YEAST_FLAG'];

		if($sanitize_equipment_flag == 0) {
			$next_ingredient = "SANITIZE_EQUIPMENT";
		} elseif($add_water_flag == 0) {
			$next_ingredient = "ADD_WATER_FLAG";
		} elseif($add_grains_flag == 0) {
			$next_ingredient = "ADD_GRAINS_FLAG";
		}  elseif($remove_grains_flag == 0) {
			$next_ingredient = "REMOVE_GRAINS_FLAG";
		} elseif($add_lme_flag == 0) {
			$next_ingredient = "ADD_LME_FLAG";
		} elseif($add_dme_flag == 0) {
			$next_ingredient = "ADD_DME_FLAG";
		} elseif($add_hops_1_flag == 0) {
			$next_ingredient = "ADD_HOPS_1_FLAG";
		} elseif($add_hops_2_flag == 0) {
			$next_ingredient = "ADD_HOPS_2_FLAG";
		} elseif($add_hops_3_flag == 0) {
			$next_ingredient = "ADD_HOPS_3_FLAG";
		} elseif($add_hops_4_flag == 0) {
			$next_ingredient = "ADD_HOPS_4_FLAG";
		} elseif($add_whirlfloc_flag == 0) {
			$next_ingredient = "ADD_WHIRLFLOC_FLAG";
		} elseif($add_yeast_flag == 0) {
			$next_ingredient = "ADD_YEAST_FLAG";
		} else {
			$next_ingredient = "";
		}
	}
	
	$sql = "UPDATE spartanbrewdb.brewing_sessions SET ".$ingredient_variable."=2,".$next_ingredient."=1 WHERE BREWER_ID=".$_SESSION['BREWER_ID'];
	echo $sql . "<br>";
	$result = mysqli_query($con,$sql);
}

?>