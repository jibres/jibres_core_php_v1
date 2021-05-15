<?php
namespace content_a\tag\clone;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit group title'));


		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/property?id='. $id);


		$category_list = \lib\app\tag\get::all_category();
		$category_list = array_reverse($category_list);
		\dash\data::listProductTag($category_list);

	}
}
?>