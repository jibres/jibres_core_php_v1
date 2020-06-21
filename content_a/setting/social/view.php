<?php
namespace content_a\setting\social;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Social Network'));


		// back

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/general');
	}
}
?>