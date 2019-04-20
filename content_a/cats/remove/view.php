<?php
namespace content_a\cats\remove;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Remove category'));
		\dash\data::page_desc(T_('You can remove your categories manually.'));
		\dash\data::page_pictogram('trash');

		if(\dash\permission::check('productCategoryListView'))
		{
			\dash\data::badge_text(T_('Category list'));
			\dash\data::badge_link(\dash\url::this());
		}


		if(\dash\data::dataRow_title())
		{
			\dash\data::page_title(T_('Edit category'). ' | '. \dash\data::dataRow_title());
		}

		$allCat = \lib\app\product\cat::list(null, ['pagenation' => false]);
		\dash\data::allCat($allCat);
	}
}
?>