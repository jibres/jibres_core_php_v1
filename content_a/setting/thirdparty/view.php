<?php
namespace content_a\setting\thirdparty;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Third Party Services'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>