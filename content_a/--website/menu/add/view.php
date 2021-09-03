<?php
namespace content_a\website\menu\add;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new menu'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/menu');

	}
}
?>
