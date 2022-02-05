<?php
namespace lib\db\store_sms;


class insert
{


	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('store_sms', $_args, 'api_log');

	}
}
?>