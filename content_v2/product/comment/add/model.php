<?php
namespace content_v2\product\comment\add;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$post =
		[
			'content'    => \content_v2\tools::input_body('content'),
			'star'       => \content_v2\tools::input_body('star'),
			'product_id' => $id,
		];

		$result = \lib\app\product\comment::add($post);

		\content_v2\tools::say($result);

	}


}
?>