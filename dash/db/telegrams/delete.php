<?php
namespace dash\db\telegrams;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM telegrams WHERE telegrams.id = $_id ";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


}
?>
