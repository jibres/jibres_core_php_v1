<?php
namespace dash\engine;
/**
 * some check for baby to not allow to harm yourself
 * v1.2
 */
class baby
{
	private static $level;
	/**
	 * add function to full check url and all user parameters
	 * @return block baby if needed
	 */
	public static function block()
	{
		// if we dont have request url it was very mysterious, say Hi to hitler
		if(!isset($_SERVER['REQUEST_URI']))
		{
			\dash\log::set('hiFather!');
			\dash\header::status(412, 'Hi Father!');
		}

		// check origine
		self::origin();

		// check duble slash in url
		self::dbl_slash();

		// check request uri
		self::check($_SERVER['REQUEST_URI'], true);

		// check for requests
		foreach ($_REQUEST as $key => $value)
		{
			if(mb_strlen($key) > 20)
			{
				self::$level = 10;
				self::pacifier();
			}
			if(mb_strlen($value) > 2000)
			{
				self::$level = 11;
				self::pacifier();
			}
			// check key is not using invalid chars
			self::check($key, true);

			if(is_array($value))
			{
				foreach ($value as $key2 => $value2)
				{
					if(mb_strlen($key2) > 20)
					{
						self::$level = 12;
						self::pacifier();
					}
					if(mb_strlen($value2) > 200)
					{
						self::$level = 13;
						self::pacifier();
					}

					// check key2 is not using invalid chars
					self::check($key2, true);
					if(is_array($value2))
					{
						// now we are not allow to give object in array request
						self::$level = 20;
						self::pacifier();
					}
					else if(is_object($value2))
					{
						// now we are not allow to give object in array request
						self::$level = 11;
						self::pacifier();
					}
					else
					{
						// self::check($value2, true);
					}
				}
			}
			else if(is_object($value))
			{
				// now we are not allow to give object in request
				self::$level = 10;
				self::pacifier();
			}
			else
			{
				// self::check($value, true);
			}
		}
		// we can add some check on php://input and maybe another one!
	}


	private static function origin()
	{

		// @TODO
		// check customer domain origine

		if (isset($_SERVER['HTTP_ORIGIN']))
		{
	    	$origin = $_SERVER['HTTP_ORIGIN'];

	    	if(!\dash\url::jibreLocal())
	    	{
		    	if(substr($origin, 0, 8) !== 'https://')
		    	{
		    		self::$level = 25;
					self::pacifier();
		    	}
	    	}

	    	if($origin === \dash\url::base())
	    	{
	    		return;
	    	}

	    	$domain = \dash\url::domain();
	    	$myOrigin = str_replace($domain, '', $origin);
	    	$last_char = substr($myOrigin, -1);

	    	if($last_char === '/' || $last_char === '.')
	    	{
	    	    // header('Access-Control-Allow-Origin: *', true);
			    header('Access-Control-Allow-Origin: ' . $origin);

				// header('Access-Control-Allow-Headers: Accept,Authorization,Cache-Control,Content-Type,DNT,If-Modified-Since,Keep-Alive,Origin,User-Agent,X-Requested-With');
				header('Access-Control-Allow-Headers: Accept,Cache-Control,Content-Type,Keep-Alive,Origin,X-Requested-With');

				// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
				header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

	    	}
	    	else
	    	{
            	self::$level = 30;
				self::pacifier();
	    	}
    	}
	}


	private static function dbl_slash()
	{
		// @check
		// if find 2slash together block!
		if(strpos($_SERVER['REQUEST_URI'], '//') !== false)
		{
			// route url like this
			// http://dash.local/enter?referer=http://dash.local/cp
			if(strpos($_SERVER['REQUEST_URI'], '?') === false || strpos($_SERVER['REQUEST_URI'], '?') > strpos($_SERVER['REQUEST_URI'], '//'))
			{
				\dash\header::status(421, 'What are you doing!');
			}
		}
	}

	/**
	 * check duble slass in url
	 */
	private static function pacifier()
	{
		$msg = 'Hi Baby'. str_repeat('!', self::$level);
		if(\dash\request::json_accept() || \dash\request::ajax())
		{
			\dash\header::status(418, "Anomalous disturbance has occurred in the transmitted values. We are unable to respond to this request.". ' '. str_repeat('!', self::$level));
		}
		else
		{
			\dash\header::status(418, $msg);
		}
		self::$level = null;
	}


	/**
	 * check input text to have problem with hex or invalid chars
	 * @param  [type]  $_txt       [description]
	 * @param  boolean $_onlyCheck [description]
	 * @return [type]              [description]
	 */
	public static function check($_txt, $_block = false)
	{
		$result = null;
		// decode url
		$_txt = urldecode($_txt);
		// check for problem in hex
		if(self::hex($_txt))
		{
			$result = true;
		}
		// check for someone try inject script
		if(self::script($_txt))
		{
			$result = true;
		}
		// check for problem for containing forbidden chars
		else if(self::forbidden($_txt))
		{
			$result = true;
		}
		// if needed block
		if($result === true && $_block)
		{
			self::pacifier();
		}
		// return final result if not blocked!
		return $result;
	}


	/**
	 * check some problem on hexas input or someother things
	 * @param  [type] $_txt [description]
	 * @return [type]       [description]
	 */
	public static function hex($_txt)
	{
		if(preg_match("#0x#Ui", $_txt))
		{
			self::$level = 1;
			return true;
		}
		if(preg_match("#0x#", $_txt))
		{
			self::$level = 2;
			return true;
		}
		// if cant find something return false
		return false;
	}


	/**
	 * check some problem on hexas input or someother things
	 * @param  [type] $_txt [description]
	 * @return [type]       [description]
	 */
	public static function script($_txt)
	{
		if(preg_match("/<script>/", $_txt))
		{
			self::$level = 1;
			return true;
		}
		if(preg_match("/</script>/", $_txt))
		{
			self::$level = 2;
			return true;
		}
		if(preg_match("/<\s+script/", $_txt))
		{
			self::$level = 3;
			return true;
		}
		if(preg_match("/<(.*)script/", $_txt))
		{
			self::$level = 4;
			return true;
		}
		if(preg_match("/alert(.*)\(/", $_txt))
		{
			self::$level = 5;
			return true;
		}
		if(preg_match("/<(.*)>/", $_txt))
		{
			self::$level = 3;
			return true;
		}
		if(preg_match("/<(.*)\?/", $_txt))
		{
			self::$level = 2;
			return true;
		}
		if(preg_match("/</", $_txt))
		{
			self::$level = 1;
			return true;
		}
		if(preg_match("/eval(.*)\(/", $_txt))
		{
			self::$level = 0;
			return true;
		}
		if(preg_match("/sleep(.*)\((.*)\)/", $_txt))
		{
			self::$level = 2;
			return true;
		}
		if(preg_match("/extractvalue(.*)\(/", $_txt))
		{
			self::$level = 3;
			return true;
		}
		if(preg_match("/xmltype(.*)\(/", $_txt))
		{
			self::$level = 4;
			return true;
		}
		if(preg_match("/\/and(.*)=/", $_txt))
		{
			self::$level = 5;
			return true;
		}
		// if cant find something return false
		return false;
	}


	/**
	 * check for using forbiden char in txt
	 * @param  [type]  $_txt            [description]
	 * @param  [type]  $_forbiddenChars [description]
	 * @return boolean                  [description]
	 */
	public static function forbidden($_txt, $_forbiddenChars = null)
	{
		if(!$_forbiddenChars || !is_array($_forbiddenChars))
		{
			$_forbiddenChars = ['"', "`" , "'", '*', '\\'];
		}
		foreach ($_forbiddenChars as $name)
		{
			if (stripos($_txt, $name) !== FALSE)
			{
				self::$level = 3;
				return true;
			}
		}
	}

}
?>