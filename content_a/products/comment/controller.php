<?php
namespace content_a\products\comment;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductEdit');

		// check load product detail
		// if have not product id, load all comment in all product
		if(\dash\request::get('id'))
		{
			\lib\app\product\load::one();
		}

	}
}
?>
