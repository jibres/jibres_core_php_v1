<?php
namespace content_a\setting\place;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Place setting'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>