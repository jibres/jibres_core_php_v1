<?php
namespace content_a\form\duplicate;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Duplicate form'));


		$form_id = \dash\request::get('id');
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?'. \dash\request::fix_get());

	}
}
?>
