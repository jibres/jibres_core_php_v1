<?php
namespace content_a\form\answer\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add answer'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that() . '?id='. \dash\request::get('id'));
	}
}
?>