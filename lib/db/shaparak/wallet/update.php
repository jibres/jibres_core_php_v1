<?php
namespace lib\db\shaparak\wallet;

class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE wallet SET $set WHERE wallet.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'shaparak');
		return $result;
	}

}
?>