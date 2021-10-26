<?php
namespace lib\db\store_plugin;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('store_plugin', $_args);

	}
}
?>