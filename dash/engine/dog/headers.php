<?php
namespace dash\engine\dog;
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
		\dash\engine\dog\toys\only::array($headers);

		if(empty($headers))
		{
			return;
		}

		foreach ($headers as $key => $value)
		{
			// check key len
			\dash\engine\dog\toys\general::len($key, 1, 50);

			// check value len
			\dash\engine\dog\toys\general::len($value, 0, 500);


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

		// disallow html tags
		\dash\engine\dog\toys\block::tags($txt);
		// disallow some words

		\dash\engine\dog\toys\block::word($txt, "'");
		\dash\engine\dog\toys\block::word($txt, "`");
		\dash\engine\dog\toys\block::word($txt, "\n");
	}
}
?>
