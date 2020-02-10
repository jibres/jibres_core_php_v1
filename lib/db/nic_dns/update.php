<?php
namespace lib\db\nic_dns;


class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE dns SET $set WHERE dns.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}


	public static function remove_old_default($_user_id)
	{
		$query  = "UPDATE dns SET dns.isdefault = NULL WHERE dns.user_id = $_user_id";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}
}
?>