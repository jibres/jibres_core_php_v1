<?php
namespace lib\db\store_plan;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('store_plan', $_args, 'master');

	}
}
?>