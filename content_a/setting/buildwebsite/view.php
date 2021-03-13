<?php
namespace content_a\setting\buildwebsite;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Build Website'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>