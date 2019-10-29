<?php
namespace content_a\product\manage;


class model
{
	public static function getPost()
	{
		$args =
		[
			'status' => \dash\request::post('status'),
		];

		return $args;
	}


	public static function post()
	{
		if(\dash\request::post('delete') === 'product')
		{
			\dash\permission::access('productDelete');

			\lib\app\product::delete(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}

		}
		else
		{
			\dash\permission::access('productStatusEdit');

			$request         = self::getPost();

			\lib\app\product::edit($request, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				// @check
				\dash\redirect::pwd();

				// after save redirect to list of products
				$url_of_product_list = \dash\url::here().'/product';
				\dash\redirect::to($url_of_product_list);
			}
		}
	}

}
?>
