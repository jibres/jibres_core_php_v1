<?php
namespace content_subdomain\shipping;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Shipping"));

		$dataTable = \lib\app\cart\search::my_detail();
		\dash\data::dataTable($dataTable);


		$addressDataTable = \lib\website::my_address_list();
		\dash\data::addressDataTable($addressDataTable);


		$payment = \lib\app\setting\get::payment();
		\dash\data::paymentWay($payment);



		self::static_var();
	}


	private static function static_var()
	{

		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		$cityList    = \dash\utility\location\cites::$data;
		$proviceList = \dash\utility\location\provinces::key_list('localname');

		$new = [];
		foreach ($cityList as $key => $value)
		{
			$temp = '';

			if(isset($value['province']) && isset($proviceList[$value['province']]))
			{
				$temp .= $proviceList[$value['province']]. ' - ';
			}
			if(isset($value['localname']))
			{
				$temp .= $value['localname'];
			}
			$new[$key] = $temp;
		}
		asort($new);

		\dash\data::cityList($new);
	}
}
?>
