<?php
namespace content_a\form\item;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit question'));

		\content_a\form\edit\view::form_preview_link();

		\content_a\form\home\view::backModuleLink();

		\dash\data::action_text(T_('Add new item'));
		\dash\data::action_link(\dash\url::this(). '/item/add?id='. \dash\request::get('id'));

		$form_id = \dash\request::get('id');

		$choice = \lib\app\form\choice\get::choice_item(\dash\request::get('item'));
		\dash\data::choiceList($choice);

		if(\dash\request::is_pwa())
		{
			\dash\face::btnSave('form1');
		}

		\dash\data::allAllowFileExt(\dash\upload\extentions::get_all_allow_ext());
	}
}
