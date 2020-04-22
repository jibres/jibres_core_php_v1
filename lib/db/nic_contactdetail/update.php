<?php
namespace lib\db\nic_contactdetail;


class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE contactdetail SET $set WHERE contactdetail.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}


}
?>
