<?php
namespace content_a\setting\product\setting;


class model
{
	public static function post()
	{
		$ratio = \dash\request::post('ratio') ? \dash\request::post('ratio') : null;

		$post =
		[
			'default_pirce_list' => \dash\request::post('defaultpricelist'),
			'variant_product'    => \dash\request::post('variant_product'),
			'ratio'              => $ratio,

		];

		\lib\app\setting\set::product_setting($post);
	}
}
?>