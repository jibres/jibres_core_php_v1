<?php
namespace content_a\website\news\design;


class view
{
	public static function config()
	{
		\dash\face::title(T_('News line'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). \dash\request::full_get());


	}
}
?>
