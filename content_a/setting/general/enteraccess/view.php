<?php
namespace content_a\setting\general\enteraccess;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Enter access'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>