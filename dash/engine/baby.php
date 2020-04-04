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

		// check duble slash in url
		self::dbl_slash();
		// check request uri
		self::check($_SERVER['REQUEST_URI'], true);

		// check for requests
		foreach ($_REQUEST as $key => $value)
		{
			if(mb_strlen($key) > 40)
			{
				self::pacifier(10, 414);
			}
			if(mb_strlen($value) > 2000)
			{
				self::pacifier(11, 414);
			}
			// check key is not using invalid chars
			self::check($key, true);

			if(is_array($value))
			{
				foreach ($value as $key2 => $value2)
				{
					if(mb_strlen($key2) > 40)
					{
						self::pacifier(12, 414);
					}
					if(mb_strlen($value2) > 200)
					{
						self::pacifier(13, 414);
					}

					// check key2 is not using invalid chars
					self::check($key2, true);
					if(is_array($value2))
					{
						// now we are not allow to give object in array request
						self::pacifier(20, 415);
					}
					else if(is_object($value2))
					{
						// now we are not allow to give object in array request
						self::pacifier(11, 415);
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
				self::pacifier(10, 415);
			}
			else
			{
				// self::check($value, true);
			}
		}
		// we can add some check on php://input and maybe another one!
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
				self::pacifier(18, 421);
			}
		}
	}

	/**
	 * check duble slass in url
	 */
	public static function pacifier($_level = null, $_status_code = 418)
	{
		if($_level === null)
		{
			$_level = self::$level;
		}

		$msg = 'Hi Baby ('. $_level. ')';
		if(\dash\request::json_accept() || \dash\request::ajax())
		{
			\dash\header::status($_status_code, "Anomalous disturbance has occurred in the transmitted values. We are unable to respond to this request.". ' '. str_repeat('!', $_level));
		}
		else
		{
			\dash\header::status($_status_code, $msg);
		}

	}


	/**
	 * check input text to have problem with hex or invalid chars
	 * @param  [type]  $_txt       [description]
	 * @param  boolean $_onlyCheck [description]
	 * @return [type]              [description]
	 */
	public static function check($_txt, $_block = false, $_block_char = null)
	{
		$result = null;
		$status_code = 418;
		// decode url
		$_txt = urldecode($_txt);

		if(self::blockNonPrintableChar($_txt))
		{
			$status_code = 431;
			$result = true;
			self::pacifier(null, $status_code);
		}
		// check for problem in hex
		if(self::hex($_txt))
		{
			$result = true;
		}
		// check for someone try inject script
		if(self::script($_txt))
		{
			$status_code = 451;
			$result = true;
		}
		// check for problem for containing forbidden chars
		else if(self::forbidden($_txt, $_block_char))
		{
			$result = true;
		}
		// if needed block
		if($result === true && $_block)
		{
			self::pacifier(null, $status_code);
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
		if(preg_match("/%00/", $_txt))
		{
			self::$level = 3;
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
		if(preg_match("/<script>/i", $_txt))
		{
			self::$level = 1;
			return true;
		}
		if(preg_match("/<\/script>/i", $_txt))
		{
			self::$level = 2;
			return true;
		}
		if(preg_match("/<\s+script/i", $_txt))
		{
			self::$level = 3;
			return true;
		}
		if(preg_match("/<(.*)script/i", $_txt))
		{
			self::$level = 4;
			return true;
		}
		if(preg_match("/alert(.*)\(/i", $_txt))
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
		if(preg_match("/eval(.*)\(/i", $_txt))
		{
			self::$level = 0;
			return true;
		}
		if(preg_match("/sleep(.*)\((.*)\)/i", $_txt))
		{
			self::$level = 2;
			return true;
		}
		if(preg_match("/extractvalue(.*)\(/i", $_txt))
		{
			self::$level = 3;
			return true;
		}
		if(preg_match("/fromCharCode/i", $_txt))
		{
			self::$level = 4;
			return true;
		}
		if(preg_match("/xmltype(.*)\(/i", $_txt))
		{
			self::$level = 4;
			return true;
		}
		if(preg_match("/\/([^\/]*)(and|or)(\s|\()+(.*)=(.*)/i", $_txt))
		{
			self::$level = 6;
			return true;
		}
		if(preg_match("/\/([^\/]*)union(.*)(\(|\=|\))=(.*)/i", $_txt))
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


	private static function blockNonPrintableChar($_txt)
	{
		if(preg_match('/[\x00-\x1F\x7F-\xFF]/', $_txt))
		{
			self::$level = 11;
			return true;
		}
		if(preg_match('/[\x00-\x1F\x7F]/', $_txt))
		{
			self::$level = 12;
			return true;
		}
		if(preg_match('/[\x00-\x1F\x7F]/u', $_txt))
		{
			self::$level = 13;
			return true;
		}
		if(preg_match('/[\x00-\x1F\x7F\xA0]/u', $_txt))
		{
			self::$level = 14;
			return true;
		}
		if(preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', $_txt))
		{
			self::$level = 15;
			return true;
		}
		if(preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', $_txt))
		{
			self::$level = 16;
			return true;
		}
		if(preg_match('/[\x00-\x1F\x7F-\xA0\xAD]/u', $_txt))
		{
			self::$level = 17;
			return true;
		}
		if(preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', $_txt))
		{
			self::$level = 18;
			return true;
		}
  		if(preg_match('/(?>[\x00-\x1F]|\xC2[\x80-\x9F]|\xE2[\x80-\x8F]{2}|\xE2\x80[\xA4-\xA8]|\xE2\x81[\x9F-\xAF])/', $_txt))
		{
			self::$level = 20;
			return true;
		}
		$badchar = [
			// control characters
			chr(0), chr(1), chr(2), chr(3), chr(4), chr(5), chr(6), chr(7), chr(8), chr(9), chr(10),
			chr(11), chr(12), chr(13), chr(14), chr(15), chr(16), chr(17), chr(18), chr(19), chr(20),
			chr(21), chr(22), chr(23), chr(24), chr(25), chr(26), chr(27), chr(28), chr(29), chr(30),
			chr(31),
			// non-printing characters
			chr(127)
		];

		//replace the unwanted chars
		$newStr = str_replace($badchar, '', $_txt);
		// exit();
		if($_txt !== $newStr)
		{
			self::$level = 21;
			return true;
		}

		return false;
	}
}
?>