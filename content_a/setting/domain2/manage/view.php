<?php
namespace content_a\setting\domain2\manage;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Manage domain'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>