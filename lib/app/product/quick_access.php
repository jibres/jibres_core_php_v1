<?php
namespace lib\app\product;

class quick_access
{
	public static function sale_page()
	{
		$category_list = \lib\app\category\search::site_list();

		if(!$category_list || !is_array($category_list))
		{
			$category_list = [];
			$category_list[] =
			[
				'id'    => null,
				'title' => T_("Latest sale"),
				'slug'  => null,
				'desc'  => null,
				'file'  => null,
			];
		}

		$max_count_category = 10;
		$max_count_product  = 10;

		$new_list = [];

		foreach ($category_list as $key => $category)
		{
			$args =
			[
				'limit'      => $max_count_product,
				'pagination' => 'no',
			];

			if(a($category, 'id'))
			{
				$args['cat_id'] = $category['id'];
			}


			$search_product_by_category = search::list_in_sale(null, $args);
			if(!is_array($search_product_by_category))
			{
				$search_product_by_category = [];
			}

			$category_list[$key]['products'] = $search_product_by_category;

			if($search_product_by_category)
			{
				$new_list[] = $category_list[$key];
			}
		}

		return $new_list;
	}
}
?>
