<?php
namespace content_my\store\start;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Create a new store"));

		$termLink = '<a href="'. \dash\url::kingdom(). '/terms" target="_blank">'. T_('Terms of Service') .'</a>';
		\dash\data::termOfService(T_("By press Create button, you're agreeing to our :term.", ['term' => $termLink]));

		\dash\data::userToggleSidebar(false);
	}
}
?>
