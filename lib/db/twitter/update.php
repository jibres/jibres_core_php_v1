<?php
namespace lib\db\twitter;

class update
{
	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('twitter', $_args, $_id, 'api_log');
	}
}
?>