<?php
namespace content_a\website\footer\maintext;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Set footer Main text'));

		// back
		\dash\data::back_text(T_('Footer'));
		\dash\data::back_link(\dash\url::that());

	}
}
?>
