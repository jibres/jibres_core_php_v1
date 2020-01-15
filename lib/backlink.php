<?php
namespace lib;

class backlink
{

	public static function set_factor($_args = [])
	{
		return self::set('factor', $_args);
	}


	public static function factor()
	{
		return self::get('factor');
	}


	public static function clean($_module)
	{
		\dash\session::clean('backlink_child_'. $_module);
		\dash\session::clean('backlink_'. $_module);
	}


	public static function product_barcode_scaned()
	{
		\dash\session::clean('backlink_products');
	}


	public static function set_products($_args = [])
	{
		return self::set('products', $_args);
	}


	public static function products()
	{
		return self::get('products');
	}


	public static function set($_module, $_args)
	{
		if(\dash\url::child())
		{
			\dash\session::set('backlink_child_'. $_module, \dash\url::child());
		}
		else
		{
			\dash\session::set('backlink_child_'. $_module, null);
		}

		$get = \dash\request::get();

		$args = array_merge($get, $_args);
		$args = array_filter($args);

		\dash\session::set('backlink_'. $_module, $args);

	}


	public static function get($_module)
	{
		$url   = \dash\url::here(). '/'. $_module;
		$child = \dash\session::get('backlink_child_'. $_module);

		if($child)
		{
			$url .= '/'. $child;
		}

		$args = \dash\session::get('backlink_'. $_module);

		if($args && is_array($args))
		{
			$url .= '?'. http_build_query($args);
		}

		return $url;

	}
}
?>