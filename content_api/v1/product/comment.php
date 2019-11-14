<?php
namespace content_api\v1\product;


class comment
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$product_id = \dash\request::get('product');
			if(!$product_id)
			{
				\dash\notif::error(T_("Product id not set"), ['code' => 1, 'element' => 'product']);
				return false;
			}

			if(!\dash\coding::decode($product_id))
			{
				\dash\notif::error(T_("Invalid product id"), ['code' => 2, 'element' => 'product']);
				return false;
			}

			return self::get_comment_list($product_id);
		}
		else
		{
			\content_api\v1::stop(405);
		}
	}


	private static function get_comment_list($_product_id)
	{
		$list = \lib\app\product\comment::approved_of_product($_product_id);
		return $list;
	}
}
?>