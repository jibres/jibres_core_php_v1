<?php
namespace lib\app\store;


class reserve
{

	private static function need_reserve()
	{
		// count business must be reserved everytime
		return 5;
	}


	/**
	 * Counts exists reserved business
	 *
	 * @return     <type>  Number of reserve.
	 */
	private static function count_reserve()
	{
		$count = \lib\db\store\get::count_reserved_business();
		return floatval($count);
	}


	/**
	 * Run by cronjob to create store reserved
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function create_business_as_reserved()
	{
		if(\dash\utility\busy::is_busy('create_reserve_business'))
		{
			return false;
		}

		if(self::count_reserve() < self::need_reserve())
		{
			\dash\utility\busy::set_busy('create_reserve_business');

			\lib\app\store\db::create_reserve_business();

			\dash\utility\busy::set_free('create_reserve_business');
		}
	}
}
?>