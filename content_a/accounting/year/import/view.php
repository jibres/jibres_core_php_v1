<?php
namespace content_a\accounting\year\import;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Import accounting factor'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/manage?id='. \dash\request::get('id'));

	}
}
?>
