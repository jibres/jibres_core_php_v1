<?php
namespace content_a\setting\general;

class view
{
	public static function config()
	{
		\dash\face::title(T_('General setting'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>