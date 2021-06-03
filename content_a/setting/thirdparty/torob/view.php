<?php
namespace content_a\setting\thirdparty\torob;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Torob'));

		// back
		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());

	}
}
?>