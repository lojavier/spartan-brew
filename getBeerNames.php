<?php
require_once("config/spartanbrewdb.php");

$beer_style = $_POST['beer_style'];

$sql = "SELECT * FROM spartanbrewdb.beer_info WHERE BEER_STYLE='".$beer_style."' ORDER BY BEER_NAME ASC";
$result = mysqli_query($con,$sql);

echo "
<b>Select a beer:</b>
<form>
<select name='beer_names' onchange='getBeerInfo(this.value)'>
	<option value='-1'>Select one:</option>";
	while ($row=mysqli_fetch_array($result))
	{
		echo "<option value='".$row['BEER_ID']."'>".$row['BEER_NAME']."</option>";
	}
echo "
</select>
</form>
<br>";

mysqli_close($con);
?>