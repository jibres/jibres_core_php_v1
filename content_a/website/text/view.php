<?php
namespace content_a\website\text;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Text'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

	}
}
?>
