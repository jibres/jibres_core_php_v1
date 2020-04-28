<?php
namespace lib\db\shaparak\gateway;

class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE gateway SET $set WHERE gateway.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'shaparak');
		return $result;
	}

}
?>