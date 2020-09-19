<?php
namespace content_a\form\item;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit question'));

			// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

		// \dash\data::action_text(T_('Add new item'));
		// \dash\data::action_link(\dash\url::this(). '/item/add?id='. \dash\request::get('id'));

		$form_id = \dash\request::get('id');

		$choice = \lib\app\form\choice\get::choice_item(\dash\request::get('item'));
		\dash\data::choiceList($choice);

		\dash\face::btnSave('form1');

		\dash\data::allAllowFileExt(\dash\upload\extentions::get_all_allow_ext());
	}
}
?>
