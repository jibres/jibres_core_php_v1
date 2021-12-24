<?php
namespace lib\db\onlinenic_log;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('log', $_args, 'onlinenic_log');
	}
}
?>
