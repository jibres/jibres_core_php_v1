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


	public static function all_list_by_count()
	{
		$list         = self::all_list();
		$count_all    = \lib\db\store_features\get::group_by_feature_key();
		$count_enable = \lib\db\store_features\get::group_by_feature_key_status('enable');

		foreach ($list as $key => $value)
		{
			if(isset($value['feature_key']))
			{
				if(isset($count_all[$value['feature_key']]))
				{
					$list[$key]['count_use'] = $count_all[$value['feature_key']];
				}

				if(isset($count_enable[$value['feature_key']]))
				{
					$list[$key]['count_enable'] = $count_enable[$value['feature_key']];
				}
			}
		}

		return $list;

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


	public static function zone($_feature)
	{
		$zone = \lib\features\call_function::zone($_feature);

		if(!$zone)
		{
			$zone = 0;
		}

		return $zone;
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