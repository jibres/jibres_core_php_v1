<?php
namespace content_a\category\edit;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Edit category'));
		\dash\data::page_desc(T_('You can manage your categories manually.'));
		\dash\data::page_pictogram('edit');


		\dash\data::page_backText(T_('Category list'));
		\dash\data::page_backLink(\dash\url::this());

		\dash\data::parentList(\lib\app\category\get::parent_list(\dash\request::get('id')));

		if(\dash\data::dataRow_title())
		{
			\dash\data::page_title(T_('Edit category'). ' | '. \dash\data::dataRow_title());
		}
	}
}
?>