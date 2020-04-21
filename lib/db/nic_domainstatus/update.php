<?php
namespace lib\db\nic_domainstatus;


class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE domainstatus SET $set WHERE domainstatus.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'nic');
		return $result;
	}


	public static function update_where($_args, $_where)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$where = \dash\db\config::make_where($_where);
		if(!$where)
		{
			return false;
		}

		$query  = "UPDATE domainstatus SET $set WHERE $where";

		$result = \dash\db::query($query, 'nic');

		return $result;
	}


}
?>