<?php
namespace content_a\form\item\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new item'));

		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();

		$form_id = \dash\request::get('id');

		// \dash\face::btnInsert('form1');

		\dash\data::itemType(\lib\app\form\item\type::get_group());

		\dash\data::allAllowFileExt(\dash\upload\extentions::get_all_allow_ext());
	}
}
?>
