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

		$data     = [];
		$buyprice   = [];
		$categories = [];
		$price      = [];
		$discount   = [];

		foreach ($chart as $key => $value)
		{
			array_push($categories, \dash\datetime::fit($value['startdate'], null, 'date'));
			array_push($buyprice, floatval($value['buyprice']));
			array_push($price, floatval($value['price']));
			array_push($discount, floatval($value['discount']));
		}

		$data =
		[
			[
				'name' => 'price',
				'data' => $price,
			],
			[
				'name' => 'buyprice',
				'data' => $buyprice,
			],
			[
				'name' => 'discount',
				'data' => $discount,
			],
		];

		$result               = [];
		$result['categories'] = json_encode($categories, JSON_UNESCAPED_UNICODE);
		$result['data']       = json_encode($data, JSON_UNESCAPED_UNICODE);

		return $result;
	}
}
?>