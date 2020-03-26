<?php
namespace content_a\website\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Website'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

	}
}
?>
