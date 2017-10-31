<?php
namespace lib\app\product;

trait buyprice
{
	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function buyprice_check($_product_id, $_args)
	{
		$changed    = false;
		$new_record = [];

		$last_product_price = \lib\db\productprices::last($_product_id);

		if(!$last_product_price || !isset($last_product_price['id']))
		{
			// old record not exits
			if(array_key_exists('price', $_args)) 	 		$new_record['price']           = $_args['price'];
			if(array_key_exists('discount', $_args)) 		$new_record['discount']        = $_args['discount'];
			if(array_key_exists('discountpercent', $_args)) $new_record['discountpercent'] = $_args['discountpercent'];
			if(array_key_exists('buyprice', $_args)) 		$new_record['buyprice']        = $_args['buyprice'];
		}
		else
		{
			// old record exist
			if
			(
				array_key_exists('price', $last_product_price) &&
				array_key_exists('price', $_args) &&
				floatval($_args['price']) !== floatval($last_product_price['price'])
			)
			{
				$new_record['price'] = $_args['price'];
				$changed = true;
			}

			if
			(
				array_key_exists('discount', $last_product_price) &&
				array_key_exists('discount', $_args) &&
				floatval($_args['discount']) !== floatval($last_product_price['discount'])
			)
			{
				$new_record['discount'] = $_args['discount'];
				$changed = true;
			}

			if
			(
				array_key_exists('buyprice', $last_product_price) &&
				array_key_exists('buyprice', $_args) &&
				floatval($_args['buyprice']) !== floatval($last_product_price['buyprice'])
			)
			{
				$new_record['buyprice'] = $_args['buyprice'];
				$changed = true;
			}

			if
			(
				array_key_exists('discountpercent', $last_product_price) &&
				array_key_exists('discountpercent', $_args) &&
				floatval($_args['discountpercent']) !== floatval($last_product_price['discountpercent'])
			)
			{
				$new_record['discountpercent'] = $_args['discountpercent'];
				$changed = true;
			}

		}


		if($changed)
		{

			$update_old_record =
			[
				'creator'       => \lib\user::id(),
				'enddate'       => date("Y-m-d H:i:s"),
				'endshamsidate' => \lib\utility\jdate::date("Ymd", false, false),
			];

			\lib\db\productprices::update($update_old_record, $last_product_price['id']);

		}

		if(!empty($new_record))
		{
			// the product was inserted
			// set the productprice record

			$new_record['product_id']      = $_product_id;
			$new_record['creator']         = \lib\user::id();
			$new_record['startdate']       = date("Y-m-d H:i:s");
			$new_record['startshamsidate'] = \lib\utility\jdate::date("Ymd", false, false);

			\lib\db\productprices::insert($new_record);
		}

	}
}
?>