<?php
namespace content_cms\category\remove;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Remove category'));

		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);


		$category_list = \dash\app\terms\get::cat_list();

		$category_list = array_reverse($category_list);
		\dash\data::listCat($category_list);
	}
}
?>