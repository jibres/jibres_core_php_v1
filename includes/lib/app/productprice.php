<?php
namespace lib\app;


class productprice
{
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

			$finalprice = floatval($price) - floatval($discount);
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

		$data =
		[
			[
				'name' => T_('Price'),
				'data' => $price_array,
			],
			[
				'name' => T_('Buyprice'),
				'data' => $buyprice_array,
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
				'name' => T_('Profit'),
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