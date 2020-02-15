<?php
namespace content_a\products\comment;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Comments'). ' | '. \dash\data::productDataRow_title());
		\dash\data::page_desc(T_('Check price change of this product like buy, sale and profit.'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));



		$dataTable = \lib\app\product\comment::of_product(\dash\request::get('id'));

		\dash\data::dataTable($dataTable);

	}
}
?>
