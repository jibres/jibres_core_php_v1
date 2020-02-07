<?php
namespace lib\db\nic_contact;


class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE contact SET $set WHERE contact.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}
}
?>