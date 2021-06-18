<?php
namespace content_business\ticket\view;

class controller
{
	public static function routing()
	{
		\dash\utility\ip::check(true);

		\dash\csrf::set();

		\dash\allow::file();

		\dash\temp::set('customer_mode', true);

		$load = \dash\app\ticket\get::my_ticket(null, true);

		if(!$load)
		{
			\dash\header::status(403);
		}

		if(isset($load['parent']) && $load['parent'])
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='. $load['parent']);
		}


		\dash\data::dataRow($load);


	}
}
?>
