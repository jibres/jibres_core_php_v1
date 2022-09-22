<?php
namespace content_a\form\tag\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit tag'));

		\content_a\form\edit\view::form_preview_link();
		$id = \dash\request::get('tid');

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::that(). '?'. \dash\request::fix_get());


		\dash\face::btnSave('form1');

	}
}
?>