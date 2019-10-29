<?php
namespace content_a\product\desc;


class model
{

	public static function getPost()
	{
		$args =
		[
			'desc'     => \dash\request::post('desc'),
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
