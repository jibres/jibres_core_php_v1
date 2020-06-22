<?php
namespace content_subdomain\p\tag;

class controller
{
	public static function routing()
	{
		$subchild = \dash\url::subchild();
		if(!$subchild)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		$load_product = \lib\app\product\tag::load_product_by_tag($subchild);
		if(!$load_product)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		\dash\data::dataRow($load_product);

		\dash\open::get();
	}
}
?>