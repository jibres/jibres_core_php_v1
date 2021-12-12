<?php
namespace lib\app\statistics;


class homepage
{
	private static $dir      = __DIR__. '/homepagenumber.me.json';


	public static function refresh()
	{
		$product    = \lib\db\store\get::count_store_analytics_product();
		$factor     = \lib\db\store\get::count_store_analytics_factor();
		$sum_factor = \lib\db\store\get::sum_store_analytics_factor();

		$json =
		[
			'product'     => $product,
			'factor'      => $factor,
			'sum_factor'  => round(floatval(floatval($sum_factor))),
			'last_update' => date("Y-m-d H:i:s"),
		];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		\dash\file::write(self::$dir, $json);

	}


	public static function get_file()
	{
		$result = \dash\file::read(self::$dir);
		return $result;
	}


	public static function get()
	{
		$result = \dash\file::read(self::$dir);

		if($result && is_string($result))
		{
			$result = json_decode($result, true);

			if(!is_array($result))
			{
				$result =
				[
					'product'     => 25783,
					'factor'      => 491505,
					'sum_factor'  => 11810316275,
					'last_update' => date("Y-m-d H:i:s"),
				];
			}
			return $result;
		}
	}
}
?>