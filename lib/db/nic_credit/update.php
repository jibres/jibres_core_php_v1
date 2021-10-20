<?php
namespace lib\db\nic_credit;


class update
{
	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE credit SET $set WHERE credit.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}


}
?>