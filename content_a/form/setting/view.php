<?php
namespace content_a\form\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit new contact form'));

		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();

		$form_id = \dash\request::get('id');

		\dash\face::btnSave('form1');

		\content_a\form\edit\view::form_preview_link();

		\dash\data::myHtmlText('hi');

	}
}
?>
