<?php
namespace lib\utility;


class homepagenumber
{
	private static $dir      = root. 'public_html/files/data/';
	private static $filename = 'homepagenumber';
	private static $ext      = '.txt';


	public static function set()
	{
		$product    = \lib\db\products::get_count();
		$factor     = \lib\db\factors::get_count();
		$sum_factor = \lib\db\factors::sum_all();

		if(is_numeric($product) && is_numeric($factor) && is_numeric($sum_factor))
		{
			// no problem
		}
		else
		{
			return;
		}

		$result ="$product\n$factor\n$sum_factor";

		if(\dash\permission::supervisor())
		{
			var_dump($product);
			var_dump($factor);
			var_dump($sum_factor);
		}

		$url    = self::$dir;
		if(!\dash\file::exists($url))
		{
			\dash\file::makeDir($url, null, true);
		}

		$url .= self::$filename. self::$ext;
		if(!\dash\file::exists($url))
		{
			\dash\file::write($url, $result);
		}
		else
		{
			\dash\file::write($url, $result);
		}
	}


	public static function get()
	{
		$url = self::$dir. self::$filename. self::$ext;

		$result = @\dash\file::read($url);

		$temp               = [];
		$temp['product']    = 2580;
		$temp['factor']     = 8167;
		$temp['sum_factor'] = 12785300;

		if(is_string($result))
		{
			$result             = explode("\n", $result);
			$temp['product']    = isset($result[0]) ? $result[0] : null;
			$temp['factor']     = isset($result[1]) ? $result[1] : null;
			$temp['sum_factor'] = isset($result[2]) ? $result[2] : null;
		}
		return $temp;
	}
}
?>