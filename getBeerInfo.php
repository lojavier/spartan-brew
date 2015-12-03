<?php
require_once("config/spartanbrewdb.php");

$beer_id = intval($_POST['beer_id']);

$sql = "SELECT * FROM spartanbrewdb.beer_info WHERE BEER_ID=".$beer_id." ";
$result = mysqli_query($con,$sql);

echo "<b>Beer Info:</b>";
if($beer_id != "-1") {
	while ($row=mysqli_fetch_array($result))
	{
		echo "
		<table>
			<thead>
				<tr>
					<th scope='col' width='25%'>ABV</th>
					<th scope='col' width='25%'>IBU</th>
					<th scope='col' width='25%'>SRM</th>
					<th scope='col' width='25%'>OG</th>
				</tr>
			</thead>
			<tbody>
				<tr style='text-align: center;'>
					<td>".$row['BEER_ABV']."%</td>
					<td>".$row['BEER_IBU']."</td>
					<td>".$row['BEER_SRM']."</td>
					<td>".$row['BEER_OG']."</td>
				</tr> 
				<tr>
					<td colspan='4' style='text-align: left;'>
						<b>DESCRIPTION</b><br/>
						<p>".$row['BEER_DESCRIPTION']."</p>
						<form name='brewingform' method='post' action='stats.php'>
							<input type='hidden' name='beer_id' value='".$beer_id."'/>
							<p><a class='button' href=\"javascript:confirmBrewingSessionStart('".$beer_id."')\">Begin Brewing Beer</a></p>
						</form>
					</td>
				</tr>
			</tbody> 
			<tfoot>
				<tr><td colspan='4'>
				<em>ABV = Alcohol By Volume&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;IBU = International Bittering Units</em><br/>
				<em>SRM = Standard Reference Method&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;OG = Original Gravity</em>
				</td></tr>
			</tfoot>
		</table>";
	}
} else {
	echo"
	<table>
		<thead>
			<tr>
				<th scope='col' width='25%'>ABV</th>
				<th scope='col' width='25%'>IBU</th>
				<th scope='col' width='25%'>SRM</th>
				<th scope='col' width='25%'>OG</th>
			</tr>
		</thead>
		<tbody>
			<tr style='text-align: center;'>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr> 
			<tr>
				<td colspan='4' style='text-align: left;'>
				<b>DESCRIPTION</b><br/>
				<p>&nbsp;</p>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr><td colspan='4'>
			<em>ABV = Alcohol By Volume&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;IBU = International Bittering Units</em><br/>
			<em>SRM = Standard Reference Method&nbsp;&nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;&nbsp;OG = Original Gravity</em>
			</td></tr>
		</tfoot>
	</table>";
}

mysqli_close($con);
?>