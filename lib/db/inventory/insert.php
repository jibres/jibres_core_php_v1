<?php
namespace lib\db\inventory;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('inventory', $_args);
	}
}
?>