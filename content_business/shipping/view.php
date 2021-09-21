<?php
namespace content_business\shipping;


class view
{
	public static function config()
	{


		$title = T_("Pay"). ' ('. \dash\fit::text(\dash\data::myCart_total_full()). ')';
		\dash\face::titlePWA($title);
		\dash\face::title($title);

		// btn
		\dash\data::back_link(\dash\url::kingdom().'/cart');

		$addressDataTable = [];
		if(\dash\user::id())
		{
			$addressDataTable = \dash\app\address::user_address_list(\dash\user::code());;
		}
		\dash\data::addressDataTable($addressDataTable);


		$payment = \lib\app\setting\get::payment();
		\dash\data::paymentWay($payment);


		$shipping_setting = \lib\app\setting\get::shipping_setting();
		\dash\data::shippingSettingSaved($shipping_setting);


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
