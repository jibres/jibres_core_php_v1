<?php
namespace content_p\comment;

class model
{
	public static function post()
	{
		$post =
		[
			'product_id'      => \dash\request::post('id'),
			'star'    => \dash\request::post('star'),
			'content' => \dash\request::post('content'),
		];

		\lib\app\product\comment::add($post);

	}
}
?>