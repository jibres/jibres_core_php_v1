<?php
namespace dash\db\comments;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('comments', $_args);

	}
}
?>