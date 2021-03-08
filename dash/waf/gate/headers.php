<?php
namespace dash\waf\gate;
/**
 * dash main configure
 */
class headers
{
	/**
	 * Save temp hader to use in other function in gate
	 * for example need to check header in phpinput function
	 *
	 * @var        <type>
	 */
	private static $temp_header = null;


	public static function inspection()
	{
		$headers = [];
		foreach($_SERVER as $key => $value)
		{
			if (substr($key, 0, 5) === 'HTTP_')
			{
				$mine = str_replace(' ', '-', str_replace('_', ' ', strtoupper(substr($key, 5))));
				$headers[$mine] = $value;
			}
		}
		// we check cookie before this
		unset($headers['COOKIE']);
		// we check agent before this
		unset($headers['USER-AGENT']);

		// check seperate

		$referer = null;
		if(isset($headers['REFERER']))
		{
			$referer = $headers['REFERER'];
		}

		unset($headers['REFERER']);


		// only allow array
		\dash\waf\gate\toys\only::array($headers);
		if(empty($headers))
		{
			return;
		}

		foreach ($headers as $key => $value)
		{
			// check key len
			\dash\waf\gate\toys\general::len($key, 1, 50);

			// check value len
			\dash\waf\gate\toys\general::len($value, 0, 1000);


			// only can be text
			\dash\waf\gate\toys\only::something($key);
			\dash\waf\gate\toys\only::text($key);

			\dash\waf\gate\toys\only::text($value);

			// check blacklist words
			self::blacklist($key);
			self::blacklist($value);
		}


		self::check_referer($referer);

		self::$temp_header = $headers;

	}


	/**
	 * Gets the header raw.
	 *
	 * @param      <type>  $_key   The key
	 */
	public static function get_header_raw($_key)
	{
		if(isset(self::$temp_header[$_key]))
		{
			return self::$temp_header[$_key];
		}

		return null;
	}


	private static function blacklist($txt)
	{
		// disallow html tags
		\dash\waf\gate\toys\block::tags($txt);
		// disallow some words

		\dash\waf\gate\toys\block::word($txt, "'");
		\dash\waf\gate\toys\block::word($txt, "`");
		\dash\waf\gate\toys\block::word($txt, "\n");
	}


	private static function check_referer($_referer)
	{
		$referer = $_referer;

		if(!is_string($referer))
		{
			$referer = null;
		}

		// set null if referer is long!
		if($referer && mb_strlen($referer) > 1000)
		{
			$referer = null;
		}

		// if tag in referer set null
		if($referer && $referer !== strip_tags($referer))
		{
			$referer = null;
		}

		if($referer && strpos($referer, "'") !== false)
		{
			$referer = null;
		}

		if($referer && strpos($referer, '"') !== false)
		{
			$referer = null;
		}

		if($referer && strpos($referer, "\n") !== false)
		{
			$referer = null;
		}

		if($referer && strpos($referer, "`") !== false)
		{
			$referer = null;
		}

		\dash\server::force_set_referer($referer);

	}
}
?>
