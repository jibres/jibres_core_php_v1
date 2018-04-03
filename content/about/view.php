<?php
namespace content\about;


class view
{
	public static function config()
	{
		\lib\data::page(T_('About our platform'), 'title');
		\lib\data::page(\lib\data::get('site', 'desc'), 'desc');
	}
}
?>