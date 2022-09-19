<?php
namespace content_a\form\item\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new item'));

		\content_a\form\home\view::backModuleLink();

		$form_id = \dash\request::get('id');

		\content_a\form\edit\view::form_preview_link();

		// \dash\face::btnInsert('form1');

		\dash\data::itemType(\lib\app\form\item\type::get_group());

		\dash\data::allAllowFileExt(\dash\upload\extentions::get_all_allow_ext());
	}
}
?>
