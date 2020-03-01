<?php
namespace content_v2\product;


class comment
{
	public static function route_add($_product_id)
	{
		if(\dash\request::is('post'))
		{
			$result = self::add_new_comment($_product_id);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}



	public static function route_get($_product_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_list($_product_id);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	private static function get_list($_product_id)
	{
		$result = \lib\app\product\comment::approved_of_product($_product_id);

		$detail = [];
		$detail['star'] =
		[
			'total'  => 4.5,
			'person' => 182,
			'1'      => 2,
			'2'      => 3,
			'3'      => 2,
			'4'      => 2,
			'5'      => 1,
		];
		$detail['list'] = $result;
		return $detail;
	}


	private static function add_new_comment($_product_id)
	{
		$post =
		[
			'content'    => \content_v2\tools::input_body('content'),
			'star'       => \content_v2\tools::input_body('star'),
			'product_id' => $_product_id,
		];

		$result = \lib\app\product\comment::add($post);
		return $result;
	}
}
?>