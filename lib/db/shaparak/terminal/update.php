<?php
namespace lib\db\shaparak\terminal;

class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE terminal SET $set WHERE terminal.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'shaparak');
		return $result;
	}

}
?>