<?php
namespace content\about;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('About our platform'));
		\dash\data::page_desc(\dash\data::site_desc());
	}
}
?>