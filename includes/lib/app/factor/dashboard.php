<?php
namespace lib\app\factor;

trait dashboard
{
	private static $life_time = 60 * 10;


	public static function dashboard($_clean_cache = false)
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			return false;
		}

		$result                 = [];
		$result['factor_count'] = \lib\db\factors::factor_count($_clean_cache);

		return $result;
	}


	public static function factor_count($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_factor_count', null);
			return null;
		}

		$count = \lib\session::get('dashboard_factor_count');
		if($count === null)
		{
			$count = \lib\db\factors::get_count(['store_id' => \lib\store::id()]);
			$count = intval($count);
			\lib\session::set('dashboard_factor_count', $count, null,  self::$life_time);
		}
		return $count;
	}

}
?>