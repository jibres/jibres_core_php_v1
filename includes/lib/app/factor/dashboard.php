<?php
namespace lib\app\factor;

trait dashboard
{
	private static $life_time = 60 * 1;

	public static function dashboard($_clean_cache = false)
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			return false;
		}

		$result                         = [];
		// $result['factor_count']         = self::factor_count($_clean_cache);
		$count_group_by                 = self::factor_count_group_by();
		$result['buy_count']            = isset($count_group_by['buy']) ? $count_group_by['buy'] : 0;
		$result['sell_count']           = isset($count_group_by['sell']) ? $count_group_by['sell'] : 0;
		$result['pre_sell_count']       = isset($count_group_by['presell']) ? $count_group_by['presell'] : 0;
		$result['lending_count']        = isset($count_group_by['lending']) ? $count_group_by['lending'] : 0;
		$result['back_from_buy_count']  = isset($count_group_by['backbuy']) ? $count_group_by['backbuy'] : 0;
		$result['back_from_sell_count'] = isset($count_group_by['backsell']) ? $count_group_by['backsell'] : 0;
		$result['waste_product_count']  = isset($count_group_by['waste']) ? $count_group_by['waste'] : 0;
		return $result;
	}


	private static function factor_count_group_by($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_factor_count_group_by_'. \lib\store::id(), null);
			return null;
		}

		$count = \lib\session::get('dashboard_factor_count_group_by_'. \lib\store::id());

		if($count === null)
		{
			$count = \lib\db\factors::get_count_group_by(\lib\store::id());
			\lib\session::set('dashboard_factor_count_group_by_'. \lib\store::id(), $count, null,  self::$life_time);
		}

		return $count;
	}


	public static function factor_count($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_factor_count_'. \lib\store::id(), null);
			return null;
		}

		$count = \lib\session::get('dashboard_factor_count_'. \lib\store::id());
		if($count === null)
		{
			$count = \lib\db\factors::get_count(['store_id' => \lib\store::id()]);
			$count = intval($count);
			\lib\session::set('dashboard_factor_count_'. \lib\store::id(), $count, null,  self::$life_time);
		}
		return $count;
	}

}
?>