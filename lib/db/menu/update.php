<?php
namespace lib\db\menu;


class update
{

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);

		if($set)
		{
			$query  = "UPDATE menu SET $set WHERE menu.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
	}

}
?>
