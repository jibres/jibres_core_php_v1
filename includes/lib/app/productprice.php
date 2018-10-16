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

		$chart = \lib\db\productprices::get(['product_id' => $id]);

		$result   = [];
		$buyprice = [];
		$price    = [];
		$discount = [];
		foreach ($chart as $key => $value)
		{
			array_push($buyprice, floatval($value['buyprice']));
			array_push($price, floatval($value['price']));
			array_push($discount, floatval($value['discount']));
		}

		$result =
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

		return json_encode($result, JSON_UNESCAPED_UNICODE);
	}
}
?>