<?php
namespace content_my\ipg\setup\profile;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Profile'));

		\content_my\ipg\setup\stepGuide::set();
		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$profileDetail = \lib\app\ipg\profile\get::my_profile();
		\dash\data::profileDetail($profileDetail);
	}
}
?>