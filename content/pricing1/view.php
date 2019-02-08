<?php
namespace content\pricing;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Plans and Pricing of Jibres'));
		\dash\data::page_desc(T_("Always know what you'll pay per month.") . ' ' . T_('Simple pricing'));
		\dash\data::page_special(true);
	}
}
?>