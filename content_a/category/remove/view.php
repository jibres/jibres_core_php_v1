<?php
namespace content_a\category\remove;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Remove category'));
		\dash\data::page_desc(T_('You can remove your categories manually.'));
		\dash\data::page_pictogram('trash');


		\dash\data::page_backText(T_('Category list'));
		\dash\data::page_backLink(\dash\url::this());

		if(\dash\data::dataRow_title())
		{
			\dash\data::page_title(T_('Remove category'). ' | '. \dash\data::dataRow_title());
		}

		$allCat = \lib\app\category\search::list(null, ['pagenation' => false]);
		\dash\data::allCat($allCat);
	}
}
?>