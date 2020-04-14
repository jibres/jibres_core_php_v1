<?php
namespace lib\db\nic_usersetting;


class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE usersetting SET $set WHERE usersetting.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}

}
?>