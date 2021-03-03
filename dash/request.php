<?php
namespace dash;

class request
{
	private static $POST              = [];
	private static $REQUEST           = [];
	private static $GET               = [];
	private static $FILES             = [];
	private static $PHP_INPUT         = [];
	private static $PHP_INPUT_CHECKED = false;

	/**
	 * filter post and safe it
	 * @param  [type] $_name [description]
	 * @param  [type] $_type [description]
	 * @param  [type] $_arg  [description]
	 * @return [type]        [description]
	 */
	public static function post($_name = null)
	{
		if(!self::$POST)
		{
			self::$POST = \dash\safe::safe($_POST, 'sqlinjection');
		}

		if(isset($_name))
		{
			if(array_key_exists($_name, self::$POST))
			{
				return self::$POST[$_name];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$POST;
		}
	}


	/**
	 * Get the html posted
	 * Everywhere need to save html use this function
	 */
	public static function post_html()
	{
		$html = null;

		if(isset($_POST['html']))
		{
			$html = $_POST['html'];
		}

		return $html;
	}


	/**
	 * Return Raw post input
	 * not safe for html editor
	 * this record was safe in app level
	 *
	 * @param      <type>  $_name  The name
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function post_raw($_name = null)
	{
		if(isset($_name))
		{
			if(array_key_exists($_name, $_POST))
			{
				return $_POST[$_name];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $_POST;
		}
	}


	/**
	 * Get request raw
	 * Use in bank api gateway
	 *
	 * @param      <type>  $_name  The name
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function request($_name = null)
	{
		if(!self::$REQUEST)
		{
			self::$REQUEST = \dash\safe::safe($_REQUEST, 'sqlinjection');
		}

		if(isset($_name))
		{
			if(array_key_exists($_name, self::$REQUEST))
			{
				return self::$REQUEST[$_name];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$REQUEST;
		}
	}

	/**
	 * filter get and safe it
	 * @param  [type] $_name [description]
	 * @param  [type] $_arg  [description]
	 * @return [type]        [description]
	 */
	public static function get($_name = null)
	{
		if(!self::$GET)
		{
			self::$GET = \dash\safe::safe($_GET, 'get_url-nottrim');
			// 26 input in search factors
			if(count(self::$GET) > 30)
			{
				self::$GET = array_slice(self::$GET, 0, 30);
			}
		}

		if(isset($_name))
		{
			if(array_key_exists($_name, self::$GET))
			{
				return self::$GET[$_name];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$GET;
		}
	}


	/**
	 * Determines if key exists in php input
	 *
	 * @param      <type>  $_key    The key
	 * @param      string  $_where  The where
	 *
	 * @return     <type>  True if key exists, False otherwise.
	 */
	public static function key_exists($_key, $_where = 'get')
	{
		switch ($_where)
		{
			case 'get':
			case 'GET':
				return array_key_exists($_key, $_GET);
				break;

			case 'post':
			case 'POST':
				return array_key_exists($_key, $_POST);
				break;

			case 'request':
			case 'REQUEST':
				return array_key_exists($_key, $_REQUEST);
				break;

			case 'files':
			case 'FILES':
				return array_key_exists($_key, $_FILES);
				break;

			default:
				return null;
				break;
		}
	}


	public static function full_get($_args = null)
	{
		return self::fix_get($_args, true);
	}

	public static function fix_get($_args = [], $_full = false)
	{
		$get = self::get();
		if(!is_array($_args))
		{
			$_args = [];
		}

		// remove pagination
		unset($get['page']);

		$get = array_merge($get, $_args);

		$query = self::build_query($get);
		if($_full)
		{
			$query = '?'. $query;
		}

		return $query;
	}


	public static function build_query($_args)
	{
		return http_build_query($_args, null, '&', PHP_QUERY_RFC3986);
	}


	/**
	 * get files
	 *
	 * @param      <type>  $_name  The name
	 */
	public static function files($_name = null, $_key = null)
	{
		if(!self::$FILES)
		{
			self::$FILES = $_FILES;
		}

		if($_name)
		{
			if(isset(self::$FILES[$_name]) && (isset(self::$FILES[$_name]['error']) && self::$FILES[$_name]['error'] != 4))
			{
				if($_key)
				{
					if(isset(self::$FILES[$_name][$_key]))
					{
						return self::$FILES[$_name][$_key];
					}
					else
					{
						return null;
					}
				}
				else
				{
					return self::$FILES[$_name];
				}

			}
			else
			{
				return null;
			}
		}
		return self::$FILES;
	}



	public static function input_body($_name = null)
	{
		if(!self::$PHP_INPUT_CHECKED)
		{
			self::$PHP_INPUT_CHECKED = true;

			if(\dash\request::post())
			{
				\dash\notif::warn(T_("Send your request as json not in post field"));
			}

			$request = \dash\request::php_input();

			if(is_string($request))
			{
				$request = json_decode($request, true);
			}

			if(!is_array($request))
			{
				$request = [];
			}

			$request = \dash\safe::safe($request, 'sqlinjection-raw');

			self::$PHP_INPUT = $request;
		}

		if(isset($_name))
		{
			if(array_key_exists($_name, self::$PHP_INPUT))
			{
				return self::$PHP_INPUT[$_name];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$PHP_INPUT;
		}
	}


	public static function isset_input_body($_name)
	{
		self::input_body();

		if(array_key_exists($_name, self::$PHP_INPUT))
		{
			return true;
		}
		return false;
	}


	/**
	 * Get php input for api
	 * check value by baby check
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function php_input()
	{
		$input = @file_get_contents('php://input');

		if(\dash\engine\waf\baby::check_simple($input))
		{
			\dash\engine\waf\baby::pacifier(null, 424);
		}

		return $input;
	}


	/**
	 * check request method
	 * POST
	 * GET
	 * ...
	 *
	 * @param      <type>   $_name  The name
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function is($_name = null)
	{
		$request_method = \dash\server::get('REQUEST_METHOD');

		if($_name)
		{
			if(mb_strtolower($_name) === mb_strtolower($request_method))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return mb_strtolower($request_method);
		}
	}


	/**
	 * @return check request is ajax or not
	 */
	public static function ajax()
	{
		if(mb_strtolower(\dash\server::get('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest')
		{
			return true;
		}

		return false;
	}


	/**
	 * @param  name of accept value to check
	 * @return check accept this type or not in this request
	 */
	public static function accept($name)
	{
		if(\dash\server::get('HTTP_ACCEPT'))
		{
			return (strpos(\dash\server::get('HTTP_ACCEPT'), $name) !== false);
		}

		return null;
	}


	/**
	 * @return check json acceptable or not
	 */
	public static function json_accept()
	{
		$result = self::accept("application/json");
		if($result)
		{
			return true;
		}
		elseif(preg_match("/application\/json/i", \dash\server::get('Content-Type')))
		{
			return true;
		}

		return false;
	}


	public static function is_unload()
	{
		if(isset($_REQUEST['cmd']) && $_REQUEST['cmd'] === 'unload')
		{
			return true;
		}
		return false;
	}


	/**
	 * Determines if pwa.
	 *
	 * @return     boolean  True if pwa, False otherwise.
	 */
	public static function is_pwa()
	{
		return \dash\detect\device::detectPWA();
	}


	public static function is_app($_app_model = null)
	{
		$x_app_request = \dash\header::get('x-app-request');

		if($_app_model)
		{
			if($x_app_request === $_app_model)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			if(in_array($x_app_request, ['android', 'ios']))
			{
				return $x_app_request;
			}
		}

		return false;
	}


	public static function is_android()
	{
		return self::is_app('android');
	}


	public static function is_ios()
	{
		return self::is_app('ios');
	}


	public static function country()
	{
		if(\dash\server::get('HTTP_CF_IPCOUNTRY'))
		{
			return mb_strtoupper(\dash\server::get('HTTP_CF_IPCOUNTRY'));
		}
		elseif(\dash\server::get('HTTP_AR_REAL_COUNTRY'))
		{
			return mb_strtoupper(\dash\server::get('HTTP_AR_REAL_COUNTRY'));
		}
		else
		{
			return null;
		}
	}
}
?>
