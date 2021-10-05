<?php
namespace content_a\report\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Reports'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());



	}
}
?>