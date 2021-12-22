<?php
namespace dash\db\csrf;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('csrf', $_args, null, ['ignore_error' => true]);
	}
}
?>