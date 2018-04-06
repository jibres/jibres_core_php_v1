<?php
namespace content\pricing;


class view
{
	public static function config()
	{
		\dash\data::page(T_('Plans and Pricing of Jibres'), 'title');
		\dash\data::page(T_("Always know what you'll pay per month.") . ' ' . T_('Simple pricing'), 'desc');
	}
}
?>