<?php
namespace dash\db\mysql\tools;

trait connect
{

	// save link to database
	public static $link;
	public static $link_open    = [];
	public static $link_default = null;

	// declare connection variables
	public static $db_name      = null;
	public static $db_user      = null;
	public static $db_pass      = null;
	public static $db_host      = 'localhost';
	public static $db_charset   = 'utf8mb4'; //'utf8';
	public static $db_lang      = 'fa_IR';
	public static $debug_error  = false;
	private static $load_error  = [];

	public static function close($_link = null)
	{
		if($_link)
		{
			$link = [$_link];
		}
		else
		{
			$link = self::$link_open;
		}

		if(is_array($link))
		{
			foreach ($link as $key => $value)
			{
				if($value)
				{
					@mysqli_close($value);
				}
			}
		}

		self::$link         = null;
		self::$link_open    = [];
		self::$link_default = null;
	}


	/**
	 * connect to related database
	 * if not exist create it
	 * @return [type] [description]
	 */
	public static function connect($_db_name = null, $_autoCreate = null)
	{
		// check if db detail is not exist return false
		if(!defined('db_name') || !defined('db_user') || !defined('db_pass'))
		{
			return false;
		}

		if($_db_name === true || $_db_name === db_name)
		{
			// connect to default db
			self::$db_name = db_name;
		}
		else
		{
			// if at first request do not connected to default db
			// connect to save link of default db
			self::connect(true, false);
			// if want to connect to core tools
			if($_db_name === '[tools]')
			{
				// connect to core db
				// self::$db_name = core_name.'_tools';
				// fix it later
				self::$db_name = 'saloos_tools';
			}
			// else connect to specefic database
			elseif($_db_name)
			{
				// connect to db passed from user
				// else connect to last db saved
				self::$db_name = $_db_name;
			}
		}

		// fill variable if empty variable
		self::$db_name = self::$db_name ? self::$db_name : db_name;
		self::$db_user = self::$db_user ? self::$db_user : db_user;
		self::$db_pass = self::$db_pass ? self::$db_pass : db_pass;

		if(array_key_exists(self::$db_name, self::$link_open))
		{
			self::$link = self::$link_open[self::$db_name];
			return true;
		}

		// if mysqli class does not exist or have some problem show related error
		if(!class_exists('mysqli'))
		{
			\dash\header::status(503, T_("we can't find database service!"). " ". T_("Please contact administrator!"));
		}

		$link = @mysqli_connect(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

		// if we have error on connection to this database
		if(!$link)
		{
			switch (@mysqli_connect_errno())
			{
				// Access denied for user 'user'@'hostname' (using password: YES)
				case 1045:
					// to not make some error
					if(!isset(self::$load_error[1045]))
					{
						self::$load_error[1045] = true;
						\dash\notif::error(T_("We can't connect to database service!"). " ". T_("Please contact administrator!"));
					}
					// \dash\header::status(503, T_("We can't connect to database service!"). " ". T_("Please contact administrator!"));
					break;

				// ERROR 1049 (42000): Unknown database
				case 1049:
					// if allow to create then start create database
					if($_autoCreate)
					{
						// connect to mysql database for creating new one
						$link = @mysqli_connect(self::$db_host, self::$db_user, self::$db_pass, 'mysql');
						// if can connect to mysql database
						if($link)
						{
							$qry = "CREATE DATABASE IF NOT EXISTS `". self::$db_name. "` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;";

							// try to create database
							if(!@mysqli_query($link, $qry))
							{
								// if cant create db
								return false;
							}

							if(defined('db_log_name'))
							{
								$qry = "CREATE DATABASE IF NOT EXISTS `". db_log_name. "` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;";
								// try to create log database
								@mysqli_query($link, $qry);
							}

							// else if can create new database then reset link to dbname
							$link = @mysqli_connect(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
						}
						else
						{
							return false;
						}
					}
					elseif($_autoCreate === false)
					{
						return false;
					}
					// else only show related message
					else
					{
						// to not make some error
						if(!isset(self::$load_error['database']))
						{
							self::$load_error['database'] = true;
							\dash\notif::error(T_("We can't connect to correct database!"). " ". T_("Please contact administrator!"));
							// \dash\header::status(501, T_("We can't connect to correct database!"). " ". T_("Please contact administrator!"));
						}
					}
					break;

				default:
					// another errors occure
					// on development create connection error handling system
					break;
			}
		}

		// link is created and exist,
		// check if link is exist set it as global variable
		if($link)
		{

			// set charset for link
			@mysqli_set_charset($link, self::$db_charset);
			// save link as global variable
			self::$link = $link;
			self::$link_open[self::$db_name] = $link;
			if(self::$db_name === db_name)
			{
				self::$link_default = $link;
			}
			return true;
		}
		// if link is not created return false
		return false;
	}
}
?>
