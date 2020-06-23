<?php
namespace content_subdomain\payment;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Payment"));

		$dataTable = \lib\app\cart\search::my_detail();
		\dash\data::dataTable($dataTable);


		$addressDataTable = \lib\website::my_address_list();
		\dash\data::addressDataTable($addressDataTable);


	}

}
?>
