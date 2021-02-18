<?php
namespace content_a\setting\github;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Github'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/social');
	}
}
?>