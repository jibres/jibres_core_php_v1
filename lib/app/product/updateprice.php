<?php
namespace lib\app\product;

class updateprice
{

	public static function check($_product_id, $_args, $_from_buy_factor = false)
	{
		$changed    = false;
		$changed    = $_from_buy_factor;

		$new_record = [];

		$last_product_price = \lib\db\productprices\db::last_active($_product_id);

		if(!$last_product_price || !isset($last_product_price['id']))
		{
			// old record not exits
			$changed = true;
		}
		else
		{
			// old record exist
			if((array_key_exists('price', $last_product_price) && array_key_exists('price', $_args) && floatval($_args['price']) !== floatval($last_product_price['price'])) || $changed)
			{
				$changed = true;
			}

			if((array_key_exists('compareatprice', $last_product_price) && array_key_exists('compareatprice', $_args) && floatval($_args['compareatprice']) !== floatval($last_product_price['compareatprice'])) || $changed)
			{
				$changed = true;
			}


			if((array_key_exists('discount', $last_product_price) && array_key_exists('discount', $_args) && floatval($_args['discount']) !== floatval($last_product_price['discount'])) || $changed)
			{
				$changed = true;
			}

			if((array_key_exists('buyprice', $last_product_price) && array_key_exists('buyprice', $_args) && floatval($_args['buyprice']) !== floatval($last_product_price['buyprice'])) || $changed)
			{
				$changed = true;
			}

			if((array_key_exists('discountpercent', $last_product_price) && array_key_exists('discountpercent', $_args) && floatval($_args['discountpercent']) !== floatval($last_product_price['discountpercent'])) || $changed)
			{
				$changed = true;
			}
		}

		if($changed)
		{
			$new_record['price']           = array_key_exists('price', $_args) 				? $_args['price'] 			: null;
			$new_record['discount']        = array_key_exists('discount', $_args) 			? $_args['discount'] 		: null;
			$new_record['buyprice']        = array_key_exists('buyprice', $_args) 			? $_args['buyprice'] 		: null;
			$new_record['compareatprice']  = array_key_exists('compareatprice', $_args) 	? $_args['compareatprice'] 	: null;
			$new_record['discountpercent'] = array_key_exists('discountpercent', $_args) 	? $_args['discountpercent'] : null;

			if(isset($new_record['price']) || isset($new_record['discount']))
			{
				$new_record['finalprice'] = floatval($new_record['price']) - floatval($new_record['discount']);
			}
		}

		if($changed && isset($last_product_price['id']))
		{
			$update_old_record =
			[
				'enddate' => date("Y-m-d H:i:s"),
				'last'    => null,
			];

			\lib\db\productprices\db::update($update_old_record, $last_product_price['id']);
		}

		if(!empty($new_record))
		{
			// the product was inserted
			// set the productprice record
			$new_record['product_id'] = $_product_id;
			$new_record['creator']    = \dash\user::id();
			$new_record['startdate']  = date("Y-m-d H:i:s");
			$new_record['last']       = 'yes';

			\lib\db\productprices\db::insert($new_record);

			\dash\temp::set('productHasChange', true);
		}
	}
}
?>