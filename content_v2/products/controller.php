<?php
namespace content_v2\products;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_v2\tools::apikey_required();

		$dir_2 = \dash\url::dir(2);

		if($dir_2 !== 'products')
		{
			\content_v2\tools::invalid_url();
		}


		$dir_3 = \dash\url::dir(3);
		$products_id = \dash\url::dir(3);


		if($dir_3 === 'list' || $dir_3 === 'search')
		{
			if(\dash\url::dir(4))
			{
				\content_v2\tools::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_v2\tools::invalid_method();
			}

			self::products_list();
		}
		elseif($dir_3 === 'category')
		{
			$category_id = \dash\url::dir(4);
			if(!$category_id || !is_numeric($category_id) || intval($category_id) < 0 || \dash\number::is_larger($category_id, 9999999999))
			{
				\content_v2\tools::invalid_url();
			}

			if(\dash\url::dir(5))
			{
				\content_v2\tools::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_v2\tools::invalid_method();
			}

			self::products_category_list($category_id);
		}
		elseif($dir_3 === 'collection')
		{
			$category_id = \dash\url::dir(4);
			if(!$category_id || !is_numeric($category_id) || intval($category_id) < 0 || \dash\number::is_larger($category_id, 9999999999))
			{
				\content_v2\tools::invalid_url();
			}

			if(\dash\url::dir(5))
			{
				\content_v2\tools::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_v2\tools::invalid_method();
			}

			self::products_category_list($category_id);
		}
		elseif($dir_3 === 'company')
		{
			$company_id = \dash\url::dir(4);
			if(!$company_id || !is_numeric($company_id) || intval($company_id) < 0 || \dash\number::is_larger($company_id, 9999999999))
			{
				\content_v2\tools::invalid_url();
			}

			if(\dash\url::dir(5))
			{
				\content_v2\tools::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_v2\tools::invalid_method();
			}

			self::products_company_list($company_id);
		}
		else
		{
			\content_v2\tools::invalid_url();
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

		$search_query = \dash\request::get('q');

		$myProductList  = \lib\app\product\search::variant_list($search_query, $args);
		$filter_message = \lib\app\product\search::filter_message();
		$isFiltered     = \lib\app\product\search::is_filtered();

		\content_v2\tools::say($myProductList);

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

		\content_v2\tools::say($myProductList);
	}


	private static function products_company_list($_company_id)
	{
		$args =
		[
			'company_id' => $_company_id,
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];

		$myProductList  = \lib\app\product\search::variant_list(null, $args);
		$filter_message = \lib\app\product\search::filter_message();
		$isFiltered     = \lib\app\product\search::is_filtered();

		\content_v2\tools::say($myProductList);
	}
}
?>