<?php
namespace dash\waf\gate\toys;
/**
 * dash main configure
 */
class block
{
	public static function word($_text, $_find)
	{
		$myTxt = $_text;
		if(strpos($myTxt, $_find) !== false)
		{
			\dash\waf\dog::BITE('Disallow l1 '. $_find, 428);
		}

		if($myTxt !== ($decode2 = urldecode($myTxt)))
		{
			if(strpos($decode2, $_find) !== false)
			{
				\dash\waf\dog::BITE('Disallow l2 '. $_find, 428);
			}

			if($decode2 !== ($decode3 = urldecode($decode2)))
			{
				if(strpos($decode3, $_find) !== false)
				{
					\dash\waf\dog::BITE('Disallow l3 '. $_find, 428);
				}

				if($decode3 !== ($decode4 = urldecode($decode3)))
				{
					if(strpos($decode4, $_find) !== false)
					{
						\dash\waf\dog::BITE('Disallow l4 '. $_find, 428);
					}

					if($decode4 !== urldecode($decode4))
					{
						\dash\waf\dog::BITE('Disallow dbl coding 1', 428);
					}
				}
			}
		}
	}


	public static function preg($_preg, $_text, $_msg)
	{
		$myTxt = $_text;

		if(preg_match($_preg, $_txt))
		{
			\dash\waf\dog::BITE($_msg, 428);
		}

		if($myTxt !== ($decode2 = urldecode($myTxt)))
		{
			if(preg_match($_preg, $decode2) !== false)
			{
				\dash\waf\dog::BITE($_msg, 428);
			}

			if($decode2 !== ($decode3 = urldecode($decode2)))
			{
				if(preg_match($_preg, $decode3) !== false)
				{
					\dash\waf\dog::BITE($_msg, 428);
				}

				if($decode3 !== ($decode4 = urldecode($decode3)))
				{
					if(preg_match($_preg, $decode4) !== false)
					{
						\dash\waf\dog::BITE($_msg, 428);
					}

					if($decode4 !== urldecode($decode4))
					{
						\dash\waf\dog::BITE('Disallow dbl coding 2', 428);
					}
				}
			}
		}
	}


	public static function tags($_text, $_from = null)
	{
		if($_from	=== 'Booster_resultXML')
		{
			// @TODO
			// need to fix
			// used on jibres booster
			return null;
		}

		$strippedText = strip_tags($_text);
		if($_text !== $strippedText)
		{
			$msg = 'ooh Tag! ';
			if($_from)
			{
				$msg = 'ooh Tag inside '. $_from;
			}
			\dash\waf\dog::BITE($msg, 428);
		}
	}


	public static function key_exists($_key, $_array)
	{
		if(array_key_exists($_key, $_array))
		{
			\dash\waf\dog::BITE('Disallow index!', 428);
		}
	}


	public static function non_printable_char($_txt)
	{
		self::preg('/[\x00-\x1F\x7F]/', $_txt, 'Disallow non-printing 1!');

		self::preg('/[\x00-\x1F\x7F]/u', $_txt, 'Disallow non-printing 2!');

		self::preg('/[\x00-\x1F\x7F\xA0]/u', $_txt, 'Disallow non-printing 3!');

		self::preg('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', $_txt, 'Disallow non-printing 4!');

		self::preg('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', $_txt, 'Disallow non-printing 5!');

		self::preg('/[\x00-\x1F\x7F-\xA0\xAD]/u', $_txt, 'Disallow non-printing 6!');

		self::preg('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', $_txt, 'Disallow non-printing 7!');

  		if(preg_match('/(?>[\x00-\x1F]|\xC2[\x80-\x9F]|\xE2[\x80-\x8F]{2}|\xE2\x80[\xA4-\xA8]|\xE2\x81[\x9F-\xAF])/', $_txt))
		{
			if(preg_match('/(\xE2[\x80-\x8F]{2})/', $_txt))
			{
				// the half space character
			}
			else
			{
				\dash\waf\dog::BITE('Disallow non-printing 8!', 428);
			}
		}

		$badchar =
		[
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

		if($_txt !== $newStr)
		{
			\dash\waf\dog::BITE('Disallow non-printing 9!', 428);
		}
	}


	public static function hex($_txt)
	{
		self::preg("#0x#Ui", $_txt, 'Disallow hex 1!');

		self::preg("#0x#", $_txt, 'Disallow hex 2!');

		self::preg("/%00/", $_txt, 'Disallow hex 3!');
	}


	public static function script($_txt, $_simple = false)
	{
		self::preg("/<script>/i", $_txt, 'Disallow script 1!');

		self::preg("/<\/script>/i", $_txt, 'Disallow script 2!');

		self::preg("/<\s+script/i", $_txt, 'Disallow script 3!');

		self::preg("/<(.*)script/i", $_txt, 'Disallow script 4!');

		self::preg("/alert(.*)\(/i", $_txt, 'Disallow script 5!');

		self::preg("/prompt(.*)\(/i", $_txt, 'Disallow script 6!');

		if(!$_simple)
		{
			self::preg("/<(.*)>/", $_txt, 'Disallow script 7!');

			self::preg("/<(.*)\?/", $_txt, 'Disallow script 8!');

			self::preg("/</", $_txt, 'Disallow script 9!');

			self::preg("/\/([^\/]*)(and|or)(\s|\()+(.*)=(.*)/i", $_txt, 'Disallow script 10!');

			self::preg("/\/([^\/]*)union(.*)(\(|\=|\))=(.*)/i", $_txt, 'Disallow script 11!');
		}

		self::preg("/eval(.*)\(/i", $_txt, 'Disallow script 12!');

		self::preg("/sleep(.*)\((.*)\)/i", $_txt, 'Disallow script 13!');

		self::preg("/extractvalue(.*)\(/i", $_txt, 'Disallow script 14!');

		self::preg("/fromCharCode/i", $_txt, 'Disallow script 15!');

		self::preg("/javascript:/i", $_txt, 'Disallow script 16!');

		self::preg("/http-equiv/i", $_txt, 'Disallow script 17!');

		self::preg("/xmltype(.*)\(/i", $_txt, 'Disallow script 18!');
	}
}
?>
