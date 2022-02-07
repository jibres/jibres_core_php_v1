<?php
namespace lib\db\sms;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('sms', $_args, 'api_log');
	}


	public static function new_record_sending($_args)
	{
		return \dash\pdo\query_template::insert('sms_sending', $_args, 'api_log');
	}
}
?>