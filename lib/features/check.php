<?php
namespace lib\features;


class check
{
	public static function is_active($_feature)
	{
		$price = 0;

		$price = \lib\features\call_function::price($_feature);
		var_dump($price);exit;

		return $price;
	}
}
?>