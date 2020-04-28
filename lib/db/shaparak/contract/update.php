<?php
namespace lib\db\shaparak\contract;

class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE contract SET $set WHERE contract.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'shaparak');
		return $result;
	}

}
?>