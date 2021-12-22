<?php
namespace lib\db\discount_lookup;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('discount_lookup', $_args);
	}
}
?>