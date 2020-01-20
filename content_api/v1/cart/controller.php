<?php
namespace content_api\v1\cart;


class controller
{
	public static function routing()
	{
		\content_api\v1\tools::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_api\v1\tools::apikey_required();

		$dir_3     = \dash\url::dir(3);


		if($dir_3 === 'list')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1\tools::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_api\v1\tools::invalid_method();
			}

			self::cart_list();
		}
		elseif($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1\tools::invalid_url();
			}

			if(!\dash\request::is('post'))
			{
				\content_api\v1\tools::invalid_method();
			}

			self::cart_add();
		}
		elseif($dir_3 === 'delete')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1\tools::invalid_url();
			}

			if(!\dash\request::is('delete'))
			{
				\content_api\v1\tools::invalid_method();
			}

			self::cart_delete();
		}
		elseif($dir_3 === 'edit')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1\tools::invalid_url();
			}

			if(!\dash\request::is('put'))
			{
				\content_api\v1\tools::invalid_method();
			}

			self::cart_edit();
		}
		elseif($dir_3 === 'checkout')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1\tools::invalid_url();
			}

			if(!\dash\request::is('post'))
			{
				\content_api\v1\tools::invalid_method();
			}

			self::cart_checkout();
		}
		else
		{
			\content_api\v1\tools::invalid_url();
		}
	}


	private static function cart_list()
	{
		$result  = \lib\app\cart\get::my_cart_list();
		\content_api\v1\tools::say($result);
	}



	private static function cart_add()
	{
		$product = \content_api\v1\tools::input_body('product');
		$count   = \content_api\v1\tools::input_body('count');
		$result  = \lib\app\cart\add::new_cart($product, $count);
		\content_api\v1\tools::say($result);
	}


	private static function cart_delete()
	{
		$product = \content_api\v1\tools::input_body('product');
		$result  = \lib\app\cart\remove::from_cart($product);
		\content_api\v1\tools::say($result);
	}


	private static function cart_edit()
	{
		$product = \content_api\v1\tools::input_body('product');
		$count   = \content_api\v1\tools::input_body('count');
		$result  = \lib\app\cart\edit::update_cart($product, $count);
		\content_api\v1\tools::say($result);
	}



	private static function cart_checkout()
	{
		$address_id         = \content_api\v1\tools::input_body('address_id');
		$args               = [];
		$args['address_id'] = $address_id;

		$result  = \lib\app\cart\checkout::user_cart($args);

		\content_api\v1\tools::say($result);
	}

}
?>