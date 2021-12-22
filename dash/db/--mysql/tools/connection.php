<?php
// namespace dash\db\mysql\tools;

// class connection
// {

// 	// save link to database
// 	private static $link;
// 	private static $link_open           = [];
// 	private static $lastDbName          = null;
// 	private static $lastFuelDetail      = null;
// 	private static $db_connection_error = false;


// 	public static function link()
// 	{
// 		return self::$link;
// 	}


// 	public static function link_open()
// 	{
// 		return self::$link_open;
// 	}


// 	public static function get_last_db_name()
// 	{
// 		return self::$lastDbName;
// 	}



// 	public static function get_last_fuel_detail()
// 	{
// 		if(self::$lastFuelDetail)
// 		{
// 			unset(self::$lastFuelDetail['pass']);
// 		}

// 		return json_encode(self::$lastFuelDetail);
// 	}


// 	public static function db_connection_error()
// 	{
// 		return self::$db_connection_error;
// 	}


// 	public static function close($_link = null)
// 	{
// 		if($_link)
// 		{
// 			$link = [$_link];
// 		}
// 		else
// 		{
// 			$link = self::$link_open;
// 		}

// 		self::$link         = null;
// 		self::$link_open    = [];

// 		if(is_array($link))
// 		{
// 			foreach ($link as $key => $value)
// 			{
// 				if($value)
// 				{
// 					@mysqli_close($value);
// 				}
// 			}
// 		}

// 	}


// 	private static function create_link($_love, $_option = null)
// 	{
// 		// check database is exist.
// 		if(!$_love)
// 		{
// 			return self::make_error(500, T_("We dont have Love!"). T_("Please contact lovers!"), $_option);
// 		}
// 		// if mysqli class does not exist or have some problem show related error
// 		if(!class_exists('mysqli'))
// 		{
// 			return self::make_error(503, T_("We can't find database service!"), $_option);
// 		}

// 		$link = \mysqli_init();

// 		\mysqli_options($link, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
// 		\mysqli_options($link, MYSQLI_OPT_CONNECT_TIMEOUT, 10);
// 		// \mysqli_options($link, MYSQLI_OPT_READ_TIMEOUT, 30);

// 		// set charset on connection option
// 		// TODO @reza check below line
// 		\mysqli_options($link, MYSQLI_SET_CHARSET_NAME, 'utf8mb4');


// 		if(!isset($_love['user']))
// 		{
// 			return self::make_error(503, T_("Whats that name!"), $_option);
// 		}
// 		if(!isset($_love['pass']))
// 		{
// 			return self::make_error(503, T_("Whats that code!"), $_option);
// 		}
// 		if(!isset($_love['host']))
// 		{
// 			return self::make_error(503, T_("Where is that home!"), $_option);
// 		}
// 		if(!isset($_love['port']))
// 		{
// 			return self::make_error(503, T_("Where is that door!"), $_option);
// 		}
// 		if(!isset($_love['database']))
// 		{
// 			return self::make_error(503, T_("Where is that bed room!"), $_option);
// 		}

// 		if($_love['host'] === 'localhost')
// 		{
// 			$real_link = @mysqli_real_connect($link, $_love['host'], $_love['user'], $_love['pass'], $_love['database'], $_love['port']);

// 			if(!$real_link)
// 			{
// 				return self::make_error(503, T_("Error in connecting to database!"), $_option);;
// 			}
// 		}
// 		else
// 		{
// 			$real_link = @mysqli_real_connect($link, $_love['host'], $_love['user'], $_love['pass'], $_love['database'], $_love['port'], NULL, MYSQLI_CLIENT_SSL);

// 			if(!$real_link)
// 			{
// 				return self::make_error(503, T_("Error in connecting to database!"), $_option);;
// 			}
// 		}


// 		// if we have error on connection to this database
// 		switch (@mysqli_connect_errno())
// 		{
// 			// Access denied for user 'user'@'hostname' (using password: YES)
// 			case 1045:
// 				return self::make_error(503, T_("We can't connect to database service!"), $_option);
// 				break;


// 			// ERROR 1049 (42000): Unknown database
// 			case 1049:
// 				if(\dash\url::store())
// 				{
// 					return self::make_error(503, T_("Unable to connect to this store at this time").  " 1049 ", $_option);
// 				}
// 				else
// 				{
// 					if(function_exists('T_'))
// 					{
// 						return self::make_error(503, T_("Please contact administrator!"). " 1049 ", $_option);
// 					}
// 					else
// 					{
// 						return self::make_error(503, "Please contact administrator!". " 1049 ", $_option);
// 					}
// 				}
// 				break;


// 			case 2002:
// 				// i dont know!
// 				return self::make_error(503, T_("Hello!"). " 2002 ", $_option);
// 				break;


// 			// MySQL server has gone away
// 			case 2006:
// 				return self::make_error(503, T_("Hello!"). " 2006 ", $_option);
// 				break;


// 			// Connections using insecure transport are prohibited while --require_secure_transport=ON.
// 			case 3159:
// 				return self::make_error(503, T_("Hello!"). " 3159 ", $_option);
// 				break;

// 			default:
// 				// another errors occure
// 				// on development create connection error handling system
// 				return $link;
// 				break;
// 		}

// 		return false;
// 	}


// 	private static function make_error($_header, $_msg, $_option = null)
// 	{
// 		self::$db_connection_error = true;

// 		// ignore error
// 		if(isset($_option['ignore_error']) && $_option['ignore_error'])
// 		{
// 			return false;
// 		}

// 		\dash\notif::error_once($_msg);
// 		// \dash\header::status($_header, $_msg);
// 		return false;
// 	}


// 	/**
// 	 * connect to related database
// 	 * if not exist create it
// 	 * @return [type] [description]
// 	 */
// 	public static function connect($_db_fuel = null)
// 	{
// 		// find my Love!
// 		$myLove = \dash\engine\fuel::who($_db_fuel);

// 		$myDbName = null;
// 		if(isset($myLove['database']))
// 		{
// 			$myDbName = $myLove['database'];
// 		}

// 		self::$lastDbName = $myDbName;

// 		self::$lastFuelDetail = $myLove;

// 		// if link exist before this, use it
// 		if(isset($myLove['code']))
// 		{
// 			$LinkKey = $myLove['code']. '_'. $myDbName;
// 			if(array_key_exists($LinkKey, self::$link_open))
// 			{
// 				if(self::$link_open[$LinkKey])
// 				{
// 					self::$link = self::$link_open[$LinkKey];
// 					return true;
// 				}
// 				else
// 				{
// 					self::$link = null;
// 					return false;
// 				}
// 			}
// 			else
// 			{
// 				self::$link = null;
// 			}
// 		}
// 		else
// 		{
// 			return self::make_error(503, "DB !0123");
// 		}

// 		// create link
// 		$link = self::create_link($myLove, $_db_fuel);

// 		// link is created and exist,
// 		// check if link is exist set it as global variable
// 		if($link)
// 		{
// 			// set charset for link
// 			// @mysqli_set_charset($link, 'utf8mb4');
// 			// $link->set_charset("utf8mb4");

// 			// save link as global variable
// 			self::$link                = $link;
// 			self::$link_open[$LinkKey] = $link;
// 			return true;
// 		}
// 		else
// 		{
// 			self::$link_open[$LinkKey] = false;
// 		}
// 		// if link is not created return false
// 		return false;
// 	}
}
?>