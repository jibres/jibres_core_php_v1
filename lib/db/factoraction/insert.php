<?php
namespace lib\db\factoraction;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('factoraction', $_args);

	}
}
?>