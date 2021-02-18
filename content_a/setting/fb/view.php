<?php
namespace content_a\setting\fb;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Facebook'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');
	}
}
?>