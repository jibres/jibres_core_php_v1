<?php
namespace content_api\v2\products;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_api\v2::check_apikey();

		$dir_2 = \dash\url::dir(2);

		if($dir_2 !== 'products')
		{
			\content_api\v2::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$products_id = \dash\url::dir(3);

		if($dir_3 === 'list')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v2::invalid_url();
			}

			self::products_list();
		}
		else
		{
			\content_api\v2::invalid_url();
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

		\content_api\v2::say($myProductList);

	}
}
?>