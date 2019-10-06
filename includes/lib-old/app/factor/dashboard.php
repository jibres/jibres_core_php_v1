<?php
namespace lib\app\factor;

class dashboard
{
	private static $life_time = 60 * 1;

	public static function detail($_clean_cache = false)
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			return false;
		}

		$result                    = [];
		// $result['factor_count'] = self::factor_count($_clean_cache);
		$count_group_by            = self::factor_count_group_by();

		$result['buy']             = isset($count_group_by['buy']) ? $count_group_by['buy'] : 0;
		$result['sale']            = isset($count_group_by['sale']) ? $count_group_by['sale'] : 0;
		$result['pre_sale']        = isset($count_group_by['presale']) ? $count_group_by['presale'] : 0;
		$result['lending']         = isset($count_group_by['lending']) ? $count_group_by['lending'] : 0;
		$result['backbuy']   = isset($count_group_by['backbuy']) ? $count_group_by['backbuy'] : 0;
		$result['backfactor']  = isset($count_group_by['backsale']) ? $count_group_by['backsale'] : 0;
		$result['waste']   = isset($count_group_by['waste']) ? $count_group_by['waste'] : 0;
		$result['all']             = array_sum($count_group_by);


		$temp = $count_group_by;
		unset($temp['sale']);
		unset($temp['buy']);
		$other_sum = array_sum($temp);
		$result['all_other']             = $other_sum;
		$result['have_other'] = false;

		if($other_sum)
		{
			$result['have_other'] = true;
		}

		return $result;
	}


	private static function factor_count_group_by($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_factor_count_group_by_'. \lib\store::id(), 'jibres_store');
			return null;
		}

		$count = \dash\session::get('dashboard_factor_count_group_by_'. \lib\store::id(), 'jibres_store');

		if($count === null)
		{
			$count = \lib\db\factors::get_count_group_by(\lib\store::id());
			\dash\session::set('dashboard_factor_count_group_by_'. \lib\store::id(), $count, 'jibres_store',  self::$life_time);
		}

		return $count;
	}


	public static function factor_count($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_factor_count_'. \lib\store::id(), 'jibres_store');
			return null;
		}

		$count = \dash\session::get('dashboard_factor_count_'. \lib\store::id(), 'jibres_store');
		if($count === null)
		{
			$count = \lib\db\factors::get_count(['store_id' => \lib\store::id()]);
			$count = intval($count);
			\dash\session::set('dashboard_factor_count_'. \lib\store::id(), $count, 'jibres_store',  self::$life_time);
		}
		return $count;
	}

}
?>