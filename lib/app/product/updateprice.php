<?php
namespace lib\app\product;

class updateprice
{
	public static function special_date($_id, $_date)
	{
		$_id = \dash\validate::id($_id);
		if(!$_id)
		{
			return false;
		}

		$_date = \dash\validate::date($_date);
		if(!$_date)
		{
			return false;
		}

		$result = \lib\db\productprices\get::special_date($_id, $_date);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\product\\ready', 'row'], $result);

		return $result;

	}



	public static function chart($_id, $_raw_result = false)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			return false;
		}

		$chart = \lib\db\productprices\get::for_chart($_id);

		if($_raw_result)
		{
			if(!is_array($chart))
			{
				$chart = [];
			}

			$chart = array_map(['\\lib\\app\\product\\ready', 'pricehistory'], $chart);

			return $chart;
		}


		$data             = [];
		$buyprice_array   = [];
		$categories_array = [];
		$price_array      = [];
		$discount_array   = [];
		$finalprice_array = [];
		$profit_array     = [];

		foreach ($chart as $key => $value)
		{
			array_push($categories_array, \dash\datetime::fit($value['startdate'], null, 'date'));

			$buyprice = null;
			if($value['buyprice'])
			{
				$buyprice = \lib\price::down($value['buyprice']);
			}

			$price = null;
			if($value['price'])
			{
				$price = \lib\price::down($value['price']);
			}

			$discount = null;
			if($value['discount'])
			{
				$discount = \lib\price::down($value['discount']);
			}

			$finalprice = null;
			if($value['finalprice'])
			{
				$finalprice = \lib\price::down($value['finalprice']);
			}

			$profit = null;
			if($buyprice)
			{
				$profit     = $finalprice - floatval($buyprice);
			}

			array_push($buyprice_array, $buyprice);
			array_push($price_array, $price);
			array_push($discount_array, $discount);
			array_push($finalprice_array, $finalprice);
			array_push($profit_array, $profit);
		}

		if(
			empty(array_filter($buyprice_array)) &&
			empty(array_filter($price_array)) &&
			empty(array_filter($discount_array)) &&
			empty(array_filter($finalprice_array)) &&
			empty(array_filter($profit_array))
		  )
		{
			return ['categories' => '[]',  'data' => '[]'];
		}

		$data =
		[
			[
				'name' => T_('Buyprice'),
				'data' => $buyprice_array,
			],
			[
				'name' => T_('Price'),
				'data' => $price_array,
			],
			[
				'name' => T_('Discount'),
				'data' => $discount_array,
			],
			[
				'name' => T_('Final price'),
				'data' => $finalprice_array,
			],
			[
				'name' => T_('Gross profit'),
				'data' => $profit_array,
			],
		];

		$result               = [];
		$result['categories'] = json_encode($categories_array, JSON_UNESCAPED_UNICODE);
		$result['data']       = json_encode($data, JSON_UNESCAPED_UNICODE);

		return $result;
	}


	public static function check($_product_id, $_args, $_from_buy_factor = false)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}


		$changed    = false;
		$changed    = $_from_buy_factor;

		$new_record = [];

		$last_product_price = \lib\db\productprices\get::last_active($_product_id);

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

			// if((array_key_exists('compareatprice', $last_product_price) && array_key_exists('compareatprice', $_args) && floatval($_args['compareatprice']) !== floatval($last_product_price['compareatprice'])) || $changed)
			// {
			// 	$changed = true;
			// }

			if((array_key_exists('finalprice', $last_product_price) && array_key_exists('finalprice', $_args) && floatval($_args['finalprice']) !== floatval($last_product_price['finalprice'])) || $changed)
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

			if((array_key_exists('vatprice', $last_product_price) && array_key_exists('vatprice', $_args) && floatval($_args['vatprice']) !== floatval($last_product_price['vatprice'])) || $changed)
			{
				$changed = true;
			}
		}


		if($changed)
		{
			$new_record['price']           = array_key_exists('price', $_args) 				? $_args['price'] 			: null;
			$new_record['discount']        = array_key_exists('discount', $_args) 			? $_args['discount'] 		: null;
			$new_record['buyprice']        = array_key_exists('buyprice', $_args) 			? $_args['buyprice'] 		: null;
			// $new_record['compareatprice']  = array_key_exists('compareatprice', $_args) 	? $_args['compareatprice'] 	: null;
			$new_record['discountpercent'] = array_key_exists('discountpercent', $_args) 	? $_args['discountpercent'] : null;
			$new_record['finalprice']      = array_key_exists('finalprice', $_args) 		? $_args['finalprice'] 		: null;
			$new_record['vatprice']        = array_key_exists('vatprice', $_args) 			? $_args['vatprice'] 		: null;
		}

		if($changed && isset($last_product_price['id']))
		{
			$update_old_record =
			[
				'enddate' => date("Y-m-d H:i:s"),
				'last'    => null,
			];

			\lib\db\productprices\update::record($update_old_record, $last_product_price['id']);
		}

		if(!empty($new_record))
		{
			// the product was inserted
			// set the productprice record
			$new_record['product_id'] = $_product_id;
			$new_record['creator']    = \dash\user::id();
			$new_record['startdate']  = date("Y-m-d H:i:s");
			$new_record['last']       = 'yes';

			\lib\db\productprices\insert::new_record($new_record);

			\dash\temp::set('productHasChange', true);
		}
	}
}
?>