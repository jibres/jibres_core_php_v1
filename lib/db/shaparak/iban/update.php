<?php
namespace lib\db\shaparak\iban;

class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE iban SET $set WHERE iban.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'shaparak');
		return $result;
	}

}
?>