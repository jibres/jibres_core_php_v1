<?php
namespace content_a\discount\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new discount code"));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnSave('discountadd');

		\dash\data::include_adminPanelBuilder(true);


		$category_list = \lib\app\tag\get::all_category();
		$category_list = array_reverse($category_list);
		\dash\data::listProductTag($category_list);

	}
}
?>
