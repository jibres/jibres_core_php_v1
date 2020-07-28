<?php
namespace dash;
/**
 * Class for session.
 * save data in session and get it
 */
class session
{
	private static $key       = 'storage';
	private static $key_time  = 'storage_time';
	private static $key_limit = 'storage_time_limit';

	public static function clean_all()
	{
		if(!isset($_SESSION))
		{
			return false;
		}

		unset($_SESSION[self::$key]);
		unset($_SESSION[self::$key_time]);
		unset($_SESSION[self::$key_limit]);
	}

	public static function clean_cat($_cat)
	{
		if(!isset($_SESSION))
		{
			return false;
		}

		unset($_SESSION[self::$key][$_cat]);
		unset($_SESSION[self::$key_time][$_cat]);
		unset($_SESSION[self::$key_limit][$_cat]);
	}

	public static function clean($_key, $_cat = null)
	{
		if(!isset($_SESSION))
		{
			return false;
		}

		if($_cat)
		{
			unset($_SESSION[self::$key][$_cat][$_key]);
			unset($_SESSION[self::$key_time][$_cat][$_key]);
			unset($_SESSION[self::$key_limit][$_cat][$_key]);
		}
		else
		{
			unset($_SESSION[self::$key][$_key]);
			unset($_SESSION[self::$key_time][$_key]);
			unset($_SESSION[self::$key_limit][$_key]);
		}
	}

	/**
	 * save data in session
	 * by key and cat
	 *
	 * @param      <type>  $_key    The key
	 * @param      <type>  $_value  The value
	 * @param      <type>  $_cat    The cat
	 */
	public static function set($_key, $_value, $_cat = null, $_time = null)
	{
		if(!isset($_SESSION))
		{
			return false;
		}

		if($_cat)
		{
			$_SESSION[self::$key][$_cat][$_key] = $_value;

			if($_time && is_numeric($_time))
			{
				$_SESSION[self::$key_time][$_cat][$_key]  = time();
				$_SESSION[self::$key_limit][$_cat][$_key] = $_time;
			}
		}
		else
		{
			$_SESSION[self::$key][$_key] = $_value;
			if($_time && is_numeric($_time))
			{
				$_SESSION[self::$key_time][$_key]  = time();
				$_SESSION[self::$key_limit][$_key] = $_time;
			}
		}
	}


	/**
	 * get data from session
	 * by check key and cat
	 *
	 * @param      <type>  $_key   The key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get($_key = null, $_cat = null)
	{
		if($_key)
		{
			if($_cat)
			{
				if(isset($_SESSION[self::$key][$_cat][$_key]))
				{
					if(isset($_SESSION[self::$key_time][$_cat][$_key]) && isset($_SESSION[self::$key_limit][$_cat][$_key]))
					{
						if(time() - intval($_SESSION[self::$key_time][$_cat][$_key]) > intval($_SESSION[self::$key_limit][$_cat][$_key]))
						{
							self::clean($_key, $_cat);
							return null;
						}
					}

					return $_SESSION[self::$key][$_cat][$_key];
				}
				else
				{
					return null;
				}
			}
			else
			{
				if(isset($_SESSION[self::$key][$_key]))
				{
					if(isset($_SESSION[self::$key_time][$_key]) && isset($_SESSION[self::$key_limit][$_key]))
					{
						if(time() - intval($_SESSION[self::$key_time][$_key]) > intval($_SESSION[self::$key_limit][$_key]))
						{
							self::clean($_key);
							return null;
						}
					}

					return $_SESSION[self::$key][$_key];
				}
				else
				{
					return null;
				}
			}
		}
		else
		{
			if(!$_cat)
			{
				return $_SESSION[self::$key];
			}
			else
			{
				if(isset($_SESSION[self::$key][$_cat]))
				{
					return $_SESSION[self::$key][$_cat];
				}
				else
				{
					return null;
				}
			}
		}

		if(isset($_SESSION))
		{
			return $_SESSION;
		}
		else
		{
			return null;
		}
	}


	/**
	 * restart session with new session id
	 * @param  [type] $_session_id new session id
	 * @return [type]              [description]
	 */
	public static function restart($_session_id)
	{
		// if a session is currently opened, close it
		if (session_id() != '')
		{
			session_write_close();
		}
		// use new id
		session_id($_session_id);
		// start new session
		session_start();
	}
}
?>