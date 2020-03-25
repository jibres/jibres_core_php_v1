<?php
namespace content\pricing;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Plans and Pricing of Jibres'));
		\dash\data::page_desc(T_("Always know what you'll pay per month.") . ' ' . T_('Simple pricing'));


		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>