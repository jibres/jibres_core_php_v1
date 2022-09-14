<?php
namespace lib\db\sms_charge;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('sms_charge', $_args, 'api_log');
	}

}
