<?php
namespace content_hook\job;


class business
{
	public static function run($_fn)
	{
		$list = \lib\db\store\get::all_store_fuel_detail();
		if(!is_array($list))
		{
			$list = [];
		}

		foreach ($list as $key => $value)
		{
			\dash\engine\store::force_lock($value);

			call_user_func($_fn);

			\dash\db\mysql\tools\connection::close();

		}
	}


	public static function run_once($_fn)
	{
		if(self::is_busy())
		{
			return;
		}

		// if code exit need to remove busy file
		register_shutdown_function(['\\content_hook\\job\\business', 'set_free']);

		self::set_busy();

		self::run($_fn);

		self::set_free();

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
	public static function set_free()
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
		$addr .= __DIR__ .'/cronjob_business_once.me.conf';

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