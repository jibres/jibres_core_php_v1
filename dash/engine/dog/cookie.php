<?php
namespace dash\engine\dog;
/**
 * dash main configure
 */
class cookie
{
	public static function inspection()
	{
		$cookie = $_COOKIE;
		// only allow array
		\dash\engine\dog\toys\only::array($cookie);

		if(empty($cookie))
		{
			return;
		}

		foreach ($cookie as $key => $value)
		{
			// check key len
			\dash\engine\dog\toys\general::len($key, 1, 50);

			// check value len
			\dash\engine\dog\toys\general::len($value, 0, 100);


			// check blacklist words
			self::blacklist($key);
			self::blacklist($value);
		}
	}


	private static function blacklist($txt)
	{
		// only can be text
		\dash\engine\dog\toys\only::something($txt);
		\dash\engine\dog\toys\only::text($txt);

		// disallow some words
		\dash\engine\dog\toys\block::word($txt, 'script');
		\dash\engine\dog\toys\block::word($txt, 'javascript');
		\dash\engine\dog\toys\block::word($txt, 'delete');
		\dash\engine\dog\toys\block::word($txt, 'xss');
		\dash\engine\dog\toys\block::word($txt, '{');
		\dash\engine\dog\toys\block::word($txt, '}');
		\dash\engine\dog\toys\block::word($txt, '(');
		\dash\engine\dog\toys\block::word($txt, ')');
		\dash\engine\dog\toys\block::word($txt, '*');
		\dash\engine\dog\toys\block::word($txt, '"');
		\dash\engine\dog\toys\block::word($txt, "'");
		\dash\engine\dog\toys\block::word($txt, "\n");
	}
}
?>
