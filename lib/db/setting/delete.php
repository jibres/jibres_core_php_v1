<?php
namespace lib\db\setting;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM setting WHERE setting.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
