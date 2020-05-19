<?php
namespace content_a\website\body\slider2;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage slider'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

	}
}
?>
