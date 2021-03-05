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
}
?>
