<?php
namespace lib\db\sms;


class update
{



	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('sms', $_args, $_id, 'api_log');
	}

}
?>
