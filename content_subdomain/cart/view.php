<?php
namespace content_subdomain\cart;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Cart"));

		$dataTable = \lib\app\cart\search::my_detail();

		\dash\data::dataTable($dataTable);

	}
}
?>
