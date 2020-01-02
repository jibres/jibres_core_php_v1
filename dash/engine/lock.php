<?php
namespace dash\engine;

/**
 * Lock service
 */
class lock
{
	/**
	 * Check service is lock or no
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function is()
	{
		if(is_file(self::lock_file_addr()))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	/**
	 * Set lock service
	 */
	public static function lock()
	{
		\dash\file::write(self::lock_file_addr(), date("Y-m-d H:i:s"));
	}


	/**
	 * Unset lock service
	 */
	public static function unlock()
	{
		\dash\file::delete(self::lock_file_addr());
	}


	/**
	 * Locks the file address.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function lock_file_addr()
	{
		$lock_file_addr = root. 'lock.me.service';
		return $lock_file_addr;
	}
}
?>