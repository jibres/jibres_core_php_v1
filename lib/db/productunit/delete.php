<?php
namespace lib\db\productunit;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM productunit WHERE productunit.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
