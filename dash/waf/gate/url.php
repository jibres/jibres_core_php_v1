<?php
namespace dash\waf\gate;

/**
 * This class describes a url.
 */
class url
{
	public static function inspection()
	{
		// if we dont have request url it was very mysterious, say Hi to hitler
		if(!isset($_SERVER['REQUEST_URI']))
		{
			\dash\waf\dog::BITE('Invalid Father10', 412);
		}

		$url = $_SERVER['REQUEST_URI'];

		if(!$url)
		{
			return;
		}

		\dash\waf\gate\toys\only::something($url);

		\dash\waf\gate\toys\only::string($url);

		\dash\waf\gate\toys\block::word($url, '"');
		\dash\waf\gate\toys\block::word($url, "'");
		\dash\waf\gate\toys\block::word($url, "`");
		\dash\waf\gate\toys\block::word($url, "*");
		\dash\waf\gate\toys\block::word($url, "\\");
		\dash\waf\gate\toys\block::word($url, "\n");

		\dash\waf\gate\toys\block::word($url, '<');
		\dash\waf\gate\toys\block::word($url, '>');

		\dash\waf\gate\toys\block::word($url, '../');
		\dash\waf\gate\toys\block::word($url, '/..');

		\dash\waf\gate\toys\block::word($url, '/.');
		\dash\waf\gate\toys\block::word($url, './');

		\dash\waf\gate\toys\block::word($url, '///');

		self::dbl_slash($url);

		\dash\waf\gate\toys\block::tags($url);

		\dash\waf\gate\toys\block::non_printable_char($url);

		\dash\waf\gate\toys\block::script($url);

		\dash\waf\gate\toys\block::maybe_script($url);

		\dash\waf\gate\toys\block::ascii($url);
	}


	private static function dbl_slash($url)
	{
		// if find 2slash together block!
		if(strpos($url, '//') !== false)
		{
			// route url like this
			// http://dash.local/enter?referer=http://dash.local/cp
			if(strpos($url, '?') === false || strpos($url, '?') > strpos($url, '//'))
			{
				\dash\waf\gate\toys\block::word($url, '//');
			}
		}
	}
}
?>