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

		$view_all_link = \dash\url::kingdom(). '/n';

		if(!\content_site\utility::fill_by_default_data())
		{
			$line_detail =
			[
				'tag_id'            => a($_args, 'post_tag'),
				'subtype'           => a($_args, 'post_template'),
				'limit'             => a($_args, 'count'),
				'post_show_author'  => a($_args, 'post_show_author'),
				'btn_viewall_check' => a($_args, 'btn_viewall_check'),
				'post_order'        => a($_args, 'post_order'),
			];

			$dataList = \dash\app\posts\load::sitebuilder_template($line_detail);

			if(isset($dataList['list']) && is_array($dataList['list']))
			{
				$productList = $dataList['list'];
			}

			if(isset($dataList['link']))
			{
				$view_all_link = $dataList['link'];
			}

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
			$productList = \content_site\assemble\fill_default::product(a($_args, 'count'));
		}

		// send the view all link to every layout of product
		$_args['btn_viewall_link'] = $view_all_link;
		if(!a($_args, 'btn_viewall'))
		{
			$_args['btn_viewall'] = T_("View all");
		}


		$html             = '';


		$type      = a($_args, 'type');

		$namespace = sprintf('%s\%s\%s', __NAMESPACE__, 'html', $type);

		if(is_callable([$namespace, 'html']))
		{
			$html .= call_user_func_array([$namespace, 'html'],[$_args, $productList]);
		}

		return $html;
	}
}
?>