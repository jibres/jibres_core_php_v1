<?php
namespace content_a\products\import;


class view
{
	public static function config()
	{
		// page title
		\dash\face::title(T_("Import products"));
		// back
		\dash\data::back_text(T_('Product setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');

		$awaiting_import = \lib\app\import\product::awaiting_import();
		\dash\data::awaitingImport($awaiting_import);
	}
}
?>
