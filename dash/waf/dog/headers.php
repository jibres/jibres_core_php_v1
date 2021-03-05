<?php
namespace dash\waf\dog;
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
		\dash\waf\dog\toys\only::array($headers);

		if(empty($headers))
		{
			return;
		}

		foreach ($headers as $key => $value)
		{
			// check key len
			\dash\waf\dog\toys\general::len($key, 1, 50);

			// check value len
			\dash\waf\dog\toys\general::len($value, 0, 500);


			// check blacklist words
			self::blacklist($key);
			self::blacklist($value);
		}
	}


	private static function blacklist($txt)
	{
		// only can be text
		\dash\waf\dog\toys\only::something($txt);
		\dash\waf\dog\toys\only::text($txt);

		// disallow html tags
		\dash\waf\dog\toys\block::tags($txt);
		// disallow some words

		\dash\waf\dog\toys\block::word($txt, "'");
		\dash\waf\dog\toys\block::word($txt, "`");
		\dash\waf\dog\toys\block::word($txt, "\n");
	}
}
?>
