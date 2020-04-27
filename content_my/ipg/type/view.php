<?php
namespace content_my\ipg\type;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Choose profile type'));

		\content_my\ipg\stepGuide::set();
		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>