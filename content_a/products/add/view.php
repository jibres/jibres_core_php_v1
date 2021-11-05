<?php
namespace content_a\products\add;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Add new product"));


		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\app\back_btn\link::products());

		\dash\face::btnInsert('aProductData');
		\dash\face::btnInsertText(T_("Add"));
		\dash\face::btnInsertValue('master');

		// $unit_list = \lib\app\product\unit::list();
		// \dash\data::listUnits($unit_list);

		\content_a\products\edit\view::product_ratio();

	}
}
?>