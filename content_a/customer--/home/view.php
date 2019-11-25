<?php
namespace content_a\customer\home;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Customers"));
		\dash\data::page_desc(T_('Check list of customer and search or filter in them to find your customer.'));
		\dash\data::page_desc(\dash\data::page_desc(). ' '. T_('Also add or edit specefic customer.'));


		// btn
		\dash\data::page_btnText(T_('Add customer'));
		\dash\data::page_btnLink(\dash\url::this(). '/add');


		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		$dataTable = \lib\app\customer\search::list(\dash\request::get('q'), $args);

		\dash\data::dataTable($dataTable);
	}
}
?>
