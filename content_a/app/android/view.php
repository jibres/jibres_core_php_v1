<?php
namespace content_a\app\android;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Application setting'));

		// back
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::here());


	}
}
?>
