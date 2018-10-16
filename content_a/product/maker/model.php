<?php
namespace content_a\product\maker;


class model
{
	public static function getPost()
	{
		$args =
		[
			'company'        => \dash\request::post('company'),
			'carton'         => \dash\request::post('carton'),
		];
		return $args;
	}


	public static function post()
	{
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
?>
