<?php
namespace content_a\setting\thirdparty\imber;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Imber'));

		// back
		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>