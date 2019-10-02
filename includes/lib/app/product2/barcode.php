<?php
namespace lib\app\product2;

class barcode
{
	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	$buyprice = \dash\app::request('buyprice');
		$buyprice = \dash\utility\convert::to_en_number($buyprice);
		if($buyprice && !is_numeric($buyprice))
		{
			\dash\notif::error(T_("Value of buyprice muset be a number"), 'buyprice');
			return false;
		}

		if(\dash\utility\filter::max_number($buyprice, 999999999999999999))
		{
			\dash\notif::error(T_("Value of buyprice is out of rage"), 'buyprice');
			return false;
		}

		if(intval($buyprice) < 0)
		{
			\dash\notif::error(T_("Value of buyprice is out of rage"), 'buyprice');
			return false;
		}

		$store_max_buyprice = \lib\store::setting('maxbuyprice');
		if($buyprice && $store_max_buyprice && intval($buyprice) > intval($store_max_buyprice))
		{
			\dash\notif::error(T_("The maximum buyprice in your store is :val", ['val' => \dash\utility\human::fitNumber($store_max_buyprice)]), 'buyprice');
			return false;
		}

		$price = \dash\app::request('price');
		$price = \dash\utility\convert::to_en_number($price);
		if($price && !is_numeric($price))
		{
			\dash\notif::error(T_("Value of price muset be a number"), 'price');
			return false;
		}

		if(\dash\utility\filter::max_number($price, 999999999999999999))
		{
			\dash\notif::error(T_("Value of price is out of rage"), 'price');
			return false;
		}

		if(intval($price) < 0)
		{
			\dash\notif::error(T_("Value of price is out of rage"), 'price');
			return false;
		}

		$store_max_price = \lib\store::setting('maxprice');
		if($price && $store_max_price && intval($price) > intval($store_max_price))
		{
			\dash\notif::error(T_("The maximum price in your store is :val", ['val' => \dash\utility\human::fitNumber($store_max_price)]), 'price');
			return false;
		}


		$discount = \dash\app::request('discount');
		$discount = \dash\utility\convert::to_en_number($discount);
		if($discount && !is_numeric($discount))
		{
			\dash\notif::error(T_("Value of discount muset be a number"), 'discount');
			return false;
		}

		if($discount && \dash\utility\filter::max_number($discount, 999999999999999999))
		{
			\dash\notif::error(T_("Value of discount is out of rage"), 'discount');
			return false;
		}

		if($discount && intval($discount) < 0)
		{
			\dash\notif::error(T_("Value of discount is out of rage"), 'discount');
			return false;
		}


		$discountpercent = null;
		if($discount && $price && intval($price) !== 0)
		{
			$discountpercent = round((intval($discount) * 100) / intval($price), 3);
		}

		$store_max_discount = \lib\store::setting('maxdiscount');
		if($discountpercent && $store_max_discount && intval($discountpercent) > intval($store_max_discount))
		{
			\dash\notif::error(T_("The maximum discount in your store is :val", ['val' => \dash\utility\human::fitNumber($store_max_discount)]), 'discount');
			return false;
		}
}
?>
