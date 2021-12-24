<?php
namespace lib\db\form_tagusage;


class insert
{
	public static function multi_insert()
	{
		return \dash\pdo\query_template::multi_insert('form_tagusage', ...func_get_args());
	}


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('form_tagusage', $_args);
	}
}
?>
