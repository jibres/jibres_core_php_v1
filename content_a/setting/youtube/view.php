<?php
namespace content_a\setting\youtube;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Youtube'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social2');
	}
}
?>