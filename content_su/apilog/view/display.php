
<div class="box">
	<table class="tbl1 v3">

<?php
foreach (\dash\data::dataRow() as $key => $value)
{
	echo "<tr>";
	echo "<th>". $key. "</th>";
	if(substr($value,0 , 1) === '[')
	{
		$myVal = json_decode($value, true);
		echo "<td>";
		foreach ($myVal as $ikey => $ivalue)
		{
			echo "<div class=''>";
			echo json_encode($ivalue);
			echo "</div>";
			# code...
		}
		echo "</td>";
	}
	else
	{
		echo "<td>". $value. "</td>";
	}
	echo "</tr>";
}
 ?>
	</table>
</div>
