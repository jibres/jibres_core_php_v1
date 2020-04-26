<?php
namespace content_my\ipg\profile;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Profile'));

		\content_my\ipg\stepGuide::set();
		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>