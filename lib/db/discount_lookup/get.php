<?php
namespace lib\db\discount_lookup;


class get
{

	public static function count_by_ip_agent($_ip_id, $_agent_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM discount_lookup WHERE discount_lookup.ip_id = $_ip_id AND discount_lookup.agent_id = $_agent_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function count_by_discount_id($_discount_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM discount_lookup WHERE discount_lookup.discount_id = $_discount_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}
}
?>