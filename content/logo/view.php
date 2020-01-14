<?php
namespace content\logo;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres Logo'));
		\dash\data::page_special(true);
		\dash\data::page_desc(T_('Know more about Jibres Logo'). ' '.  \dash\data::site_slogan());
	}
}
?>