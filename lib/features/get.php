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


	public static function detail($_feature)
	{
		$price = \lib\features\call_function::price($_feature);

		if(!$price)
		{
			$price = 0;
		}

		$title = \lib\features\call_function::title($_feature);
		$description = \lib\features\call_function::description($_feature);


		return
		[
			'feature_key' => $_feature,
			'title'       => $title,
			'price'       => $price,
			'description' => $description,
		];

	}
}
?>