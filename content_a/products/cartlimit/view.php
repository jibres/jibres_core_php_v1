<?php
namespace content_a\products\cartlimit;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Cart limit"));

		\dash\face::btnSave('form1');
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

	}
}
?>
