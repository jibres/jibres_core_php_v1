<?php
namespace lib\features;


class get
{
	public static function all_list()
	{
		$list = glob(__DIR__. '/items/*');

		$features = [];

		foreach ($list as $key => $value)
		{
			$feature_key = str_replace('.php', '', basename($value));

			$features[] = self::detail($feature_key);
		}

		return $features;

	}


	public static function price($_feature)
	{
		$price = \lib\features\call_function::price($_feature);

		if(!$price)
		{
			$price = 0;
		}

		return $price;
	}


	public static function title($_feature)
	{
		$title = \lib\features\call_function::title($_feature);

		return $title;
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