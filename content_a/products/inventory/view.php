<?php
namespace content_a\products\inventory;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Inventory"));

		\dash\face::btnSave('form1');
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

	}
}
?>
