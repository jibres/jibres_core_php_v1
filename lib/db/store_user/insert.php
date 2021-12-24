<?php
namespace lib\db\store_user;


class insert
{
	public static function jibres_new_record($_args)
	{
		return \dash\pdo\query_template::insert('store_user', $_args, 'master');
	}
}
?>