<?php
namespace content_a\discount\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new discount code"));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnSave('discountadd');

		\dash\face::btnSaveName('save_and_publish');
		\dash\face::btnSaveValue('save_and_publish');
		\dash\face::btnSaveText(T_("Save"));

		if(\dash\data::editMode())
		{
			\dash\data::discountDedicate(\lib\app\discount\dedicated::load_all_dedicated(\dash\request::get('id')));
		}

	}
}
?>