<?php
namespace lib\db\userstore;


class db
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'update']);
		if($set)
		{
			$query = " UPDATE `userstore` SET $set WHERE userstore.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
		else
		{
			return false;
		}
	}


}
?>