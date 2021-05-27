<?php
namespace content_a\setting\general\title;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Business title'));


		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>