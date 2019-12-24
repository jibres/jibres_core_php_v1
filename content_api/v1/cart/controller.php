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
		$result  = \lib\app\cart\get::my_cart_list();
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
		$product = \content_api\v1::input_body('product');
		$result  = \lib\app\cart\remove::from_cart($product);
		\content_api\v1::say($result);
	}


	private static function cart_edit()
	{
		$product = \content_api\v1::input_body('product');
		$count   = \content_api\v1::input_body('count');
		$result  = \lib\app\cart\edit::update_cart($product, $count);
		\content_api\v1::say($result);
	}

}
?>