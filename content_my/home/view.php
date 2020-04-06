<?php
namespace content_my\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres my'));
		\dash\face::boxTitle(false);

		if(!\dash\detect\device::detectPWA())
		{
			\dash\face::title(' ');

			\dash\face::boxTitle(true);
			\dash\data::action_text(T_('Stores'));
			\dash\data::action_link(\dash\url::here() . '/store');
		}
	}
}
?>