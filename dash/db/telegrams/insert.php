<?php
namespace dash\db\telegrams;


class insert
{
	public static function insert_telegram_api_log($_args)
	{
		return \dash\pdo\query_template::insert('telegram', $_args, 'api_log');
	}


	public static function insert_telegram_sending_api_log($_args)
	{
		return \dash\pdo\query_template::insert('telegram_sending', $_args, 'api_log');
	}
}
?>