<?php
namespace lib\db\sms_charge;


class update
{


	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('sms_charge', $_args, $_id, 'api_log');
	}

}

