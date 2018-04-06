<?php
namespace content\changelog;


class view
{
	public static function config()
	{
		\dash\data::page(T_('Change log of Jibres'), 'title');
		\dash\data::page(T_('We were born to do Best!'). ' ' . T_("We are Developers, please wait!"), 'desc');
	}
}
?>