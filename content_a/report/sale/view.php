<?php
namespace content_a\report\sale;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sale report'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


		$args = [];

		$result = \lib\app\report\sale\get::master_report($args);

		\dash\data::masterReport($result);

	}
}
?>