<?php
namespace dash\waf\gate;
/**
 * dash main configure
 */
class cookie
{
	public static function inspection()
	{
		$cookie = $_COOKIE;
		// only allow array
		\dash\waf\gate\toys\only::array($cookie);

		if(empty($cookie))
		{
			return;
		}

		// need check count of all cookie
		\dash\waf\gate\toys\general::array_count($cookie, 0, 100);

		foreach ($cookie as $key => $value)
		{
			// only can be text
			\dash\waf\gate\toys\only::something($key);
			\dash\waf\gate\toys\only::text($key);

			// check key len
			\dash\waf\gate\toys\general::len($key, 1, 200);

			// check value len
			\dash\waf\gate\toys\general::len($value, 0, 5000);


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
		\dash\waf\gate\toys\block::word($txt, 'script');
		\dash\waf\gate\toys\block::word($txt, 'javascript');
		\dash\waf\gate\toys\block::word($txt, 'prompt');
		\dash\waf\gate\toys\block::word($txt, 'delete');
		\dash\waf\gate\toys\block::word($txt, 'xss');
		\dash\waf\gate\toys\block::word($txt, '{');
		\dash\waf\gate\toys\block::word($txt, '}');
		\dash\waf\gate\toys\block::word($txt, '(');
		\dash\waf\gate\toys\block::word($txt, ')');
		\dash\waf\gate\toys\block::word($txt, '<');
		\dash\waf\gate\toys\block::word($txt, '>');
		\dash\waf\gate\toys\block::word($txt, '*');
		\dash\waf\gate\toys\block::word($txt, '"');
		\dash\waf\gate\toys\block::word($txt, "'");
		\dash\waf\gate\toys\block::word($txt, "\n");
	}
}
?>
