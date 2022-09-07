<?php
namespace content_a\form\find;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Find answer and print'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));


	}
}
?>
