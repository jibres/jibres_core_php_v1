<?php
namespace content_a\product\sale;


class model
{
	public static function getPost()
	{
		$args =
		[
			'salesite'     => \dash\request::post('salesite'),
			'saletelegram' => \dash\request::post('saletelegram'),
			'saleapp'      => \dash\request::post('saleapp'),
			'salephysical' => \dash\request::post('salephysical'),
		];

		return $args;
	}


	public static function post()
	{

		\dash\permission::access('productManageSaleGateway');

		$request         = self::getPost();

		\lib\app\product::edit($request, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			// @check
			\dash\redirect::pwd();
		}

	}

}
?>
