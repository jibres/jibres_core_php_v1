<?php
namespace content_a\category\edit;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Edit category'));
		\dash\data::page_desc(T_('You can manage your categories manually.'));
		\dash\data::page_pictogram('edit');

		if(\dash\permission::check('categoryView'))
		{
			\dash\data::badge_text(T_('Category list'));
			\dash\data::badge_link(\dash\url::this());
		}

		if(\dash\data::dataRow_title())
		{
			\dash\data::page_title(T_('Edit category'). ' | '. \dash\data::dataRow_title());
		}
	}
}
?>