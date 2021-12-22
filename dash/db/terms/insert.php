<?php
namespace dash\db\terms;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('terms', $_args);
	}
}
?>