<?php
namespace content_a\channels\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sales Channels'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>