<?php
namespace lib\db\nic_dns;


class update
{
	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('dns', $_args, $_id, 'nic');
	}


	public static function remove_old_default($_user_id)
	{
		$query  = "UPDATE dns SET dns.isdefault = NULL WHERE dns.user_id = $_user_id";
		$result = \dash\pdo::query($query, [], 'nic');
		return $result;
	}
}
?>