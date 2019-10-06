<?php
namespace lib\app;


class productprice
{
	public static function dashboard($_product_id)
	{

		$product_id = \dash\coding::decode($_product_id);
		if(!$product_id)
		{
			return false;
		}

		$result         = [];
		$last_buy_date  = null;
		$last_sale_date = null;

		$last_buy = \lib\db\factors::product_last_factor_date($product_id, 'buy');
		if(isset($last_buy['datecreated']))
		{
			$last_buy_date = \dash\datetime::fit($last_buy['datecreated'], true);
		}

		$last_sale = \lib\db\factors::product_last_factor_date($product_id, 'sale');
		if(isset($last_sale['datecreated']))
		{
			$last_sale_date = \dash\datetime::fit($last_sale['datecreated'], true);
		}

		$low_sale_price = \lib\db\productprices::price_history_date($product_id, 'asc');
		if($low_sale_price)
		{
			$low_sale_price = \dash\datetime::fit($low_sale_price, true);
		}

		$top_sale_price = \lib\db\productprices::price_history_date($product_id, 'desc');
		if($top_sale_price)
		{
			$top_sale_price = \dash\datetime::fit($top_sale_price, true);
		}

		$result['last_buy']       = $last_buy_date;
		$result['last_sale']      = $last_sale_date;
		$result['last_buy_id']    = isset($last_buy['id']) ? \dash\coding::encode($last_buy['id']) : null;
		$result['last_sale_id']   = isset($last_sale['id']) ? \dash\coding::encode($last_sale['id']) : null;

		$result['top_sale_price'] = $top_sale_price;
		$result['low_sale_price'] = $low_sale_price;

		return $result;
	}


	public static function chart($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$chart = \lib\db\productprices::get(['product_id' => $id],['order' => 'ORDER BY productprices.id ASC']);

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
				$buyprice = floatval($value['buyprice']);
			}

			$price = null;
			if($value['price'])
			{
				$price = floatval($value['price']);
			}

			$discount = null;
			if($value['discount'])
			{
				$discount = floatval($value['discount']);
			}

			$finalprice = null;
			if($price || $discount)
			{
				$finalprice = floatval($price) - floatval($discount);
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
}
?>