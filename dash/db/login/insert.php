<?php
namespace dash\db\login;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('login', $_args);
	}


	public static function new_record_login_ip($_args, $_fuel = null)
	{
		return \dash\pdo\query_template::insert('login_ip', $_args);
	}
}
?>