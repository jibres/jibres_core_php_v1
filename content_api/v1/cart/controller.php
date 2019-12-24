<?php
namespace content_api\v1\cart;


class controller
{
	public static function routing()
	{
		\content_api\v1::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_api\v1::apikey_required();

		$dir_3     = \dash\url::dir(3);


		if($dir_3 === 'list')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_api\v1::invalid_method();
			}

			self::cart_list();
		}
		elseif($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			if(!\dash\request::is('post'))
			{
				\content_api\v1::invalid_method();
			}

			self::cart_add();
		}
		elseif($dir_3 === 'delete')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			if(!\dash\request::is('delete'))
			{
				\content_api\v1::invalid_method();
			}

			self::cart_delete();
		}
		elseif($dir_3 === 'edit')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			if(!\dash\request::is('put'))
			{
				\content_api\v1::invalid_method();
			}

			self::cart_edit();
		}
		else
		{
			\content_api\v1::invalid_url();
		}
	}


	private static function cart_list()
	{
		$result =
		[
			[
				'product' => 1,
				'count'   => 10,
				'date'    => date("Y-m-d H:i:s"),
				'product_detail' => ['title' => 'product 1', 'price' => 1000],
			],
			[
				'product' => 2,
				'count'   => 10,
				'date'    => date("Y-m-d H:i:s"),
				'product_detail' => ['title' => 'product 2', 'price' => 2000],
			],
		];
		\content_api\v1::say($result);
	}



	private static function cart_add()
	{
		$product = \content_api\v1::input_body('product');
		$count   = \content_api\v1::input_body('count');
		$result  = \lib\app\cart\add::new_cart($product, $count);
		\content_api\v1::say($result);
	}


	private static function cart_delete()
	{
		$result = null;

		$product = \content_api\v1::input_body('product');
		if(!$product || !is_numeric($product))
		{
			\dash\notif::error(T_("Please set the product"));
			\content_api\v1::say($result);
		}

		\dash\notif::ok(T_("The product was removed from your cart"));
		\content_api\v1::say($result);
	}


	private static function cart_edit()
	{
		$result = null;

		$product = \content_api\v1::input_body('product');
		if(!$product || !is_numeric($product))
		{
			\dash\notif::error(T_("Please set the product"));
			\content_api\v1::say($result);
		}

		$count = \content_api\v1::input_body('count');
		if(!$count || !is_numeric($count))
		{
			\dash\notif::error(T_("Please set the count"));
			\content_api\v1::say($result);
		}

		\dash\notif::ok(T_("Your cart was updated"));
		\content_api\v1::say($result);
	}

}
?>