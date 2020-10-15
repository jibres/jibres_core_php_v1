<?php
namespace content_a\setting\product\tag;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add tag to all product'));

		// back
		\dash\data::back_text(T_('Product setting'));
		\dash\data::back_link(\dash\url::that());


		$all_tag = \lib\app\tag\get::all_tag();
		\dash\data::allTagList($all_tag);


	}
}
?>