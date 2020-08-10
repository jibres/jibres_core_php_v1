<?php
namespace lib\app\cache;

/**
 * file cache
 */
class file
{
	private static $data      = [];
	private static $life_time = 120;


	/**
	 * Clean data
	 */
	private static function clean()
	{
		self::$data = [];
	}


	/**
	 * Deletes chche file
	 */
	public static function delete()
	{
		\dash\file::delete(self::addr());
		self::clean();
	}


	/**
	 * The file location addr
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function addr()
	{
		$addr = \dash\engine\store::cache_addr();
		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}

		$addr .= \lib\store::id(). \dash\engine\store::$ext;
		return $addr;
	}


	/**
	 * Read cache file
	 */
	private static function load()
	{
		if(empty(self::$data))
		{
			$get = \dash\file::read(self::addr());
			if(is_string($get))
			{
				$get = json_decode($get, true);
			}

			if(is_array($get))
			{
				self::$data = $get;
			}

			// check time
			$delete = false;
			if(isset($get['update_time']))
			{
				if(time() - intval($get['update_time']) > self::$life_time)
				{
					$delete = true;
				}
			}
			else
			{
				$delete = true;
			}

			if($delete)
			{
				self::delete();
			}
		}
	}


	/**
	 * Gets the specified need in cache file
	 *
	 * @param      <type>  $_need  The need
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get($_need = null)
	{
		$data = self::load();
		if($_need)
		{
			if(array_key_exists($_need, self::$data))
			{
				return self::$data[$_need];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$data;
		}
	}


	/**
	 * Set detail in cache file
	 *
	 * @param      <type>  $_key    The key
	 * @param      <type>  $_value  The value
	 */
	public static function set($_key, $_value)
	{
		$data                = self::get();
		$data[$_key]         = $_value;
		$data['update_time'] = time();
		\dash\file::write(self::addr(), json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		self::clean();
	}

}
?>