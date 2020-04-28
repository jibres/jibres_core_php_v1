<?php
namespace content_my\ipg\upload;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Upload Document'));


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$profileDetail = \lib\app\shaparak\profile\get::my_profile();
		\dash\data::profileDetail($profileDetail);
	}
}
?>