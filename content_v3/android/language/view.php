<?php
namespace content_v3\android\language;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Choose your language'));

		\dash\face::disablePWA_Header(true);
	}
}
?>