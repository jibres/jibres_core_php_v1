<?php
namespace lib\db\twitter;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('twitter', $_args, 'api_log');

	}
}
?>