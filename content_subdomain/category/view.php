<?php
namespace content_subdomain\category;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Category"));

		$myCategoryList = \lib\app\category\search::list(null, []);

		\dash\data::categoryDataTable($myCategoryList);

	}
}
?>
