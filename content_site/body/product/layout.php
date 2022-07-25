<?php
namespace content_site\body\product;


class layout
{


	/**
	 * Layout product html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$productList = [];
		$dataList = [];

		$view_all_link = \dash\url::kingdom(). '/search';

		if(!\content_site\utility::fill_by_default_data())
		{
			$line_detail =
			[
				'cat_id'               => a($_args, 'product_tag'),
				'limit'                => a($_args, 'count'),
				'website_order'        => a($_args, 'product_order'),

				// 'btn_viewall_check' => a($_args, 'btn_viewall_check'),
			];

			if(a($_args, 'product_filter_image') === true)
			{
				$line_detail['g'] = 'y';
			}

			$productList = \lib\app\product\search::website_product_search(null, $line_detail);

			if(a($_args, 'product_tag'))
			{
				$view_all_link .= '?catid='. $_args['product_tag'];
			}
			// if(isset($dataList['list']) && is_array($dataList['list']))
			// {
			// 	$productList = $dataList['list'];
			// }

			// if(isset($dataList['link']))
			// {
			// 	$view_all_link = $dataList['link'];
			// }

			if(!is_array($productList))
			{
				// error
				// it will not happend because we fill it in all conditions
				$productList = [];
			}
		}

		// fill_default_data receive from preview function
		if(empty($productList) || \content_site\utility::fill_by_default_data())
		{
			$productList = self::fill_default(a($_args, 'count'), a($_args, 'preview_mode'));
		}

		// send the view all link to every layout of product
		$_args['btn_viewall_link'] = $view_all_link;
		if(!a($_args, 'btn_viewall'))
		{
			$_args['btn_viewall'] = T_("View all");
		}


		$html             = '';


		$model      = a($_args, 'model');


		if($model === 'p1' || $model === 'p2')
		{
			share::fit_for_blog($_args, $productList);
		}

		return \content_site\call_function::final_html(__NAMESPACE__, a($_args, 'model'), $_args, $productList);
	}



	public static function fill_default($_count, $_preview_mode = true)
	{
		if(!is_numeric($_count))
		{
			$_count = 1;
		}

		$list = [];
		for ($i=1; $i <= $_count ; $i++)
		{
			$list[] = self::get_one_random_product($i, $_preview_mode);
		}

		return $list;
	}




	private static function get_one_random_product($i, $_preview_mode)
	{

		if($_preview_mode || \dash\url::subdomain() === 'demo')
		{
			$img = \dash\sample\img::static_image();
		}
		else
		{
			$img = \dash\app::static_image_url();
		}

		return
		[
			'title'         => T_("Your product’s title"),
			'excerpt'       => T_("Your business hasn't published any products yet."),
			'thumb'         => $img,
			'price'         => rand(1, 90) * 1000,

		];
	}
}
?>