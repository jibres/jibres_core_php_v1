<?php
namespace dash\utility;


class busy
{

	/**
	 * Determines if busy.
	 *
	 * @return     boolean  True if busy, False otherwise.
	 */
	public static function is_busy(string $_key)
	{
		return self::busy($_key, null);
	}


	/**
	 * Sets the transfer is busy.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function set_busy(string $_key)
	{
		return self::busy($_key, true);
	}


	/**
	 * Sets the free.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function set_free(string $_key)
	{
		return self::busy($_key, false);
	}


	/**
	 * Manaage busy file
	 *
	 * @param      boolean  $_action  The action
	 *
	 * @return     <type>   ( description_of_the_return_value )
	 */
	private static function busy(string $_key, $_action = null)
	{
		// busy file addr
		$addr = YARD. 'jibres_temp/busy/busy_'. $_key. '.me.conf';

		// create folder
		if(!is_dir(dirname($addr)))
		{
			\dash\file::makeDir(dirname($addr), null, true);
		}

		if($_action === null)
		{
			// check is busye
			return is_file($addr);
		}

		if($_action === false)
		{
			// remove file and set free
			\dash\file::delete($addr);
		}

		if($_action === true)
		{
			// set free function on shutdown_function
			// when we have error in process exit automaticaly
			register_shutdown_function(['\\dash\\utility\\busy', 'set_free'], $_key);

			// write file
			\dash\file::write($addr, date("Y-m-d H:i:s"));
		}
	}

}
?>