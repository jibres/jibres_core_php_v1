<?php
namespace content_a\products\import;


class view
{
	public static function config()
	{
		// page title
		\dash\data::page_title(T_("Import products"));
		// back
		\dash\data::page_backText(T_('Products'));
		\dash\data::page_backLink(\dash\url::this());
		// support link
		\dash\data::page_help(\dash\url::support().'/products/import');

		$awaiting_import = \lib\app\import\product::awaiting_import();
		\dash\data::awaitingImport($awaiting_import);
	}
}
?>
