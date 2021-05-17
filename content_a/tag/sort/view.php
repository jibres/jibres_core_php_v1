<?php
namespace content_a\tag\sort;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sort Product tags'));

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::this());


		$category_list = \lib\app\tag\get::all_category_not_sorted();
		$category_list = array_reverse($category_list);
		\dash\data::listProductTag($category_list);
	}
}
?>