<?php
namespace content_a\products\import;


class view
{
	public static function config()
	{
		// page title
		\dash\face::title(T_("Import products"));
		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\dash\url::this());
		// support link
		\dash\face::help(\dash\url::support().'/products/import');

		$awaiting_import = \lib\app\import\product::awaiting_import();
		\dash\data::awaitingImport($awaiting_import);
	}
}
?>
