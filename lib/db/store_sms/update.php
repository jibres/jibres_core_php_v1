<?php
namespace lib\db\store_sms;


class update
{



	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store_sms', $_args, $_id, 'api_log');
	}

}
?>
