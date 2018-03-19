<?php
namespace lib\utility;
/**
 * Class for plan.
 * check plan feachers
 *
 */
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

		$result ="$product\n$factor\n$sum_factor";

		$url    = self::$dir;
		if(!\lib\file::exists($url))
		{
			\lib\file::makeDir($url, null, true);
		}

		$url .= self::$filename. self::$ext;
		if(!\lib\file::exists($url))
		{
			\lib\file::write($url, $result);
		}
		else
		{
			\lib\file::write($url, $result);
		}
	}


	public static function get()
	{
		$url = self::$dir. self::$filename. self::$ext;

		$result = @\lib\file::read($url);

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