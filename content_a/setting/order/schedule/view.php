<?php
namespace content_a\setting\order\schedule;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Order schedule'));

		// back
		\dash\data::back_text(T_('Order Setting'));
		\dash\data::back_link(\dash\url::that());

	}
}
?>