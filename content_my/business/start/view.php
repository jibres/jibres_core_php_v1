<?php
namespace content_my\business\start;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Create a new store"));

		$termLink = '<a href="'. \dash\url::kingdom(). '/terms" target="_blank">'. T_('Terms of Service') .'</a>';
		\dash\data::termOfService(T_("By press Create button, you're agreeing to our :term.", ['term' => $termLink]));

		\dash\data::userToggleSidebar(false);

		if(\dash\detect\device::detectPWA())
		{
			// back
			\dash\data::back_text(T_('Cancel'));
			\dash\data::back_link(\dash\url::this());
		}
	}
}
?>
