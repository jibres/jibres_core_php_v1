<?php
namespace dash\waf\dog;
/**
 * dash main configure
 */
class cookie
{
	public static function inspection()
	{
		$cookie = $_COOKIE;
		// only allow array
		\dash\waf\dog\toys\only::array($cookie);

		if(empty($cookie))
		{
			return;
		}

		// need check count of all cookie
		\dash\waf\dog\toys\general::array_count($cookie, 0, 100);

		foreach ($cookie as $key => $value)
		{
			// check key len
			\dash\waf\dog\toys\general::len($key, 1, 49);

			// check value len
			\dash\waf\dog\toys\general::len($value, 0, 220);

			// only can be text
			\dash\waf\dog\toys\only::something($key);
			\dash\waf\dog\toys\only::text($key);

			\dash\waf\dog\toys\only::text($value);

			// check blacklist words
			self::blacklist($key);
			self::blacklist($value);
		}
	}


	private static function blacklist($txt)
	{

		// disallow html tags
		\dash\waf\dog\toys\block::tags($txt);
		// disallow some words
		\dash\waf\dog\toys\block::word($txt, 'script');
		\dash\waf\dog\toys\block::word($txt, 'javascript');
		\dash\waf\dog\toys\block::word($txt, 'prompt');
		\dash\waf\dog\toys\block::word($txt, 'delete');
		\dash\waf\dog\toys\block::word($txt, 'xss');
		\dash\waf\dog\toys\block::word($txt, '{');
		\dash\waf\dog\toys\block::word($txt, '}');
		\dash\waf\dog\toys\block::word($txt, '(');
		\dash\waf\dog\toys\block::word($txt, ')');
		\dash\waf\dog\toys\block::word($txt, '<');
		\dash\waf\dog\toys\block::word($txt, '>');
		\dash\waf\dog\toys\block::word($txt, '*');
		\dash\waf\dog\toys\block::word($txt, '"');
		\dash\waf\dog\toys\block::word($txt, "'");
		\dash\waf\dog\toys\block::word($txt, "\n");
	}
}
?>
