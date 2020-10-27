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


	/**
	 * start session
	 */
	public static function start()
	{
		// in api content needless to start session
		// check apikey and start session by function \dash\session::restart()
		if(\dash\engine\content::api_content())
		{
			return;
		}

		if(is_string(\dash\url::root()))
		{
			session_name(\dash\url::root());
		}

		$cookie_secure   = true;
		$cookie_samesite = 'Strict';
		if(\dash\url::isLocal() && \dash\url::protocol() === 'http')
		{
			$cookie_secure = false;
		}

		// set session cookie params
		if(PHP_VERSION_ID < 70300)
		{
			// session_set_cookie_params(0, '/', '.'.\dash\url::domain(), $cookie_secure, true);
			session_set_cookie_params(0, '/; samesite='.$cookie_samesite, '.'.\dash\url::domain(), $cookie_secure, true);
		}
		else
		{
			session_set_cookie_params(
			[
				'lifetime' => 0,
				'path'     => '/',
				'domain'   => '.'.\dash\url::domain(),
				'secure'   => $cookie_secure,
				'httponly' => true,
				'samesite' => $cookie_samesite
			]);
		}

		// not start session
		// start if need in get and set session
	}


	/**
	 * Start session if not started
	 */
	public static function sessionStart()
	{
		if(session_status() !== PHP_SESSION_ACTIVE)
		{
			session_start();
		}
	}


	/**
	 * Close session and return result
	 *
	 * @param      <type>  $_data  The data
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function close($_data = null)
	{
		session_write_close();
		return $_data;
	}



	/**
	 * Destroys the session
	 */
	public static function destroy()
	{
		$_SESSION = [];

		// unset and destroy session then regenerate it
		session_unset();

		if(session_status() === PHP_SESSION_ACTIVE)
		{
			session_destroy();
		}
	}



	/**
	 * Clean all session detail
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function clean_all()
	{
		self::sessionStart();

		unset($_SESSION[self::$key]);
		unset($_SESSION[self::$key_time]);
		unset($_SESSION[self::$key_limit]);

		self::close();
	}


	/**
	 * Clean one category in sessio
	 *
	 * @param      <type>  $_cat   The cat
	 */
	public static function clean_cat($_cat)
	{
		self::sessionStart();

		unset($_SESSION[self::$key][$_cat]);
		unset($_SESSION[self::$key_time][$_cat]);
		unset($_SESSION[self::$key_limit][$_cat]);

		self::close();
	}



	/**
	 * Clean one index in session
	 *
	 * @param      <type>   $_key   The key
	 * @param      <type>   $_cat   The cat
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function clean($_key, $_cat = null)
	{
		self::sessionStart();

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

		self::close();
	}


	/**
	 * Gets All data exist in category
	 *
	 * @param      <type>   $_cat   The cat
	 *
	 * @return     boolean  The cat.
	 */
	public static function get_cat($_cat)
	{
		self::sessionStart();

		if(isset($_SESSION[self::$key][$_cat]))
		{
			return self::close($_SESSION[self::$key][$_cat]);
		}

		return self::close(null);
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
		self::sessionStart();

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

		self::close();
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
		self::sessionStart();

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
							return self::close(null);
						}
					}

					return self::close($_SESSION[self::$key][$_cat][$_key]);
				}
				else
				{
					return self::close(null);
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
							return self::close(null);
						}
					}

					return self::close($_SESSION[self::$key][$_key]);
				}
				else
				{
					return self::close(null);
				}
			}
		}
		else
		{
			if(!$_cat)
			{
				return self::close($_SESSION[self::$key]);
			}
			else
			{
				if(isset($_SESSION[self::$key][$_cat]))
				{
					return self::close($_SESSION[self::$key][$_cat]);
				}
				else
				{
					return self::close(null);
				}
			}
		}

		if(isset($_SESSION))
		{
			return self::close($_SESSION);
		}
		else
		{
			return self::close(null);
		}
	}


	/**
	 * restart session with new session id
	 * @param  [type] $_session_id new session id
	 * @return [type]              [description]
	 */
	public static function restart($_session_id, $_close = true)
	{
		// if a session is currently opened, close it
		if (session_id() != '')
		{
			self::close();
		}
		// use new id
		session_id($_session_id);
		// start new session
		// self::sessionStart();
		session_start();

		if($_close)
		{
			self::close();
		}
	}
}
?>