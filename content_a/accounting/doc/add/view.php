<?php
namespace content_a\accounting\doc\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add accounting doc'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>
