<?php
namespace lib\db\domains;


class update
{
	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('domains', $_args, $_id, 'nic_log');
	}
}
?>