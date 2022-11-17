<?php
namespace content_a\products\inventory;


class view
{

	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Product inventory history"));

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		// \dash\data::listEngine_filter(\lib\app\order\filter::list());
		\dash\data::listEngine_sort(true);
		// \dash\data::sortList(\lib\app\order\filter::sort_list());


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this() . '/edit?id=' . $id);

		$args =
			[
				'product_id' => $id,
			];

		$dataTable = \lib\app\product\inventory::search(null, $args);

		\dash\data::dataTable($dataTable);

	}

}

?>
