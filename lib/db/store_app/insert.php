<?php
namespace lib\db\store_app;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('store_app', $_args, 'master');

	}
}
?>