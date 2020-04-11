<?php
namespace lib\db\domains;


class update
{
		public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE domains SET $set WHERE domains.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'nic_log');
		return $result;
	}
}
?>