<?php
namespace content_business\ticket\view;

class controller
{
	public static function routing()
	{
		\dash\utility\ip::check(true);

		\dash\csrf::set();

		\dash\temp::set('customer_mode', true);

		$load = \dash\app\ticket\get::my_ticket();
		if(!$load)
		{
			\dash\header::status(403);
		}

		\dash\data::dataRow($load);


	}
}
?>
