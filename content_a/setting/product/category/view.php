<?php
namespace content_a\setting\product\category;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add category to all product'));

		// back
		\dash\data::back_text(T_('Product setting'));
		\dash\data::back_link(\dash\url::that());



		$all_tag = \lib\app\category\get::all_category();
		\dash\data::allTagList($all_tag);
	}
}
?>