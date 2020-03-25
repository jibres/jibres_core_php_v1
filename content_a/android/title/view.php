<?php
namespace content_a\android\title;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Application title'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\content_a\android\load::detail();
	}
}
?>
