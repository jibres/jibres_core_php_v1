<?php
namespace content_a\form\thankyou;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit Thankyou message form'));

		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();

		$form_id = \dash\request::get('id');

		\dash\face::btnSave('form1');
		\content_a\form\edit\view::form_preview_link();
	}
}
?>
