<?php
namespace lib\db\instagram;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('instagram', $_args, 'api_log');

	}
}
?>