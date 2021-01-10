<?php
namespace dash\app;

class apilog
{
	private static $apilog     = [];
	private static $static_var = [];
	private static $status     = false;

	private static $save_detail = true;

	public static function save_detail($_status)
	{
		self::$save_detail = $_status;
	}


	private static function jsonEncode($_array)
	{
		$result = json_encode($_array, JSON_UNESCAPED_UNICODE);
		return $result;
	}


	public static function stop()
	{
		self::$status = false;
	}


	public static function start()
	{
		self::$status = true;


		self::$apilog['user_id']        = null;
		self::$apilog['token']          = null; // 100
		self::$apilog['apikey']         = null; // 100
		self::$apilog['appkey']         = null; // 100
		self::$apilog['zoneid']         = null; // 100
		self::$apilog['url']            = addslashes(substr(\dash\url::pwd(), 0, 2000));
		self::$apilog['method']         = addslashes(substr(\dash\request::is(), 0, 200));
		self::$apilog['header']         = $headerjson = addslashes(self::jsonEncode(\dash\header::get()));
		self::$apilog['headerlen']      = mb_strlen($headerjson);
		self::$apilog['body']           = $body = addslashes(self::getBody());
		self::$apilog['bodylen']        = mb_strlen($body);
		self::$apilog['datesend']       = date("Y-m-d H:i:s");

		self::$apilog['pagestatus']     = null; // 100
		self::$apilog['resultstatus']   = null; // 100
		self::$apilog['responseheader'] = null;
		self::$apilog['responsebody']   = null;
		self::$apilog['dateresponse']   = null;

		self::$apilog['notif']          = null;
		self::$apilog['responselen']    = null;
		self::$apilog['version']        = addslashes(substr(\dash\url::module(), 0, 100));
		self::$apilog['subdomain']      = addslashes(\dash\url::subdomain());
		self::$apilog['urlmd5']         = md5(\dash\url::current());

	}


	public static function save($_result = null)
	{
		if(!self::$status)
		{
			return;
		}

		if((is_array($_result) || is_object($_result)))
		{
			$_result = self::jsonEncode($_result);
		}

		self::$apilog['user_id']        = \dash\user::id();
		self::$apilog['token']          = self::static_var('token'); // 100
		self::$apilog['apikey']         = self::static_var('apikey'); // 100
		self::$apilog['appkey']         = self::static_var('appkey'); // 100
		self::$apilog['zoneid']         = self::static_var('zoneid'); // 100
		self::$apilog['pagestatus']     = \http_response_code();  // 100
		self::$apilog['resultstatus']   = \dash\engine\process::status() ? 'true' : 'false'; // 100
		self::$apilog['responseheader'] = addslashes(self::jsonEncode(\headers_list()));
		self::$apilog['responsebody']   = self::$save_detail ? addslashes($_result) : null;
		self::$apilog['notif']          = addslashes(self::jsonEncode(\dash\notif::get()));
		self::$apilog['responselen']    = mb_strlen($_result);
		self::$apilog['dateresponse']   = date("Y-m-d H:i:s");

		self::save_db();
	}


	private static function getBody()
	{
		$request = \dash\request::request();
		$myBody  = null;

		if($request)
		{
			$myBody = $request;
		}
		else
		{
			$rawInput = \dash\request::php_input();
			if($rawInput)
			{
				$myBody = $rawInput;
			}
		}

		if($myBody)
		{
			if(is_string($myBody))
			{
				return $myBody;
			}
			else
			{
				return self::jsonEncode($myBody);
			}
		}
		else
		{
			return null;
		}
	}


	public static function static_var($_name, $_value = null)
	{
		if($_value !== null)
		{
			self::$static_var[$_name] = $_value;
			return;
		}

		if(array_key_exists($_name, self::$static_var))
		{
			return self::$static_var[$_name];
		}
		return null;
	}


	private static function save_db()
	{
		if(self::$apilog && self::$status)
		{
			\dash\db\apilog::insert(self::$apilog);
			self::$apilog = [];
		}
	}
}

?>