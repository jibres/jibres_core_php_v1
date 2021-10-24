<?php
namespace content_a\category\remove;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Remove category'));


		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);

	}
}
?>