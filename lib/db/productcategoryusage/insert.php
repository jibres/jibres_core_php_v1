<?php
namespace lib\db\productcategoryusage;


class insert
{
	public static function multi_insert()
	{
		return \dash\pdo\query_template::multi_insert('productcategoryusage', ...func_get_args());
	}


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('productcategoryusage', $_args);
	}
}
?>
