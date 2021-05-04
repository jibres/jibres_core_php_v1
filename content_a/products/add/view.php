<?php
namespace content_a\products\add;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Add new product"));


		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());

		\dash\face::btnInsert('aProductData');
		\dash\face::btnInsertValue('master');
		\dash\face::btnInsertText(T_("Add"));

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\category\search::list(null, ['pagination' => false]);
		\dash\data::listCategory($category_list);

		$all_tag = \lib\app\tag\get::all_tag();
		\dash\data::allTagList($all_tag);
		\dash\data::tagsSavedTitle([]);


		\content_a\products\edit\view::product_ratio();

	}
}
?>