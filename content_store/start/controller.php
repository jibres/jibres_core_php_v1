<?php
namespace content_store\start;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('subdomain'))
		{
			$check_valid = \lib\app\store\subdomain::validate_exist(\dash\request::get('subdomain'));

			if($check_valid)
			{
				\dash\notif::ok(null, ['element' => 'subdomain']);
			}
			else
			{
				\dash\notif::error(null, ['element' => 'subdomain']);
			}
			\dash\code::end();
		}
	}
}
?>
