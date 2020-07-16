<?php
namespace content_business\orders;


class view
{
	public static function config()
	{
		\dash\face::title(T_("My orders"));

		$my_orders = \lib\app\factor\search::my_orders();
		\dash\data::dataTable($my_orders);
	}
}
?>
