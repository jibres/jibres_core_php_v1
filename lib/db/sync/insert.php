<?php
namespace lib\db\sync;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('sync', $_args);

	}
}
?>