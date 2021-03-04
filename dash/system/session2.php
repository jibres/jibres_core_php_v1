<?php
namespace dash\system;

/**
 * Class for session v2.
 * save data in session and get it
 */
class session2
{
	private static $isStart = null;


	public static function set($_key, $_value)
	{
		if(self::startSession())
		{
			$_SESSION[$_key] = $_value;
			// close session
			self::closeSession();
			// return everything is okay
			return true;
		}

		return false;
	}



	public static function set_with_cat($_cat, $_key, $_value)
	{
		if(self::startSession())
		{
			$_SESSION[$_cat][$_key] = $_value;
			// close session
			self::closeSession();
			// return everything is okay
			return true;
		}

		return false;
	}


	public static function getLock($_key = null, $_cat = null)
	{
		self::startSession();
		$result = self::get($_key, $_cat);
		self::closeSession();
		return $result;
	}


	public static function get($_key = null, $_cat = null)
	{
		if(!self::$isStart)
		{
			if(self::startSession())
			{
				self::closeSession();
			}
		}

		if($_key)
		{
			if($_cat)
			{
				if(isset($_SESSION[$_cat][$_key]))
				{
					return $_SESSION[$_cat][$_key];
				}
				return null;
			}

			if(isset($_SESSION[$_key]))
			{
				return $_SESSION[$_key];
			}
			return null;
		}

		if(isset($_SESSION))
		{
			return $_SESSION;
		}

		return null;
	}


	public static function clean($_key)
	{
		self::startSession();
		unset($_SESSION[$_key]);
		self::closeSession();
	}


	public static function clean_child($_l1, $_key)
	{
		self::startSession();
		unset($_SESSION[$_l1][$_key]);
		self::closeSession();
	}


	public static function clean_sub_child($_l1, $_l2, $_key)
	{
		self::startSession();
		unset($_SESSION[$_l1][$_l2][$_key]);
		self::closeSession();
	}


	private static function setSessionParams()
	{
		// set session name
		$sessionName = 'jibres';
		if(\dash\url::subdomain())
		{
			$sessionName .= '-'. \dash\url::subdomain();
		}
		session_name($sessionName. '-waf');

		$cookie_secure   = true;
		if(\dash\url::isLocal() && \dash\url::protocol() === 'http')
		{
			$cookie_secure = false;
		}

		// set session cookie params
		session_set_cookie_params(
		[
			'lifetime' => 0,
			'path'     => '/',
			'domain'   => \dash\url::host(),
			'secure'   => $cookie_secure,
			'httponly' => true,
			'samesite' => 'Strict'
		]);

		self::$isStart = true;
	}


	/**
	 * Start session if not started
	 */
	public static function startSession()
	{
		$sessionStatus = session_status();
		if($sessionStatus === PHP_SESSION_DISABLED)
		{
			\dash\header::status(424, 'Need Start Something!');
		}
		if($sessionStatus === PHP_SESSION_ACTIVE)
		{
			// session is enable before this!
			// need to check who is open it and don't close
			self::closeSession();
		}
		if($sessionStatus === PHP_SESSION_NONE)
		{
			// normal condition
		}

		if(headers_sent($filename, $linenum))
		{
			// echo "Headers already sent in $filename on line $linenum";
		}
		else
		{
			if(!self::$isStart)
			{
				self::setSessionParams();
			}

			session_start();
			return true;
		}

		return false;
	}


	public static function closeSession()
	{
		return session_write_close();
	}


	/**
	 * Destroys the session
	 */
	public static function destroy()
	{
		// unset and destroy session then regenerate it
		session_unset();

		if(session_status() === PHP_SESSION_ACTIVE)
		{
			session_destroy();
			return true;
		}

		return null;
	}

}
?>