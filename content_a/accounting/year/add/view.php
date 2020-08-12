<?php
namespace content_a\accounting\year\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add accounting year'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>
