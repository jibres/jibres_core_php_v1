<?php
namespace content_site\body\product;


class share
{
	public static function fit_for_blog(&$_args, &$productList)
	{
		$_args['post_show_image'] = a($_args, 'product_show_image');

		foreach ($productList as $key => $value)
		{
			$productList[$key]['link'] = a($value, 'url');
		}

	}
}
?>