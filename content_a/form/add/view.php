<?php
namespace content_a\form\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new contact form'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
