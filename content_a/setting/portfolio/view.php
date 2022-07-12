<?php
namespace content_a\setting\portfolio;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres portfolio'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>