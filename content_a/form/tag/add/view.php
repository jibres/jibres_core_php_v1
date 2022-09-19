<?php
namespace content_a\form\tag\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new form tag'));

		\content_a\form\edit\view::form_preview_link();

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>