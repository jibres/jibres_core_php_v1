<?php
namespace content\logo;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Plans and Pricing of Jibres'), 'title');
		\lib\data::page(T_("Always know what you'll pay per month.") . ' ' . T_('Simple pricing'), 'desc');
	}
}
?>