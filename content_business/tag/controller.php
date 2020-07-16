<?php
namespace content_business\tag;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();
		if(!$child)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		$load_product = \lib\app\product\tag::load_product_by_tag($child);

		if(!$load_product)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		\dash\data::dataRow($load_product);

		\dash\open::get();
	}
}
?>