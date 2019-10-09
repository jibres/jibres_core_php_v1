<?php
namespace content_c\store\add;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('slug'))
		{
			$check_valid = \lib\app\store\subdomain::validate_exist(\dash\request::get('slug'));

			if($check_valid)
			{
				\dash\notif::ok(null, ['element' => 'slug']);
			}
			else
			{
				\dash\notif::error(null, ['element' => 'slug']);
			}
			\dash\code::end();
		}
	}
}
?>
