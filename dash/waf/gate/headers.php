<?php
namespace dash\waf\gate;
/**
 * dash main configure
 */
class headers
{
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

		\dash\waf\gate\toys\general::array_count($headers, 0, 100);

		foreach ($headers as $key => $value)
		{
			\dash\waf\gate\toys\only::text($key);

			// check key len
			\dash\waf\gate\toys\general::len($key, 1, 50);


			\dash\waf\gate\toys\only::text($value);

			// check value len
			\dash\waf\gate\toys\general::len($value, 0, 1000);


			// only can be text
			\dash\waf\gate\toys\only::something($key);

			\dash\waf\gate\toys\only::string($key);


			// check blacklist words
			self::blacklist($key);
			self::blacklist($value);
		}


		self::check_referer($referer);

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
