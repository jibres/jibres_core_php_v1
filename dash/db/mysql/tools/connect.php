<?php
namespace dash\db\mysql\tools;

trait connect
{

	// save link to database
	public static $link;
	public static $link_open    = [];
	public static $link_default = null;

	// declare connection variables
	// this is the jibres customer database name
	// if this variable is set owerride to $db_name
	public static $store_db_name = null;
	public static $db_port        = 3306;
	public static $db_user        = null;
	public static $db_pass        = null;
	public static $db_host        = 'localhost';

	public static $db_name        = null;
	public static $db_charset     = 'utf8mb4'; //'utf8';
	public static $db_lang        = 'fa_IR';
	public static $debug_error    = false;
	private static $load_error    = [];

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


	private static function create_link($_love)
	{
		// check database is exist.
		if(!$_love)
		{
			\dash\header::status(500, T_("We dont have Love!"). T_("Please contact lovers!"));
			return false;
		}
		// if mysqli class does not exist or have some problem show related error
		if(!class_exists('mysqli'))
		{
			\dash\header::status(503, T_("We can't find database service!"));
		}

		$link = \mysqli_init();

		\mysqli_options($link, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
		\mysqli_options($link, MYSQLI_OPT_CONNECT_TIMEOUT, 10);
		// \mysqli_options($link, MYSQLI_OPT_READ_TIMEOUT, 30);


		if(!isset($_love['user']))
		{
			\dash\header::status(503, T_("Whats that name!"));
		}
		if(!isset($_love['pass']))
		{
			\dash\header::status(503, T_("Whats that code!"));
		}
		if(!isset($_love['host']))
		{
			\dash\header::status(503, T_("Where is that home!"));
		}
		if(!isset($_love['port']))
		{
			\dash\header::status(503, T_("Where is that door!"));
		}
		if(!isset($_love['database']))
		{
			\dash\header::status(503, T_("Where is that bed room!"));
		}

		if($_love['host'] === 'localhost')
		{
			$real_link = @mysqli_real_connect($link, $_love['host'], $_love['user'], $_love['pass'], $_love['database'], $_love['port']);
		}
		else
		{
			$real_link = @mysqli_real_connect($link, $_love['host'], $_love['user'], $_love['pass'], $_love['database'], $_love['port'], NULL, MYSQLI_CLIENT_SSL);
		}


		// if we have error on connection to this database
		switch (@mysqli_connect_errno())
		{
			// Access denied for user 'user'@'hostname' (using password: YES)
			case 1045:
				\dash\header::status(503, T_("We can't connect to database service!"));
				break;


			// ERROR 1049 (42000): Unknown database
			case 1049:
				\dash\header::status(503, T_("We can't connect to correct database!"));
				break;


			case 2002:
				// i dont know!
				\dash\header::status(503, T_("Hello!"). " 2002 ");
				break;


			// MySQL server has gone away
			case 2006:
				\dash\header::status(503, T_("Hello!"). " 2006 ");
				break;


			// Connections using insecure transport are prohibited while --require_secure_transport=ON.
			case 3159:
				\dash\header::status(503, T_("Hello!"). " 3159 ");
				break;

			default:
				// another errors occure
				// on development create connection error handling system
				return $link;
				break;
		}

		return false;
	}


	/**
	 * connect to related database
	 * if not exist create it
	 * @return [type] [description]
	 */
	public static function connect()
	{
		// if link exist before this, use it
		if(array_key_exists(self::$db_name, self::$link_open))
		{
			self::$link = self::$link_open[self::$db_name];
			return true;
		}

		// find my Love!
		$myLove = \dash\engine\detective::who();
		// create link
		$link = self::create_link($myLove);

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
