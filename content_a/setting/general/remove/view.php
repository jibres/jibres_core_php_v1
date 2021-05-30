<?php
namespace content_a\setting\general\remove;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Remove business'));

		// back
		\dash\data::back_text(T_('General setting'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>