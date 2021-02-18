<?php
namespace content_a\setting\branding;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Branding'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>