<?php
namespace content_a\app\android\setting;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Set app title and logo'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\content_a\app\android\view::ready();
	}
}
?>
