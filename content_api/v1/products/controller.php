<?php
namespace content_api\v1\products;


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

		$dir_2 = \dash\url::dir(2);

		if($dir_2 !== 'products')
		{
			\content_api\v1::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$products_id = \dash\url::dir(3);


		if($dir_3 === 'list')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			self::products_list();
		}
		elseif($dir_3 === 'category')
		{
			$category_id = \dash\url::dir(4);
			if(!$category_id || !is_numeric($category_id) || intval($category_id) < 0 || \dash\number::is_larger($category_id, 9999999999))
			{
				\content_api\v1::invalid_url();
			}

			if(\dash\url::dir(5))
			{
				\content_api\v1::invalid_url();
			}

			self::products_category_list($category_id);
		}
		else
		{
			\content_api\v1::invalid_url();
		}
	}


	private static function products_list()
	{
		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'filter' => [],
		];

		$myProductList  = \lib\app\product\search::variant_list(null, $args);
		$filter_message = \lib\app\product\search::filter_message();
		$isFiltered     = \lib\app\product\search::is_filtered();

		\content_api\v1::say($myProductList);

	}


	private static function products_category_list($_category_id)
	{
		$args =
		[
			'cat_id' => $_category_id,
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];

		$myProductList  = \lib\app\product\search::variant_list(null, $args);
		$filter_message = \lib\app\product\search::filter_message();
		$isFiltered     = \lib\app\product\search::is_filtered();

		\content_api\v1::say($myProductList);
	}
}
?>