<?php
namespace content_a\category\property;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Property of category'));
		\dash\data::page_desc(T_('You can manage your categories property manually.'));
		\dash\data::page_pictogram('magic');

		if(\dash\permission::check('categoryView'))
		{
			\dash\data::badge_text(T_('Category list'));
			\dash\data::badge_link(\dash\url::this());
		}

		if(\dash\data::dataRow_title())
		{
			\dash\data::page_title(T_('Category property'). ' | '. \dash\data::dataRow_title());
		}

	}
}
?>