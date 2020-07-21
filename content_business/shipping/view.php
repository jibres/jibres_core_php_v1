<?php
namespace content_business\shipping;


class view
{
	public static function config()
	{
		$title = T_("Pay"). ' ('. \dash\fit::number(\lib\website::cart_total(true)). ')';
		\dash\face::titlePWA($title);
		\dash\face::title($title . ' '. \dash\face::site());

		// btn
		\dash\data::back_link(\dash\url::kingdom().'/cart');

		$addressDataTable = \lib\website::my_address_list();
		\dash\data::addressDataTable($addressDataTable);


		$payment = \lib\app\setting\get::payment();
		\dash\data::paymentWay($payment);


		$shipping_setting = \lib\app\setting\get::shipping_setting();
		\dash\data::shippingSettingSaved($shipping_setting);


		$myCart = \lib\website::cart_detail();
		\dash\data::myCart($myCart);

		$cartSummary = \lib\website::cart_summary();
		\dash\data::cartSummary($cartSummary);

		$cart_setting = \lib\app\setting\get::cart_setting();
		\dash\data::cartSettingSaved($cart_setting);


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
