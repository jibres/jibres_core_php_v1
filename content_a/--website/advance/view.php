<?php
namespace content_a\website\advance;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Website advance'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
