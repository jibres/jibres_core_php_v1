<?php
namespace lib\db\discount_dedicated;


class insert
{
	public static function multi_insert()
	{
		return \dash\pdo\query_template::multi_insert('discount_dedicated', ...func_get_args());
	}


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('discount_dedicated', $_args);
	}

}
?>
