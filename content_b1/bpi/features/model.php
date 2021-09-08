<?php
namespace content_b1\bpi\features;


class model
{

	public static function post()
	{
		$args             = [];

		if(\dash\request::input_body('sync_required'))
		{
			\lib\features\business::sync_required();
		}

		\dash\notif::ok(T_("Setting saved"));

		\content_b1\tools::say([]);
	}

}
?>