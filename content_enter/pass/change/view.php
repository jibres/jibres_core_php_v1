<?php
namespace content_enter\pass\change;

class view
{
	public static function config()
	{
		\content_enter\pass\view::config();

		$referer = \dash\get::index($_SERVER, 'HTTP_REFERER');

		if($referer && substr($referer, -8) === '/profile')
		{
			$backLink = \dash\url::kingdom(). '/profile';
		}
		else
		{
			$backLink = \dash\url::sitelang(). '/account/security';
		}

		\dash\data::myBackLink($backLink);
	}
}
?>