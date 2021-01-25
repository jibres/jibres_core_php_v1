<?php
namespace content_a\products\export;


class view
{
	public static function config()
	{
		// page title
		\dash\face::title(T_("Export products"));
		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');
		// support link
		// \dash\face::help(\dash\url::support().'/products/export');

		$count_all = \lib\app\product\export::count_all();
		\dash\data::countAll($count_all);

		if(\dash\request::get('download') === 'now')
		{
			\lib\app\product\export::download_now();
		}

		if(\dash\request::get('id'))
		{
			\lib\app\export\download::export_products(\dash\request::get('id'));
		}

		$list = \lib\app\product\export::list();
		\dash\data::exportList($list);
	}
}
?>
