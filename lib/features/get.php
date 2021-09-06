<?php
namespace lib\features;


class get
{
	public static function price($_feature)
	{
		$price = \lib\features\call_function::price($_feature);

		if(!$price)
		{
			$price = 0;
		}

		return $price;
	}
}
?>