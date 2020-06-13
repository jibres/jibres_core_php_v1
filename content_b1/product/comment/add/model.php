<?php
namespace content_b1\product\comment\add;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$post =
		[
			'content'    => \content_b1\tools::input_body('content'),
			'star'       => \content_b1\tools::input_body('star'),
			'product_id' => $id,
		];

		$result = \lib\app\product\comment::add($post);

		\content_b1\tools::say($result);

	}


}
?>