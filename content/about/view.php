<?php
namespace content\about;


class view
{
	public static function config()
	{
		\dash\data::page(T_('About our platform'), 'title');
		\dash\data::page(\dash\data::get('site', 'desc'), 'desc');
	}
}
?>