<?php
namespace content_a\setting\order\schedule;

class controller
{
	public static function routing()
	{
		\dash\data::weekdayList(['Monday','Tuesday','Wednesday','Thursday','Friday', 'Saturday','Sunday',]);

		if(\dash\language::current() === 'fa')
		{
			\dash\data::weekdayList(['Saturday','Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday',]);
		}



		$load = \lib\store::detail('order_schedule');
		$load = json_decode($load, true);
		\dash\data::dataRow($load);

	}
}
?>