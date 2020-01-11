<?php
namespace content_api\v1\product;


class comment
{
	public static function route_add($_product_id)
	{
		if(\dash\request::is('post'))
		{
			$result = self::add_new_comment($_product_id);
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function add_new_comment($_product_id)
	{
		$post =
		[
			'content'    => \content_api\v1::input_body('content'),
			'star'       => \content_api\v1::input_body('star'),
			'product_id' => $_product_id,
		];

		$result = \lib\app\product\comment::add($post);
		return $result;
	}
}
?>