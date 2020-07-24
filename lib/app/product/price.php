<?php
namespace lib\app\product;

class price
{
	public static function variant_price($_id)
	{
		$_id = \dash\validate::id($_id);
		if(!$_id)
		{
			return false;
		}

		$load_price = \lib\db\products\get::variant_min_max_price($_id);

		$min_price = 0;
		$max_price = 0;

		if(isset($load_price['min_price']))
		{
			$min_price = \lib\price::down($load_price['min_price']);
		}

		if(isset($load_price['max_price']))
		{
			$max_price = \lib\price::down($load_price['max_price']);
		}

		$result =
		[
			'min_price' => $min_price,
			'max_price' => $max_price,
		];

		return $result;


	}
}
?>