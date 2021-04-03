<?php
namespace lib\app\store;


class reserve
{

	private static function need_reserve()
	{
		// count business must be reserved everytime
		return 1;
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
		if(self::is_busy())
		{
			return false;
		}

		if(self::count_reserve() < self::need_reserve())
		{
			self::set_busy();

			\lib\app\store\db::create_reserve_business();

			self::set_free();
		}
	}


	/**
	 * Determines if busy.
	 *
	 * @return     boolean  True if busy, False otherwise.
	 */
	private static function is_busy()
	{
		return self::busy(null);
	}


	/**
	 * Sets the transfer is busy.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function set_busy()
	{
		return self::busy(true);
	}


	/**
	 * Sets the free.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function set_free()
	{
		return self::busy(false);
	}


	/**
	 * Manaage busy file
	 *
	 * @param      boolean  $_action  The action
	 *
	 * @return     <type>   ( description_of_the_return_value )
	 */
	private static function busy($_action = null)
	{
		$addr = __DIR__. '/creating_reserve_business_is_busy.me.log';

		// check is busye
		if($_action === null)
		{
			return is_file($addr);
		}

		if($_action === false)
		{
			\dash\file::delete($addr);
		}

		if($_action === true)
		{
			\dash\file::write($addr, date("Y-m-d H:i:s"));
		}
	}

}
?>