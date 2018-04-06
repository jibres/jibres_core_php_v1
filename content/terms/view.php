<?php
namespace content\terms;


class view
{
	public static function config()
	{
		\dash\data::page(T_('Terms of Service Agreement'), 'title');
		\dash\data::page(T_('Jibres acts upon international rules, depends on the countries receiving its services and renders its activities within this framework.'), 'desc');
	}
}
?>