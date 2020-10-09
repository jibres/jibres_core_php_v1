<?php
namespace content_a\category\remove;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Remove category'));

		if(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\face::title(). ' | '. \dash\data::dataRow_title());
		}

		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);


		$category_list = \lib\app\category\get::all_category();
		$category_list = array_reverse($category_list);
		\dash\data::listCategory($category_list);
	}
}
?>