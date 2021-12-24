<?php
namespace lib\db\sms_log;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('sms_log', $_args);

	}
}
?>