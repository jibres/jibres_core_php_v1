<?php
namespace lib\db\productinventory;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('productinventory', $_args);

	}
}
?>