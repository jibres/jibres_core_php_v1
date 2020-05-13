<?php
namespace content_a\website\body\image;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage image'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/body');

	}
}
?>
