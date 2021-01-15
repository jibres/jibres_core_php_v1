<?php
namespace content_a\setting\thirdparty\raychat;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Raychat'));

		// back
		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>