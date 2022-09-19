<?php
namespace content_a\form\sorting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit question sort'));
		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();


		$form_id = \dash\request::get('id');

		$items = \lib\app\form\item\get::items($form_id);

		\dash\data::formItems($items);

		\content_a\form\edit\view::form_preview_link();
	}
}
?>
