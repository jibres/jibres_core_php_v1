<?php
namespace content_a\category\quickaccess;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Quick access'));

		\dash\data::back_text(T_('Sale'));
		\dash\data::back_link(\dash\url::here(). '/sale');

	}
}
?>