<?php
namespace dash\db\telegrams;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM telegrams WHERE telegrams.id = $_id ";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>
