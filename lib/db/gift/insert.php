<?php
namespace lib\db\gift;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('gift', $_args);
	}


	public static function new_record_usage($_args)
	{
		return \dash\pdo\query_template::insert('giftusage', $_args);
	}
}
?>
