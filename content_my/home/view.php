<?php
namespace content_my\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Dashboard'));
		\dash\face::help(\dash\url::support().'/dashboard');

		if(!\dash\detect\device::detectPWA())
		{
			\dash\data::action_text(T_('Add Your Business'));
			\dash\data::action_icon('plus');
			\dash\data::action_link(\dash\url::this(). '/store/start');
		}
	}
}
?>