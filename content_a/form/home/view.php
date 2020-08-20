<?php
namespace content_a\form\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Contact form'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

	}

}
?>
