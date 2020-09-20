<?php
namespace content_a\form\analytics\duplicate;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Duplicate filter'));


		$form_id = \dash\request::get('id');
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/filter?'. \dash\request::fix_get());

	}
}
?>
