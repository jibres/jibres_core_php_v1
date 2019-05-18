<?php
namespace content_a\product\stock;


class model
{
	public static function getPost()
	{
		$args =
		[
			'initialbalance' => \dash\request::post('initialbalance'),
			'minstock'       => \dash\request::post('minstock'),
			'maxstock'       => \dash\request::post('maxstock'),
			'infinite'       => \dash\request::post('infinite'),
			'company'       => \dash\request::post('company'),
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
