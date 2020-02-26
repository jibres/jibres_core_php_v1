<?php
namespace lib\db\nic_log;


class get
{

	public static function by_id($_id)
	{
		$query  = "SELECT log.* FROM log  WHERE log.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic_log');
		return $result;
	}
}
?>