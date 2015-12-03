<?php
require_once("config/spartanbrewdb.php");
require_once("classes/Login.php");
$login = new Login();

$sql = "SELECT * FROM spartanbrewdb.brewing_sessions WHERE BREWER_ID=".$_SESSION['BREWER_ID'];
$result = mysqli_query($con,$sql);
$result_brewing_session_check = mysqli_num_rows($result);

$_SESSION['BREWING_SESSION_FLAG'] = $result_brewing_session_check == 1 ? true : false;

if($_SESSION['BREWING_SESSION_FLAG']) {
	while ($row=mysqli_fetch_array($result)) {
		$brewing_session_id = $row['BREWING_SESSION_ID'];
		$sql_temp = "SELECT * FROM spartanbrewdb.beer_info WHERE BEER_ID=".$row['BEER_ID'];
		$result_temp = mysqli_query($con,$sql_temp);
		while ($row_temp=mysqli_fetch_array($result_temp)) {
			$beer_name = $row_temp['BEER_NAME'];
		}
		
		$message = "** MESSAGE **";
		
		$temperature_f = $row['TEMPERATURE_F'];
		$remaining_time = $row['REMAINING_TIME'];
		
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

		if($sanitize_equipment_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("SANITIZE_EQUIPMENT"); </script> <?php
		} elseif($add_water_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_WATER_FLAG"); </script> <?php
		} elseif($add_grains_flag == 1) {
			if($temperature_f >= 170) {
		?> 		<script> javascript:confirmIngredientAdd("ADD_GRAINS_FLAG"); </script> <?php
			}
		}  elseif($remove_grains_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("REMOVE_GRAINS_FLAG"); </script> <?php
		} elseif($add_lme_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_LME_FLAG"); </script> <?php
		} elseif($add_dme_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_DME_FLAG"); </script> <?php
		} elseif($add_hops_1_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_HOPS_1_FLAG"); </script> <?php
		} elseif($add_hops_2_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_HOPS_2_FLAG"); </script> <?php
		} elseif($add_hops_3_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_HOPS_3_FLAG"); </script> <?php
		} elseif($add_hops_4_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_HOPS_4_FLAG"); </script> <?php
		} elseif($add_whirlfloc_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_WHIRLFLOC_FLAG"); </script> <?php
		} elseif($add_yeast_flag == 1) {
		?> 	<script> javascript:confirmIngredientAdd("ADD_YEAST_FLAG"); </script> <?php
		} else {
		?> 	<script> javascript:closeDialogBox(); </script> <?php
		}
		
		if($add_dme_flag == 3) {
			$add_malt_extract_flag = $add_lme_flag;
		} else {
			$add_malt_extract_flag = $add_dme_flag;
		}
?>
		<p>
		<table>
			<thead>
				<tr>
					<th scope='col'><?php echo $beer_name; ?></th>
					<th scope='col'>Data</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope='row'>Remaining Time</th>
					<td><?php echo $remaining_time; ?></td>
				</tr> 
				<tr>
					<th scope='row'>Temperature</th>
					<td><?php echo $row['TEMPERATURE_F']; ?> &#186;F <br> <?php echo $row['TEMPERATURE_C']; ?> &#186;C</td>
				</tr>
				<tr>
					<th scope='row'>Sanitized?</th>
			<?php 	switch($sanitize_equipment_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>Water?</th>
			<?php 	switch($add_water_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>Add Grains?</th>
			<?php 	switch($add_grains_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>Remove Grains?</th>
			<?php 	switch($remove_grains_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>Malt Extract?</th>
			<?php 	switch($add_malt_extract_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>1st Hops?</th>
			<?php 	switch($add_hops_1_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>2nd Hops?</th>
			<?php 	switch($add_hops_2_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>3rd Hops?</th>
			<?php 	switch($add_hops_3_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>4th Hops?</th>
			<?php 	switch($add_hops_4_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>Whirlfloc?</th>
			<?php 	switch($add_whirlfloc_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>Yeast?</th>
			<?php 	switch($add_hops_1_flag) {
						case 0:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 1:
							echo "<td class='message warning'>&nbsp;</td>";
							break;
						case 2:
							echo "<td class='message success'>&nbsp;</td>";
							break;
						default:
							echo "<td class='message info'>N/A</td>";
					}
			?>
				</tr>
				<tr>
					<th scope='row'>Elapsed Time</th>
					<td><?php echo $row['ELAPSED_TIME']; ?></td>
				</tr>
			</tbody>      
			<tfoot>
				<tr><td colspan='2'><?php echo $message; ?></td></tr>
			</tfoot>
		</table>
		<form name='cancelbrewingsessionform' method='post' action='stats.php'>
			<input type='hidden' name='brewing_session_id' value='<?php echo $brewing_session_id; ?>'/>
			<a class='cancel_button' href="javascript:confirmBrewingSessionDelete(<?php echo $brewing_session_id; ?> )" >Cancel Brewing Session</a>
		</form>
		</p>		
<?php
	}
} else {
	echo "
	<p class='message info'><strong>A brewing session has not been activated yet.</strong></p>";
}

?>