<?php
namespace content_a\accounting\year\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit accounting year'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\face::btnSetting(\dash\url::that(). '/manage?id='. \dash\request::get('id'));

		\dash\data::editMode(true);

	}
}
?>
