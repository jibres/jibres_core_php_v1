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
			session_write_close();
			// return everything is okay
			return true;
		}

		return false;
	}


	public static function getLock($_key = null, $_cat = null)
	{
		self::startSession();
		$result = self::get($_key, $_cat);
		session_write_close();
		return $result;
	}


	public static function get($_key = null, $_cat = null)
	{
		if(!self::$isStart)
		{
			if(self::startSession())
			{
				session_write_close();
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


	private static function setSessionParams()
	{
		// set session name
		$sessionName = 'jibres';
		if(\dash\url::store())
		{
			$sessionName .= '-'. \dash\url::store();
		}
		session_name($sessionName);

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
	private static function startSession()
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
			session_write_close();
		}
		if($sessionStatus === PHP_SESSION_NONE)
		{
			// normal condition
		}

		if(!headers_sent())
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