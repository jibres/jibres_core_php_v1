<?php
namespace content_a\category\sort;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sort Product categories'));

		\dash\data::back_text(T_('Categories'));
		\dash\data::back_link(\dash\url::this());


		$category_list = \lib\app\category\get::all_category_not_sorted();
		$category_list = array_reverse($category_list);
		\dash\data::listProductTag($category_list);
	}
}
?>