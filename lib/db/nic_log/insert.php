<?php
namespace lib\db\nic_log;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('log', $_args, 'nic_log');

	}
}
?>
