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

		$dataRow = \lib\app\product\cat::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(isset($dataRow['title']))
		{
			\dash\data::page_title(T_('Remove category'). ' | '. $dataRow['title']);
		}

		$allCat = \lib\app\product\cat::list(null, ['pagination' => false]);
		\dash\data::allCat($allCat);
	}
}
?>