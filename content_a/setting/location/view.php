<?php
namespace content_a\setting\location;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Business location'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>