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

			// disallow html tags
			\dash\waf\gate\toys\block::tags($key);
			// disallow some words
			\dash\waf\gate\toys\block::word($key, 'script');
			\dash\waf\gate\toys\block::word($key, 'javascript');
			\dash\waf\gate\toys\block::word($key, 'prompt');
			\dash\waf\gate\toys\block::word($key, 'delete');
			\dash\waf\gate\toys\block::word($key, 'xss');
			\dash\waf\gate\toys\block::word($key, '{');
			\dash\waf\gate\toys\block::word($key, '}');
			\dash\waf\gate\toys\block::word($key, '(');
			\dash\waf\gate\toys\block::word($key, ')');
			\dash\waf\gate\toys\block::word($key, '<');
			\dash\waf\gate\toys\block::word($key, '>');
			\dash\waf\gate\toys\block::word($key, '*');
			\dash\waf\gate\toys\block::word($key, '"');
			\dash\waf\gate\toys\block::word($key, "'");
			\dash\waf\gate\toys\block::word($key, "\n");

			// disallow html tags
			\dash\waf\gate\toys\block::tags($value);
			// disallow some words
			\dash\waf\gate\toys\block::word($value, 'script');
			\dash\waf\gate\toys\block::word($value, 'javascript');
			\dash\waf\gate\toys\block::word($value, 'prompt');
			\dash\waf\gate\toys\block::word($value, 'delete');
			\dash\waf\gate\toys\block::word($value, 'xss');
			// \dash\waf\gate\toys\block::word($value, '{');
			// \dash\waf\gate\toys\block::word($value, '}');
			// \dash\waf\gate\toys\block::word($value, '(');
			// \dash\waf\gate\toys\block::word($value, ')');
			\dash\waf\gate\toys\block::word($value, '<');
			\dash\waf\gate\toys\block::word($value, '>');
			\dash\waf\gate\toys\block::word($value, '*');
			\dash\waf\gate\toys\block::word($value, '"');
			\dash\waf\gate\toys\block::word($value, "'");
			\dash\waf\gate\toys\block::word($value, "\n");

		}
	}
}
?>