<?php
namespace content_a\product\cats;

class controller
{
	public static function routing()
	{
		\dash\permission::access('productCategoryListView');

		$catList = \lib\app\product\cat::list(true);
		\dash\data::dataTable($catList);

		$edit = \dash\request::get('edit');
		if($edit && !array_key_exists($edit, $catList))
		{
			\dash\header::status(403, T_("Invalid cat"));
		}

		if(isset($catList[$edit]))
		{
			\dash\data::productCount($catList[$edit]);
		}

		if(is_array($_GET) && array_key_exists('edit', $_GET))
		{
			\dash\permission::access('productCategoryListEdit');
			\dash\data::editMode(true);
		}
	}
}
?>