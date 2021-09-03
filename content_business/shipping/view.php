<?php
namespace content_business\shipping;


class view
{
	public static function config()
	{
		$title = T_("Pay"). ' ('. \dash\fit::number(\lib\app\cart\get::my_cart_total(true)). ')';
		\dash\face::titlePWA($title);
		\dash\face::title($title);

		// btn
		\dash\data::back_link(\dash\url::kingdom().'/cart');

		$addressDataTable = \dash\app\address::user_address_list(\dash\user::code());;
		\dash\data::addressDataTable($addressDataTable);


		$payment = \lib\app\setting\get::payment();
		\dash\data::paymentWay($payment);


		$shipping_setting = \lib\app\setting\get::shipping_setting();
		\dash\data::shippingSettingSaved($shipping_setting);

		self::cart_detail();

		$cartSummary = \lib\app\cart\search::my_detail_summary(\lib\app\cart\search::my_detail());
		\dash\data::cartSummary($cartSummary);

		$cart_setting = \lib\app\setting\get::cart_setting();
		\dash\data::cartSettingSaved($cart_setting);


		self::static_var();
	}


	public static function cart_detail()
	{

		$myCart = \lib\app\cart\search::my_detail();
		\dash\data::myCart($myCart);

		if(is_array($myCart))
		{
			$allType = array_column($myCart, 'type');
			if(count($allType) === 1 && a($allType, 0) === 'file')
			{
				\dash\data::fileMode(true);
			}
		}
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
